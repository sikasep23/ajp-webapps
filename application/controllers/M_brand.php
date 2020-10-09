<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_brand extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('brand_model', 'brand');
  }

  public function index()
  {
    is_logged_in();
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['title']        = 'Master Brand';
    $data['main_content'] = 'master/brand';
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
    <script src="' . base_url() . 'assets/js/brand.js"></script>
    <script src="' . base_url() . 'assets/js/jquery.mask.js"></script>';
    $this->load->view('layout/template', $data);  
  }

  function m_brand_code()
  {
    $dariDB = $this->brand->cekkode();
    $nourut = $dariDB;
    $code = $nourut + 1;
    $data = sprintf("%03s",$code);
    echo json_encode(["code" => $data]);
  }

  public function m_brand_get()
  {

    $list = $this->brand->get_datatables();
    $data = array();
    $no = $_POST['start'];
    //var_dump($list); die();
    foreach ($list as $pa) {
      $no++;
      $row = array();
      $row[] = $pa->brand_code;
      $row[] = strtoupper($pa->brand);

      $row[] = '<a class="badge badge-primary" href="javascript:void(0)" id="edit_pa" data-sid="' . "$pa->id" . '"><i class="glyphicon glyphicon-pencil"></i> Update</a>
              <a class="badge badge-danger" href="javascript:void(0)" id="delete_pa" data-did="' . "$pa->id" . '"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->brand->count_all(),
      "recordsFiltered" => $this->brand->count_filtered(),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function m_brand_add()
  {
    $brand_code = trim(strtoupper($this->input->post('brand_code')));
    $brand = trim(strtoupper($this->input->post('brand')));
    $data = array(
      'brand_code' => $brand_code,
      'brand' => $brand
    );
    $this->brand->save($data);
    echo json_encode(array("status" => TRUE));
  }

  function m_brand_update()
  {
    $brand_code = trim(strtoupper($this->input->post('brand_code')));
    $brand = trim(strtoupper($this->input->post('brand')));
    $data = array(
      'brand_code' => $brand_code,
      'brand' => $brand
    );
    $id = $this->input->post('id');
    $this->brand->update(array('id' => $id), $data);
    echo json_encode(array("status" => TRUE));
  }

  function m_brand_edit($id)
  {
    $data = $this->brand->get_by_id($id);
    echo json_encode($data);
  }

  function m_brand_delete($sid)
  {
    $this->brand->delete_by_id($sid);
    echo json_encode(array("status" => TRUE));
  }

}


/* End of file M_brand.php */
/* Location: ./application/controllers/M_brand.php */