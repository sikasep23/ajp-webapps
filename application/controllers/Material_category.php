<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Material_category extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('material_category_model', 'matcat');
  }

  public function index()
  {
    is_logged_in();
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['matcat_type'] = $this->db->get('sub_matcat_type')->result_array();
    $data['matcat_stmain'] = $this->db->get('sub_matcat_stmain')->result_array();
    $data['title']        = 'Material Category';
    $data['main_content'] = 'master/material_category';
    $data['class'] = 'active';
    $data['additional_header'] = '
    <link href="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css"/><link href="' . base_url() . 'assets/plugins/select2/css/select2-bs4.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.css" rel="stylesheet" type="text/css"/>';
    $data['additional_footer'] = '
    <script src="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="' . base_url() . 'assets/js/select2.js" type="text/javascript"></script>
    <script src="' . base_url() . 'assets/js/mtr_category.js"></script>
    <script src="' . base_url() . 'assets/js/jquery.mask.js"></script>
    ';
    $this->load->view('layout/template', $data);
  }

  function material_category_code()
  {
    $dariDB = $this->matcat->cekkode();
    $nourut = substr($dariDB, 3, 4);
    $code = $nourut + 1;
    $data = sprintf("%03s", $code);
    echo json_encode(["code" => $data]);
  }

  function material_category_get()
  {
    $list = $this->matcat->get_datatables();
    $data = array();
    $no = $_POST['start'];

    foreach ($list as $pa) {
      $pa_type = $pa->matcat_type;
      $type = $this->db->get_where('sub_matcat_type', ['id' => $pa_type])->row_array();
      $pa_stmain = $pa->matcat_stmain;
      $stmain = $this->db->get_where('sub_matcat_stmain', ['id' => $pa_stmain])->row_array();
      $row = array();
      $row[] = $pa->matcat_code;
      $row[] = $pa->matcat_category;
      $row[] = $type['name'];
      $row[] = $stmain['name'];
      $row[] = $pa->matcat_remark;
      $row[] = '<a class="badge badge-primary" href="javascript:void(0)" id="edit" data-sid="' . "$pa->id" . '"><i class="glyphicon glyphicon-pencil"></i> Update</a>
              <a class="badge badge-danger" href="javascript:void(0)" id="delete" data-did="' . "$pa->id" . '"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->matcat->count_all(),
      "recordsFiltered" => $this->matcat->count_filtered(),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function material_category_add()
  {
    $code = strtoupper($this->input->post('matcat_code', TRUE));
    $category = strtoupper($this->input->post('matcat_category', TRUE));
    $type = strtoupper($this->input->post('matcat_type', TRUE));
    $stmain = strtoupper($this->input->post('matcat_stmain', TRUE));
    $remark = strtoupper($this->input->post('matcat_remark', TRUE));
    $data = [
      'matcat_code' => $code,
      'matcat_category' => $category,
      'matcat_type' => $type,
      'matcat_stmain' => $stmain,
      'matcat_remark' => $remark
    ];
    $insert = $this->matcat->save($data);
    echo json_encode(array("status" => TRUE));
  }

  function material_category_edit($id)
  {
    $data = $this->matcat->get_by_id($id);
    echo json_encode($data);
  }

  function material_category_update()
  {
    $code = strtoupper($this->input->post('matcat_code', TRUE));
    $category = strtoupper($this->input->post('matcat_category', TRUE));
    $type = strtoupper($this->input->post('matcat_type', TRUE));
    $stmain = strtoupper($this->input->post('matcat_stmain', TRUE));
    $remark = strtoupper($this->input->post('matcat_remark', TRUE));
    $data = [
      'matcat_code' => $code,
      'matcat_category' => $category,
      'matcat_type' => $type,
      'matcat_stmain' => $stmain,
      'matcat_remark' => $remark
    ];
    $id = $this->input->post('id');
    $this->matcat->update(array('id' => $id), $data);
    echo json_encode(array("status" => TRUE));
  }

  function material_category_delete($sid)
  {
    $this->matcat->delete_by_id($sid);
    echo json_encode(array("status" => TRUE));
  }
}


/* End of file Material_category.php */
/* Location: ./application/controllers/Material_category.php */
