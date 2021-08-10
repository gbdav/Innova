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
        $data
    ) {
        //$date_ini = date('Y-m-s');
        //$sql = "INSERT INTO project ('name', 'description', 'date_ini', 'stat_pro') VALUES('$nombre','$description','$date_ini',1)";
        $consulta = $this->db->insert("project", $data);
        //$consulta = $this->db->query($sql);
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
    public function updatepro($id, $modificar = "NULL", $name_project = "NULL", $description = "NULL")
    {
        if ($modificar == "NULL") {
            $consulta = $this->db->query("SELECT * FROM project WHERE id=$id");
            return $consulta->result();
        } else {
            $consulta = $this->db->query("
              UPDATE project SET
              name_project     ='$name_project', 
              description     ='$description'          
               WHERE
               id=$id;");

            if ($consulta == true) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function updateuser($id, $modificar = "NULL", $name = "NULL")
    {
        if ($modificar == "NULL") {
            $consulta = $this->db->query("SELECT * FROM user WHERE id=$id");
            return $consulta->result();
        } else {
            $consulta = $this->db->query("
              UPDATE user SET
              name    ='$name'          
               WHERE
               id=$id;");

            if ($consulta == true) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function get_tarea($id)
    {
        $sql = "SELECT id_tarea, nombre, des_tareas, stat_tarea, name, name_project from tareas, user, project 
        WHERE tareas.id_user = user.id and tareas.id_pro = project.id and project.id = $id and stat_tarea =1";

        $consulta = $this->db->query($sql);

        return $consulta->result();
    }

    public function deltarea($id)
    {
        $consulta = $this->db->query("UPDATE tareas SET stat_tarea=0 WHERE id_tarea='$id'");
        if ($consulta == true) {
            return true;
        } else {
            return false;
        }
    }

    public function realizatarea($id)
    {
        $consulta = $this->db->query("UPDATE tareas SET stat_tarea=1 WHERE id_tarea='$id'");
        if ($consulta == true) {
            return true;
        } else {
            return false;
        }
    }
}
