<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Postmodel extends CI_Controller {
  public function createNewPost($postdata){
    $posttitle = $postdata['posttitle'];
    $post = $postdata['post'];
    $date = date("Y/m/d");
    $tag = $postdata['tag'];
    $sql = "INSERT INTO `post`(`posttitle`, `post`, `date`, `point`, `tag`) VALUES ('$posttitle','$post','$date',0,'$tag')";
    $this->load->database();
    $this->db->query($sql);
  }
  public function getAllPost(){
    $sql = "SELECT * FROM `post`";
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
}
