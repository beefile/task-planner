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
        return $this->db
                    ->where('id', $task_id)
                    ->where('user_id', $user_id)
                    ->update('tasks', ['is_active' => 0]);
    }

    public function get_tasks_by_user($user_id) {
    return $this->db
                ->where('user_id', $user_id)
                ->where('is_active', 1)
                ->get('tasks')
                ->result();
    }

    public function get_tasks_by_date($user_id, $date) {
    return $this->db
                ->where('user_id', $user_id)
                ->where('DATE(due_date)', $date)
                ->where('is_active', 1)
                ->get('tasks')
                ->result_array();
    }   

    public function count_tasks_by_status($user_id, $status) {
    return $this->db
                ->where('user_id', $user_id)
                ->where('status', $status)
                ->where('is_active', 1)
                ->count_all_results('tasks');
    }

    public function count_tasks_by_user($user_id) {
    return $this->db
                ->where('user_id', $user_id)
                ->where('is_active', 1)
                ->count_all_results('tasks');
}


    public function get_recent_tasks_by_user($user_id, $limit = 5) {
        return $this->db
                    ->where('user_id', $user_id)
                    ->where('is_active', 1)
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
