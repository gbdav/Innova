<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
       if ($this->session->userdata("email") != NULL) {
        $data['title'] = 'Pagina principal';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        /*echo 'Jorge' . $data['usuario']['nombre'];*/
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
       }else{
        redirect('error_404');
       }
          
    }

    public function proyectos()
    {
       if ($this->session->userdata("email") != NULL) {
        $data['title'] = 'Proyectos';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        /*echo 'Jorge' . $data['usuario']['nombre'];*/
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/proyectos', $data);
        $this->load->view('templates/footer');
       }else{
        redirect('error_404');
       }
          
    }
    public function tareas()
    {
       if ($this->session->userdata("email") != NULL) {
        $data['title'] = 'Tareas';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        /*echo 'Jorge' . $data['usuario']['nombre'];*/
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/tareas', $data);
        $this->load->view('templates/footer');
       }else{
        redirect('error_404');
       }
          
    }
    public function usuarios()
    {
       if ($this->session->userdata("email") != NULL) {
        $data['title'] = 'Usuarios';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        /*echo 'Jorge' . $data['usuario']['nombre'];*/
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/Usuarios', $data);
        $this->load->view('templates/footer');
       }else{
        redirect('error_404');
       }
          
    }
    

    public function create_project(){
        $name=$this->input->post('name');
        $description=$this->input->post('description');
        $date_ini=$this->input->post('date_ini');
        $id_user=$this->input->post('id_user');
        $data= [
            'name'=> $name,
            'description'=>$description,
            'date_ini'=>$date_ini,
            'id_user'=>$id_user
        ];
        $this->db->insert('project',$data);
    }

    public function get_project(){
        $rs=$this->db->get("project")->row_array();
    }
}
