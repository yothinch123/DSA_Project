<?php

class ReportModel extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function fetch_report_by_hour()
  {
    $sql = "SELECT total FROM tbl_hour";

    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function fetch_report_by_day()
  {
    $sql = "SELECT * FROM tbl_day";

    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function fetch_report_by_week()
  {
    $sql = "SELECT * FROM tbl_week";

    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function fetch_report_by_month()
  {
    $sql = "SELECT * FROM tbl_month";

    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function fetch_report_by_year()
  {
    $sql = "SELECT * FROM tbl_year";

    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function fetch_report_by_old_cust()
  {
    $sql = "SELECT COUNT(id) as total, ssn 
    FROM customer_register 
    GROUP BY ssn 
    ";

    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function fetch_report_by_custom($data)
  {
    extract($data);
    $sql = "SELECT COUNT(id) as total, DATE(register_time) AS register_time  
    FROM customer_register
    WHERE register_time BETWEEN '$date_start' AND '$date_end'
    GROUP BY day(register_time), month(register_time), year(register_time) 
    ORDER BY register_time ASC
    ";

    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function fetch_report_total_by()
  {
    $sql = "SELECT COUNT(id) as total
    FROM customer_register 
    GROUP BY hour(register_time)
    ";

    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function round_report_day()
  {
    $sql1 = "TRUNCATE TABLE tbl_day";
    $sql2 = "INSERT INTO tbl_day (time,total)
    SELECT  DATE(register_time) , COUNT(id)
    FROM customer_register 
    GROUP BY day(register_time), month(register_time), year(register_time) 
    ORDER BY register_time ASC
    ";

    $sql = [];
    array_push($sql, $sql1, $sql2);
    for ($i = 0; $i < 2; $i++) {
      $query = $this->db->query($sql[$i]);
    }

    if ($query) {
      return true;
    } else {
      return false;
    }
  }

  public function round_report_week()
  {
    $sql1 = "TRUNCATE TABLE tbl_week";
    $sql2 = "INSERT INTO tbl_week (time,total)
    SELECT FROM_DAYS(TO_DAYS(register_time) -MOD(TO_DAYS(register_time) -1, 7)) , COUNT(id)
    FROM customer_register
    GROUP BY FROM_DAYS(TO_DAYS(register_time) -MOD(TO_DAYS(register_time) -1, 7))
    ORDER BY FROM_DAYS(TO_DAYS(register_time) -MOD(TO_DAYS(register_time) -1, 7))
    ";

    $sql = [];
    array_push($sql, $sql1, $sql2);
    for ($i = 0; $i < 2; $i++) {
      $query = $this->db->query($sql[$i]);
    }

    if ($query) {
      return true;
    } else {
      return false;
    }
  }

  public function round_report_month()
  {
    $sql1 = "TRUNCATE TABLE tbl_month";
    $sql2 = "INSERT INTO tbl_month (time,total)
    SELECT CONCAT(year(register_time),'-', LPAD(month(register_time),2,'0')) , COUNT(id) 
    FROM customer_register 
    GROUP BY month(register_time), year(register_time) 
    ORDER BY year(register_time),month(register_time) ASC
    ";

    $sql = [];
    array_push($sql, $sql1, $sql2);
    for ($i = 0; $i < 2; $i++) {
      $query = $this->db->query($sql[$i]);
    }

    if ($query) {
      return true;
    } else {
      return false;
    }
  }

  public function round_report_year()
  {
    $sql1 = "TRUNCATE TABLE tbl_year";
    $sql2 = "INSERT INTO tbl_year (time,total)
    SELECT year(register_time) , COUNT(id)  
    FROM customer_register 
    GROUP BY year(register_time) 
    ORDER BY year(register_time) ASC
    ";

    $sql = [];
    array_push($sql, $sql1, $sql2);
    for ($i = 0; $i < 2; $i++) {
      $query = $this->db->query($sql[$i]);
    }

    if ($query) {
      return true;
    } else {
      return false;
    }
  }
 
}
