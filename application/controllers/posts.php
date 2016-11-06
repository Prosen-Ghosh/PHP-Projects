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
      $data['style'] = '';
      $data['title'] = 'Posts';
      $this->load->view('view_header',$data);
      $this->load->view('view_specificpost',$data);
      $this->load->view('view_footer');
    }
    else {
      echo "<script>alert('No Data Found.')</script>";
      redirect('http://localhost/coder/posts','refresh');
    }
  }

  public function mypost(){
    if(!$this->session->userdata('username'))redirect('http://localhost/coder/login');

      $style = "<style>
      .button {
          display: block;
          width: 80px;
          height: 15px;
          background: #4E9CAF;
          padding: 10px;
          text-align: center;
          border-radius: 5px;
          color: white;
          font-weight: bold;
      }
      </style>";
      $username = $this->session->userdata('username');
      $res = $this->postmodel->getAllUserPost($username);
      $str = "";
      foreach ($res as $r) {
        $r['post'] = str_replace('<','&lt',$r['post']);
        $r['post'] = str_replace('>','&gt',$r['post']);
        $id = $r['postid'];
        $str.= "<b>".$r['posttitle']."</b>"."<div class='postDiv'><a class='postATag' href='/coder/posts/showUserSpecificPost/$id'><pre>".$r['post']."</pre></a></div><br>"
          ."<a class='button' style='float:left;' href='/coder/posts/editPost/$id'>Edit</a> <a style='float:left;' class='button' href=''>Delete</a> <br><hr><br>";
      }
      $data['tableData'] = $str;
      $data['style'] = $style;
      $data['title'] = 'Posts';
      $this->load->view('view_header',$data);
      $this->load->view('view_userpost',$data);
      $this->load->view('view_footer');
  }

  public function showUserSpecificPost($id){

    if(!$this->session->userdata('username')) redirect('http://localhost/coder/login');
    $res = $this->postmodel->getPost($id);
    if($res['postid'] == $id){

      $style = "<style>
      .button {
          display: block;
          width: 80px;
          height: 15px;
          background: #4E9CAF;
          padding: 10px;
          text-align: center;
          border-radius: 5px;
          color: white;
          font-weight: bold;
      }
      </style>";

      $this->load->model('usersmodel');
      $username = $res['username'];
      $userinfo = $this->usersmodel->getUserInfo($username);
      $fbURL = $userinfo['url'];
      $res['post'] = str_replace('<','&lt',$res['post']);
      $res['post'] = str_replace('>','&gt',$res['post']);

      $str = "<center><h1>Title: ".$res['posttitle']."</h1></center><hr><br><br>"
      ."<div style='margin-left:120px; font-size: 22px; line-height: 25px padding:50px;'><pre>".$res['post']."</pre></div><br><br><hr>"
      ."<div style='margin-top:50px; padding:30px;'><b>Author: ".$userinfo['name']."</b>"
      ."<strong><a style='margin-left:20px; text-decoration: none; color: blue;' href='$fbURL'>Facebook Profile</a></strong></div><br><br>"
      ."<a class='button' style='float:left;' href='/coder/posts/editPost/$id'>Edit</a> <a style='float:left;' class='button' href=''>Delete</a> <br><hr><br>";

      $data['postdata'] = $str;
      $data['style'] = $style;
      $data['title'] = 'Posts';
      $this->load->view('view_header',$data);
      $this->load->view('view_specificpost',$data);
      $this->load->view('view_footer');
    }
    else {
      echo "<script>alert('No Data Found.')</script>";
      redirect('http://localhost/coder/posts/mypost','refresh');
    }
  }
  public function editPost($postid){
    if(!$this->session->userdata('username')) redirect('http://localhost/coder/login');
    $res = $this->postmodel->getPost($postid);
    if(!$this->input->post('submit')){
      $style = "<style>
      .button {
          display: block;
          width: 80px;
          height: 15px;
          background: #4E9CAF;
          padding: 10px;
          text-align: center;
          border-radius: 5px;
          color: white;
          font-weight: bold;
      }
      </style>";
      $data['postdata'] = $res;
      $data['style'] = $style;
      $data['title'] = 'Edit Posts';
      $this->load->view('view_header',$data);
      $this->load->view('view_editpost',$data);
      $this->load->view('view_footer');
    }
    else {
      if($this->form_validation->run('postField')){
        $postdata = array(
          'posttitle' => $this->input->post('posttitle'),
          'post' => $this->input->post('post'),
          'tag' => $this->input->post('tag')
        );
        $this->postmodel->updatePost($postdata,$res);
        echo "<script>alert('Post updated successfully.');</script>";
        redirect('http://localhost/coder/posts/mypost','refresh');
      }
      else {
        $data['title'] = 'Edit Posts';
        $this->load->view('view_header',$data);
        $this->load->view('view_editpost',$data);
        $this->load->view('view_footer');
      }
    }
  }

  public function deletePost($postid){
    if(!$this->session->userdata('username')) redirect('http://localhost/coder/login');
  }
}
