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

    public function count_active_tasks_by_user($user_id) {
        return $this->db
                    ->where('user_id', $user_id)
                    ->where('is_active', 1)
                    ->count_all_results('tasks');
    }

    public function get_paginated_tasks_by_user($user_id, $limit, $start) {
        $this->db->where('user_id', $user_id);
        $this->db->where('is_active', 1);
        $this->db->order_by('due_date', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get('tasks');
        return $query->result();
    }

    public function get_tasks_by_user($user_id) {
    return $this->db
                ->where('user_id', $user_id)
                ->where('is_active', 1)
                ->get('tasks')
                ->result();
    }

    public function get_task_by_id_and_user($task_id, $user_id) {
        $this->db->where('id', $task_id);
        $this->db->where('user_id', $user_id);
        $this->db->where('is_active', 1);
        $query = $this->db->get('tasks');
        return $query->row();
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
        $this->db->where('user_id IS NULL'); 
        $this->db->order_by('category', 'ASC');
        $query = $this->db->get('categories');
        return $query->result();
    }
    public function get_tasks_for_due_date_alert($user_id, $days_until_due = 3) {
        $today = date('Y-m-d');
        $due_soon_start_date = date('Y-m-d', strtotime("+1 day"));
        $due_soon_end_date = date('Y-m-d', strtotime("+$days_until_due days")); 

        $this->db->where('user_id', $user_id);
        $this->db->where('is_active', 1);
        $this->db->where('status !=', 'completed');

        $this->db->group_start();
        $this->db->where('due_date <', $today); 

        $this->db->or_where('due_date BETWEEN "' . $due_soon_start_date . '" AND "' . $due_soon_end_date . '"');
        $this->db->group_end();

        $this->db->order_by('due_date', 'ASC');
        $this->db->order_by('due_time', 'ASC');
        $query = $this->db->get('tasks');
        return $query->result();
    }
}