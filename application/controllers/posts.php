<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('postmodel');
    $this->load->model('usersmodel');
  }

  public function index(){

    //if(!$this->session->userdata('username')) redirect('http://localhost/coder/login');
    $res = $this->postmodel->getAllPost();
    $str = "";
    foreach ($res as $r) {
      $r['post'] = str_replace('<','&lt',$r['post']);
      $r['post'] = str_replace('>','&gt',$r['post']);
      $id = $r['postid'];
      $str.= $r['posttitle']."<div class='postDiv'><a class='postATag' href='/coder/posts/showSpecificPost/$id'><pre>".$r['post']."</pre></a></div><hr>";
      //  ."<div ><a style='margin: 10px;' href=''>Edit</a></td><td> <a style='margin: 10px;' href=''>Delete</a></div>"
    }
    $data['tableData'] = $str;
    $data['title'] = 'Posts';
    $this->load->view('view_header',$data);
    $this->load->view('view_posts',$data);
    $this->load->view('view_footer');
  }

  public function showSpecificPost($id){
    $res = $this->postmodel->getPost($id);

    if($res['postid'] == $id){
      $this->load->model('usersmodel');
      $username = $res['username'];
      $userinfo = $this->usersmodel->getUserInfo($username);
      $fbURL = $userinfo['url'];
      $res['post'] = str_replace('<','&lt',$res['post']);
      $res['post'] = str_replace('>','&gt',$res['post']);

      $str = "<center><h1>Title: ".$res['posttitle']."</h1></center><hr><br><br>"
      ."<div style='margin-left:120px; font-size: 22px; line-height: 25px padding:50px;'><pre>".$res['post']."</pre></div><br><br><hr>"
      ."<div style='margin-top:50px; padding:30px;'><b>Author: ".$userinfo['name']."</b>"
      ."<strong><a style='margin-left:20px; text-decoration: none; color: blue;' href='$fbURL'>Facebook Profile</a></strong></div><br><br>";

      $data['postdata'] = $str;
      $data['title'] = 'Posts';
      $this->load->view('view_header',$data);
      $this->load->view('view_specificpost',$data);
      $this->load->view('view_footer');
    }
    else {
      echo "<script>alert('No Data Found.ss')</script>";
      redirect('http://localhost/coder/posts','refresh');
    }
  }

  public function mypost(){
    if(!$this->session->userdata('username'))redirect('http://localhost/coder/login');
    echo "kal ai khantheke suru..";
  }
}
