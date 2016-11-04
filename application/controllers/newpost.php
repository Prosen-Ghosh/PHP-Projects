<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newpost extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('postmodel');
  }

  public function index(){
    if(!$this->session->userdata('username')) redirect('http://localhost/coder/login');
    if(!$this->input->post('submit')){
      $data['title'] = 'New Post';
      $this->load->view('view_header',$data);
      $this->load->view('view_newpost');
      $this->load->view('view_footer');
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
        $this->load->view('view_header',$data);
        $this->load->view('view_newpost');
        $this->load->view('view_footer');
      }
    }
  }
}
