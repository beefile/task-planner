<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Task_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
    }

    public function update_status($task_id) {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return; // Stop execution
        }

        $input_data = json_decode($this->input->raw_input_stream, true);
        $new_status = $input_data['status'] ?? null;

        // Basic validation
        if ($task_id && $new_status && in_array($new_status, ['pending', 'completed', 'in-progress', 'cancelled'])) {
            $data = ['status' => $new_status];
            $result = $this->Task_model->update_task($task_id, $data);

            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Task status updated.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update task status in DB.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid task ID or status provided.']);
        }
        exit();
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
            // For AJAX requests, send JSON error. For regular POST, redirect.
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
                exit();
            }
            redirect('login');
        }

        $user_id = $this->session->userdata('user_id');
        $task_id = $this->input->post('id'); // This would be null for new tasks
        // Note: For 'save' from home.php, 'description' and 'checklist_items' will be null/empty
        // Only 'title', 'due_date', 'category_id' are sent.
        // 'status' will be 'pending' by default.

        // Filter allowed input fields for creation from home.php form
        $taskData = [
            'user_id'     => $user_id,
            'title'       => $this->input->post('title'),
            'due_date'    => $this->input->post('due_date'),
            'category_id' => $this->input->post('category_id') ?? null, // Default to null if not selected
            'status'      => 'pending', // New tasks start as pending
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
            'description' => null, // Not provided by home.php form
            'due_time'    => null, // Not provided by home.php form
            'checklist_items' => null // Not provided by home.php form
        ];

        // Basic validation
        if (empty($taskData['title'])) {
            echo json_encode(['status' => 'error', 'message' => 'Task title is required.']);
            exit();
        }

        // Ensure category_id is an integer or null
        if (!is_numeric($taskData['category_id']) && $taskData['category_id'] !== null) {
            $taskData['category_id'] = null; // Or handle as an error
        }


        $new_task_id = $this->Task_model->insert_task($taskData); // Changed from update_task as home.php only adds

        if ($new_task_id) {
            // For AJAX request, return JSON response
            if ($this->input->is_ajax_request()) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Task added successfully.',
                    'task_id' => $new_task_id // Return the new ID
                ]);
                exit();
            } else {
                // Fallback for non-AJAX POST (if any)
                $this->session->set_flashdata('success', 'Task added successfully.');
                redirect('task'); // Or wherever appropriate
            }
        } else {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => 'Failed to add task.']);
                exit();
            } else {
                $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
                redirect('task');
            }
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

}
