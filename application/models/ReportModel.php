<?php

class ReportModel extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }


  public function fetch_report()
  {
    $sql = "SELECT `register_time` FROM customer_register GROUP BY `register_time` ORDER BY `register_time` ASC";
    // $sql = "SELECT COUNT(id) as total, `register_time` FROM customer_register GROUP BY `register_time` ORDER BY `register_time` ASC";

    $query = $this->db->query($sql);
    return $query->result();
  }

  public function fetch_report_by_day()
  {
    $sql = "SELECT COUNT(id) as total, `register_time` FROM customer_register GROUP BY day(register_time), month(register_time), year(register_time) ORDER BY `register_time` ASC";


    $query = $this->db->query($sql);
    return $query->result();
  }

  public function fetch_report_by_we()
  {
    $sql = "SELECT COUNT(id) as total, `register_time` FROM customer_register GROUP BY WEEKOFYEAR(`register_time`)";

    $query = $this->db->query($sql);
    return $query->result();
  }

  public function fetch_report_by_mo()
  {
    $sql = "SELECT COUNT(id) as total, `register_time` FROM customer_register GROUP BY month(register_time), year(register_time) ORDER BY `register_time` ASC";

    $query = $this->db->query($sql);
    return $query->result();
  }

  public function fetch_report_by_year()
  {
    $sql = "SELECT COUNT(id) as total, `register_time` FROM customer_register GROUP BY year(register_time) ORDER BY `register_time` ASC";

    $query = $this->db->query($sql);
    return $query->result();
  }

  public function fetch_report_by_old_cust()
  {
    $sql = "SELECT COUNT(id) as total, `ssn` FROM customer_register GROUP BY `ssn` ";

    $query = $this->db->query($sql);
    return $query->result();
  }

  public function record_count($keyword)
  {
    //$this->db->like('date',$keyword);
    //SELECT SUM(deposits) as total FROM booksdetail GROUP BY `date`
    $this->db->from('customer_register');
    return $this->db->count_all_results();
  }
  public function all_customer()
  {
    $sql = "SELECT COUNT(id) as total FROM customer_register  ";
    $query = $this->db->query($sql);
    return $query->result();
  }
}
