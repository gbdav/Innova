<?php

class Tareas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model( "Tareas_model" );
    }  

    public function index(){
        if ($this->session->userdata("email") != NULL) {
            $data['title'] = 'Tareas';
            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/tareas_view', $data);
            $this->load->view('templates/footer');
           }else{
            redirect('error_404');
           }
    }
    
    public function get_tareas(){         
        $id=$this->input->post('id_project');
        $obj = $this->Proyectos_model->get_tarea($id);
         $this->output->set_content_type( "application/json" );
         echo json_encode($obj);
        }
    
    public function create_tarea(){
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

    

    
}
