<?php
   class Proyectos_model extends CI_Model{
   	
   	public function __construct(){
   		parent::__construct();
   	}
       public function login ($email) {   
        $this->db->where( "email", $email);
        $rs = $this->db->get( "user" );
    
        return $rs;
    }
       public function get_proyect($email) {   
        $this->db->order_by( "name_project" );
       // $this->db->where( "email", $email );
        $rs = $this->db->get( "project", ['email' => $email]);
    
        return $rs;
    }
    public function insert_proyect($data) {   
        $this->db->insert( "project", $data);
			$obj[ "resultado" ] = $this->db->affected_rows() == 1;
			$obj[ "mensaje" ]   = $obj[ "resultado" ] ?
				"Insertado correctamente" : "Problema al insertar";
    
        return $obj;
    }
    public function update_proyect($data, $id) {   
        $this->db->where( "id", $id);
        $this->db->update( "project", $data );
        $obj[ "resultado" ] = $this->db->affected_rows() > 0;
        $obj[ "mensaje" ]   = $obj[ "resultado" ] ?
            "proyecto actualizado" : "No se actualizó el registro";
        return $obj;
    }
    
    public function delete_proyect($id){
        $this->db->where('id', $id);
        $this->db->delete('project', ['id' => $id]);
        $obj[ "resultado" ] = true;
        $obj[ "mensaje" ]    = $obj[ "resultado" ] ?
            "Eliminado exitosamente" : "Imposible eliminar";
         return $obj;
    }


    

}


?>