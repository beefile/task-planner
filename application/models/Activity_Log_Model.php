<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_log_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function log_activity($user_id, $activity_type) {
        $data = [
            'user_id'       => $user_id,
            'activity_type' => $activity_type,
        ];

        return $this->db->insert('activity_log', $data);
    }
}