<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('postmodel');
    $this->load->helper('file');
  }
  public function index(){
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('category');

    $res = $this->postmodel->getAllPostID();

    foreach($res as $r){
      //echo $r['postid'];
      $this->session->unset_userdata($r['postid']);
    }
    redirect('http://localhost/coder/','refresh');
  }
}
