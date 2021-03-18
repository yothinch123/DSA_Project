<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmployeeController extends CI_Controller

{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('EmployeeModel');
  }
  public function getEmployeeBy()
  {
    $result = $this->EmployeeModel->getEmployeeBy();
    echo json_encode($result);
  }

  public function getEmployeeByCode()
  {
  }

  public function insertEmployee()
  {
    $file_input = [];
    $file_input = json_decode(file_get_contents("php://input"));
    // if (count($file_input) > 0) {
    $data = array(
      'fname'  =>  $file_input->fname,
      'lname' => $file_input->lname,
      'ssn'  => $file_input->ssn,
      'phone'  => $file_input->phone,
      'username' => $file_input->username,
      'password'  => $file_input->password,
      'jobtitle'  => $file_input->jobtitle,
    );
    // }
    // $result = true;
    $result = $this->EmployeeModel->insertEmployee($data);
    if ($result) {
      echo "successsss11";
    } else {
      echo "faillll";
    }
  }

  public function updateEmployee()
  {
  }

  public function deleteEmployee()
  {
  }
}