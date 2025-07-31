<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends My_Controller {

    public function forgot_password() {
        if ($this->input->post()) {
            $email = $this->input->post('email', true);
            $answer = $this->input->post('security_answer', true);
            $password = $this->input->post('password', true);
            $confirm_password = $this->input->post('confirm_password', true);

            $user = $this->db->get_where('users', ['email' => $email])->row();

            if (!$user) {
                $data['error'] = "Email not found.";
                return $this->load->view('auth/forgot_password', $data);
            }

            $selected_question = $this->input->post('security_question', true);

            if ($user->security_question !== $selected_question) {
                $data['error'] = "Security question does not match our records.";
                return $this->load->view('auth/forgot_password', $data);
            }

            if (!password_verify($answer, $user->security_answer)) {
                $data['error'] = "Incorrect security answer.";
                return $this->load->view('auth/forgot_password', $data);
            }


            if ($password !== $confirm_password) {
                $data['error'] = "Passwords do not match.";
                $data['security_question'] = $this->map_security_question($user->security_question);
                return $this->load->view('auth/forgot_password', $data);
            }

            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/', $password)) {
                $data['error'] = "Password must be 12+ characters with uppercase, lowercase, number & symbol.";
                $data['security_question'] = $this->map_security_question($user->security_question);
                return $this->load->view('auth/forgot_password', $data);
            }

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $this->db->update('users', ['password' => $hash], ['email' => $email]);

            $this->session->set_flashdata('message', "Password successfully reset. You can now log in.");
            redirect('/'); 

        } else {
            $this->load->view('auth/forgot_password');
        }
    }

    public function get_security_question_ajax() {
        $email = $this->input->post('email');
        $user = $this->db->get_where('users', ['email' => $email])->row();

        if ($user) {
            echo json_encode(['security_question' => $user->security_question]);
        } else {
            echo json_encode(['security_question' => '']);
        }
    }

    private function map_security_question($key) {
        $questions = [
            'birth_place' => 'Where were you born?',
            'childhood_street' => 'What street did you grow up on?',
            'fav_historical' => 'Who is your favorite historical figure?'
        ];
        return $questions[$key] ?? 'No question found';
    }

    public function login() {
        $this->load->view('auth/login');
    }
}
