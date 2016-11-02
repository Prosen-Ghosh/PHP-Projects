<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
  public function index(){
    $data['title'] = 'Register';
    $this->load->view('view_header',$data);
    $this->load->view('view_register');
    $this->load->view('view_footer');
  }
}
