<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('LoginModel');
  }

  public function check_login()
  {
    $file_input = [];
    $file_input = json_decode(file_get_contents("php://input"));
    $username = $file_input->username;
    $password = $file_input->password;

    $result = $this->LoginModel->checkLoginBy($username);
    $password_hash = $result->password;
    if (password_verify($password, $password_hash)) {

      // $ssn = $data['ssn'];
      // $fname = $data['fname'];
      // $lname = $data['lname'];
      // $sesdata = array(
      //   'ssn'          => $ssn,
      //   'fname'        => $fname,
      //   'lname'        => $lname,
      // );
      // $this->session->set_userdata($sesdata);

      echo true;
    } else {
      echo false;
    }
  }
}
