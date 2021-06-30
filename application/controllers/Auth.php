<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Inicio de Sesión';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //validar el acceso
            $this->_Iniciodesesion();
        }
    }

    private function _Iniciodesesion()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            if ($user['is_active'] == 1) {
                // checa el password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡Contraseña incorrecta! </strong>  <br> Por favor de ingresar la contraseña correcta. </div></center>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡El correo es esta inactivo! </strong> <br> Por favor de activarlo desde el correo que ingresaste. </div></center>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡El correo es inexistente! </strong> <br> Favor de registrarse. </div></center>');
            redirect('auth');
        }
    }


   

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'innovanotesuteq@gmail.com',
            'smtp_pass' => 'Telcel123',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset'  => 'utf-8',
            'newline'  => "\r\n"
        ];
        $this->email->initialize($config);
        $this->email->from('innovanotesuteq@gmail.com', ' Innovanotes');
        $this->email->to($this->input->post('email'));
        if ($type == 'verify') {
            $this->email->subject('Verificacion de Innovanotes');
            $this->email->message('Haga clic en este enlace para verificar su cuenta : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activar</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Restablecer la contraseña');
            $this->email->message('Haga clic en este enlace para restablecer tu contraseña : <a href="' . base_url() . 'auth/restablecercontra?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Restablecer contraseña</a>');
        }
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡Ha sido activado! </strong> <br>  Por favor inicia sesión. </div></center>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email'  =>  $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡Activación de cuenta fallida! </strong> <br> Token expirado. </div></center>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡Activación de cuenta fallida! </strong> <br> Token incorrecto. </div></center>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡Activación de cuenta fallida! </strong> <br> Correo electronico incorrecto. </div></center>');
            redirect('auth');
        }
    }

    public function cerrarsesion()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡Cerraste tu cuenta! </strong> <br> Vuelve pronto te extrañamos. </div></center>');
        redirect('auth');
    }
    
    

    

    

    
}
