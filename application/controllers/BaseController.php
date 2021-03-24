<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BaseController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('EmployeeModel');
    $this->load->helper('url');
  }
  public function index()
  {
    $this->view_login();
  }

  public function loading()
  {
    $this->load->view('_layout/loading');
  }

  public function view_employee()
  {
    $this->load->view('_layout/header');
    $this->load->view('_layout/sidebar');
    $this->load->view('_layout/topbar');
    $this->load->view('employee/view.php');
    $this->load->view('_layout/footer');
  }

  public function view_user()
  {
    $this->load->view('_layout/header');
    $this->load->view('_layout/sidebar');
    $this->load->view('_layout/loading');
    $this->load->view('_layout/topbar');
    $this->load->view('user/index.php');
    $this->load->view('_layout/footer');
  }

  public function view_employee_insert()
  {
    $this->load->view('_layout/header');
    $this->load->view('_layout/sidebar');
    $this->load->view('_layout/topbar');
    $this->load->view('employee/insert.php');
    $this->load->view('_layout/footer');
  }

  public function view_employee_update()
  {
    $this->load->view('_layout/header');
    $this->load->view('_layout/sidebar');
    $this->load->view('_layout/topbar');
    $this->load->view('employee/update.php');
    $this->load->view('_layout/footer');
  }

  public function view_dashboard()
  {
    $this->load->view('_layout/header');
    $this->load->view('_layout/sidebar');
    $this->load->view('_layout/topbar');
    $this->load->view('dashboard/index.php');
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
    $this->load->view('_layout/header');
    $this->load->view('_layout/sidebar');
    $this->load->view('_layout/topbar');
    $this->load->view('statistics/index.php');
    $this->load->view('_layout/footer');
  }
}
