<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pic extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('pic_model', 'pic');
  }
 
  public function index()
  {
    is_logged_in();
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['title']        = 'Purchase Handler';
    $data['main_content'] = 'master/purchase_handler';
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
    <script src="' . base_url() . 'assets/js/pic.js"></script>
    <script src="' . base_url() . 'assets/js/jquery.mask.js"></script>
    ';
    $this->load->view('layout/template', $data);
  }

  function pic_get()
  {
    $list = $this->pic->get_datatables();
    $data = array();
    $no = $_POST['start'];
    //var_dump($list); die();
    foreach ($list as $pa) {
      $no++;
      $row = array();
      $row[] = $pa->pic_code;
      $row[] = $pa->pic_handler;

      $row[] = '<a class="badge badge-primary" href="javascript:void(0)" id="edit" data-sid="' . "$pa->id" . '"><i class="glyphicon glyphicon-pencil"></i> Update</a>
              <a class="badge badge-danger" href="javascript:void(0)" id="delete" data-did="' . "$pa->id" . '"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->pic->count_all(),
      "recordsFiltered" => $this->pic->count_filtered(),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function pic_code()
  {
    $dariDB = $this->pic->cekkode();
    $nourut = substr($dariDB, 3, 4);
    $codedept = $nourut + 1;
    $data = sprintf("%03s",$codedept);
    echo json_encode(["code" => $data]);
  }

  function pic_add()
  {
    $eq_code = trim(strtoupper($this->input->post('ph_code')));
    $eq_type = trim(strtoupper($this->input->post('ph_handler')));
    $data = array(
      'pic_code' => $eq_code,
      'pic_handler' => $eq_type
    );
    $insert = $this->pic->save($data);
    echo json_encode(array("status" => TRUE));
  }

  function pic_edit($id)
  {
    $data = $this->pic->get_by_id($id);
    echo json_encode($data);
  }

  function pic_update()
  {
    $data = array(
      'pic_code' => $this->input->post('ph_code'),
      'pic_handler' => $this->input->post('ph_handler')
    );
    $id = $this->input->post('id');
    $this->pic->update(array('id' => $id), $data);
    echo json_encode(array("status" => TRUE));
  }

  function pic_delete($sid)
  {
    $this->pic->delete_by_id($sid);
    echo json_encode(array("status" => TRUE));
  }

}


/* End of file Pic.php */
/* Location: ./application/controllers/Pic.php */