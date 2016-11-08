<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('postmodel');
    $this->load->model('usersmodel');
    $this->load->model('commentmodel');
  }

  public function index(){

    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    if(!write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView));

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
    $data['totalPageView'] = $totalSiteView;
    $this->load->view('view_header',$data);
    $this->load->view('view_posts',$data);
    $this->load->view('view_footer',$data);
  }

  public function showSpecificPost($id){
    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    if(!write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView));

    $res = $this->postmodel->getPost($id);
    $comments = $this->commentmodel->postComment($id);
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

      $commentTable = "<center><h1>Comments</h1></center><table>";

      foreach($comments as $com){
        $username = $com['username'];
        $userinfo = $this->usersmodel->getUserInfo($username);
        $uname = $userinfo['name'];
        $commentTable .= "<tr><td><b>"
        .$uname.":</b><br><div class='commentStyle'>"
        .$com['comment']."</div></td></tr>";
      }
      $commentTable.="</table>";
      if($this->session->userdata('username')){
        $commentTable.="<form action='/coder/posts/postNewComment/$id' method='post'><table><tr><td><input type='text' name='comment' value='".set_value('comment')."' placeholder='Enter comment'></td>"
        ."<td style='color:red;'>".form_error('comment')."</td><td><input type='submit' name='submit' value='Submit'></td></tr></table></form>";
      }
      $style = "<style>
      .commentStyle {
        border: 2px solid #a1a1a1;
        padding: 10px 40px;
        background: #dddddd;
        width: 300px;
        border-radius: 20px;
        margin-left: 35px;
      }
      </style>";
      $data['postdata'] = $str;
      $data['style'] = $style;
      $data['title'] = 'Posts';
      $data['commentTable'] = $commentTable;
      $data['totalPageView'] = $totalSiteView;
      $this->load->view('view_header',$data);
      $this->load->view('view_specificpost',$data);
      $this->load->view('view_footer',$data);
    }
    else {
      echo "<script>alert('No Data Found.')</script>";
      redirect('http://localhost/coder/posts','refresh');
    }
  }

  public function mypost(){
    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    if(!write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView));

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
          ."<a class='button' style='float:left;' href='/coder/posts/editPost/$id'>Edit</a>"
          ." <a style='float:left;' class='button' href='/coder/posts/deletePost/$id'>Delete</a> <br><hr><br>";
      }
      $data['tableData'] = $str;
      $data['style'] = $style;
      $data['title'] = 'Posts';
      $data['totalPageView'] = $totalSiteView;
      $this->load->view('view_header',$data);
      $this->load->view('view_userpost',$data);
      $this->load->view('view_footer',$data);
  }

  public function showUserSpecificPost($id){

    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    if(!write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView));

    if(!$this->session->userdata('username')) redirect('http://localhost/coder/login');
    $res = $this->postmodel->getPost($id);
    $comments = $this->commentmodel->postComment($id);
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
      .commentStyle {
        border: 2px solid #a1a1a1;
        padding: 10px 40px;
        background: #dddddd;
        width: 300px;
        border-radius: 20px;
        margin-left: 35px;
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
      ."<a class='button' style='float:left;' href='/coder/posts/editPost/$id'>Edit</a>"
      ." <a style='float:left;' class='button' href='/coder/posts/deletePost/$id'>Delete</a> <br><hr><br>";

      $commentTable = "<center><h1>Comments</h1></center><table>";

      foreach($comments as $com){
        $username = $com['username'];
        $userinfo = $this->usersmodel->getUserInfo($username);
        $uname = $userinfo['name'];
        $commentTable .= "<tr><td><b>"
        .$uname.":</b><br><div class='commentStyle'>"
        .$com['comment']."</div></td></tr>";
      }
      $commentTable.="</table>";
      $commentTable.="<form action='/coder/posts/postNewComment/$id' method='post'><table><tr><td><input type='text' name='comment' value='".set_value('comment')."' placeholder='Enter comment'></td>"
      ."<td style='color:red;'>".form_error('comment')."</td><td><input type='submit' name='submit' value='Submit'></td></tr></table></form>";

      $data['postdata'] = $str;
      $data['style'] = $style;
      $data['postdata'] = $str;
      $data['style'] = $style;
      $data['commentTable'] = $commentTable;
      $data['title'] = 'Posts';
      $data['totalPageView'] = $totalSiteView;
      $this->load->view('view_header',$data);
      $this->load->view('view_specificpost',$data);
      $this->load->view('view_footer',$data);
    }
    else {
      echo "<script>alert('No Data Found.')</script>";
      redirect('http://localhost/coder/posts/mypost','refresh');
    }
  }

  public function editPost($postid){
    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    if(!write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView));

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
      $data['totalPageView'] = $totalSiteView;
      $this->load->view('view_header',$data);
      $this->load->view('view_editpost',$data);
      $this->load->view('view_footer',$data);
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
        $data['totalPageView'] = $totalSiteView;
        $this->load->view('view_header',$data);
        $this->load->view('view_editpost',$data);
        $this->load->view('view_footer',$data);
      }
    }
  }

  public function deletePost($postid){
    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    if(!write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView));

    if(!$this->session->userdata('username')) redirect('http://localhost/coder/login');
    if(!$this->input->post('submit')){
      $style = "<style>
      .button {
        width: 65%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }
      </style>";
      $data['style'] = $style;
      $data['title'] = 'Delete Posts';
      $data['totalPageView'] = $totalSiteView;
      $this->load->view('view_header',$data);
      $this->load->view('view_deletepost',$data);
      $this->load->view('view_footer',$data);
    }
    else {
      $this->postmodel->deleteMyPost($postid);
      redirect('http://localhost/coder/posts/mypost','refresh');
    }
  }

  public function userPosts(){
    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    if(!write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView));

    if(!$this->session->userdata('username'))redirect('http://localhost/coder/login');
      $style = "<style>
      .button {
          display: block;
          width: 100%;
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
      $res = $this->postmodel->getAllPost();
      $str = "";
      foreach ($res as $r) {
        $r['post'] = str_replace('<','&lt',$r['post']);
        $r['post'] = str_replace('>','&gt',$r['post']);
        $id = $r['postid'];
        $str.= "<b>".$r['posttitle']."</b>"."<div class='postDiv'><a class='postATag' href='/coder/posts/specificPostForBlock/$id'><pre>".$r['post']."</pre></a></div><br>"
          ."<a class='button' style='float:left;' href='/coder/posts/blockPost/$id'>Block This Post.</a>";
      }
      $data['tableData'] = $str;
      $data['style'] = $style;
      $data['title'] = 'Posts';
      $data['totalPageView'] = $totalSiteView;
      $this->load->view('view_header',$data);
      $this->load->view('view_userpost',$data);
      $this->load->view('view_footer',$data);
  }

  public function specificPostForBlock($id){
    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    if(!write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView));

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
      ."<a class='button' style='float:left;' href='/coder/posts/blockPost/$id'>Block This Post.</a>";

      $data['postdata'] = $str;
      $data['style'] = $style;
      $data['title'] = 'Posts';
      $data['totalPageView'] = $totalSiteView;
      $this->load->view('view_header',$data);
      $this->load->view('view_specificpost',$data);
      $this->load->view('view_footer',$data);
    }
    else {
      echo "<script>alert('No Data Found.')</script>";
      redirect('http://localhost/coder/posts/userPosts','refresh');
    }
  }

  public function blockPost($postid){
    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    if(!write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView));

    if(!$this->session->userdata('username')) redirect('http://localhost/coder/login');
      $this->postmodel->blockUserPost($postid);
      echo "<script>alert('This Pots Is blocked.')</script>";
      redirect('http://localhost/coder/posts/userPosts','refresh');
  }

  public function userBlockedPosts(){
    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    if(!write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView));

    if(!$this->session->userdata('username'))redirect('http://localhost/coder/login');
      $style = "<style>
      .button {
          display: block;
          width: 100%;
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
      $res = $this->postmodel->getAllBlockedPost();
      $str = "";
      foreach ($res as $r) {
        $r['post'] = str_replace('<','&lt',$r['post']);
        $r['post'] = str_replace('>','&gt',$r['post']);
        $id = $r['postid'];
        $str.= "<b>".$r['posttitle']."</b>"."<div class='postDiv'><a class='postATag' href='/coder/posts/specificPostForBlock/$id'><pre>".$r['post']."</pre></a></div><br>"
          ."<a class='button' style='float:left;' href='/coder/posts/unblockPost/$id'>Unblock This Post.</a>";
      }
      $data['tableData'] = $str;
      $data['style'] = $style;
      $data['title'] = 'Posts';
      $data['totalPageView'] = $totalSiteView;
      $this->load->view('view_header',$data);
      $this->load->view('view_userpost',$data);
      $this->load->view('view_footer',$data);
  }

  public function unblockPost($postid){
    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    if(!write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView));

    if(!$this->session->userdata('username')) redirect('http://localhost/coder/login');
      $this->postmodel->unBlockUserPost($postid);
      echo "<script>alert('This Pots Is unblocked.')</script>";
      redirect('http://localhost/coder/posts/userBlockedPosts','refresh');
  }
  public function postNewComment($id){
    if(!$this->session->userdata('username')) redirect('http://localhost/coder/login');
    if($this->form_validation->run('commentField')){
      $commentdata = array(
        'comment' => $this->input->post('comment'),
        'username' => $this->session->userdata('username'),
        'postid' => $id
      );
      $this->commentmodel->newComment($commentdata);
      echo "<script>alert('Comment Posted.')</script>";
      redirect('http://localhost/coder/posts/showSpecificPost/'.$id,'refresh');
    }
    else redirect('http://localhost/coder/posts/showSpecificPost/'.$id,'refresh');
  }
}
