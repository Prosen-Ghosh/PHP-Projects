<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Postmodel extends CI_Controller {
  public function createNewPost($postdata){
    $posttitle = $postdata['posttitle'];
    $post = $postdata['post'];
    $date = date("Y/m/d");
    $tag = $postdata['tag'];
    $sql = "INSERT INTO `post`(`posttitle`, `post`, `date`, `point`, `tag`) VALUES ('$posttitle','$post','$date',0,'$tag')";
    $this->load->database();
    $res = $this->db->query($sql);
  }
}
