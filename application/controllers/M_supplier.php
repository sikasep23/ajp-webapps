<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_supplier extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['role'] = $this->db->get_where('user_role', ['is_active' => '1'])->result_array();
    $data['supplier_data'] = $this->db->get_where('m_supplier', ['is_active' => '1'])->result_array();
    $data['supplier_group'] = $this->db->get_where('m_supplier_group', ['is_active' => '1'])->result_array();
    $data['title']        = 'Master supplier';
    $data['main_content'] = 'master/m_supplier';
    $data['class'] = 'active';
    $data['additional_header'] = '
    <link href="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css"/>
    <link href="' . base_url() . 'assets/plugins/custombox/css/custombox.min.css" rel="stylesheet">
    <link href="' . base_url() . 'assets/plugins/select2/css/select2-bs4.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.css" rel="stylesheet" type="text/css"/>
    <link href="' . base_url() . 'assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="' . base_url() . 'assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
    ';
    $data['additional_footer'] = '
    <script type="text/javascript" src="' . base_url() . 'assets/plugins/parsleyjs/parsley.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/custombox/js/custombox.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/custombox/js/custombox.legacy.min.js"></script>
    <script src="' . base_url() . 'assets/js/select2.js" type="text/javascript"></script>
    <script src="' . base_url() . 'assets/plugins/moment/moment.js"></script>
    <script src="' . base_url() . 'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/toastr/toastr.min.js"></script>
    <script src="' . base_url() . 'assets/js/m_supplier.js"></script>
    <script src="' . base_url() . 'assets/js/jquery.mask.js"></script>';
    $this->load->view('layout/template', $data); 
  }

  function m_supplier_add()
  {
    $supp_code = $this->input->post('supp_code', TRUE);
    $supp_name = $this->input->post('supp_name', TRUE);
    $group = $this->input->post('group', TRUE);
    $npwp = $this->input->post('npwp', TRUE);
    $address = $this->input->post('address', TRUE);
    $city = $this->input->post('city', TRUE);
    $phone = $this->input->post('phone', TRUE);
    $contact_name = $this->input->post('contact_name', TRUE);
    $email = $this->input->post('email', TRUE);
    $website = $this->input->post('website', TRUE);
    $top = $this->input->post('top', TRUE);
    $limit_day = $this->input->post('limit_day', TRUE);
    $ship_mode = $this->input->post('ship_mode', TRUE);
    $tax = $this->input->post('tax', TRUE);
    $otax = $this->input->post('otax', TRUE);
    $otax2 = $this->input->post('otax2', TRUE);
    $is_active = '1';

    $data = [
      'supp_code' => $supp_code,
      'supp_name' => $supp_name,
      'supp_group' => $group,
      'supp_npwp' => $npwp,
      'supp_address' => $address,
      'supp_city' => $city,
      'supp_phone' => $phone,
      'supp_contact' => $contact_name,
      'supp_email' => $email,
      'supp_website' => $website,
      'supp_top' => $top,
      'supp_limit' => $limit_day,
      'supp_ship' => $ship_mode,
      'supp_tax1' => $tax,
      'supp_tax2' => $otax,
      'supp_tax3' => $otax2,
      'is_active' => $is_active,
      
    ];

    $this->db->insert('m_supplier', $data);
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('message', 'Added');
      redirect('master/m_supplier');
    }

  }

  function m_supplier_delete()
  {
    $id = $this->input->post('id');
    $this->db->set('is_active', '0');
    $this->db->where('id', $id);
    $this->db->update('m_supplier');
    echo json_encode(array("status" => TRUE));
  }

}


/* End of file M_supplier.php */
/* Location: ./application/controllers/M_supplier.php */