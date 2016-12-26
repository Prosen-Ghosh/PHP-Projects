<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CheckUniqueUser extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('usersmodel');
  }
  public function index(){
    $userName = $this->input->post('username');
    $val = $this->usersmodel->getUsername($userName);
    if($val['user'] >= '1')echo "false";
    else echo "true";
  }
}
