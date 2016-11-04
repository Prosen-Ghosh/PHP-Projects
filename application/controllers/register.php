<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('usersmodel');
  }

  public function index(){
    if(!$this->input->post('submit')){
      $data['title'] = 'Register';
      $this->load->view('view_header',$data);
      $this->load->view('view_register');
      $this->load->view('view_footer');
    }
    else{
      if($this->form_validation->run('signup')){
        $user = array(
          'name' => $this->input->post('name'),
          'userName' => $this->input->post('userName'),
          'email' => $this->input->post('email'),
          'password' => $this->input->post('password')
        );
        $this->usersmodel->createNewUser($user);
        echo "<script>
        alert('Your Registraton Successfull. Go To Login Page To Login.');
        </script>";

        redirect('http://localhost/coder/login','refresh');
      }
      else{
        $data['title'] = 'Register';
        $this->load->view('view_header',$data);
        $this->load->view('view_register');
        $this->load->view('view_footer');
      }
    }
  }
  public function checkUpperCaseAndLowerCase($str){
    $len = strlen($str);
    $upper = False;
    $lower = False;
    for($i = 0; $i < $len; $i++){
      if($str[$i] >= 'A' && $str[$i] <= 'Z')$upper = True;
      if($str[$i] >= 'a' && $str[$i] <= 'z')$lower = True;
    }
    if($upper){
      if($lower){
        return True;
      }
      else{
        $this->form_validation->set_message('checkUpperCaseAndLowerCase','Password Must Contain At Least 1 Lowercase character.');
        return False;
      }
    }
    else {
      $this->form_validation->set_message('checkUpperCaseAndLowerCase','Password Must Contain At Least 1 Uppercase character');
      return False;
    }
  }
}
