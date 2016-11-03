<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Adminhome extends CI_Controller {
  public function index(){
    $data['title'] = 'Home';
    $this->load->view('view_header',$data);
    $this->load->view('view_adminhome');
    $this->load->view('view_footer');
  }
}
