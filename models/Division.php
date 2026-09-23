<?php
    class Division extends Conectar{

        public function get_division(){
            $conectar=parent::conexion();
            
            $sql="SELECT * FROM tm_division WHERE est=1;";
            $query=$conectar->prepare($sql);
            $query->execute();

            return $query->fetchAll();
        }
    }
?>