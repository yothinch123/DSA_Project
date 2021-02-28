<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_Controller extends CI_Controller
{

  public function index()
  {
    $data['title'] = '';
    $this->load->view('_layout/header', $data);
    $this->load->view('_layout/sidebar', $data);
    $this->load->view('_layout/topbar', $data);
    $this->load->view('core/dashboard', $data);
    $this->load->view('_layout/footer');
  }
}
