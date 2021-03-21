<?php


defined('BASEPATH') or exit('No direct script access allowed');
class ReportController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('ReportModel');
    }

    public function index()
    {
        $config = array();
        $config['base_url'] = base_url('report/index');
        $config['total_rows'] = $this->ReportModel->record_count($this->input->get('keyword'));
        $config['per_page'] = $this->input->get('keyword') == NULL ? 14 : 999;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = round($choice);
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['results'] = $this->ReportModel->fetch_report($config['per_page'], $page, $this->input->get('keyword'));
        $data['r_w'] = $this->ReportModel->fetch_report_by_we($config['per_page'], $page, $this->input->get('keyword'));
        $data['r_m'] = $this->ReportModel->fetch_report_by_mo($config['per_page'], $page, $this->input->get('keyword'));
        $data['r_y'] = $this->ReportModel->fetch_report_by_year($config['per_page'], $page, $this->input->get('keyword'));
        // old statistics 
        $data['old_cus'] = $this->ReportModel->fetch_report_by_old_cus($config['per_page'], $page, $this->input->get('keyword'));

        $this->load->view('export/statistics', $data);
        // $this->load->view('pages/statistics', $data);
    }

    public function fetchReport(){
        $result = $this->ReportModel->fetch_report();

        if ($result) {
            echo json_encode($result);
        } else {
            return false;
        }
    }

    public function fetchReportByDay(){
        $result = $this->ReportModel->fetch_report_by_day();

        if ($result) {
            echo json_encode($result);
        } else {
            return false;
        }
    }

    public function fetchReportByWeek(){
        $result = $this->ReportModel->fetch_report_by_we();
        
        if ($result) {
            echo json_encode($result);
        } else {
            return false;
        }
    }

    public function fetchReportByMonth(){
        $result = $this->ReportModel->fetch_report_by_mo();
        
        if ($result) {
            echo json_encode($result);
        } else {
            return false;
        }
    }

    public function fetchReportByYear(){
        $result = $this->ReportModel->fetch_report_by_year();
        
        if ($result) {
            echo json_encode($result);
        } else {
            return false;
        }
    }

    public function fetchReportByoldCust(){
        $result = $this->ReportModel->fetch_report_by_old_cust();
        
        if ($result) {
            echo json_encode($result);
        } else {
            return false;
        }
    }
}
