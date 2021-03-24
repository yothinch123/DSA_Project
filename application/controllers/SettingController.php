<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SettingController extends CI_Controller
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
            'wifi_open'  =>  $file_input->wifi_open,
            'wifi_close' => $file_input->wifi_close,
            'name_cafe'  => $file_input->name_cafe,
        );
        $result = $this->SettingModel->update_setting($data);

        if ($result) {
            echo true;
        } else {
            echo false;
        }
    }
}
