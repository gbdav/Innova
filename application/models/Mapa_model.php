<?php
class Mapa_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function update($id, $latitud, $longitud)
    {
        $consulta = $this->db->query(
            "
            UPDATE user SET
            latitud ='$latitud',
            longitud ='$longitud'
            WHERE id=$id;"
        );
        if ($consulta == true) {
            return true;
        } else {
            return false;
        }
    }
    public function update2($id, $latitud, $longitud)
    {
        $consulta = $this->db->query(
            "
            UPDATE user SET
            latitud ='$latitud',
            longitud ='$longitud'
            WHERE id=$id;"
        );
        if ($consulta == true) {
            return true;
        } else {
            return false;
        }
    }
}
