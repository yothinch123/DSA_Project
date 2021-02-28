<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Core_Controller extends CI_Controller
{

  public function index()
  {
    $data['title'] = '';
    $this->load->view('_layout/header', $data);
    $this->load->view('_layout/sidebar', $data);
    $this->load->view('_layout/topbar', $data);
    $this->load->view('core/view.dashboard.php', $data);
    $this->load->view('_layout/footer');
  }
  public function login()
  {
    $data['title'] = '';
    $this->load->view('_layout/auth-header', $data);
    $this->load->view('element/page/login.employee.php', $data);
    $this->load->view('_layout/auth-footers', $data);
  }
  public function index3()
  {
    $data['title'] = '';
    $this->load->view('_layout/header', $data);
    $this->load->view('_layout/sidebar', $data);
    $this->load->view('_layout/topbar', $data);
    $this->load->view('core/manage.wifi.php', $data);
    $this->load->view('_layout/footer');
  }
  public function index4()
  {
    $data['title'] = '';
    $this->load->view('_layout/header', $data);
    $this->load->view('_layout/sidebar', $data);
    $this->load->view('_layout/topbar', $data);
    $this->load->view('core/view.employee.php', $data);
    $this->load->view('_layout/footer');
  }
  public function index1()
  {
    $data['title'] = '';
    $this->load->view('_layout/header', $data);
    $this->load->view('_layout/sidebar', $data);
    $this->load->view('_layout/topbar', $data);
    $this->load->view('core/insert.employee.php', $data);
    $this->load->view('_layout/footer');
  }
  public function index2()
  {
    $data['title'] = '';
    $this->load->view('_layout/header', $data);
    $this->load->view('_layout/sidebar', $data);
    $this->load->view('_layout/topbar', $data);
    $this->load->view('core/view.statistics.php', $data);
    $this->load->view('_layout/footer');
  }
}
