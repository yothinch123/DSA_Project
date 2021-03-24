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

    public function fetchReport()
    {
        $result = $this->ReportModel->fetch_report();

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
}
