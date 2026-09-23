<?php
    class Novedad extends Conectar{

        public function get_novedad($div_id){
            $conectar=parent::conexion();
            $sql = "SELECT id_nov, novedad,descripcion 
                    FROM tm_novedades 
                    WHERE div_id = ? 
                    ORDER BY novedad ASC";

            $query = $conectar->prepare($sql);
            $query->execute([$div_id]);
            return $query->fetchAll();
        }
    }
?>