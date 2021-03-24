<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SettingModel extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  function update_setting($data)
  {
    extract($data);

    $sql = "UPDATE setting SET 
    details = CASE WHEN attribute = 'wifi_open' THEN '$wifi_open'
    WHEN attribute = 'wifi_close' THEN '$wifi_close'
    WHEN attribute = 'name_cafe' THEN '$name_cafe'
    END 
    WHERE attribute IN ('wifi_open','wifi_close','name_cafe')";

    $query = $this->db->query($sql);

    if ($query) {
      return true;
    } else {
      return false;
    }
  }
}
