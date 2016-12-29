<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('usersmodel');
    $this->load->helper('file');
  }
  public function index(){
    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    if(!$this->session->userdata('login')){
      $this->session->set_userdata('login','login');
      write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView);
    }

    if($this->session->userdata('username') && strtolower($this->session->userdata('category')) == 'user')redirect('http://localhost/coder/userhome');
    if($this->session->userdata('username') && strtolower($this->session->userdata('category')) == 'admin')redirect('http://localhost/coder/adminhome');
    if(!$this->input->post('submit')){
      $data['title'] = 'Login';
      $data['errorMsg'] = '';
      $data['totalPageView'] = $totalSiteView;

      $data['userName'] = "";
      $data['password'] = "";

      $this->parser->parse('view_header',$data);
      $this->parser->parse('view_login',$data);
      $this->parser->parse('view_footer',$data);
    }
    else {
      if($this->form_validation->run('login')){
        $user = $this->usersmodel->getUser($this->input->post('userName'),$this->input->post('password'));
        if(!isset($user['username'])){
          $data['title'] = 'Login';
          $data['errorMsg'] = 'Check Your User Name And Password.';
          $data['totalPageView'] = $totalSiteView;

          $data['userName'] = "";
          $data['password'] = "";
          $this->load->view('view_header',$data);
          $this->parser->parse('view_login',$data);
          $this->parser->parse('view_footer',$data);
          return;
        }
        if(strtolower($user['category']) == 'user' && strtolower($user['status']) == "active"){
          $this->session->set_userdata('username',$user['username']);
          $this->session->set_userdata('category',$user['category']);
          redirect('http://localhost/coder/userhome');
        }
        else if(strtolower($user['category']) == 'admin' && strtolower($user['status']) == "active"){
          $this->session->set_userdata('username',$user['username']);
          $this->session->set_userdata('category',$user['category']);
          redirect('http://localhost/coder/adminhome');
        }
        else redirect('http://localhost/coder/login/blocked');
      }
      else {
        $data['title'] = 'Login';
        $data['errorMsg'] = '';
        $data['totalPageView'] = $totalSiteView;
        $data['userName'] = form_error('userName');
        $data['password'] = form_error('password');
        $this->parser->parse('view_header',$data);
        $this->parser->parse('view_login',$data);
        $this->parser->parse('view_footer',$data);
      }
    }
  }

  public function blocked(){
    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);

    $data['title'] = 'Block';
    $data['totalPageView'] = $totalSiteView;
    $data['errorMsg'] = 'Check Your User Name And Password.';
    $this->parser->parse('view_header',$data);
    $this->load->view('view_blockpage');
    $this->parser->parse('view_footer',$data);
  }
}
