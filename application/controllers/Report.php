<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ReportModel');
  }

  public function roundFetch()
  {
    $this->ReportModel->round_report_hour();
    $this->ReportModel->round_report_day();
    $this->ReportModel->round_report_week();
    $this->ReportModel->round_report_month();
    $this->ReportModel->round_report_year();
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

  public function fetchReportTotalBy()
  {
    $result = $this->ReportModel->fetch_report_total_by();

    if ($result) {
      echo json_encode($result);
    } else {
      return false;
    }
  }
  public function export_CSV($data, $type)
  {
    $handle = fopen('php://output', 'w');
    ob_clean();
    fputs($handle, (chr(0xEF) . chr(0xBB) . chr(0xBF)));

    if ($type == "date") {
      fputcsv($handle, array('วันที่', 'จำนวนคนที่มาใช้บริการ'));
    } else if ($type == "we") {
      fputcsv($handle, array('สัปดาห์ที่', 'จำนวนคนที่มาใช้บริการ'));
    } else if ($type == "mo") {
      fputcsv($handle, array('เดือนที่', 'จำนวนคนที่มาใช้บริการ'));
    } else if ($type == "ye") {
      fputcsv($handle, array('ปีที่', 'จำนวนคนที่มาใช้บริการ'));
    } else if ($type == "old_cust") {
      fputcsv($handle, array('รหัสบัตรประชาชน', 'จำนวนครั้งที่มาใช้บริการ'));
    } else if ($type == "custom") {
      fputcsv($handle, array('วันที่', 'จำนวนคนที่มาใช้บริการ'));
    } else if ($type == "hist_cust") {
      fputcsv($handle, array('ลำดับ', 'ชื่อผู้ใช้', 'แอตทริบิวต์', 'โอเปอร์เรเตอร์', 'ค่าของข้อมูล', 'เวลาเริ่มต้น', 'เวลาสิ้นสุด'));
    }


    foreach ($data as $row) {
      fputcsv($handle, $row);
    }

    ob_flush();
    fclose($handle);
    die();
  }

  public function export_headers($filename)
  {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header('Content-Type: text/csv; charset=utf-8');
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
          $type = "date";
          break;
        case "week";
          $this->export_headers("ข้อมูลลูกค้ารายสัปดาห์.csv");
          $data = $this->ReportModel->fetch_report_by_week();
          $type = "we";
          break;
        case "month";
          $this->export_headers("ข้อมูลลูกค้ารายเดือน.csv");
          $data = $this->ReportModel->fetch_report_by_month();
          $type = "mo";
          break;
        case "year";
          $this->export_headers("ข้อมูลลูกค้ารายปี.csv");
          $data = $this->ReportModel->fetch_report_by_year();
          $type = "ye";
          break;
        case "old_cust";
          $this->export_headers("ข้อมูลลูกค้าที่กลับมาใช้ซ้ำ.csv");
          $type = "old_cust";
          $data = $this->ReportModel->fetch_report_by_old_cust();
          break;
      }
      $this->export_CSV($data, $type);
      die();
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
      $type = "custom";
      $this->export_CSV($result, $type);
    }
  }

  public function export_hist_cust()
  {
    $name = "ข้อมูลประวัติการใช้งานของลูกค้า.csv";
    $this->export_headers($name);
    $result = $this->ReportModel->fetch_report_hist_cust();
    $type = "hist_cust";
    $this->export_CSV($result, $type);
  }
}
