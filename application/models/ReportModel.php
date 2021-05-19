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

  public function fetch_report_hist_cust()
  {
    $sql = "SELECT *
    FROM radcheck
    ";

    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function round_report_hour()
  {
    $hours = [
      '00:00:00', '01:00:00', '02:00:00', '03:00:00', '04:00:00', '05:00:00', '06:00:00', '07:00:00',
      '08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00', '14:00:00', '15:00:00',
      '16:00:00', '17:00:00', '18:00:00', '19:00:00', '20:00:00', '21:00:00', '22:00:00', '23:00:00'
    ];

    $sql_trunc = "TRUNCATE TABLE tbl_hour";
    $query_trunc = $this->db->query($sql_trunc);

    for ($i = 0; $i < count($hours); $i++) {
      $j = $i + 1;
      $sql = "INSERT INTO tbl_hour (total,time) VALUES
      ((SELECT COUNT(register_time)
      FROM customer_register 
      WHERE DATE_FORMAT(register_time, '%Y-%m-%d') = CURDATE() 
      AND DATE_FORMAT(register_time,'%H:%i:%s') BETWEEN '$hours[$i]'
      AND '$hours[$j]') ,'$hours[$i]')
      ";
      $query = $this->db->query($sql);
    }

    if ($query) {
      return true;
    } else {
      return false;
    }
  }

  public function round_report_day()
  {
    $sql_trunc = "TRUNCATE TABLE tbl_day";

    $sql = "INSERT INTO tbl_day (time,total)
    SELECT DATE(register_time) , COUNT(id)
    FROM customer_register 
    GROUP BY day(register_time), month(register_time), year(register_time) 
    ORDER BY register_time ASC
    ";

    $query_trunc = $this->db->query($sql_trunc);
    $query = $this->db->query($sql);

    if ($query && $query_trunc) {
      return true;
    } else {
      return false;
    }
  }

  public function round_report_week()
  {
    $sql_trunc = "TRUNCATE TABLE tbl_week";

    $sql = "INSERT INTO tbl_week (time,total)
    SELECT FROM_DAYS(TO_DAYS(register_time) -MOD(TO_DAYS(register_time) -1, 7)) , COUNT(id)
    FROM customer_register
    GROUP BY FROM_DAYS(TO_DAYS(register_time) -MOD(TO_DAYS(register_time) -1, 7))
    ORDER BY FROM_DAYS(TO_DAYS(register_time) -MOD(TO_DAYS(register_time) -1, 7))
    ";

    $query_trunc = $this->db->query($sql_trunc);
    $query = $this->db->query($sql);

    if ($query && $query_trunc) {
      return true;
    } else {
      return false;
    }
  }

  public function round_report_month()
  {
    $sql_trunc = "TRUNCATE TABLE tbl_month";

    $sql = "INSERT INTO tbl_month (time,total)
    SELECT CONCAT(year(register_time),'-', LPAD(month(register_time),2,'0')) , COUNT(id) 
    FROM customer_register 
    GROUP BY month(register_time), year(register_time) 
    ORDER BY year(register_time),month(register_time) ASC
    ";

    $query_trunc = $this->db->query($sql_trunc);
    $query = $this->db->query($sql);

    if ($query && $query_trunc) {
      return true;
    } else {
      return false;
    }
  }

  public function round_report_year()
  {
    $sql_trunc = "TRUNCATE TABLE tbl_year";

    $sql = "INSERT INTO tbl_year (time,total)
    SELECT year(register_time) , COUNT(id)  
    FROM customer_register 
    GROUP BY year(register_time) 
    ORDER BY year(register_time) ASC
    ";

    $query_trunc = $this->db->query($sql_trunc);
    $query = $this->db->query($sql);

    if ($query && $query_trunc) {
      return true;
    } else {
      return false;
    }
  }
}
