<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usersmodel extends CI_Model {
  public function getUser($username,$pass){
    $sql = "SELECT * FROM `users` WHERE username = '$username' AND password = '$pass' OR email = '$username' AND password = '$pass'";
    $this->load->database();
    $res = $this->db->query($sql);
    return $res->row_array();
  }
}
