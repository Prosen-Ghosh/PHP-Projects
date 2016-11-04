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
    $sql = "INSERT INTO `users`(`category`, `username`, `name`, `email`, `password`, `address`, `url`, `status`, `picture`, `country`, `city`) VALUES ('USER','$uname','$name','$email','$pass','','','OK','','','')";
    $this->load->database();
    $this->db->query($sql);
  }
  public function getUserInfo($username){
    $sql = "SELECT * FROM `users` WHERE username = '$username'";
    $this->load->database();
    $res = $this->db->query($sql);
    return $res->row_array();
  }
}
