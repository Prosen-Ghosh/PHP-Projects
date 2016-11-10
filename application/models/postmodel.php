<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Postmodel extends CI_Model {
  public function createNewPost($postdata){
    $posttitle = $postdata['posttitle'];
    $post = $postdata['post'];
    $date = date("Y/m/d");
    $tag = $postdata['tag'];
    $uname = $this->session->userdata('username');
    $sql = "INSERT INTO `post`(`posttitle`, `post`, `date`, `point`, `tag`, `username`, `state` ) VALUES ('$posttitle','$post','$date',0,'$tag','$uname','ACTIVE')";
    $this->load->database();
    $this->db->query($sql);
  }
  public function getAllPost(){
    $sql = "SELECT * FROM `post` WHERE `state` NOT LIKE 'BLOCK'";
    $this->load->database();
    $res = $this->db->query($sql);
    return $res->result_array();
  }
  public function getPost($id){
    $sql = "SELECT * FROM `post` WHERE postid = $id";
    $this->load->database();
    $res = $this->db->query($sql);
    return $res->row_array();
  }
  public function getAllUserPost($username){
    $sql = "SELECT * FROM `post` WHERE username = '$username'";
    $this->load->database();
    $res = $this->db->query($sql);
    return $res->result_array();
  }
  public function updatePost($postdata,$res){
    $id = $res['postid'];
    $posttitle = $postdata['posttitle'];
    $post = $postdata['post'];
    $tag = $postdata['tag'];
    $sql = "UPDATE `post` SET `posttitle`='$posttitle',`post`='$post', `tag`='$tag' WHERE `postid` = $id";
    $this->load->database();
    $this->db->query($sql);
  }
  public function deleteMyPost($postId){
    $sql = "DELETE FROM `post` WHERE `postid` = $postId";
    $this->load->database();
    $this->db->query($sql);
  }

  public function blockUserPost($postId){
    $sql = "UPDATE `post` SET `state`='BLOCK' WHERE `postid` = $postId";
    $this->load->database();
    $this->db->query($sql);
  }
  public function unBlockUserPost($postId){
    $sql = "UPDATE `post` SET `state`='OK' WHERE `postid` = $postId";
    $this->load->database();
    $this->db->query($sql);
  }
  public function getAllBlockedPost(){
    $sql = "SELECT * FROM `post` WHERE `state` LIKE 'BLOCK'";
    $this->load->database();
    $res = $this->db->query($sql);
    return $res->result_array();
  }
  public function searchPost($key){
    $sql = "SELECT * FROM `post` WHERE `posttitle` LIKE '$key%' OR `tag` LIKE '%$key%'";
    $this->load->database();
    $res = $this->db->query($sql);
    return $res->result_array();
  }
}
