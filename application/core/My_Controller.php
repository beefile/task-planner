<?php
defined('BASEPATH') OR exit('No direct script access allowed');


date_default_timezone_set('Asia/Manila');

class My_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
    }

    protected function render($middle, $data = []) {
    $this->data['header'] = $this->load->view('templates/header', [], TRUE);
    $this->data['sidebar'] = $this->load->view('templates/sidebar', ['active' => 'task'], TRUE);
    $this->data['content'] = $this->load->view($middle, $data, TRUE);
    $this->data['footer'] = $this->load->view('templates/footer', [], TRUE);
    $this->load->view('templates/layout', $this->data);
    }

    protected function renderwithoutsidebar($middle, $data = []) {
        $this->data['header'] = $this->load->view('templates/header', [], TRUE);
        $this->data['content'] = $this->load->view($middle, $data, TRUE);
        $this->data['footer'] = $this->load->view('templates/footer', [], TRUE);
        $this->load->view('templates/layout_without_sidebar', $this->data);
    }
}