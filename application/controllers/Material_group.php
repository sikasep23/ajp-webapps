<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Material_group extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('material_group_model', 'matgro');
  }

  public function index()
  {
    is_logged_in();
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['matcat_type'] = $this->db->get('sub_matcat_type')->result_array();
    $data['matcat_stmain'] = $this->db->get('sub_matcat_stmain')->result_array();
    $data['title']        = 'Material group';
    $data['main_content'] = 'master/material_group';
    $data['class'] = 'active';
    $data['additional_header'] = '
    <link href="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css"/><link href="' . base_url() . 'assets/plugins/select2/css/select2-bs4.css" rel="stylesheet" type="text/css"/>
    <link href="' . base_url() . 'assets/plugins/custombox/css/custombox.min.css" rel="stylesheet">
    <link href="' . base_url() . 'assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.css" rel="stylesheet" type="text/css"/>';
    $data['additional_footer'] = '
    <script src="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/custombox/js/custombox.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/custombox/js/custombox.legacy.min.js"></script>
    <script src="' . base_url() . 'assets/js/select2.js" type="text/javascript"></script>
    <script src="' . base_url() . 'assets/plugins/toastr/toastr.min.js"></script>
    <script src="' . base_url() . 'assets/js/mtr_group.js"></script>
    <script src="' . base_url() . 'assets/js/jquery.mask.js"></script>
    ';
    $this->load->view('layout/template', $data);
  }

  function material_group_code()
  {
    $dariDB = $this->matgro->cekkode();
    $nourut = substr($dariDB, 3, 4);
    //echo $nourut; die();
    $code = $nourut + 1;
    $data = sprintf("%03s", $code);
    echo json_encode(["code" => $data]);
  }

  function material_group_get()
  {
    $list = $this->matgro->get_datatables();
    $data = array();
    $no = $_POST['start'];

    foreach ($list as $pa) {
      $row = array();
      $row[] = $pa->material_gro_code;
      $row[] = $pa->material_gro_group;
      $row[] = $pa->material_gro_type;      
      $row[] = $pa->material_gro_pc_cat;
      $row[] = $pa->material_gro_pc_subcat;
      $row[] = $pa->material_gro_log_cat;
      $row[] = '<a class="badge badge-primary" href="javascript:void(0)" id="edit" data-sid="' . "$pa->id" . '"><i class="glyphicon glyphicon-pencil"></i> Update</a>
              <a class="badge badge-danger" href="javascript:void(0)" id="delete" data-did="' . "$pa->id" . '"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->matgro->count_all(),
      "recordsFiltered" => $this->matgro->count_filtered(),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function material_group_add()
  {
    $code = $this->input->post('code', TRUE);
    $type = $this->input->post('type', TRUE);
    $group = $this->input->post('group', TRUE);
    $plc_cat = $this->input->post('plc-cat', TRUE);
    $plc_subcat = $this->input->post('plc-subcat', TRUE);
    $logistic_cat = $this->input->post('logistic-cat', TRUE);

    $data = [
      'material_gro_code' => $code,
      'material_gro_type' => strtoupper($type),
      'material_gro_group' => strtoupper($group),
      'material_gro_pc_cat' => strtoupper($plc_cat),
      'material_gro_pc_subcat' => strtoupper($plc_subcat),
      'material_gro_log_cat' => strtoupper($logistic_cat)
    ];
    $this->db->insert('m_material_gro', $data);
    echo json_encode(["status" => TRUE]);
  }

  function material_group_edit($id)
  {
    $data = $this->matgro->get_by_id($id);
    echo json_encode($data);
  }

  function material_group_update()
  {
    $code = $this->input->post('code', TRUE);
    $type = $this->input->post('type', TRUE);
    $group = $this->input->post('group', TRUE);
    $plc_cat = $this->input->post('plc-cat', TRUE);
    $plc_subcat = $this->input->post('plc-subcat', TRUE);
    $logistic_cat = $this->input->post('logistic-cat', TRUE);
    $data = [
      'material_gro_code' => $code,
      'material_gro_type' => strtoupper($type),
      'material_gro_group' => strtoupper($group),
      'material_gro_pc_cat' => strtoupper($plc_cat),
      'material_gro_pc_subcat' => strtoupper($plc_subcat),
      'material_gro_log_cat' => strtoupper($logistic_cat)
    ];

    $this->matgro->update(['id' => $this->input->post('id')], $data);
    echo json_encode(["status" => TRUE]);
  }
}