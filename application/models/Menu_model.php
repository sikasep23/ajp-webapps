<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Menu_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  
  public function getSubMenu()
    {
        $query = "SELECT user_sub_menu.*, user_menu.menu
                  FROM user_sub_menu JOIN user_menu
                  ON user_sub_menu.menu_id = user_menu.id";
        return $this->db->query($query)->result_array();
    }

  

}

/* End of file Menu_model.php */
/* Location: ./application/models/Menu_model.php */