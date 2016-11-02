<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BlogHome extends CI_Controller{
	public function index(){
		$data['title'] = "Codes Blog";
		$this->load->view("view_header",$data);
		$this->load->view("view_bloghome");
		$this->load->view("view_footer");
	}
}
