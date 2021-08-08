<?php

class Misproyectos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model( "misProyectos_model" );
    }  

    public function index(){
        if ($this->session->userdata("email") != NULL) {
            $data['title'] = 'Mis Proyectos';
            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('usuario/proyectos_usuario_view', $data);
            $this->load->view('templates/footer');
           }else{
            redirect('error_404');
           }
    }
    
    

    
}
