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
        } else {
            redirect('error_404');
        }
    }

    public function usuarios()
    {

        $this->load->model("p_model");
        $data['title'] = 'Empleados de la empresa';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data["p"] = $this->p_model->verempleados();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/Usuarios_view', $data);
        $this->load->view('templates/footer');
    }
    //Borrar empleados;
    public function delempleados($id)
    {
        $this->load->model("p_model");

        if (is_numeric($id)) {
            redirect(base_url('admin/usuarios'));
            die();
        }
        $string = $id;
        $encrypt_method = 'AES-256-CBC';
        $secret_key = 'riju';
        $secret_iv = 'riju';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $id = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

        if (is_numeric($id)) {
            $eliminar = $this->p_model->delempleados($id);
            if ($eliminar == true) {
                $this->session->set_flashdata('correcto', 'Empleado eliminado correctamente');
            } else {
                $this->session->set_flashdata('incorrecto', 'Empleado eliminado correctamente');
            }
            redirect(base_url('admin/usuarios'));
        } else {
            redirect(base_url('admin/usuarios'));
        }
    }

    public function proyectos()
    {
        $this->load->model("p_model");
        $data['title'] = 'Todos proyectos';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data["p"] = $this->p_model->verproyectos();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/proyectos', $data);
        $this->load->view('templates/footer');
    }

    //Borrar proyecto;
    public function delproyecto($id)
    {
        $this->load->model("p_model");

        if (is_numeric($id)) {
            redirect(base_url('admin/proyectos'));
            die();
        }
        $string = $id;
        $encrypt_method = 'AES-256-CBC';
        $secret_key = 'riju';
        $secret_iv = 'riju';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $id = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

        if (is_numeric($id)) {
            $eliminar = $this->p_model->delproyecto($id);
            if ($eliminar == true) {
                $this->session->set_flashdata('correcto', 'Proyecto eliminado correctamente');
            } else {
                $this->session->set_flashdata('incorrecto', 'Proyecto eliminado correctamente');
            }
            redirect(base_url('admin/proyectos'));
        } else {
            redirect(base_url('admin/proyectos'));
        }
    }
    function creproyecto()
    {

        $this->load->model("p_model");
        $name = $this->input->post("nombre");
        $desc = $this->input->post("description");
        $date = date('Y-m-d');
        $status = 1;
        $data = [
            'name_project' => $name,
            'description' => $desc,
            'date_ini' => $date,
            'stat_pro' =>  $status
        ];
        $añadir = $this->p_model->creproyecto($data);

        if ($añadir == true) {
            //Sesion de una sola ejecución
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Felicidades! </strong>  <br>Creado. </div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error! </strong>  <br>No se creo. </div>');
        }

        //redirecciono la pagina a la url por defecto
        redirect(base_url('admin/proyectos/'));
    }

    function updatepro($id)
    {
        $url = $id;
        if (is_numeric($id)) {
            redirect(base_url('admin/usuarios'));
            die();
        }
        $encrypt_method = 'AES-256-CBC';
        $secret_key = 'riju';
        $secret_iv = 'riju';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $id = openssl_decrypt(base64_decode($id), $encrypt_method, $key, 0, $iv);
        $this->load->model("p_model");
        $data["mod"] = $this->p_model->updatepro($id);
        $data['title'] = 'Modificar proyecto';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/update_pro", $data);
        $this->load->view('templates/footer');
        if ($this->input->post("submit")) {
            $mod = $this->p_model->updatepro(
                $id,
                $this->input->post("submit"),
                $this->input->post("name_project"),
                $this->input->post("description"),
                $this->input->post("date_ini"),
                $this->input->post("stat_pro")
            );
            if ($mod == true) {
                //Sesion de una sola ejecución
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Felicidades! </strong>  <br>Proyecto modificado. </div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error! </strong>  <br>El Proyecto no fue modificado . </div>');
            }
            redirect(base_url('admin/proyectos/'));
        }
    }

    function tareas($id){
        $url = $id;
        if (is_numeric($id)) {
            redirect(base_url('admin/usuarios'));
            die();
        }
        $encrypt_method = 'AES-256-CBC';
        $secret_key = 'riju';
        $secret_iv = 'riju';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $id = openssl_decrypt(base64_decode($id), $encrypt_method, $key, 0, $iv);
        $this->load->model("p_model");
        //$data["mod"] = $this->p_model->updatepro($id);
        $data['title'] = 'Tareas del proyecto';
        $data['tareas']= $this->p_model->get_tarea();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/Tareasv", $data);
        $this->load->view('templates/footer');
    }

}
