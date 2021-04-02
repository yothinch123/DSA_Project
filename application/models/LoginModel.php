<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginModel extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  function check_login_by($username)
  {
    $this->db->where('username', $username);
    $query = $this->db->get('employee');
    return $query->row();
  }

  function insert_login_log($data)
  {
    extract($data);
    $sql = "INSERT INTO employee_login (
    id,
    username_emp,
    login_time,
    logout_time,
    details
    ) VALUES (
    '$id', 
    '$username_emp', 
    now(),
    '',
    ''
    )";

    $query = $this->db->query($sql);
    return $query;
  }

  function update_login_log($username)
  {
    $sql = "UPDATE employee_login SET 
    logout_time = now() 
    WHERE username_emp = '$username' 
    AND logout_time = '0000-00-00 00:00:00'
    ";

    $this->db->query($sql);
  }
}
