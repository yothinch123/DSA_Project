<?php

class ReportModel extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }


  public function fetch_report_by_hour()
  {
    $sql = "SELECT `register_time` FROM customer_register GROUP BY hour(register_time)";

    $query = $this->db->query($sql);
    return $query->result();
  }

  public function fetch_report_by_day()
  {
    $sql = "SELECT COUNT(id) as total, DATE(register_time) AS register_time FROM customer_register GROUP BY day(register_time), month(register_time), year(register_time) ORDER BY register_time ASC";


    $query = $this->db->query($sql);
    return $query->result();
  }

  public function fetch_report_by_we()
  {
    $sql = "SELECT FROM_DAYS(TO_DAYS(register_time) -MOD(TO_DAYS(register_time) -1, 7)) AS week_beginning, COUNT(id) AS total
            FROM customer_register
            GROUP BY FROM_DAYS(TO_DAYS(register_time) -MOD(TO_DAYS(register_time) -1, 7))
            ORDER BY FROM_DAYS(TO_DAYS(register_time) -MOD(TO_DAYS(register_time) -1, 7))";

    $query = $this->db->query($sql);
    return $query->result();
  }

  public function fetch_report_by_mo()
  {
    $sql = "SELECT COUNT(id) as total , CONCAT(year(register_time),'-', LPAD(month(register_time),2,'0')) AS register_time FROM customer_register GROUP BY month(register_time), year(register_time) ORDER BY year(register_time),month(register_time) ASC";

    $query = $this->db->query($sql);
    return $query->result();
  }

  public function fetch_report_by_year()
  {
    $sql = "SELECT COUNT(id) as total,  year(register_time) AS register_time FROM customer_register GROUP BY year(register_time) ORDER BY  year(register_time) ASC";

    $query = $this->db->query($sql);
    return $query->result();
  }

  public function fetch_report_by_old_cust()
  {
    $sql = "SELECT COUNT(id) as total, ssn FROM customer_register GROUP BY ssn ";

    $query = $this->db->query($sql);
    return $query->result();
  }
}
