<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project_area extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('projectarea_model', 'project');
  }

  public function index()
  {
    is_logged_in();
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['title']        = 'Project Area';
    $data['main_content'] = 'master/project_area';
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
    <script src="' . base_url() . 'assets/js/project_area.js"></script>
    <script src="' . base_url() . 'assets/js/jquery.mask.js"></script>
    <script>
    

  
  </script>';


    $this->load->view('layout/template', $data);
  }

  public function project_area_get()
  {

    $list = $this->project->get_datatables();
    $data = array();
    $no = $_POST['start'];
    //var_dump($list); die();
    foreach ($list as $pa) {
      $no++;
      $row = array();
      $row[] = $pa->projectarea_code;
      $row[] = $pa->projectarea_area;
      $row[] = $pa->projectarea_npwp;
      $row[] = $pa->projectarea_address;

      $row[] = '<a class="badge badge-primary" href="javascript:void(0)" id="edit_pa" data-sid="' . "$pa->id" . '"><i class="glyphicon glyphicon-pencil"></i> Update</a>
              <a class="badge badge-danger" href="javascript:void(0)" id="delete_pa" data-did="' . "$pa->id" . '"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->project->count_all(),
      "recordsFiltered" => $this->project->count_filtered(),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function project_area_edit($id)
  {
    $data = $this->project->get_by_id($id);
    echo json_encode($data);
  }

  function project_area_add()
  {
    $pa_code = trim(strtoupper($this->input->post('code_pa')));
    $pa_area = trim(strtoupper($this->input->post('pa')));
    $data = array(
      'projectarea_code' => $pa_code,
      'projectarea_area' => $pa_area,
      'projectarea_npwp' => $this->input->post('npwp_pa'),
      'projectarea_address' => $this->input->post('address_pa')

    );
    $insert = $this->project->save($data);
    echo json_encode(array("status" => TRUE));
  }

  function project_area_update()
  {
    $data = array(
      'projectarea_code' => $this->input->post('code_pa'),
      'projectarea_area' => $this->input->post('pa'),
      'projectarea_npwp' => $this->input->post('npwp_pa'),
      'projectarea_address' => $this->input->post('address_pa')
    );
    $id = $this->input->post('id');
    $this->project->update(array('id' => $id), $data);
    echo json_encode(array("status" => TRUE));
  }

  function project_area_delete($sid)
  {
    $this->project->delete_by_id($sid);
    echo json_encode(array("status" => TRUE));
  }

  function project_area_code()
  {
    $dariDB = $this->project->cekkode();
    $nourut = $dariDB;
    $codedept = $nourut + 1;
    $data = sprintf("%03s",$codedept);
    echo json_encode(["code" => $data]);
  }
}


/* End of file Project_area.php */
/* Location: ./application/controllers/Project_area.php */
