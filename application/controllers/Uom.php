<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Uom extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('uom_model', 'uom');
  }

  public function index()
  {
    is_logged_in();
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['title']        = 'Master UoM';
    $data['main_content'] = 'master/uom';
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
    <script src="' . base_url() . 'assets/js/uom.js"></script>
    <script src="' . base_url() . 'assets/js/jquery.mask.js"></script>';
    $this->load->view('layout/template', $data); 
  }

  function uom_code()
  {
    $dariDB = $this->uom->cekkode();
    $nourut = $dariDB;
    $code = $nourut + 1;
    $data = sprintf("%03s",$code);
    echo json_encode(["code" => $data]);
  }

  public function uom_get()
  {

    $list = $this->uom->get_datatables();
    $data = array();
    $no = $_POST['start'];
    //var_dump($list); die();
    foreach ($list as $pa) {
      $no++;
      $row = array();
      $row[] = $pa->uom_code;
      $row[] = strtoupper($pa->uom);

      $row[] = '<a class="badge badge-primary" href="javascript:void(0)" id="edit_pa" data-sid="' . "$pa->id" . '"><i class="glyphicon glyphicon-pencil"></i> Update</a>
              <a class="badge badge-danger" href="javascript:void(0)" id="delete_pa" data-did="' . "$pa->id" . '"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->uom->count_all(),
      "recordsFiltered" => $this->uom->count_filtered(),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function uom_add()
  {
    $uom_code = trim(strtoupper($this->input->post('uom_code')));
    $uom = trim(strtoupper($this->input->post('uom')));
    $data = array(
      'uom_code' => $uom_code,
      'uom' => $uom
    );
    $this->uom->save($data);
    echo json_encode(array("status" => TRUE));
  }

  function uom_update()
  {
    $uom_code = trim(strtoupper($this->input->post('uom_code')));
    $uom = trim(strtoupper($this->input->post('uom')));
    $data = array(
      'uom_code' => $uom_code,
      'uom' => $uom
    );
    $id = $this->input->post('id');
    $this->uom->update(array('id' => $id), $data);
    echo json_encode(array("status" => TRUE));
  }

  function uom_edit($id)
  {
    $data = $this->uom->get_by_id($id);
    echo json_encode($data);
  }

  function uom_delete($sid)
  {
    $this->uom->delete_by_id($sid);
    echo json_encode(array("status" => TRUE));
  }


}


/* End of file Uom.php */
/* Location: ./application/controllers/Uom.php */