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

  public function export_CSV($data)
  {
    if (count($data) == 0) {
      return null;
    }
    ob_start();
    $df = fopen("php://output", 'w');
    fputcsv($df, array_keys(reset($data)));
    foreach ($data as $row) {
      fputcsv($df, $row);
    }
    fclose($df);
    return ob_get_clean();
  }

  public function export_headers($filename)
  {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
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
}
