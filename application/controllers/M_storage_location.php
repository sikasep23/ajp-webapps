<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_storage_location extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_storage_location_model', 'storage');
  }

  public function index()
  {
    is_logged_in();
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['title']        = 'Storage Location';
    $data['main_content'] = 'master/storage_location';
    $data['class'] = 'active';
    $data['additional_header'] = '
    <link href="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css"/>';
    $data['additional_footer'] = '
    <script type="text/javascript" src="' . base_url() . 'assets/plugins/parsleyjs/parsley.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="' . base_url() . 'assets/js/brand.js"></script>
    <script src="' . base_url() . 'assets/js/jquery.mask.js"></script>';
    $this->load->view('layout/template', $data);  
  }

}


/* End of file M_storage_location.php */
/* Location: ./application/controllers/M_storage_location.php */