<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller {
  public function index(){
    if(!$this->session->userdata('username')) redirect('http://localhost/coder/login');
    $data['title'] = 'Posts';
    $this->load->view('view_header',$data);
    $this->load->view('view_posts');
    $this->load->view('view_footer');
  }
}
