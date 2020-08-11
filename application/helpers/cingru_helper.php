<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('login');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);
        $submenu = $ci->uri->segment(2);
        //$querymenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $querymenu = $ci->db->query("select * from user_menu where menu like '%$menu%'")->row_array();
        $menu_id = $querymenu['id'];
        $querysub = $ci->db->query("select * from user_sub_menu where url like '%$submenu%' ")->row_array();
        $submenu_id = $querysub['id'];
        //var_dump($menu_id); die();
        $useraccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id,
            'submenu_id' => $submenu_id
        ]);
        //var_dump($useraccess); die();
        if ($useraccess->num_rows() < 1) {
            redirect('auth/block');
        }
    }
}

function check_access($role_id, $menu_id, $sub_menu_id)
{
    $ci = get_instance();
    $query = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id, 'submenu_id' => $sub_menu_id]);
    if ($query->num_rows() > 0) {
        return "checked";
    }
}

function helper_log($tipe = "", $str = "")
{
    $CI = &get_instance();

    if (strtolower($tipe) == "login") {
        $log_tipe   = 0;
    } elseif (strtolower($tipe) == "logout") {
        $log_tipe   = 1;
    } elseif (strtolower($tipe) == "add") {
        $log_tipe   = 2;
    } elseif (strtolower($tipe) == "edit") {
        $log_tipe  = 3;
    } else {
        $log_tipe  = 4;
    }

    $param['log_user']      = $CI->session->userdata('username');
    $param['log_tipe']      = $log_tipe;
    $param['log_desc']      = $str;

    $CI->load->model('m_log');

    $CI->m_log->save_log($param);
}
