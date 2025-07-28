<?php
class User_model extends CI_Model {

    public function get_user_by_id($id) {
    return $this->db->get_where('users', ['ID' => $id])->row();
}

public function email_exists($email) {
    $this->db->where('email', $email);
    $query = $this->db->get('users');

    return $query->num_rows() > 0;
}

}
