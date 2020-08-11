<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modelunit extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('modelunit_model', 'man');
  }

  public function index()
  {
    is_logged_in();
    $data['manufacture'] = $this->db->get_where('m_manufacture', ['is_active' => '1'])->result_array();
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['title']        = 'Modelunit';
    $data['main_content'] = 'master/modelunit';
    $data['class'] = 'active';
    $data['additional_header'] = '
    <link href="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css"/>
    <link href="' . base_url() . 'assets/plugins/select2/css/select2-bs4.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.css" rel="stylesheet" type="text/css"/>';
    $data['additional_footer'] = '
    <script src="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.js" type="text/javascript"></script>
    <script src="' . base_url() . 'assets/js/modelunit.js"></script>
    <script src="' . base_url() . 'assets/js/jquery.mask.js"></script>
    ';
    $this->load->view('layout/template', $data);
  }

  function modelunit_get()
  {
    $list = $this->man->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $pa) {
      $mf = $pa->mu_manufacture;
      $query = $this->db->get_where('m_manufacture', ['manufacture_code' => $mf])->row_array();
      $no++;
      $row = array();
      $row[] = $pa->mu_code;
      $row[] = $pa->mu_name;
      $row[] = $query['manufacture'];

      $row[] = '<a class="badge badge-primary" href="javascript:void(0)" id="edit" data-sid="' . "$pa->id" . '"><i class="glyphicon glyphicon-pencil"></i> Update</a>
              <a class="badge badge-danger" href="javascript:void(0)" id="delete" data-did="' . "$pa->id" . '"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->man->count_all(),
      "recordsFiltered" => $this->man->count_filtered(),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function modelunit_code()
  {
    $dariDB = $this->man->cekkode();
    $nourut = $dariDB;
    $codedept = $nourut + 1;
    $data = sprintf("%03s",$codedept);
    echo json_encode(["code" => $data]);
  }

  function modelunit_add()
  {
    $eq_code = trim(strtoupper($this->input->post('mu_code')));
    $eq_type = trim(strtoupper($this->input->post('mu')));
    $manufacture = trim(strtoupper($this->input->post('mu_manufacture')));
    $data = array(
      'mu_code' => $eq_code,
      'mu_name' => $eq_type,
      'mu_manufacture' => $manufacture
    );
    $insert = $this->man->save($data);
    echo json_encode(array("status" => TRUE));
  }

  function modelunit_edit($id)
  {
    $data = $this->man->get_by_id($id);
    echo json_encode($data);
  }

  function modelunit_update()
  {
    $data = array(
      'mu_code' => $this->input->post('mu_code'),
      'mu_name' => $this->input->post('mu'),
      'mu_manufacture' => $this->input->post('mu_manufacture')
    );
    $id = $this->input->post('id');
    $this->man->update(array('id' => $id), $data);
    echo json_encode(array("status" => TRUE));
  }

  function modelunit_delete($sid)
  {
    $this->man->delete_by_id($sid);
    echo json_encode(array("status" => TRUE));
  }

}


/* End of file Modelunit.php */
/* Location: ./application/controllers/Modelunit.php */