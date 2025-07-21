<?php
class Planner_model extends CI_Model {

    public function get_user_by_username($username) {
        return $this->db->get_where('users', ['email' => $username])->row();
    }

    public function email_exists($email) {
        return $this->db->get_where('users', ['email' => $email])->num_rows() > 0;
    }

    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

}
