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

  public function hashPassword($password)
  {
    return password_hash($password, PASSWORD_BCRYPT);
  }

  public function getEmployeeBy()
  {
    $result = $this->EmployeeModel->getEmployeeBy();
    echo json_encode($result);
  }

  public function getEmployeeByCode()
  {
    $file_input = [];
    $file_input = json_decode(file_get_contents("php://input"));
    $id = $file_input->id;
    $result = $this->EmployeeModel->getEmployeeByCode($id);
    if ($result) {
      echo json_encode($result);
    } else {
      echo false;
    }
  }

  public function insertEmployee()
  {
    $file_input = [];
    $file_input = json_decode(file_get_contents("php://input"));
    $password = $this->hashPassword($file_input->password); 
    $data = array(
      'fname'  =>  $file_input->fname,
      'lname' => $file_input->lname,
      'ssn'  => $file_input->ssn,
      'phone'  => $file_input->phone,
      'username' => $file_input->username,
      'password'  => $password,
      'jobtitle'  => $file_input->jobtitle,
    );
    $result = $this->EmployeeModel->insertEmployee($data);
    if ($result) {
      echo true;
    } else {
      echo false;
    }
  }

  public function updateEmployee()
  {
    $file_input = [];
    $file_input = json_decode(file_get_contents("php://input"));
    $data = array(
      'fname'  =>  $file_input->fname,
      'lname' => $file_input->lname,
      'ssn'  => $file_input->ssn,
      'phone'  => $file_input->phone,
      'username' => $file_input->username,
      'password'  => $file_input->password,
      'jobtitle'  => $file_input->jobtitle,
    );
    $result = $this->EmployeeModel->updateEmployee($data);
    if ($result) {
      echo true;
    } else {
      echo false;
    }
  }

  public function deleteEmployee()
  {
    $file_input = [];
    $file_input = json_decode(file_get_contents("php://input"));
    $id = $file_input->id;
    $result = $this->EmployeeModel->deleteEmployee($id);
    if ($result) {
      echo true;
    } else {
      echo false;
    }
  }
}
