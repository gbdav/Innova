<?php

class Proyectos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model( "Proyectos_model" );
    }  

    public function index(){
        if ($this->session->userdata("email") != NULL) {
            $data['title'] = 'Proyectos';
            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/proyectos_view', $data);
            $this->load->view('templates/footer');
           }else{
            redirect('error_404');
           }
    }
    
    public function get_proyecto(){         
        $email=$this->input->post('email');
        $obj = $this->Proyectos_model->get_proyect($email);
        $this->output->set_content_type( "application/json" );
        echo json_encode($obj);
        }
    
    public function create_proyect(){
        $name_project=$this->input->post('name_project');
        $description=$this->input->post('description');
        $date_ini=$this->input->post('date_ini');
        $email=$this->input->post('email');
        $data= array( 
            'name_project'=> $name_project,
            'description'=>$description,
            'date_ini'=>$date_ini,
            'email'=>$email
        );
         $obj = $this->Proyectos_model->insert_proyect($data);
         $this->output->set_content_type( "application/json" );
         echo json_encode($obj);
    }

    public function actualiza_proyect(){
        $id=$this->input->post('id');
        $name_project=$this->input->post('name_project');
        $description=$this->input->post('description');
        $date_ini=$this->input->post('date_ini');
        $email=$this->input->post('email');
        $data= array( 
            'name_project'=> $name_project,
            'description'=>$description,
            'date_ini'=>$date_ini,
            'email'=>$email
        );
        $obj = $this->Proyectos_model->update_proyect($data, $id);
         $this->output->set_content_type( "application/json" );
         echo json_encode($obj);
    }

    public function borra_proyect(){
        $id= $this->input->post("id");
        $obj = $this->Proyectos_model->delete_proyect( $id);
		$this->output->set_content_type( "application/json" );
		echo json_encode( $obj );
       
    }

    
}
