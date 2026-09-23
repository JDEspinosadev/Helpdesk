<?php
class Canal extends Conectar{

    public function get_canal(){

        $conectar = parent::Conexion();
        
        $sql = "SELECT * FROM tm_canal WHERE est = 1";

        $query = $conectar->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}
?>