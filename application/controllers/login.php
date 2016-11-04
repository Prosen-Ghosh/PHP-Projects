<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('usersmodel');
  }
  public function index(){
    if(!$this->input->post('submit')){
      $data['title'] = 'Login';
      $data['errorMsg'] = '';
      $this->load->view('view_header',$data);
      $this->load->view('view_login',$data);
      $this->load->view('view_footer');
    }
    else {
      if($this->form_validation->run('login')){
        $user = $this->usersmodel->getUser($this->input->post('userName'),$this->input->post('password'));
        if(!isset($user['username'])){
          $data['title'] = 'Login';
          $data['errorMsg'] = 'Check Your User Name And Password.';
          $this->load->view('view_header',$data);
          $this->load->view('view_login',$data);
          $this->load->view('view_footer');
          return;
        }
        $this->session->set_userdata('username',$user['username']);
        if(strtolower($user['category']) === 'user' && strtolower($user['status']) === "ok"){
          redirect('http://localhost/coder/userhome');
        }
        else if(strtolower($user['category']) === 'admin' && strtolower($user['status']) === "ok"){
          redirect('http://localhost/coder/adminhome');
        }
        else redirect('http://localhost/coder/blockpage');
      }
      else {
        $data['title'] = 'Login';
        $data['errorMsg'] = '';
        $this->load->view('view_header',$data);
        $this->load->view('view_login',$data);
        $this->load->view('view_footer');
      }
    }
  }
}
