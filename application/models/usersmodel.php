<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usersmodel extends CI_Model {
  public function getUser($username,$pass){
    $sql = "SELECT * FROM `users` WHERE username = '$username' AND password = '$pass' OR email = '$username' AND password = '$pass'";
    $this->load->database();
    $res = $this->db->query($sql);
    return $res->row_array();
  }
  public function createNewUser($user){
    $uname = $user['userName'];
    $name = $user['name'];
    $email = $user['email'];
    $pass = $user['password'];
    $sql = "INSERT INTO `users`(`category`, `username`, `name`, `email`, `password`, `address`, `url`, `status`, `picture`, `country`, `city`) VALUES ('USER','$uname','$name','$email','$pass','','','ACTIVE','','','')";
    $this->load->database();
    $this->db->query($sql);
  }
  public function getUsername($username){
    $sql = "SELECT count(*) AS user FROM `users` WHERE username = '$username'";
    $this->load->database();
    $res = $this->db->query($sql);
    return $res->row_array();
  }
  public function getUserInfo($username){
    $sql = "SELECT * FROM `users` WHERE username = '$username'";
    $this->load->database();
    $res = $this->db->query($sql);
    return $res->row_array();
  }
  public function getAllUser(){
    $sql = "SELECT * FROM `users` WHERE `category` NOT LIKE 'admin' AND `status` LIKE 'ACTIVE'";
    $this->load->database();
    $res = $this->db->query($sql);
    return $res->result_array();
  }

  public function _blockUser($uname){
    $sql = "UPDATE `users` SET `status`='BLOCK' WHERE `username` = '$uname'";
    $this->load->database();
    $this->db->query($sql);
  }

  public function getBlockedUser(){
    $sql = "SELECT * FROM `users` WHERE `category` NOT LIKE 'admin' AND `status` LIKE 'BLOCK'";
    $this->load->database();
    $res = $this->db->query($sql);
    return $res->result_array();
  }
  public function _unblockUser($uname){
    $sql = "UPDATE `users` SET `status`='ACTIVE' WHERE `username` = '$uname'";
    $this->load->database();
    $this->db->query($sql);
  }
}
