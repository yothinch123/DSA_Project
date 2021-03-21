<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class EmployeeModel extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  function fetch_employee_By()
  {
    $query = $this->db->get('employee');
    return $query->result();
  }

  function fetch_employee_by_code($id)
  {
    $where_cond = array('id' => $id);
    $query =  $this->db->get_where('employee', $where_cond);

    return $query->row();
  }

  function insert_employee($data)
  {
    $query =  $this->db->insert('employee', $data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }

  function delete_employee_by($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('employee');
    return true;
  }

  function update_employee($data)
  {
    extract($data);
    $sql = "UPDATE employee SET 
    ssn = '$ssn',
    fname = '$fname',
    lname = '$lname',
    username = '$username', 
    phone = '$phone',
    jobtitle = '$jobtitle'
    WHERE id = '$id'
    ";

    $query = $this->db->query($sql);
    return $query;
  }

  function update_password_emp($data)
  {
    extract($data);

    $sql = "UPDATE employee SET 
    password = '$password' 
    WHERE id = '$id'
    ";

    $query = $this->db->query($sql);
    return $query;
  }
}
