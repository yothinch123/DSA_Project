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
    $this->db->insert('employee', $data);
    return true;
  }

  function deleteEmployee($data)
  {
    $this->db->where('id', $data);
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
