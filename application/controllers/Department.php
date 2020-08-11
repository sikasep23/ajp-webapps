<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Department extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('department_model', 'department');
  }

  public function index()
  {
    is_logged_in();
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['title']        = 'Department';
    $data['main_content'] = 'master/department';
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
    <script src="' . base_url() . 'assets/js/department.js"></script>
    <script src="' . base_url() . 'assets/js/jquery.mask.js"></script>
    <script>
    

  
  </script>';


    $this->load->view('layout/template', $data);
  }

  function department_get()
  {
    $list = $this->department->get_datatables();
    $data = array();
    $no = $_POST['start'];
    //var_dump($list); die();
    foreach ($list as $pa) {
      $no++;
      $row = array();
      $row[] = $pa->department_code;
      $row[] = $pa->department;

      $row[] = '<a class="badge badge-primary" href="javascript:void(0)" id="edit_dept" data-sid="' . "$pa->id" . '"><i class="glyphicon glyphicon-pencil"></i> Update</a>
              <a class="badge badge-danger" href="javascript:void(0)" id="delete_dept" data-did="' . "$pa->id" . '"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->department->count_all(),
      "recordsFiltered" => $this->department->count_filtered(),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function department_add()
  {
    $dept_code = trim(strtoupper($this->input->post('dept_code')));
    $dept = trim(strtoupper($this->input->post('dept')));
    $data = array(
      'department_code' => $dept_code,
      'department' => $dept
    );
    $insert = $this->department->save($data);
    echo json_encode(array("status" => TRUE));
  }

  function department_edit($id)
  {
    $data = $this->department->get_by_id($id);
    echo json_encode($data);
  }

  function department_update()
  {
    $data = array(
      'department_code' => $this->input->post('dept_code'),
      'department' => $this->input->post('dept')
    );
    $id = $this->input->post('id');
    $this->department->update(array('id' => $id), $data);
    echo json_encode(array("status" => TRUE));
  }

  function department_delete($sid)
  {
    $this->department->delete_by_id($sid);
    echo json_encode(array("status" => TRUE));
  }

  function department_code()
  {
    $dariDB = $this->department->cekkode();
    $nourut = $dariDB;
    $codedept = $nourut + 1;
    $data = sprintf("%03s",$codedept);
    echo json_encode(["code" => $data]);
  }
}


/* End of file Department.php */
/* Location: ./application/controllers/Department.php */
