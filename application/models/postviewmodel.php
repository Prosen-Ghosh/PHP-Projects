<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Postviewmodel extends CI_Model {
  public function getPostView($postid){
    $sql = "SELECT `totalpostview` FROM `postview` WHERE `postid` = $postid";
    $this->load->database();
    $res = $this->db->query($sql);
    return $res->row_array();
  }
  public function updatePostView($postid,$postView){
    //$sql = "INSERT INTO `postview`(`postviewid`, `postid`, `totalpostview`) VALUES (null,$id,$postView)";
    $sql = "UPDATE `postview` SET `totalpostview`=$postView WHERE `postid` = $postid";
    $this->load->database();
    $this->db->query($sql);
  }
  public function insertPostView($postid,$postView){
    $sql = "INSERT INTO `postview`(`postviewid`, `postid`, `totalpostview`) VALUES (null,$postid,$postView)";
    $this->load->database();
    $this->db->query($sql);
  }
  public function checkPostView($postid){
    $sql = "SELECT count(*) AS count FROM `postview` WHERE `postid` = $postid";
    $this->load->database();
    $res = $this->db->query($sql);
    $r = $res->row_array();
    if($r['count'] == 0)return FALSE;
    else return TRUE;
  }
  public function getTopTenPost(){
    $sql = "SELECT p.posttitle, pv.totalpostview FROM `postview`pv, post p where p.postid = pv.postid order by `totalpostview` desc LIMIT 10";
    $this->load->database();
    $res = $this->db->query($sql);
    return $res->result_array();
  }
  public function getTopTenBlogger(){
    $sql = "SELECT u.name,sum(pv.totalpostview) AS visited,count(p.postid) AS Post from post p, postview pv,users u where pv.postid = p.postid and u.username = p.username GROUP BY p.username ORDER BY sum(pv.totalpostview) desc LIMIT 10";
    $this->load->database();
    $res = $this->db->query($sql);
    return $res->result_array();
  }
}
