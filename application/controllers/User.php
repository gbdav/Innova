<?php

defined('BASEPATH') or exit('No direct script access allowed');



class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        if ($this->session->userdata( "email" ) != NULL ) {
            $data['title'] = 'Mi perfil';
            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
            /*echo 'Jorge' . $data['usuario']['nombre'];*/
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('usuario/index', $data);
            $this->load->view('templates/footer');
        }else{
           redirect('error_404');
 
        }
        
    }
}
