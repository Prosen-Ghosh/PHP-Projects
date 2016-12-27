<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Adminhome extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('usersmodel');
    $this->load->helper('file');
    $this->load->model('postviewmodel');
  }
  public function index(){
    if($this->session->userdata('username') && strtolower($this->session->userdata('username')) == "admin"){
      $totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
  		$totalSiteView = intval($totalSiteView);

      $data['title'] = 'Home';
      $data['totalPageView'] = $totalSiteView;
      $data['username'] = ucfirst($this->session->userdata('username'));
      $this->parser->parse('view_header',$data);
      $this->parser->parse('view_adminhome',$data);
      $this->load->view('view_footer');
    }
    else  redirect('http://localhost/coder/login');
  }

  public function getAllUsers(){
    $totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);

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
      $data['nav'] = $this->getAdminNav();
      $data['totalPageView'] = $totalSiteView;
      $data['username'] = ucfirst($this->session->userdata('username'));
      $this->parser->parse('view_header',$data);
      $this->parser->parse('view_usersinfo',$data);
      $this->load->view('view_footer');
    }
  }

  public function getSpecificUserForBlock($uname){
    $totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);

    if(!$this->session->userdata('username'))redirect('http://localhost/coder/login');
      $style = "<style>
      .button {
          display: block;
          width: 100px;
          height: 25px;
          background: #4E9CAF;
          padding: 10px;
          text-align: center;
          border-radius: 5px;
          color: white;
          font-weight: bold;
      }
      </style>";
    $string = "<center><h1 style='color:red;'>Are You Sure That you want to block this user.</h1></center>"
    ."<table><tr><td><a class='button' href='/coder/adminhome/blockuser/$uname'>YES</a> <a class='button' href='/coder/adminhome/getAllUsers'>NO</a></td></tr></table>";
    $data['string'] = $string;
    $data['style'] = $style;
    $data['title'] = 'Users';
    $data['totalPageView'] = $totalSiteView;
    $data['username'] = ucfirst($this->session->userdata('username'));
    $this->parser->parse('view_header',$data);
    $this->parser->parse('view_blockuser',$data);
    $this->load->view('view_footer');
  }

  function blockUser($uname){
    if(!$this->session->userdata('username'))redirect('http://localhost/coder/login');
    $this->usersmodel->_blockUser($uname);
    echo "<script>alert('Selected User is Blocked.');</script>";
    redirect('http://localhost/coder/adminhome/getAllUsers','refresh');
  }

  public function getAllBlockedUser(){
    $totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);

    if(!$this->session->userdata('username'))redirect('http://localhost/coder/login');
    $res = $this->usersmodel->getBlockedUser();
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
          ."<tr><td><a class='button' style='float:left;' href='/coder/adminhome/getSpecificUserForUnblock/$uname'>Unblock This User.</a></td></tr>";
      }
      $str.='</table>';
      $data['title'] = 'Blocked Users List';
      $data['userData'] = $str;
      $data['style'] = $style;
      $data['nav'] = $this->getAdminNav();
      $data['totalPageView'] = $totalSiteView;
      $data['username'] = ucfirst($this->session->userdata('username'));
      $this->parser->parse('view_header',$data);
      $this->parser->parse('view_usersinfo',$data);
      $this->load->view('view_footer');
    }
  }

  public function getSpecificUserForUnblock($uname){
    if(!$this->session->userdata('username'))redirect('http://localhost/coder/login');
    $this->usersmodel->_unblockUser($uname);
    echo "<script>alert('This User Is Now Unblocked.')</script>";
    redirect('http://localhost/coder/adminhome/getAllBlockedUser','refresh');
  }

  public function profile(){
    $totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);

    $data['title'] = ucfirst($this->session->userdata('username')).' Profile';
    $data['nav'] = $this->getAdminNav();
    $data['totalPageView'] = $totalSiteView;
    $data['username'] = ucfirst($this->session->userdata('username'));
    $this->parser->parse('view_header',$data);
    $this->parser->parse('view_profile',$data);
    $this->load->view('view_footer');
  }

  public function reports(){
    $totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);
    $res = $this->postviewmodel->getTopTenPost();
    $topTenPost = "<center><h2>Top Ten Post</h2><table border='1'><tr><th>#Post</th><th>Post Title</th> <th>Total Post View</th></tr>";
    $i = 0;
    foreach ($res as $r) {
      $i++;
      $topTenPost.= "<tr><td>$i</td><td>".$r['posttitle']."</td> <td>".$r['totalpostview']."</td></tr>";
    }
    $topTenPost .="</table></center><br />";

    $res = $this->postviewmodel->getTopTenBlogger();
    $topTenBlogger = "<center><h2>Top Ten Blogger</h2><table border='1'><tr><th>Serial</th><th>Blogger Name</th> <th>Total Visitor</th></th> <th>Total Post</th></tr>";
    $i = 0;
    foreach ($res as $r) {
      $i++;
      $topTenBlogger.= "<tr><td>$i</td><td>".$r['name']."</td> <td>".$r['visited']."</td><td>".$r['Post']."</td></tr>";
    }
    $topTenBlogger .="</table></center><br />";

    $data['nav'] = $this->getAdminNav();
    $data['totalPageView'] = $totalSiteView;
    $data['topTenPost'] = $topTenPost;
    $data['topTenBlogger'] = $topTenBlogger;
    $data['title'] = "Blog Report";
    $data['username'] = ucfirst($this->session->userdata('username'));
    $this->parser->parse('view_header',$data);
    $this->parser->parse('view_report',$data);
    $this->load->view('view_footer',$data);
  }
  public function getAdminNav(){
    $uname = ucfirst($this->session->userdata('username'));
    return $nav = "<div class='header'>
    <div class='logo logoSize'></div>
    <div class='position'>
      <nav>
        <ul>
          <li><a href='/coder/adminhome'>Home</a></li>
          <li><a href='/coder/posts/userPosts'>Posts</a></li>
          <li><a href='/coder/adminhome/getAllUsers'>Users</a></li>
          <li><a href='/coder/adminhome/getAllBlockedUser'>Block Users</a></li>
          <li><a href='/coder/posts/userBlockedPosts'>Block Posts</a></li>
          <li><a href='/coder/adminhome/reports'>Reports</a></li>
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
}
