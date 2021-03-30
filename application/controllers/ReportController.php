<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReportController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ReportModel');
  }

  public function index()
  {
    $this->fetchReportByDay();
  }

  public function fetchReportByHour()
  {
    $result = $this->ReportModel->fetch_report_by_hour();

    if ($result) {
      echo json_encode($result);
    } else {
      return false;
    }
  }

  public function fetchReportByDay()
  {
    $result = $this->ReportModel->fetch_report_by_day();

    if ($result) {
      echo json_encode($result);
    } else {
      return false;
    }
  }

  public function fetchReportByWeek()
  {
    $result = $this->ReportModel->fetch_report_by_week();

    if ($result) {
      echo json_encode($result);
    } else {
      return false;
    }
  }

  public function fetchReportByMonth()
  {
    $result = $this->ReportModel->fetch_report_by_month();

    if ($result) {
      echo json_encode($result);
    } else {
      return false;
    }
  }

  public function fetchReportByYear()
  {
    $result = $this->ReportModel->fetch_report_by_year();

    if ($result) {
      echo json_encode($result);
    } else {
      return false;
    }
  }

  public function fetchReportByoldCust()
  {
    $result = $this->ReportModel->fetch_report_by_old_cust();

    if ($result) {
      echo json_encode($result);
    } else {
      return false;
    }
  }

  public function fetchReportByCustom()
  {
    $file_input = json_decode(file_get_contents("php://input"));
    $data = array(
      'date_start'  =>  $file_input->date_start,
      'date_end' => $file_input->date_end,
    );
    $result = $this->ReportModel->fetch_report_by_custom($data);

    if ($result) {
      echo json_encode($result);
    } else {
      return false;
    }
  }

  public function export_CSV()
  {
    // foreach($data as $value){
    //   echo $value->total;
    //   echo "&nbsp;";
    //   echo "&nbsp;";
    //   echo "&nbsp;";
    //   echo "&nbsp;";
    //   echo $value->register_time;
    //   echo "<br>";
    // }
    // header('Content-Type: text/csv; charset=utf-8');
    // header('Content-Disposition: attachment; filename=data.csv');
    // $output = fopen("php://output", "w");

    $filename = 'users_' . date('Ymd') . '.csv';
    // header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv; ");

    // get data 
    $usersData = $this->fetchReportByWeek();
    $data = json_decode($usersData, true);

    // file creation 
    $file = fopen('php://output', 'w');

    $header = array("Username", "Name", "Gender", "Email");
    fputcsv($file, $header);
    foreach ($data as $key => $line) {
      fputcsv($file, $line);
    }
    fclose($file);
    exit;
  }

  public function export_headers($filename)
  {
    // disable caching
    // $now = gmdate("D, d M Y H:i:s");
    // header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    // header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    // header("Last-Modified: {$now} GMT");

    // // force download  
    // header("Content-Type: application/force-download");
    // header("Content-Type: application/octet-stream");
    // header("Content-Type: application/download");

    // // disposition / encoding on response body
    // header("Content-Disposition: attachment;filename={$filename}");
    // header("Content-Transfer-Encoding: binary");
  }

  public function export_data()
  {
    if (isset($_GET['type'])) {
      switch ($_GET['type']) {
        case "day":
          $this->export_headers("ข้อมูลลูกค้ารายวัน.csv");
          $data = $this->ReportModel->fetch_report_by_day();
          break;
        case "week";
          $this->export_headers("ข้อมูลลูกค้ารายสัปดาห์.csv");
          $data = $this->ReportModel->fetch_report_by_week();
          break;
        case "month";
          $this->export_headers("ข้อมูลลูกค้ารายเดือน.csv");
          $data = $this->ReportModel->fetch_report_by_month();
          break;
        case "year";
          $this->export_headers("ข้อมูลลูกค้ารายปี.csv");
          $data = $this->ReportModel->fetch_report_by_year();
          break;
        case "old_cust";
          $this->export_headers("ข้อมูลลูกค้าที่กลับมาใช้ซ้ำ.csv");
          $data = $this->ReportModel->fetch_report_by_old_cust();
          break;

          $this->export_CSV($data);
          die();
      }
    }
  }

  public function export_data_custom()
  {
    if (isset($_GET['date_start']) && isset($_GET['date_end'])) {
      $name = "ข้อมูลลูกค้าตั้งแต่วันที่ " . $_GET['date_start'] . " ถึง " . $_GET['date_end'] . ".csv";
      $this->export_headers($name);

      $data = array(
        'date_start' => $_GET['date_start'],
        'date_end'   => $_GET['date_end'],
      );

      $result = $this->ReportModel->fetch_report_by_custom($data);
      $this->export_CSV($result);
    }
  }
}
