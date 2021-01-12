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
    $data['additional_header'] = '
    <link rel="stylesheet" href="' . base_url() . 'assets/plugins/morris/morris.css">';
    $data['additional_footer'] = '
    <script src="'.base_url().'assets/plugins/morris/morris.min.js"></script>
    <script src="'.base_url().'assets/plugins/raphael/raphael-min.js"></script>
    <script src="'.base_url().'assets/pages/jquery.dashboard.js"></script>
    ';
    $this->load->view('layout/template', $data);
  }
}
