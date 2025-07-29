<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Task_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
    }

    public function update_task($task_id, $task_data) {
        $this->db->where('id', $task_id); // ✅ 'id', not 'task_id'
        $this->db->update('tasks', $task_data);
    }


    
    public function index() {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }

        $user_id = $this->session->userdata('user_id');
        $data['tasks'] = $this->Task_model->get_tasks_by_user($user_id);

        // Get categories and create a map
        $categories = $this->Task_model->get_categories_by_user($user_id);
        $categoryMap = [];
        foreach ($categories as $cat) {
            $categoryMap[$cat->id] = $cat->category;
        }

        $data['categories'] = $categories;
        $data['categoryMap'] = $categoryMap;

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

        $taskData = [
            'user_id'     => $user_id,
            'title'       => $this->input->post('title'),
            'due_date'    => $this->input->post('due_date'),
            'due_time'    => $this->input->post('due_time'), // ✅ fix
            'description' => $this->input->post('description'), // ✅ fix
            'category_id' => $this->input->post('category_id') ?? null,
            'checklist_items' => null,
            'repeat_type' => $this->input->post('repeat_type') ?? 'none',
            'repeat_days' => null,
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        if (empty($taskData['title'])) {
            echo json_encode(['status' => 'error', 'message' => 'Task title is required.']);
            exit();
        }

        if (!is_numeric($taskData['category_id']) && $taskData['category_id'] !== null) {
            $taskData['category_id'] = null;
        }

        $allowed_repeat_types = ['none', 'daily', 'weekly', 'custom'];
        if (!in_array($taskData['repeat_type'], $allowed_repeat_types)) {
            $taskData['repeat_type'] = 'none';
        }

        if ($taskData['repeat_type'] === 'custom') {
            $custom_days = $this->input->post('custom_days');
            if (is_array($custom_days) && count($custom_days) > 0) {
                $taskData['repeat_days'] = implode(',', $custom_days);
            }
        }

        // Insert or Update logic
        if ($task_id) {
            // Update existing task
            $updated = $this->Task_model->update_task($task_id, $taskData);
            if ($updated) {
                $response = ['status' => 'success', 'message' => 'Task updated successfully.', 'task_id' => $task_id];
            } else {
                $response = ['status' => 'error', 'message' => 'Failed to update task.'];
            }
        } else {
            // Insert new task
            $taskData['status'] = 'pending';
            $taskData['created_at'] = date('Y-m-d H:i:s');

            $new_task_id = $this->Task_model->insert_task($taskData);
            if ($new_task_id) {
                $response = ['status' => 'success', 'message' => 'Task added successfully.', 'task_id' => $new_task_id];
            } else {
                $response = ['status' => 'error', 'message' => 'Failed to add task.'];
            }
        }

        // Respond with JSON or fallback
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
        $this->Task_model->delete_task($id, $user_id); // soft delete here
        $this->session->set_flashdata('error', 'Task deleted successfully.');
        redirect('task');
    }

public function update_status($task_id) {
    $status = $this->input->post('status');

    log_message('debug', 'Received status: ' . $status);

    if (!in_array($status, ['pending', 'completed', 'in-progress'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid status value: ' . $status]);
        return;
    }

    $this->Task_model->update_task($task_id, ['status' => $status]);
    echo json_encode(['success' => true]);
}


}
