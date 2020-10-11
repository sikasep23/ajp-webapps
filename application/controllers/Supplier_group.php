<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier_group extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('supplier_group_model', 'supplier_group');
  }

  public function index()
  {
    is_logged_in();
    $data['currency'] = $this->db->get('m_currency')->result_array();
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['title']        = 'Supplier Group';
    $data['main_content'] = 'master/supplier_group';
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
    <script src="' . base_url() . 'assets/js/supplier_group.js"></script>
    <script src="' . base_url() . 'assets/js/jquery.mask.js"></script>';
    $this->load->view('layout/template', $data);  
  }

  function supplier_group_code()
  {
    $dariDB = $this->supplier_group->cekkode();
    $nourut = $dariDB;
    $code = $nourut + 1;
    $data = sprintf("%03s",$code);
    echo json_encode(["code" => $data]);
  }

  public function supplier_group_get()
  {

    $list = $this->supplier_group->get_datatables();
    $data = array();
    $no = $_POST['start'];
    //var_dump($list); die();
    foreach ($list as $pa) {
      $no++;
      $row = array();
      $row[] = $pa->sg_code;
      $row[] = strtoupper($pa->sg);
      $row[] = strtoupper($pa->sg_currency);

      $row[] = '<a class="badge badge-primary" href="javascript:void(0)" id="edit_pa" data-sid="' . "$pa->id" . '"><i class="glyphicon glyphicon-pencil"></i> Update</a>
              <a class="badge badge-danger" href="javascript:void(0)" id="delete_pa" data-did="' . "$pa->id" . '"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->supplier_group->count_all(),
      "recordsFiltered" => $this->supplier_group->count_filtered(),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function supplier_group_add()
  {
    $sg_code = trim(strtoupper($this->input->post('sg_code')));
    $sg = trim(strtoupper($this->input->post('sg')));
    $sg_currency = trim(strtoupper($this->input->post('sg_currency')));
    $data = array(
      'sg_code' => $sg_code,
      'sg' => $sg,
      'sg_currency' => $sg_currency
    );
    $this->supplier_group->save($data);
    echo json_encode(array("status" => TRUE));
  }

  function supplier_group_update()
  {
    $sg_code = trim(strtoupper($this->input->post('sg_code')));
    $sg = trim(strtoupper($this->input->post('sg')));
    $sg_currency = trim(strtoupper($this->input->post('sg_currency')));
    $data = array(
      'sg_code' => $sg_code,
      'sg' => $sg,
      'sg_currency' => $sg_currency
    );
    $id = $this->input->post('id');
    $this->supplier_group->update(array('id' => $id), $data);
    echo json_encode(array("status" => TRUE));
  }

  function supplier_group_edit($id)
  {
    $data = $this->supplier_group->get_by_id($id);
    echo json_encode($data);
  }

  function supplier_group_delete($sid)
  {
    $this->supplier_group->delete_by_id($sid);
    echo json_encode(array("status" => TRUE));
  }

}


/* End of file Supplier_group.php */
/* Location: ./application/controllers/Supplier_group.php */