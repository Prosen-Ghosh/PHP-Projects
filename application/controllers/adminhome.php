<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Adminhome extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('usersmodel');
  }
  public function index(){
    if($this->session->userdata('username')){
      $data['title'] = 'Home';
      $this->load->view('view_header',$data);
      $this->load->view('view_adminhome');
      $this->load->view('view_footer');
    }
    else {
      redirect('http://localhost/coder/login');
    }
  }

  public function getAllUsers(){
    if(!$this->session->userdata('username'))redirect('http://localhost/coder/login');
    $res = $this->usersmodel->getAllUser();
    $style = "<style>
    .button {
        display: block;
        width: 75%;
        height: 25px;
        background: #4E9CAF;
        padding: 10px;
        text-align: center;
        border-radius: 5px;
        color: white;
        font-weight: bold;
    }
    </style>";
    if(!$this->input->post('submit')){
      $str='<table>';
      foreach ($res as $r) {
        $uname = $r['username'];
        $str.= "<tr><td><b>".ucfirst($r['username'])."</b></td></td>"
        ."<tr><td><div class='postDiv'>".$r['name']." ".$r['address']."</div></td></tr>"
          ."<tr><td><a class='button' style='float:left;' href='/coder/adminhome/getSpecificUserForBlock/$uname'>Block This User.</a></td></tr>";
      }
      $str.='</table>';
      $data['title'] = 'Users List';
      $data['userData'] = $str;
      $data['style'] = $style;
      $this->load->view('view_header',$data);
      $this->load->view('view_usersinfo',$data);
      $this->load->view('view_footer');
    }
  }

  public function getSpecificUserForBlock($uname){
    if(!$this->session->userdata('username'))redirect('http://localhost/coder/login');
    $string = "<center>Are You Sure That you want to bloc this user.</center>"
    ."<table><tr><td><a href='/coder/adminhome/blockuser/$uname'>Yes</a></td><td><a href='/coder/adminhome/getAllUsers'>Yes</a></td></tr></table>";
    $data['string'] = $string;
    $data['title'] = 'Posts';
    $this->load->view('view_header',$data);
    $this->load->view('view_blockuser',$data);
    $this->load->view('view_footer');
  }

  function blockUser($uname){
    if(!$this->session->userdata('username'))redirect('http://localhost/coder/login');
    $this->usersmodel->_blockUser($uname);
    echo "<script>alert('Selected User is Blocked.')</script>";
    redirect('http://localhost/coder/adminhome/getAllUsers','refresh');
  }
}
