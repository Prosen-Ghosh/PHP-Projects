<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
  'login' => array(
    array(
      'field' => 'userName',
      'label' => 'User Name',
      'rules' => 'trim|required'
    ),
    array(
      'field' => 'password',
      'label' => 'Password',
      'rules' => 'trim|required'
    )
  ),
  'signup' => array(
    array(
      'field' => 'name',
      'label' => 'Name',
      'rules' => 'trim|required|alpha'
    ),
    array(
      'field' => 'userName',
      'label' => 'User Name',
      'rules' => 'trim|required|is_unique[users.username]'
    ),
    array(
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'trim|required|valid_email|is_unique[users.email]'
    ),
    array(
      'field' => 'password',
      'label' => 'Password',
      'rules' => 'trim|required|min_length[6]|callback_checkUpperCaseAndLowerCase'
    ),
    array(
      'field' => 'confrimPassword',
      'label' => 'Confrim Password',
      'rules' => 'trim|required|min_length[6]|matches[password]'
    )
  ),
  'postField' => array(
    array(
      'field' => 'posttitle',
      'label' => 'Post Title',
      'rules' => 'trim|required'
    ),
    array(
      'field' => 'post',
      'label' => 'Post',
      'rules' => 'trim|required|min_length[60]'
    ),
    array(
      'field' => 'tag',
      'label' => 'Tag',
      'rules' => 'trim|required'
    )
  ),
  'commentField' => array(
    array(
      'field' => 'comment',
      'label' => 'Comment Text',
      'rules' => 'trim|required'
    )
  )
);
