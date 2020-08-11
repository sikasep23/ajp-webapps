<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Order extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['title']        = 'Dashboard';
    $data['main_content'] = 'po/po';
    $data['class'] = 'active';
    $data['additional_header'] = "";
    $data['additional_footer'] = '';
    $this->load->view('layout/template', $data);
  }

}


/* End of file Order.php */
/* Location: ./application/controllers/Order.php */