<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Equipment_type extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('equipment_type_model','equipment');
  }

  public function index()
  {
    is_logged_in();
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['title']        = 'Equipment Type';
    $data['main_content'] = 'master/equipment_type';
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
    <script src="' . base_url() . 'assets/js/equipment.js"></script>
    <script src="' . base_url() . 'assets/js/jquery.mask.js"></script>
    ';
    $this->load->view('layout/template', $data);
  }

  function equipment_type_get()
  {
    $list = $this->equipment->get_datatables();
    $data = array();
    $no = $_POST['start'];
    //var_dump($list); die();
    foreach ($list as $pa) {
      $no++;
      $row = array();
      $row[] = $pa->equipment_code;
      $row[] = $pa->equipment_type;

      $row[] = '<a class="badge badge-primary" href="javascript:void(0)" id="edit_dept" data-sid="' . "$pa->id" . '"><i class="glyphicon glyphicon-pencil"></i> Update</a>
              <a class="badge badge-danger" href="javascript:void(0)" id="delete_dept" data-did="' . "$pa->id" . '"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->equipment->count_all(),
      "recordsFiltered" => $this->equipment->count_filtered(),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function equipment_type_code()
  {
    $dariDB = $this->equipment->cekkode();
    $nourut = $dariDB;
    $codedept = $nourut + 1;
    $data = sprintf("%03s",$codedept);
    echo json_encode(["code" => $data]);
  }

  function equipment_type_add()
  {
    $eq_code = trim(strtoupper($this->input->post('eq_code')));
    $eq_type = trim(strtoupper($this->input->post('eq_type')));
    $data = array(
      'equipment_code' => $eq_code,
      'equipment_type' => $eq_type
    );
    $insert = $this->equipment->save($data);
    echo json_encode(array("status" => TRUE));
  }

  function equipment_type_edit($id)
  {
    $data = $this->equipment->get_by_id($id);
    echo json_encode($data);
  }

  function equipment_type_update()
  {
    $data = array(
      'equipment_code' => $this->input->post('eq_code'),
      'equipment_type' => $this->input->post('eq_type')
    );
    $id = $this->input->post('id');
    $this->equipment->update(array('id' => $id), $data);
    echo json_encode(array("status" => TRUE));
  }

  function equipment_type_delete($sid)
  {
    $this->equipment->delete_by_id($sid);
    echo json_encode(array("status" => TRUE));
  }

}


/* End of file Equipment_type.php */
/* Location: ./application/controllers/Equipment_type.php */