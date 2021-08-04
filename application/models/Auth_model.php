<?php
   class Auth_model extends CI_Model{
   	
   	public function __construct(){
   		parent::__construct();
   	}
       public function login ($email) {   
        $this->db->where( "email", $email);
        $rs = $this->db->get( "user" );
    
        return $rs;
    }

}


?>