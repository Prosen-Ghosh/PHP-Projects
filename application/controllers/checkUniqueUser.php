<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$userName = $this->input->post('username');
$val = $this->usersmodel->getUsername($userName);
if($val['user'] >= '1')echo "false";
else echo "true";
