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
            $data['title'] = 'Mi perfil';
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
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Felicidades! </strong>  <br>Felicidades ya tienes un nuevo proyecto. </div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error! </strong>  <br>Ounou no se creo el nuevo proyecto.</div>');
        }

        //redirecciono la pagina a la url por defecto
        redirect(base_url('admin/proyectos/'));
    }

    function updatepro($id)
    {
        $url = $id;
        if (is_numeric($id)) {
            redirect(base_url('admin/proyectos'));
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
                $this->input->post("description")
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

    function updateuser($id)
    {
        $url = $id;
        if (is_numeric($id)) {
            redirect(base_url('admin/proyectos'));
            die();
        }
        $encrypt_method = 'AES-256-CBC';
        $secret_key = 'riju';
        $secret_iv = 'riju';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $id = openssl_decrypt(base64_decode($id), $encrypt_method, $key, 0, $iv);
        $this->load->model("p_model");
        $data["mod"] = $this->p_model->updateuser($id);
        $data['title'] = 'Modificar proyecto';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/updateuser", $data);
        $this->load->view('templates/footer');
        if ($this->input->post("submit")) {
            $mod = $this->p_model->updateuser(
                $id,
                $this->input->post("submit"),
                $this->input->post("name")
            );
            if ($mod == true) {
                //Sesion de una sola ejecución
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Felicidades! </strong>  <br>Empleado modificado. </div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error! </strong>  <br>El empleado no fue modificado . </div>');
            }
            redirect(base_url('admin/usuarios/'));
        }
    }

    function tareas($id)
    {
        $url = $id;
        if (is_numeric($id)) {
            redirect(base_url('admin/proyectos'));
            die();
        }
        $encrypt_method = 'AES-256-CBC';
        $secret_key = 'riju';
        $secret_iv = 'riju';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $id = openssl_decrypt(base64_decode($id), $encrypt_method, $key, 0, $iv);
        $this->load->model("p_model");
        $data['title'] = 'Tareas del proyecto';
        $data['t'] = $this->p_model->get_tarea($id);
        $data['id'] = $id;
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/Tareasv", $data);
        $this->load->view('templates/footer');
    }
    //Borrar tarea;
    public function deltarea($id)
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
            $eliminar = $this->p_model->deltarea($id);
            if ($eliminar == true) {
                $this->session->set_flashdata('correcto', 'Tarea eliminada correctamente');
            } else {
                $this->session->set_flashdata('incorrecto', 'Tarea eliminada correctamente');
            }
            redirect(base_url('admin/proyectos'));
        } else {
            redirect(base_url('admin/proyectos'));
        }
    }

    function addtareas($id)
    {
        $url = $id;
        if (is_numeric($id)) {
            redirect(base_url('admin/proyectos'));
            die();
        }
        $encrypt_method = 'AES-256-CBC';
        $secret_key = 'riju';
        $secret_iv = 'riju';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $id = openssl_decrypt(base64_decode($id), $encrypt_method, $key, 0, $iv);
        $this->load->model("p_model");
        $data['title'] = 'Crear tarea';
        $data['t'] = $this->p_model->get_tarea($id);
        $data['id'] = $id;
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/cretareas", $data);
        $this->load->view('templates/footer');
    }

    function cretareas()
    {
        $this->load->model("p_model");
        $nombre = $this->input->post("nombre");
        $des_tareas = $this->input->post("des_tareas");
        $stat_tarea = 0;
        $id_user = $this->input->post("id_user");
        $id_pro = $this->input->post("pro");


        $data = [
            'nombre' => $nombre,
            'des_tareas' => $des_tareas,
            'stat_tarea' => $stat_tarea,
            'id_user' => $id_user,
            'id_pro' => $id_pro

        ];
        $añadir = $this->p_model->cretarea($data);

        if ($añadir == true) {
            //Sesion de una sola ejecución
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Felicidades! </strong>  <br>Se creo una tarea nueva. </div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Error! </strong>  <br>No se creo una tarea nueva. </div>');
        }

        //$url = base_url() . "admin/tareas/" . $id;

        //redirecciono la pagina a la url por defecto
        //redirect($url);
        redirect(base_url('admin/proyectos/'));
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
            $this->load->view('admin/mapa', $data);
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
        $mod = $this->mapa_model->update(
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
