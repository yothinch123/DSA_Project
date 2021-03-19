<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function checkLoginBy($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('employee');
		return $query->row();
    }
}
