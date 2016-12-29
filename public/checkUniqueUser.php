<?php
$userName = $this->input->get('username');
$this->load->database();
$this->load->model('usersmodel');

if($val['user'] >= '1')echo "false";
else echo "true";
