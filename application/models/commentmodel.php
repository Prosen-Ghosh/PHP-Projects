<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commentmodel extends CI_Model {
  public function postComment($postid){
    /*$sql = "SELECT * FROM `comment` WHERE `postid` = $postid";
    $this->load->database();
    $res = $this->db->query($sql);*/

    // active record
    $res = $this->db->where('postid',$postid)->get('comment');
    return $res->Result_array();
  }
  public function newComment($commentdata){
    /*$com = $commentdata['comment'];
    $uname = $commentdata['username'];
    $postid = $commentdata['postid'];
    $sql = "INSERT INTO `comment`(`commentid`, `comment`, `username`, `postid`) VALUES (null,'$com','$uname','$postid')";
    $this->load->database();
    $this->db->query($sql);*/

    // active record
    $data = array(
      'commentid' => null,
      'comment' = > $commentdata['username'],
      'username' => $commentdata['username'],
      'postid' => $commentdata['postid']
    );
    $this->db->insert('comment',$data);
  }
}
