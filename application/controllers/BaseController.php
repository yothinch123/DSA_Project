<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BaseController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('EmployeeModel');
  }
  public function index()
  {
    $this->load->view('_layout/header');
    $this->load->view('_layout/sidebar');
    $this->load->view('_layout/topbar');
    $this->load->view('employee/view.php');
    $this->load->view('_layout/footer');
  }
  public function view_employee()
  {
    $this->load->view('_layout/header');
    $this->load->view('_layout/sidebar');
    $this->load->view('_layout/topbar');
    $this->load->view('employee/view.php');
    $this->load->view('_layout/footer');
  }
  public function view_employee_insert()
  {
    $data['title'] = '';
    $this->load->view('_layout/header');
    $this->load->view('_layout/sidebar');
    $this->load->view('_layout/topbar');
    $this->load->view('employee/insert.php', $data);
    $this->load->view('_layout/footer');
  }

  public function view_employee_update()
  {
    $data['title'] = '';
    $this->load->view('_layout/header');
    $this->load->view('_layout/sidebar');
    $this->load->view('_layout/topbar');
    $this->load->view('employee/update.php', $data);
    $this->load->view('_layout/footer');
  }

  public function view_dashboard()
  {
    $data = '';
    $this->load->view('_layout/header');
    $this->load->view('_layout/sidebar');
    $this->load->view('_layout/topbar');
    $this->load->view('dashboard/index.php', $data);
    $this->load->view('_layout/footer');
  }
  public function view_login()
  {
    $this->load->view('_layout/header');
    $this->load->view('login/index.php');    
    $this->load->view('_layout/footer');

  }
  public function view_wifi_setting()
  {
    $this->load->view('_layout/header');
    $this->load->view('_layout/sidebar');
    $this->load->view('_layout/topbar');
    $this->load->view('wifi-setting/index.php');
    $this->load->view('_layout/footer');
  }
  public function view_statistics()
  {
    $data = '';
    $this->load->view('_layout/header');
    $this->load->view('_layout/sidebar');
    $this->load->view('_layout/topbar');
    $this->load->view('statistics/index.php', $data);
    $this->load->view('_layout/footer');
  }
}
