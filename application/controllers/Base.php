<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Base extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('EmployeeModel');
    $this->load->library('session');
  }
  public function index()
  {
    $this->load->view('_layout/header');
    $this->load->view('_layout/topbar');
    $this->load->view('_layout/loading');
    $this->load->view('dashboard/index.php');
    $this->load->view('_layout/footer');
  }

  public function loading()
  {
    $this->load->view('_layout/loading');
  }

  public function view_employee()
  {
    if ($this->session->userdata('username')) {
      $this->load->view('_layout/header');
      $this->load->view('_layout/sidebar');
      $this->load->view('_layout/topbar');
      $this->load->view('_layout/loading');
      $this->load->view('employee/view.php');
      $this->load->view('_layout/footer');
    } else {
      $this->load->view('session/index.php');
    }
  }

  public function view_user()
  {
    if ($this->session->userdata('username')) {
      $this->load->view('_layout/header');
      $this->load->view('_layout/sidebar');
      $this->load->view('_layout/topbar');
      $this->load->view('_layout/loading');
      $this->load->view('user/index.php');
      $this->load->view('_layout/footer');
    } else {
      $this->load->view('session/index.php');
    }
  }

  public function view_employee_insert()
  {
    if ($this->session->userdata('username')) {
      $this->load->view('_layout/header');
      $this->load->view('_layout/sidebar');
      $this->load->view('_layout/topbar');
      $this->load->view('_layout/loading');
      $this->load->view('employee/insert.php');
      $this->load->view('_layout/footer');
    } else {
      $this->load->view('session/index.php');
    }
  }

  public function view_employee_update()
  {
    if ($this->session->userdata('username')) {
      $this->load->view('_layout/header');
      $this->load->view('_layout/sidebar');
      $this->load->view('_layout/topbar');
      $this->load->view('_layout/loading');
      $this->load->view('employee/update.php');
      $this->load->view('_layout/footer');
    } else {
      $this->load->view('session/index.php');
    }
  }

  public function view_dashboard()
  {
    if ($this->session->userdata('username')) {
      $this->load->view('_layout/header');
      $this->load->view('_layout/sidebar');
      $this->load->view('_layout/topbar');
      $this->load->view('_layout/loading');
      $this->load->view('dashboard/index.php');
      $this->load->view('_layout/footer');
    } else {
      $this->load->view('session/index.php');
    }
  }
  public function view_login()
  {
    $this->load->view('_layout/loading');
    $this->load->view('_layout/header');
    $this->load->view('login/index.php');
    $this->load->view('_layout/footer');
  }
  public function view_wifi_setting()
  {
    if ($this->session->userdata('username')) {
      $this->load->view('_layout/header');
      $this->load->view('_layout/sidebar');
      $this->load->view('_layout/topbar');
      $this->load->view('_layout/loading');
      $this->load->view('wifi-setting/index.php');
      $this->load->view('_layout/footer');
    } else {
      $this->load->view('session/index.php');
    }
  }
  public function view_statistics()
  {
    if ($this->session->userdata('username')) {
      $this->load->view('_layout/header');
      $this->load->view('_layout/sidebar');
      $this->load->view('_layout/topbar');
      $this->load->view('_layout/loading');
      $this->load->view('statistics/index.php');
      $this->load->view('_layout/footer');
    } else {
      $this->load->view('session/index.php');
    }
  }

  public function Export()
  {
    $this->load->view('statistics/report.php');
  }
}
