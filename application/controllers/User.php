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
        if ($this->session->userdata("email") != NULL) {
            $data['title'] = 'Mi perfil';
            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
            /*echo 'Jorge' . $data['usuario']['nombre'];*/
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('usuario/index', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('error_404');
        }
    }
    public function editar()
    {
        $data['title'] = ' Modificar perfil ';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('usuario/editar', $data);
        $this->load->view('templates/footer');
    }

    public function mistareas()
    {
        if ($this->session->userdata("id") != NULL) {
            $data['title'] = 'Mis tareas ';
            $data['user'] = $this->db->get_where('user', ['id' =>
            $this->session->userdata('id')])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('usuario/proyectos_usuario_view', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('error_404');
        }
    }
    //Borrar proyecto empleado;
    public function realizatarea2($id)
    {
        $this->load->model("p_model");

        if (is_numeric($id)) {
            redirect(base_url('user/mistareas'));
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
            $eliminar = $this->p_model->realizatarea($id);
            if ($eliminar == true) {
                $this->session->set_flashdata('correcto', 'Proyecto eliminado correctamente');
            } else {
                $this->session->set_flashdata('incorrecto', 'Proyecto eliminado correctamente');
            }
            redirect(base_url('user/mistareas'));
        } else {
            redirect(base_url('user/mistareas'));
        }
    }

    function mapa()
    {
        if ($this->session->userdata("email") != NULL) {
            $data['title'] = 'Mapa';
            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
            // /echo 'Jorge' . $data['usuario']['nombre'];/
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('usuario/mapa', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('error_404');
        }
    }

    function updateUbicacion()
    {
        /* $url = $id;
        if (is_numeric($id)) {
            redirect(base_url('admin/proyectos'));
            die();
        }
        $encrypt_method = 'AES-256-CBC';
        $secret_key = 'riju';
        $secret_iv = 'riju';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $id = openssl_decrypt(base64_decode($id), $encrypt_method, $key, 0, $iv); */
        $id = $_POST['id'];
        $latitud = $_POST['latitud'];
        $longitud = $_POST['longitud'];
        $mod = $this->load->model("mapa_model");
        $mod = $this->mapa_model->update2(
            $id,
            $latitud,
            $longitud,
        );
        if ($mod) {
            echo 'Ubicación guardada';
        } else {
            echo 'Error al guardar la ubicación';
        }
    }
}
