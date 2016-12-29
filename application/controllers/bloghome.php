<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BlogHome extends CI_Controller{
	public function index(){
		$this->load->helper('file');
		$totalSiteView = read_file('C:\xampp\htdocs\coder\application\doc\pageview.txt');
		$totalSiteView = intval($totalSiteView);

		if(!$this->session->userdata('bloghome')){
			$this->session->set_userdata('bloghome','bloghome');
	    if(!write_file('C:\xampp\htdocs\coder\application\doc\pageview.txt',++$totalSiteView));
		}

		$data['title'] = "Codes Blog";
		$data['totalPageView'] = $totalSiteView;
		$this->parser->parse("view_header",$data);
		$this->load->view("view_bloghome");
		$this->parser->parse("view_footer",$data);
	}
}
