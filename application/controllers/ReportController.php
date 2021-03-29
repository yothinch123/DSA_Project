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
    $result = $this->ReportModel->fetch_report_by_we();

    if ($result) {
      echo json_encode($result);
    } else {
      return false;
    }
  }

  public function fetchReportByMonth()
  {
    $result = $this->ReportModel->fetch_report_by_mo();

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

  public function exportCSV($array)
  {
    // if (count($array) == 0) {
    //   return null;
    // }
    ob_start();
    $df = fopen("php://output", 'w');
    fputcsv($df, array_keys(reset($array)));
    foreach ($array as $row) {
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

  public function test()
  {
    if (isset($_GET['type'])) {
      $this->export_headers("data_export_" . date("Y-m-d") . ".csv");
      $data = $this->ReportModel->fetch_report_by_year();

      $this->exportCSV($data);
      die();
    } else {
      echo "haha false !";
    }
  }
}
