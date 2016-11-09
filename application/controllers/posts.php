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
    $nav = '';
    if(!$this->session->userdata('username')){
      $nav = $this->getGuestNav();
    }else{
      if(strtolower($this->session->userdata('category')) == 'admin')$nav = $this->getAdminNav();
      else $nav = $this->getUserNav();
    }
    $data['tableData'] = $str;
    $data['title'] = 'Posts';
    $data['nav'] = $nav;
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
      $logedin = TRUE;
      if(!$this->session->userdata('username'))$logedin = FALSE;
      $data['postdata'] = $str;
      $data['style'] = $style;
      $data['title'] = 'Posts';
      $data['nav'] = ($logedin == FALSE)? $this->getGuestNav() : $this->getUserNav();
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
      $nav = '';
      if(!$this->session->userdata('username')){
        $nav = $this->getGuestNav();
      }else{
        if(strtolower($this->session->userdata('category')) == 'admin')$nav = $this->getAdminNav();
        else $nav = $this->getUserNav();
      }
      $data['tableData'] = $str;
      $data['style'] = $style;
      $data['title'] = 'Posts';
      $data['nav'] = $nav;
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

      $nav = '';
      if(!$this->session->userdata('username')){
        $nav = $this->getGuestNav();
      }else{
        if(strtolower($this->session->userdata('category')) == 'admin')$nav = $this->getAdminNav();
        else $nav = $this->getUserNav();
      }

      $data['postdata'] = $str;
      $data['style'] = $style;
      $data['postdata'] = $str;
      $data['style'] = $style;
      $data['commentTable'] = $commentTable;
      $data['title'] = 'Posts';
      $data['nav'] = $nav;
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
      $data['nav'] = (strtolower($this->session->userdata('category')) == 'admin') ? $this->getAdminNav() : $this->getUserNav();
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
      $data['commentTable'] = '';
      $data['nav'] = $this->getAdminNav();
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

    if(!$this->session->userdata('username')) redirect('http://localhost/coder/login');
      $this->postmodel->blockUserPost($postid);
      echo "<script>alert('This Pots Is blocked.')</script>";
      redirect('http://localhost/coder/posts/userPosts','refresh');
  }

  public function userBlockedPosts(){
    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    //if(!write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView));

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
      $data['title'] = 'Block Posts';
      $data['nav'] = $this->getAdminNav();
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
  public function newPost(){
    $this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    if(!write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView));

    if(!$this->session->userdata('username')) redirect('http://localhost/coder/login');
    if(!$this->input->post('submit')){
      $data['title'] = 'New Post';
      $data['nav'] = $this->getUserNav();
      $data['totalPageView'] = $totalSiteView;
      $this->load->view('view_header',$data);
      $this->load->view('view_newpost');
      $this->load->view('view_footer',$data);
    }
    else {
      if($this->form_validation->run('postField')){
        $postdata = array(
          'posttitle' => $this->input->post('posttitle'),
          'post' => $this->input->post('post'),
          'tag' => $this->input->post('tag')
        );

        $this->postmodel->createNewPost($postdata);
        echo "<script>
        alert('Your Post is Posted Seccessfully.');
        </script>";

        redirect('http://localhost/coder/posts','refresh');
      }
      else {
        $data['title'] = 'New Post';
        $data['nav'] = $this->getUserNav();
        $data['totalPageView'] = $totalSiteView;
        $this->load->view('view_header',$data);
        $this->load->view('view_newpost',$data);
        $this->load->view('view_footer',$data);
      }
    }
  }

  public function getAdminNav(){
    $uname = ucfirst($this->session->userdata('username'));
    return $nav = "<div class='header'>
    <div class='logo logoSize'></div>
    <div class='position'>
      <nav>
        <ul>
          <li><a href='/coder/'>Home</a></li>
          <li><a href='/coder/posts/userPosts'>Posts</a></li>
          <li><a href='/coder/adminhome/getAllUsers'>Users</a></li>
          <li><a href='/coder/adminhome/getAllBlockedUser'>Block Users</a></li>
          <li><a href='/coder/posts/userBlockedPosts'>Block Posts</a></li>
          <li style='float:right'>
            <select name='userinfo' onchange='location = this.value'>
              <option value=''>Option</option>
              <option value='/coder/adminhome/profile'>".$uname." Profile</option>
              <option value='/coder/logout'>Logout</option>
            </select>
          </li>
        </ul>
      </nav>
    </div>
    </div>";
  }

  public function getGuestNav(){
    return $nav = "<div class='header'>
    <div class='logo logoSize'></div>
    <div class='position'>
    	<nav>
    		<ul style='width: 225px;'>
    			<li><a class='active' href='/coder/'>Home</a></li>
    			<li><a href='/coder/posts'>Posts</a></li>
    		</ul>
    	</nav>
    </div>
    </div>";
  }

  public function getUserNav(){
    $uname = ucfirst($this->session->userdata('username'));
    return $nav = "<div class='header'>
    <div class='logo logoSize'></div>
    <div class='position'>
    	<nav>
    		<ul>
    			<li><a href='/coder/userhome'>Home</a></li>
    			<li><a href='/coder/posts'>Posts</a></li>
          <li><a href='/coder/posts/newpost'>New Post</a></li>
    			<li><a href='/coder/posts/mypost'>My Post</a></li>
          <li style='float:right'>
            <select name='userinfo' onchange='location = this.value'>
              <option value=''>".$uname." Profile</a></option>
              <option value='/coder/logout'>Logout</option>
            </select>
          </li>
    		</ul>
    	</nav>
    </div>
    </div>";
  }
}
