<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
    Author : Said Mohamad Ikrimah Pamungkas
    Email  : pamungkas1992@gmail.com
    date   : 29 Oktober 2015
*/

class AuthModel extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function validate($user, $pass) {
		$this->db->where('username', $user);
		$this->db->where('password', md5($pass));
		$this->db->where('status', 1);
		$res = $this->db->get('admin');
		if ($res->num_rows() == 0) {
			return -1;
		} else {
			return $res->row_array();
		}
	}
}
