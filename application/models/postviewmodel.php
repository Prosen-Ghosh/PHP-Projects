<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Postviewmodel extends CI_Model {
  public function getPostView($postid){
    /*$sql = "SELECT `totalpostview` FROM `postview` WHERE `postid` = $postid";
    $this->load->database();
    $res = $this->db->query($sql);*/

    // active record
    $res = $this->db->where('postid',$postid)->get('postview');
    return $res->row_array();
  }
  public function updatePostView($postid,$postView){
    //$sql = "INSERT INTO `postview`(`postviewid`, `postid`, `totalpostview`) VALUES (null,$id,$postView)";
    /*$sql = "UPDATE `postview` SET `totalpostview`=$postView WHERE `postid` = $postid";
    $this->load->database();
    $this->db->query($sql);*/

    // active record
    $this->db->where('postid',$postid)->update('postview',array('totalpostview'=>$postView));
  }
  public function insertPostView($postid,$postView){
    /*$sql = "INSERT INTO `postview`(`postviewid`, `postid`, `totalpostview`) VALUES (null,$postid,$postView)";
    $this->load->database();
    $this->db->query($sql);*/

    // active record
    $data = array(
      'postviewid' => null,
      'postid' => $postid,
      'totalpostview' => $postView
    );
    $this->db->insert('postview',$data);
  }
  public function checkPostView($postid){
    /*$sql = "SELECT count(*) AS count FROM `postview` WHERE `postid` = $postid";
    $this->load->database();
    $res = $this->db->query($sql);*/

    // active record
    $res = $this->db->select('count(*) AS count')->where('postid',$postid)->get('postview');
    $r = $res->row_array();
    if($r['count'] == 0)return FALSE;
    else return TRUE;
  }
  public function getTopTenPost(){
    /*$sql = "SELECT p.posttitle, pv.totalpostview FROM `postview`pv, post p where p.postid = pv.postid order by `totalpostview` desc LIMIT 10";
    $this->load->database();
    $res = $this->db->query($sql);*/

    // active record
    $res = $this->db->select('p.posttitle, pv.totalpostview')->from('postview pv')->join('post p','p.postid = pv.postid')->order_by('totalpostview','desc')->limit(10)->get();
    return $res->result_array();
  }
  public function getTopTenBlogger(){
    /*$sql = "SELECT u.name,sum(pv.totalpostview) AS visited,count(p.postid) AS Post from post p, postview pv,users u where pv.postid = p.postid and u.username = p.username GROUP BY p.username ORDER BY sum(pv.totalpostview) desc LIMIT 10";
    $this->load->database();
    $res = $this->db->query($sql);*/

    // active record
    $this->db->select('u.name, sum(pv.totalpostview) AS visited, count(p.postid) AS Post');
    $this->db->from('post p')->join('postview pv','pv.postid = p.postid')->join('users u','u.username = p.username');
    $res = $this->db->group_by('p.username')->order_by('sum(pv.totalpostview)','desc')->limit(10)->get();
    return $res->result_array();
  }
}
