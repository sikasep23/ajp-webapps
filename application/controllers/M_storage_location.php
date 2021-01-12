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
    $data['project'] = $this->db->get('m_projectarea')->result_array();
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
    <script src="' . base_url() . 'assets/js/storage_location.js"></script>
    <script src="' . base_url() . 'assets/js/jquery.mask.js"></script>';
    $this->load->view('layout/template', $data);  
  }

  public function m_storage_location_get()
  {

    $list = $this->storage->get_datatables();
    $data = array();
    $no = $_POST['start'];
    //var_dump($list); die();
    foreach ($list as $p) {
      $project = $this->db->get_where('m_projectarea', ['id' => $p->project_id])->row();
      $no++;
      $row = array();
      $row[] = $p->code;
      $row[] = strtoupper($project->projectarea_area).'-'.$project->projectarea_code;
      $row[] = strtoupper($p->storage);
      $row[] = strtoupper($p->type);

      $row[] = '<a class="badge badge-primary" href="javascript:void(0)" id="edit_p" data-sid="' . "$p->id" . '"><i class="glyphicon glyphicon-pencil"></i> Update</a>
              <a class="badge badge-danger" href="javascript:void(0)" id="delete_p" data-did="' . "$p->id" . '"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->storage->count_all(),
      "recordsFiltered" => $this->storage->count_filtered(),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function m_storage_location_code()
  {
    $dariDB = $this->storage->cekkode();
    $nourut = $dariDB;
    $code = $nourut + 1;
    $data = sprintf("%03s",$code);
    echo json_encode(["code" => $data]);
  }

  function m_storage_location_add()
  {
    $code = trim(strtoupper($this->input->post('code')));
    $storage = trim(strtoupper($this->input->post('storage')));
    $project = trim(strtoupper($this->input->post('project')));
    $type = trim(strtoupper($this->input->post('type')));
    $data = array(
      'code' => $code,
      'storage' => $storage,
      'project_id' => $project,
      'type' => $type,
    );
    $this->storage->save($data);
    echo json_encode(array("status" => TRUE));
  }

}


/* End of file M_storage_location.php */
/* Location: ./application/controllers/M_storage_location.php */