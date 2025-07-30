<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Manila');

class Task extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Task_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
        $this->load->library('pagination');
        $this->load->model('Activity_Log_Model');
    }

    /*
    public function update_task($task_id, $task_data) {
        $this->db->where('id', $task_id);
        $this->db->update('tasks', $task_data);
    }
    */

    public function index() {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }

        $user_id = $this->session->userdata('user_id');

        $config['base_url'] = base_url('task/index');
        $config['total_rows'] = $this->Task_model->count_active_tasks_by_user($user_id);
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = '<div class="pagination-links">';
        $config['full_tag_close'] = '</div>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['cur_tag_open'] = '<a class="current-page">';
        $config['cur_tag_close'] = '</a>';
        $config['num_tag_open'] = '<span>';
        $config['num_tag_close'] = '</span>';
        $config['attributes'] = array('class' => 'pagination-link');

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['tasks'] = $this->Task_model->get_paginated_tasks_by_user($user_id, $config['per_page'], $page);

        $data['pagination_links'] = $this->pagination->create_links();

        $categories = $this->Task_model->get_all_categories();
        $data['categories'] = $categories;

        $categoryMap = [];
        foreach ($categories as $cat) {
            $categoryMap[$cat->id] = $cat->category;
        }
        $data['categoryMap'] = $categoryMap;

        if ($user_id) {
            $this->Activity_Log_Model->log_activity($user_id, 'task_read');
        }

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', ['active' => 'task']);
        $this->load->view('pages/task', $data);
        $this->load->view('templates/footer');
    }

    public function save() {
        if (!$this->session->userdata('user_id')) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
                exit();
            }
            redirect('login');
        }

        $user_id = $this->session->userdata('user_id');
        $task_id = $this->input->post('id');

        $raw_checklist_items = $this->input->post('checklist_items');
        $processed_checklist_items = [];
        if (is_array($raw_checklist_items)) {
            foreach ($raw_checklist_items as $item_text) {
                $item_text = trim($item_text);
                if (!empty($item_text)) {
                    $processed_checklist_items[] = ['item' => $item_text, 'completed' => false];
                }
            }
        }
        $checklist_json = !empty($processed_checklist_items) ? json_encode($processed_checklist_items) : null;

        $selected_category_id = $this->input->post('category_id');
        $final_category_id = null;
        $final_custom_category_name = null;

        $OTHER_CATEGORY_DB_ID = '4';

        if ($selected_category_id === $OTHER_CATEGORY_DB_ID) {
            $submitted_custom_name = trim($this->input->post('custom_category_name'));

            if (!empty($submitted_custom_name)) {
                $final_custom_category_name = $submitted_custom_name;
                $final_category_id = (int)$OTHER_CATEGORY_DB_ID;
            } else {
                $this->session->set_flashdata('error', 'Custom category name is required when selecting "Other".');
                if ($this->input->is_ajax_request()) {
                    echo json_encode(['status' => 'error', 'message' => 'Custom category name is required.']);
                    exit();
                }
                redirect('task');
            }
        } else {
            $final_category_id = empty($selected_category_id) ? null : (int)$selected_category_id;
            $final_custom_category_name = null;
        }

        $taskData = [
            'user_id'              => $user_id,
            'title'                => $this->input->post('title'),
            'due_date'             => $this->input->post('due_date'),
            'due_time'             => $this->input->post('due_time'),
            'description'          => $this->input->post('description'),
            'category_id'          => $final_category_id,
            'custom_category_name' => $final_custom_category_name,
            'checklist_items'      => $checklist_json,
            'repeat_type'          => $this->input->post('repeat_type') ?? 'none',
            'updated_at'           => date('Y-m-d H:i:s'),
        ];

        if ($taskData['repeat_type'] === 'custom') {
            $custom_days = $this->input->post('custom_days');
            if (is_array($custom_days) && count($custom_days) > 0) {
                $taskData['repeat_days'] = implode(',', $custom_days);
            } else {
                $taskData['repeat_days'] = null;
            }
        } else {
            $taskData['repeat_days'] = null;
        }

        if (empty($taskData['title'])) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => 'Task title is required.']);
                exit();
            }
            $this->session->set_flashdata('error', 'Task title is required.');
            redirect('task');
        }

        $allowed_repeat_types = ['none', 'daily', 'weekly', 'custom'];
        if (!in_array($taskData['repeat_type'], $allowed_repeat_types)) {
            $taskData['repeat_type'] = 'none';
        }

        if ($task_id) {
            $updated = $this->Task_model->update_task($task_id, $taskData);
            if ($updated) {
                $response = ['status' => 'success', 'message' => 'Task updated successfully.', 'task_id' => $task_id];
                $this->Activity_Log_Model->log_activity($user_id, 'task_updated');
            } else {
                $response = ['status' => 'error', 'message' => 'Failed to update task.'];
            }
        } else {
            $taskData['status'] = 'pending';
            $taskData['created_at'] = date('Y-m-d H:i:s');

            $new_task_id = $this->Task_model->insert_task($taskData);
            if ($new_task_id) {
                $response = ['status' => 'success', 'message' => 'Task added successfully.', 'task_id' => $new_task_id];
                $this->Activity_Log_Model->log_activity($user_id, 'task_created');
            } else {
                $response = ['status' => 'error', 'message' => 'Failed to add task.'];
            }
        }

        if ($this->input->is_ajax_request()) {
            echo json_encode($response);
            exit();
        } else {
            $this->session->set_flashdata($response['status'], $response['message']);
            redirect('task');
        }
    }

    public function delete($id) {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }

        $user_id = $this->session->userdata('user_id');

        if ($this->Task_model->delete_task($id, $user_id)) {
            $this->session->set_flashdata('success', 'Task deleted successfully.');
            $this->Activity_Log_Model->log_activity($user_id, 'task_deleted');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete task or task not found.');
        }
        redirect('task');
    }

    public function update_status($task_id) {
        if (!$this->input->is_ajax_request()) {
            echo json_encode(['success' => false, 'message' => 'Invalid request.']);
            return;
        }

        if (!$this->session->userdata('user_id')) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized.']);
            return;
        }

        $user_id = $this->session->userdata('user_id');
        $status = $this->input->post('status');

        log_message('debug', 'Received status: ' . $status . ' for task_id: ' . $task_id . ' by user_id: ' . $user_id);

        if (!in_array($status, ['pending', 'completed', 'in-progress'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid status value: ' . $status]);
            return;
        }

        $task = $this->Task_model->get_task_by_id_and_user($task_id, $user_id);

        if (!$task) {
            echo json_encode(['success' => false, 'message' => 'Task not found or not authorized.']);
            return;
        }

        $update_data = ['status' => $status, 'updated_at' => date('Y-m-d H:i:s')];

        if ($task->checklist_items) {
            try {
                $checklist = json_decode($task->checklist_items, true);
                if (is_array($checklist)) {
                    foreach ($checklist as &$item) {
                        $item['completed'] = ($status === 'completed');
                    }
                    $update_data['checklist_items'] = json_encode($checklist);
                }
            } catch (Exception $e) {
                log_message('error', 'Error processing checklist for status update for task ' . $task_id . ': ' . $e->getMessage());
            }
        }

        $updated = $this->Task_model->update_task($task_id, $update_data);

        if ($updated) {
            echo json_encode(['success' => true, 'message' => 'Task status and checklist (if any) updated.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update task status in DB.']);
        }
    }
}