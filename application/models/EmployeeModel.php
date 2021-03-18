<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class EmployeeModel extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  function getEmployeeBy()
  {
    $sql = "SELECT * 
    FROM employee";

    $query = $this->db->query($sql);
    return $query->result();
  }

  function getEmployeeByCode($data)
  {
    $sql = "SELECT * 
    FROM employee
    WHERE ssn = '$data'";

    $query = $this->db->query($sql);
    return $query->result();
  }

  function insertEmployee($data)
  {
    $query =  $this->db->insert('employee', $data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }

  function deleteEmployee($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('employee');
    return true;
  }

  function updateEmployee($data)
  {
    extract($data);
    $this->db->where('ssn', $ssn);
    $this->db->update('employee', $data);
    return true;
  }
}
