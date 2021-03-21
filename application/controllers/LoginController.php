<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
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

    $result = $this->LoginModel->checkLoginBy($username);
    $password_hash = $result->password;

    if (password_verify($password, $password_hash)) {
      $data = $this->EmployeeModel->getEmployeeByCode($result->id);

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
  public function logout()
  {
    $this->session->sess_destroy();
    echo true;
  }
}
