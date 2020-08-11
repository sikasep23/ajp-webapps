<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    is_logged_in();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['title']        = 'Dashboard';
    $data['main_content'] = 'dashboard';
    $data['class'] = 'active';
    $data['additional_header'] = "";
    $data['additional_footer'] = '';
    $this->load->view('layout/template', $data);
  }
}
