<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
  public function index(){
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('category');
    redirect('http://localhost/coder/','refresh');
  }
}
