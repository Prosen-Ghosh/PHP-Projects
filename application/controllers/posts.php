<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('postmodel');
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
      $data['postdata'] = $res;
      $data['title'] = 'Posts';
      $this->load->view('view_header',$data);
      $this->load->view('view_specificpost',$data);
      $this->load->view('view_footer');
    }
  }
}
