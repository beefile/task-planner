<?php
class Task_model extends CI_Model {

    public function insert_task($data) {
        $this->db->insert('tasks', $data);
        return $this->db->insert_id();
    }

    public function update_task($task_id, $data) {
        $this->db->where('id', $task_id);
        return $this->db->update('tasks', $data);
    }


    public function delete_task($task_id, $user_id) {
        return $this->db->delete('tasks', ['id' => $task_id, 'user_id' => $user_id]);
    }

    public function get_tasks_by_user($user_id) {
        return $this->db
                    ->where('user_id', $user_id)
                    ->get('tasks')
                    ->result();
    }

    public function get_tasks_by_date($user_id, $date) {
        $this->db->where('user_id', $user_id);
        $this->db->where('DATE(due_date)', $date);
        return $this->db->get('tasks')->result_array();
    }

    public function count_tasks_by_user($user_id) {
        return $this->db->where('user_id', $user_id)->count_all_results('tasks');
    }

    public function count_tasks_by_status($user_id, $status) {
        return $this->db
                    ->where('user_id', $user_id)
                    ->where('status', $status)
                    ->count_all_results('tasks');
    }

    public function get_recent_tasks_by_user($user_id, $limit = 5) {
        return $this->db
                    ->where('user_id', $user_id)
                    ->order_by('created_at', 'DESC')
                    ->limit($limit)
                    ->get('tasks')
                    ->result();
    }
    public function get_categories_by_user($user_id) {
        return $this->db->get('categories')->result(); 
    }

    public function get_all_categories() {
        $query = $this->db->get('categories');
        return $query->result();
    }


}
