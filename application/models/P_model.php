<?php
class P_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function verproyectos()
    {
        //Hacemos una consulta
        $consulta = $this->db->query("SELECT * FROM project WHERE stat_pro=1");

        //Devolvemos el resultado de la consulta
        return $consulta->result();
    }
    public function delproyecto($id)
    {
        $consulta = $this->db->query("UPDATE project SET stat_pro=0 WHERE id='$id'");
        if ($consulta == true) {
            return true;
        } else {
            return false;
        }
    }
    public function creproyecto(
        $nombre,
        $description,
        $date_ini
    ) {
        $consulta = $this->db->query("INSERT INTO project VALUES(NULL,'$nombre','$description','$date_ini',1);");
        if ($consulta == true) {
            return true;
        } else {
            return false;
        }
    }
    public function verempleados()
    {
        //Hacemos una consulta
        $consulta = $this->db->query("SELECT * FROM user WHERE role_id=2");

        //Devolvemos el resultado de la consulta
        return $consulta->result();
    }
    public function delempleados($id)
    {
        $consulta = $this->db->query("UPDATE user SET role_id=0 WHERE id='$id'");
        if ($consulta == true) {
            return true;
        } else {
            return false;
        }
    }
}
