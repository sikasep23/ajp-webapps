<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Menu_model', 'menu');
  }

  //start menu function
  public function menu()
  {
    is_logged_in();
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['title']        = 'Menu Management';
    $data['main_content'] = 'administrator/menu';
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
    <script src="' . base_url() . 'assets/js/menu.js" type="text/javascript"></script>
    <script type="text/javascript">
    table = $(\'#table\').DataTable();
    </script>
    ';

    $this->form_validation->set_rules('menu', 'Menu name', 'required');
    $this->form_validation->set_rules('sort', 'Priority', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('layout/template', $data);
    } else {
      $active = ($this->input->post('is_active') == null ? '0' : '1');
      $menu = $this->input->post('menu');
      $this->db->insert('user_menu', [
        'menu' => $menu, 
        'icon' => $this->input->post('icon'),
        'sort' => $this->input->post('sort'),
        'is_active' => $active ]);
      $this->session->set_flashdata('message', 'Added');
      helper_log("add", "Add menu $menu");
      redirect('administrator/menu');
    }
  }

  public function hapusmenu($id)
  {
    $mid = $this->enkripsi->decode($id);
    $query = $this->db->get_where('user_menu', ['id' => $mid])->row_array();
    $mn = $query['menu'];
    helper_log("delete", "Delete menu $mn");
    $this->db->delete('user_menu', ['id' => $mid]);
    $this->session->set_flashdata('message', 'Deleted');
    redirect('administrator/menu');
  }

  public function getMenu()
  {
    $id = $this->input->post('id');
    $query = $this->db->get_where('user_menu', ['id' => $id]);
    echo json_encode($query->row_array());
  }
  public function updateMenu()
  {
    $id = $this->input->post('id');
    $active = ($this->input->post('is_active') == null ? '0' : '1');
    $update = array(
      'menu' => $this->input->post('menu'),
      'icon' => $this->input->post('icon'),
      'sort' => $this->input->post('sort'),
      'is_active' => $active
    );
    $this->db->set($update);
    $this->db->where('id', $id);
    $this->db->update('user_menu');
    $this->session->set_flashdata('message', 'Updated');
    redirect('administrator/menu');
  }
  //end of menu function

  //start submenu
  public function submenu()
  {
    is_logged_in();
    $data['submenu'] = $this->menu->getSubMenu();
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['title']        = 'Submenu Management';
    $data['main_content'] = 'administrator/submenu';
    $data['class'] = 'active';
    $data['additional_header'] = '
    <link href="' . base_url() . 'assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="'.base_url().'assets/plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css"/>';
    $data['additional_footer'] = '
    <script src="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="' . base_url() . 'assets/js/submenu.js" type="text/javascript"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script type="text/javascript">
    table = $(\'#table\').DataTable();
    </script>
    ';

    $this->form_validation->set_rules('title', 'Submenu name', 'required');
    $this->form_validation->set_rules('menu_id', 'Menu name', 'required');
    $this->form_validation->set_rules('url', 'URL', 'required');
    $this->form_validation->set_rules('priority', 'Priority', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('layout/template', $data);
    } else {
      $active = ($this->input->post('is_active') == null ? '0' : '1');
      $this->db->insert(
        'user_sub_menu',
        [
          'title' => $this->input->post('title'),
          'menu_id' => $this->input->post('menu_id'),
          'url' => $this->input->post('url'),
          'sort' => $this->input->post('priority'),
          'is_active' => $active
        ]
      );
      $this->session->set_flashdata('message', 'Added');
      redirect('administrator/submenu');
    }
  }

  public function getsubMenu()
  {
    $id = $this->input->post('id');
    $query = $this->db->get_where('user_sub_menu', ['id' => $id]);
    echo json_encode($query->row_array());
  }

  public function updatesubMenu()
  {
    $id = $this->input->post('id');
    $update = array(
      'title' => $this->input->post('title'),
      'menu_id' => $this->input->post('menu_id'),
      'url' => $this->input->post('url'),
      'sort' => $this->input->post('priority'),
      'is_active' => $this->input->post('is_active')
    );
    $this->db->set($update);
    $this->db->where('id', $id);
    $this->db->update('user_sub_menu');
    $this->session->set_flashdata('message', 'Updated');
    redirect('administrator/submenu');
  }

  public function hapussubmenu($id)
  {
    $this->db->delete('user_sub_menu', ['id' => $id]);
    $this->session->set_flashdata('message', 'Deleted');
    redirect('administrator/submenu');
  }

  //end of sub menu
  //start role and access

  public function role()
  {
    $data['role'] = $this->db->get('user_role')->result_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['title']        = 'Role Management';
    $data['main_content'] = 'administrator/role';
    $data['class'] = 'active';
    $data['additional_header'] = '
    <link href="'.base_url().'assets/plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css"/>';
    $data['additional_footer'] = '
    <script src="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
    <script src="' . base_url() . 'assets/js/role.js" type="text/javascript"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script type="text/javascript">
    table = $(\'#table\').DataTable();
    </script>
    ';

    $this->form_validation->set_rules('role', 'Role', 'required');
    

    if ($this->form_validation->run() == false) {
      $this->load->view('layout/template', $data);
    } else {
      $active = ($this->input->post('is_active') == null ? '0' : '1');
      $data = [
        'role' => $this->input->post('role', true),
        'deskripsi' => $this->input->post('deskripsi', true),
        'is_active' => $active
      ];
      $this->db->insert('user_role', $data);
      $this->session->set_flashdata('message', 'Added');
      redirect('administrator/role');
    }
  }

  public function rolehapus($id)
  {
    
    $this->db->delete('user_role', ['id' => $id]);
    $this->session->set_flashdata('message', 'deleted!');
    redirect('administrator/role');
  }

  public function getrole()
  {
    $id = $this->input->post('id');
    $query = $this->db->get_where('user_role', ['id' => $id]);
    echo json_encode($query->row_array());
  }

  public function updaterole()
  {
    $id = $this->input->post('id');
    $active = ($this->input->post('is_active') == null ? '0' : '1');
    $update = array(
      'role' => $this->input->post('role'),
      'deskripsi' => $this->input->post('deskripsi'),     
      'is_active' => $active
    );
    $this->db->set($update);
    $this->db->where('id', $id);
    $this->db->update('user_role');
    $this->session->set_flashdata('message', 'Updated');
    redirect('administrator/role');
  }

  public function roleaccess($id)
  {
    $role_id = $this->enkripsi->decode($id);
    $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $query = $this->db->query('
    SELECT user_menu.id AS mid, user_menu.menu, user_sub_menu.id as smid, user_sub_menu.title as submenu
    FROM user_menu JOIN user_sub_menu ON
    user_sub_menu.menu_id = user_menu.id 
    order by user_menu.menu ASC
    ');
    $data['menu'] = $query->result_array();
    //$data['menu'] = $this->db->get('user_menu')->result_array();
    $data['title']        = 'Role Access';
    $data['main_content'] = 'administrator/roleaccess';
    $data['class'] = 'active';
    $data['additional_header'] = '
    <link href="'.base_url().'assets/plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css"/>';
    $data['additional_footer'] = '
    <script src="' . base_url() . 'assets/js/roleaccess.js"></script>
    <script src="' . base_url() . 'assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
    <script src="' . base_url() . 'assets/js/role.js" type="text/javascript"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="' . base_url() . 'assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script type="text/javascript">
    table = $(\'#table\').DataTable();
    </script>';

    //$this->form_validation->set_rules('role', 'Role', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('layout/template', $data);
    } else {
      //$data = ['role' => $this->input->post('role', true)];
      //$this->db->insert('user_role', $data);
      //$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>Well done!</strong> Your new role has been created!</div>');
      //redirect('menu/role');
    }
  }

  public function changeaccess()
  {
    $menu_id = $this->input->post('menuId');
    $role_id = $this->input->post('roleId');
    $submenu_id = $this->input->post('submenuID');

    $data = [
      'role_id' => $role_id,
      'menu_id' => $menu_id,
      'submenu_id' => $submenu_id
    ];

    $result = $this->db->get_where('user_access_menu', $data);

    if ($result->num_rows() < 1) {
      $this->db->insert('user_access_menu', $data);
    } else {
      $this->db->delete('user_access_menu', $data);
    }
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>Access Changed!</strong></div>');
  }
  
}


/* End of file Administrator.php */
/* Location: ./application/controllers/Administrator.php */
