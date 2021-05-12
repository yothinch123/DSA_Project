<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('SettingModel');
  }

  public function updateSetting()
  {
    $file_input = json_decode(file_get_contents("php://input"));
    $data = array(
      'wifi_open'  => $file_input->wifi_open,
      'wifi_close' => $file_input->wifi_close,
      'time_use' => $file_input->time_use,
    );
    $result = $this->SettingModel->update_setting($data);

    if ($result) {
      $text = "ตั้งค่าเวลา";
      $this->createSettingLog($text);
      echo true;
    } else {
      echo false;
    }
  }

  public function updateSettingPass()
  {
    $file_input = json_decode(file_get_contents("php://input"));
    $password = $file_input->password;
    $result = $this->SettingModel->update_setting_pass($password);

    if ($result) {
      $text = "เปลี่ยนรหัสผ่าน";
      $this->createSettingLog($text);
      echo true;
    } else {
      echo false;
    }
  }
  public function createSettingLog($text)
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    $username = $this->session->userdata('username');
    $data = array(
      'ip' => $ip,
      'username_emp' => $username,
      'text' => $text
    );

    $this->SettingModel->insert_setting_log($data);
  }
}
