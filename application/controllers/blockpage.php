<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blockpage extends CI_Controller {
  public function index(){
    $data['title'] = 'Block';
    $data['errorMsg'] = 'Check Your User Name And Password.';
    $this->load->view('view_header',$data);
    $this->load->view('view_blockpage');
    $this->load->view('view_footer');
  }
}
