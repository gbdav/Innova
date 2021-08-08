<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model( "Auth_model" );
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', 
          array(
                'required'      => 'Necesitas poner un Correo electrónico existente')
    );
        $this->form_validation->set_rules('password', 'Password', 'trim|required',
            array(
                'required'      => 'Necesitas poner una contraseña')
    );
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
        date_default_timezone_set("America/Mexico_City");
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        
        
        if ($user) {
                if ($user['is_active'] == 1 ) {
                    $date = date("Y-m-d H:i:s");
                    if($user['fecha'] < $date){
                            // checa el password
                        if (password_verify($password, $user['password'])) {
                            $this->db->set('count', 'count=0', FALSE);
                            $data = [
                                'email' => $user['email'],
                                'role_id' => $user['role_id']
                            ];
                            $this->session->set_userdata($data);
                            if ($user['role_id'] == 1) {
                                
                                redirect('admin', $user);
                            } else {
                                redirect('user', $user);
                            }
                        } else { //primer error
                            $date = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +1 minutes"));
                            $this->db->set('count', 'count+1', FALSE);
                            $this->db->set('fecha', $date);
                            $this->db->where('id', $user['id']);
                            $this->db->update('user');
                            if($user['count']+1 == 3){ //para el segundo error
                                $date = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes"));
                                $this->db->set('fecha', $date);
                                $this->db->where('id', $user['id']);
                                $this->db->update('user');
                                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡Te haz equivocado 3 veces! </strong>  <br> Por favor de revisar los datos de autenticacion. </div></center>');
                            redirect('auth');
                            }
                            if($user['count']+1 == 5){ //quinto error
                                $date = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +3 years"));
                                $this->db->set('fecha', $date);
                                $this->db->where('id', $user['id']);
                                $this->db->update('user');
                                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡Te haz equivocado 5 veces! </strong>  <br> Contactar al administrador. </div></center>');
                            redirect('auth');
                            }
                            
                            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡Contraseña incorrecta! </strong>  <br> Por favor de ingresar la contraseña correcta. </div></center>');
                            redirect('auth');
                            
                        }
                    }else{
                        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡El correo esta inactivo! </strong> <br> No ha transcurrido el tiempo necesario. </div></center>');
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
      

    public function resgistro()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim',
    array(
                'required'      => 'Necesitas poner un Nombre'
            ));
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', array(
                'required'      => 'Necesitas poner un Correo electrónico',
                'is_unique'      => 'El correo ya esta registrado'
            ));
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]',
    array(
                'required'      => 'Necesitas poner una contraseña',
                'min_length'     => 'Contraseña mayor a 6 caracteres',
                'matches'     => 'La contraseña no es igual'
            ));
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[6]|matches[password1]',
    array(
                'required'      => 'Necesitas poner una contraseña',
                'min_length'     => 'Contraseña mayor a 6 caracteres',
                'matches'     => 'La contraseña no es igual'
            ));
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registro';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/resgistro');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name')),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
            ];
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email'        => $email,
                'token'        => $token,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);
            $this->_sendEmail($token, 'verify');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡Felicidades ya estas registrado! </strong> <br> Por favor activar token. </div></center>');
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
        $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡Cerraste tu cuenta! </strong> <br> Vuelve pronto te extrañaremos. </div></center>');
        redirect('auth');
    }
    public function bloqueo()
    {
        $this->load->view('auth/bloqueo');
    }

    public function recuperarcontra()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',
    array(
                'required'      => 'Necesitas poner un Correo electrónico existente',
            ));
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Olvidé mi Contraseña';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/recuperarcontra');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email'        => $email,
                    'token'        => $token,
                    'date_created' => time()
                ];
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡Porfavor checar tu correo electronico! </strong> <br> Ya se envío un correo electronico para restablecer tu contraseña. </div></center>');
                redirect('auth/recuperarcontra');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡Correo no resgistrado o activado! </strong> <br> Favor de verificar. </div></center>');
                redirect('auth/recuperarcontra');
            }
        }
    }

    public function restablecercontra()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->cambiarcontra();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡Restablecer contraseña falló! </strong> <br> Token incorrecto. </div></center>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡Restablecer contraseña falló! </strong> <br> Correo electronico incorrecto. </div></center>');
            redirect('auth');
        }
    }

    public function cambiarcontra()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]',
    array(
                'required'      => 'Necesitas poner una contraseña',
                'min_length'     => 'Contraseña mayor a 6 caracteres',
                'matches'     => 'La contraseña no es igual'
            ));
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[6]|matches[password1]',
    array(
                'required'      => 'Necesitas poner una contraseña',
                'min_length'     => 'Contraseña mayor a 6 caracteres',
                'matches'     => 'La contraseña no es igual'
            ));
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Cambiar Contraseña';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/cambiarcontra');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');
            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>¡La contraseña ha sido cambiada! </strong> <br> Felicidades. </div></center>');
            redirect('auth');
        }
    }

    

}
