<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
  public function index(){
    if($this->input->post('submit')){
      if($this->form_validation->run('signup') != FALSE){
        $data['title'] = 'Register';
        $this->load->view('view_header',$data);
        $this->load->view('view_register');
        $this->load->view('view_footer');
      }
      else{
        $data['title'] = 'Register';
        $this->load->view('view_header',$data);
        $this->load->view('view_register');
        $this->load->view('view_footer');
      }
    }
    else{
      $data['title'] = 'Register';
      $this->load->view('view_header',$data);
      $this->load->view('view_register');
      $this->load->view('view_footer');
    }
  }
}
