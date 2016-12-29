<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Userhome extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('usersmodel');
  }
  public function index(){
    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    //if(!write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView));

    if($this->session->userdata('username') && strtolower($this->session->userdata('category')) == "user"){
      $data['title'] = 'Home';
      $data['totalPageView'] = $totalSiteView;

      $data['username'] = ucfirst($this->session->userdata('username'));
      $this->parser->parse('view_header',$data);
      $this->parser->parse('view_userhome',$data);
      $this->parser->parse('view_footer',$data);
    }
    else {
      redirect('http://localhost/coder/login');
    }
  }
  public function profile(){
    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    //if(!write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView));

    if($this->session->userdata('username') && strtolower($this->session->userdata('category')) == "user"){
      $data['title'] = 'Profile';
      $data['totalPageView'] = $totalSiteView;
      $res = $this->usersmodel->getUserInfo($this->session->userdata('username'));
      $data['username'] = ucfirst($this->session->userdata('username'));
      $data['name'] = $res['name'];
      $data['email'] = $res['email'];
      $data['url'] = $res['url'];
      $data['address'] = $res['address'];
      $data['country'] = $res['country'];
      $this->parser->parse('view_header',$data);
      $this->parser->parse('view_userProfile',$data);
      $this->parser->parse('view_footer',$data);
    }
    else {
      redirect('http://localhost/coder/login');
    }
  }
  public function save(){
    $username = $this->input->post('username');
    $data = array(
      'name' => $this->input->post('name'),
      'address' => $this->input->post('address'),
      'url' => $this->input->post('url'),
      'country' => $this->input->post('country')
    );
    $this->usersmodel->updateUser($data,$username);
    redirect('http://localhost/coder/userhome/profile');
  }
}
