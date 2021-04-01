<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model('LoginModel');
    $this->load->model('EmployeeModel');
  }

  public function check_login()
  {
    $file_input = json_decode(file_get_contents("php://input"));
    $username = $file_input->username;
    $password = $file_input->password;

    $result = $this->LoginModel->check_login_by($username);
    $password_hash = $result->password;

    if (password_verify($password, $password_hash)) {
      $data = $this->EmployeeModel->fetch_employee_by_code($result->id);

      $this->createLoginLog($data->username);
      $sesdata = array(
        'id'       =>  $data->id,
        'ssn'      =>  $data->ssn,
        'fname'    =>  $data->fname,
        'lname'    =>  $data->lname,
        'username' =>  $data->username,
        'phone'    =>  $data->phone,
        'jobtitle' =>  $data->jobtitle,
      );
      $this->session->set_userdata($sesdata);
      echo true;
    } else {
      echo false;
    }
  }

  public function createLoginLog($username)
  {
    $data = array(
      'id' => session_id(),
      'username_emp' => $username,
    );
    $this->LoginModel->insert_login_log($data);
  }

  public function updateLoginLog()
  {
    $username = $this->session->userdata('username');
    $this->LoginModel->update_login_log($username);
  }

  public function logout()
  {
    $this->updateLoginLog();
    $this->session->sess_destroy();
    echo true;
  }
}
