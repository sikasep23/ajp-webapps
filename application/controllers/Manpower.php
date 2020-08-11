<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manpower extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('manpower_model', 'manpower');
  }

  public function index()
  {
    is_logged_in();
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['role'] = $this->db->get_where('user_role', ['is_active' => '1'])->result_array();
    $data['project_area'] = $this->db->get_where('m_projectarea', ['is_active' => '1'])->result_array();
    $data['dept'] = $this->db->get_where('m_department', ['is_active' => '1'])->result_array();
    $data['title']        = 'Manpower';
    $data['main_content'] = 'master/manpower';
    $data['class'] = 'active';
    $data['additional_header'] = '
    <link href="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css"/>
    <link href="' . base_url() . 'assets/plugins/custombox/css/custombox.min.css" rel="stylesheet">
    <link href="' . base_url() . 'assets/plugins/select2/css/select2-bs4.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.css" rel="stylesheet" type="text/css"/>
    <link href="' . base_url() . 'assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="' . base_url() . 'assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
    ';
    $data['additional_footer'] = '
    <script type="text/javascript" src="' . base_url() . 'assets/plugins/parsleyjs/parsley.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/custombox/js/custombox.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/custombox/js/custombox.legacy.min.js"></script>
    <script src="' . base_url() . 'assets/js/select2.js" type="text/javascript"></script>
    <script src="' . base_url() . 'assets/plugins/moment/moment.js"></script>
    <script src="' . base_url() . 'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/toastr/toastr.min.js"></script>
    <script src="' . base_url() . 'assets/js/manpower.js"></script>
    <script src="' . base_url() . 'assets/js/jquery.mask.js"></script>';
    $this->load->view('layout/template', $data);
  }

  function manpower_get()
  {
    $list = $this->manpower->get_datatables();
    $data = array();
    $no = $_POST['start'];
    //var_dump($list); die();
    foreach ($list as $mp) {
      $qpa = $this->db->get_where('m_projectarea', ['projectarea_code' => $mp->mp_pa])->row_array();
      $qdept = $this->db->get_where('m_department', ['department_code' => $mp->mp_department])->row_array();
      $pa = $qpa['projectarea_area'];
      $dept = $qdept['department'];
      $login = $this->db->get_where('users', ['manpower_id' => $mp->id])->row_array();
      $status = ($login['active'] == 1) ? 'Disable' : 'Enable';
      $role = $this->db->get_where('user_role', ['id' => $login['role_id']])->row_array();
      $color = ($status == 'Disable') ? 'success' : 'warning';    
      $s_active = ($status == 'Disable') ? 'ACTIVE' : 'INACTIVE';    
      $no++;
      $row = array();
      $row[] = $mp->mp_id;
      $row[] = $mp->mp_nik;
      $row[] = $mp->mp_name;
      $row[] = $login['username'];
      $row[] = $role['role'];
      $row[] = $pa;
      $row[] = $dept;
      $row[] = $s_active;

      $row[] = '<a class="badge badge-primary" href="javascript:void(0)" id="edit_mp" data-sid="' . "$mp->id" . '"><i class="glyphicon glyphicon-pencil"></i> Update</a>
              <a class="badge badge-danger" href="javascript:void(0)" id="delete_mp" data-did="' . "$mp->id" . '"><i class="glyphicon glyphicon-trash"></i> Delete</a>
              <a class="badge badge-'.$color.'" href="javascript:void(0)" id="'.$status.'" data-std="' . "$mp->id" . '"><i class="glyphicon glyphicon-trash"></i> '.$status.' Login</a>';

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->manpower->count_all(),
      "recordsFiltered" => $this->manpower->count_filtered(),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function manpower_edit($id)
  {
    $data = $this->manpower->get_by_id($id);
    echo json_encode($data);
  }

  function manpower_enable()
  {
    $id = $this->input->post('id');
    $this->db->where('manpower_id', $id);
    $data = $this->db->update('users', ['active' => '1']);
    echo json_encode($data);
  }

  function manpower_disable()
  {
    $id = $this->input->post('id');
    $this->db->where('manpower_id', $id);
    $data = $this->db->update('users', ['active' => '0']);
    echo json_encode($data);
  }

  function manpower_add()
  {
    $this->_validation(); 

    $mp_id = $this->input->post('mp_id', TRUE);
    $mp_gender = $this->input->post('mp_gender', TRUE);
    $mp_department = $this->input->post('mp_department', TRUE);
    $mp_position = $this->input->post('mp_position', TRUE);
    $mp_nik = $this->input->post('mp_nik', TRUE);
    $mp_pa = $this->input->post('mp_pa', TRUE);
    $mp_poh = $this->input->post('mp_poh', TRUE);
    $mp_doh = $this->input->post('mp_doh', TRUE);
    $mp_name = $this->input->post('mp_name', TRUE);
    $mp_status = $this->input->post('mp_status', TRUE);
    $username = $this->input->post('username', TRUE);
    $email= $this->input->post('email', TRUE);
    $password = $this->input->post('password', TRUE);
    $role = $this->input->post('role', TRUE);

    $data = [
      'mp_id' => $mp_id,
      'mp_gender' => $mp_gender,
      'mp_department' => $mp_department,
      'mp_position' => $mp_position,
      'mp_nik' => $mp_nik,
      'mp_pa' => $mp_pa,
      'mp_poh' => $mp_poh,
      'mp_doh' => $mp_doh,
      'mp_name' => $mp_name,
      'mp_status' => $mp_status
    ];
    $this->db->insert('m_manpower',$data);
    $idu = $this->db->insert_id();
    $user = [
      'username' => $username,
      'email' => $email,
      'password' => password_hash($password, PASSWORD_DEFAULT),
      'role_id' => $role,
      'manpower_id' => $idu,
      'active' => '1'
    ];
    $this->db->insert('users', $user);
    echo json_encode(array("status" => TRUE));
  }

  function manpower_update()
  {
    $this->_validation_update();
    $mp_id = $this->input->post('mp_id', TRUE);
    $mp_gender = $this->input->post('mp_gender', TRUE);
    $mp_department = $this->input->post('mp_department', TRUE);
    $mp_position = $this->input->post('mp_position', TRUE);
    $mp_nik = $this->input->post('mp_nik', TRUE);
    $mp_pa = $this->input->post('mp_pa', TRUE);
    $mp_poh = $this->input->post('mp_poh', TRUE);
    $mp_doh = $this->input->post('mp_doh', TRUE);
    $mp_name = $this->input->post('mp_name', TRUE);   
    $mp_status = $this->input->post('mp_status', TRUE);
    $username = $this->input->post('username', TRUE);
    $email= $this->input->post('email', TRUE);
    $password = $this->input->post('password', TRUE);
    $role = $this->input->post('role', TRUE);

    $data = [
      'mp_id' => $mp_id,
      'mp_gender' => $mp_gender,
      'mp_department' => $mp_department,
      'mp_position' => $mp_position,
      'mp_nik' => $mp_nik,
      'mp_pa' => $mp_pa,
      'mp_poh' => $mp_poh,
      'mp_doh' => $mp_doh,
      'mp_name' => $mp_name,
      'mp_status' => $mp_status
    ];

    $user = [
      'username' => $username,
      'email' => $email,
      'password' => password_hash($password, PASSWORD_DEFAULT),
      'role_id' => $role
    ];

    $this->manpower->update(array('id' => $this->input->post('id')), $data);
    $this->manpower->update_login(['manpower_id' => $this->input->post('id')], $user);
    echo json_encode(array("status" => TRUE));
  }

  public function manpower_delete($id)
  {
    $this->manpower->delete_by_id($id);
    echo json_encode(array("status" => TRUE));
  }


  function _validation()
  {
    $this->form_validation->set_rules('mp_id', 'No. ID', 'required');
    $this->form_validation->set_rules('mp_gender', 'Gender', 'required');
    $this->form_validation->set_rules('mp_department', 'Department', 'required');
    $this->form_validation->set_rules('mp_position', 'Position', 'required');
    $this->form_validation->set_rules('mp_nik', 'NIK', 'required|is_unique[m_manpower.mp_nik]');
    $this->form_validation->set_rules('mp_pa', 'Project Area', 'required');
    $this->form_validation->set_rules('mp_poh', 'Point Of Hire', 'required');
    $this->form_validation->set_rules('mp_doh', 'Date Of Hire', 'required');
    $this->form_validation->set_rules('mp_name', 'Name', 'required');
    $this->form_validation->set_rules('mp_status', 'Status', 'required');

    if ($this->form_validation->run() == false) {
      $errors[] = validation_errors();
      $data = ['inputerror' => $errors];
      echo json_encode($data);
      exit();
    }
  }

  function _validation_update()
  {
    $this->form_validation->set_rules('mp_id', 'No. ID', 'required');
    $this->form_validation->set_rules('mp_gender', 'Gender', 'required');
    $this->form_validation->set_rules('mp_department', 'Department', 'required');
    $this->form_validation->set_rules('mp_position', 'Position', 'required');
    $this->form_validation->set_rules('mp_nik', 'NIK', 'required');
    $this->form_validation->set_rules('mp_pa', 'Project Area', 'required');
    $this->form_validation->set_rules('mp_poh', 'Point Of Hire', 'required');
    $this->form_validation->set_rules('mp_doh', 'Date Of Hire', 'required');
    $this->form_validation->set_rules('mp_name', 'Name', 'required');
    $this->form_validation->set_rules('mp_status', 'Status', 'required');

    if ($this->form_validation->run() == false) {
      $errors[] = validation_errors();
      $data = ['inputerror' => $errors];
      echo json_encode($data);
      exit();
    }
  }

  function manpower_code()
  {
    $dariDB = $this->manpower->cekkode();
    $nourut = $dariDB;
    $code = $nourut + 1;
    $data = sprintf("%03s", $code);
    echo json_encode(["code" => $data]);
  }
}


/* End of file Manpower.php */
/* Location: ./application/controllers/Manpower.php */
