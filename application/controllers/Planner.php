<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Manila'); 

class Planner extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Planner_model');
        $this->load->model('User_model');
        $this->load->model('Task_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
        $this->load->model('Activity_Log_Model');
    }

    public function view($page = 'home') {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }

        $data = [];
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);

        if ($page === 'home') {
            $today = date('Y-m-d');
            $data['today_tasks'] = $this->Task_model->get_tasks_by_date($user_id, $today);

            $total_tasks = $this->Task_model->count_tasks_by_user($user_id);
            $completed = $this->Task_model->count_tasks_by_status($user_id, 'completed');
            $pending = $this->Task_model->count_tasks_by_status($user_id, 'pending');
            $in_progress = $this->Task_model->count_tasks_by_status($user_id, 'in-progress');

            $data['overall_tasks_count'] = $total_tasks;
            $data['completed_tasks_count'] = $completed;

            $total_safe = $total_tasks ?: 1;

            $data['percent_pending'] = round(($pending / $total_safe) * 100);
            $data['percent_in_progress'] = round(($in_progress / $total_safe) * 100);
            $data['percent_completed'] = round(($completed / $total_safe) * 100);

            $categories = $this->Task_model->get_all_categories();
            $data['categories'] = $categories;

            $categoryMap = [];
            foreach ($categories as $cat) {
                $categoryMap[$cat->id] = $cat->category;
            }
            $data['categoryMap'] = $categoryMap;

            $data['alert_tasks'] = $this->Task_model->get_tasks_for_due_date_alert($user_id, 3);
        }

        if ($page === 'progress') {
            $data['tasks'] = $this->Task_model->get_tasks_by_user($user_id);
            $data['categories'] = $this->Task_model->get_all_categories();
            $categoryMap = [];
            foreach ($data['categories'] as $cat) {
                $categoryMap[$cat->id] = $cat->category;
            }
            $data['categoryMap'] = $categoryMap;
        }
        if ($user_id) {
            $this->Activity_Log_Model->log_activity($user_id, 'task_read');
        }

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', ['active' => $page]);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');
    }

    public function login_action() {
        $username = $this->input->post('username',true);
        $password = $this->input->post('password',true);

        $user = $this->Planner_model->get_user_by_username($username);

        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata('user_id', $user->ID);
            $this->Activity_Log_Model->log_activity($user->ID, 'login');
            redirect('home');
        } else {
            $this->session->set_flashdata('error', 'Invalid login credentials.');
            redirect('login');
        }
    }

    public function logout() {
        $user_id = $this->session->userdata('user_id');

        $this->session->sess_destroy();


        if ($user_id) { 
            $this->Activity_Log_Model->log_activity($user_id, 'logout');
        }
        redirect('login');
    }

    public function signup() {
        $this->load->view('templates/header');
        $this->load->view('auth/signup');
        $this->load->view('templates/footer');
    }
    public function signup_action() {
        $first_name = $this->input->post('first_name', true);
        $last_name = $this->input->post('last_name', true);
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $security_question = $this->input->post('security_question', true);
        $security_answer = $this->input->post('security_answer', true);

        if ($this->Planner_model->email_exists($email)) {
            $this->session->set_flashdata('error', 'Email already exists.');
            redirect('signup');
        }

        $data = [
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'email'      => $email,
            'password'   => password_hash($password, PASSWORD_DEFAULT),
            'security_question' => $security_question,
            'security_answer'   => password_hash($security_answer, PASSWORD_DEFAULT)
        ];

        $new_user_id = $this->Planner_model->insert_user($data);
        if ($new_user_id) {
            $this->session->set_flashdata('success', 'Account created successfully! You can now log in.');
            $this->Activity_Log_Model->log_activity($new_user_id, 'user_registered');
            redirect('login');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
            redirect('signup');
        }
    }

    public function login() {
        $this->load->view('templates/header');
        $this->load->view('auth/login');
        $this->load->view('templates/footer');
    }

    public function check_email_exists() {
        $email = $this->input->post('email',true);
        $this->load->model('User_model');
        $exists = $this->User_model->email_exists($email);

        echo json_encode(['exists' => $exists]);
    }

    public function get_tasks_for_date($date) {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        $user_id = $this->session->userdata('user_id');


        $tasks = $this->Task_model->get_tasks_by_date($user_id, $date);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($tasks));
    }
}