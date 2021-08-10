<?php
   class Tareas_model extends CI_Model{
   	
   	public function __construct(){
   		parent::__construct();
   	}
       public function login ($email) {   
        $this->db->where( "email", $email);
        $rs = $this->db->get( "user" );
    
        return $rs;
    }
       public function get_tarea($id) {   
        $this->db->order_by( "id_priority" );
        $this->db->where( "id", $id );
        $rs = $this->db->get( "task" );
    
        return $rs->result();
    }
    
   


    

}


?>