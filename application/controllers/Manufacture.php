<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manufacture extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('manufacture_model', 'man');
  }

  public function index()
  {
    is_logged_in();
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['title']        = 'Manufacture';
    $data['main_content'] = 'master/manufacture';
    $data['class'] = 'active';
    $data['additional_header'] = '
    <link href="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css"/>';
    $data['additional_footer'] = '
    <script src="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="' . base_url() . 'assets/js/manufacture.js"></script>
    <script src="' . base_url() . 'assets/js/jquery.mask.js"></script>
    ';
    $this->load->view('layout/template', $data);
  }

  function manufacture_get()
  {
    $list = $this->man->get_datatables();
    $data = array();
    $no = $_POST['start'];
    //var_dump($list); die();
    foreach ($list as $pa) {
      $no++;
      $row = array();
      $row[] = $pa->manufacture_code;
      $row[] = $pa->manufacture;

      $row[] = '<a class="badge badge-primary" href="javascript:void(0)" id="edit_dept" data-sid="' . "$pa->id" . '"><i class="glyphicon glyphicon-pencil"></i> Update</a>
              <a class="badge badge-danger" href="javascript:void(0)" id="delete_dept" data-did="' . "$pa->id" . '"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

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

  function manufacture_code()
  {
    $dariDB = $this->man->cekkode();
    $nourut = $dariDB;
    $codedept = $nourut + 1;
    $data = sprintf("%03s",$codedept);
    echo json_encode(["code" => $data]);
  }

  function manufacture_add()
  {
    $eq_code = trim(strtoupper($this->input->post('mf_code')));
    $eq_type = trim(strtoupper($this->input->post('mf')));
    $data = array(
      'manufacture_code' => $eq_code,
      'manufacture' => $eq_type
    );
    $insert = $this->man->save($data);
    echo json_encode(array("status" => TRUE));
  }

  function manufacture_edit($id)
  {
    $data = $this->man->get_by_id($id);
    echo json_encode($data);
  }

  function manufacture_update()
  {
    $data = array(
      'manufacture_code' => $this->input->post('mf_code'),
      'manufacture' => $this->input->post('mf')
    );
    $id = $this->input->post('id');
    $this->man->update(array('id' => $id), $data);
    echo json_encode(array("status" => TRUE));
  }

  function manufacture_delete($sid)
  {
    $this->man->delete_by_id($sid);
    echo json_encode(array("status" => TRUE));
  }

}


/* End of file Manufacture.php */
/* Location: ./application/controllers/Manufacture.php */