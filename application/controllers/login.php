<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('usersmodel');
  }
  public function index(){
    if($this->input->post('submit')){

      if($this->form_validation->run('login')){
        $user = $this->usersmodel->getUser($this->input->post('userName'));
        if(strtolower($user['category']) === 'user' && strtolower($user['status']) === "ok"){
          redirect('http://localhost/coder/userhome');
        }
        else if(strtolower($user['category']) === 'admin' && strtolower($user['status']) === "ok"){
          redirect('http://localhost/coder/userhome/');
        }
        /*$data['title'] = 'Login';
        $this->load->view('view_header',$data);
        $this->load->view('view_login');
        $this->load->view('view_footer');*/
      }
      else {
        $data['title'] = 'Login';
        $this->load->view('view_header',$data);
        $this->load->view('view_login');
        $this->load->view('view_footer');
      }
    }
    else{
      $data['title'] = 'Login';
      $this->load->view('view_header',$data);
      $this->load->view('view_login');
      $this->load->view('view_footer');
    }
  }
}
