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
    WHEN attribute = 'time_use' THEN '$time_use'
    END 
    WHERE attribute IN ('wifi_open','wifi_close','time_use')";

    $query = $this->db->query($sql);

    if ($query) {
      return true;
    } else {
      return false;
    }
  }

  function update_setting_pass($password)
  {
    $sql = "UPDATE `setting` SET `details` = '$password' WHERE `setting`.`attribute` = 'password'";

    $query = $this->db->query($sql);

    if ($query) {
      return true;
    } else {
      return false;
    }
  }

  function insert_setting_log($data)
  {
    extract($data);

    $sql = "INSERT INTO log_setting (
        username_emp,
        login_time,
        details,
        login_from
        ) VALUES (
        '$username_emp', 
        now(),
        '$text',
        '$ip'
        )";

    $query = $this->db->query($sql);
    return $query;
  }
}
