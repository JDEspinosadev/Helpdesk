<?php
    class Documento extends Conectar {
        public function insert_documento($tick_id,$doc_nom) {
            $conectar = parent::conexion();
            $sql = "INSERT INTO td_documento (doc_id,tick_id, doc_nom,fech_crea,est) 
                    VALUES (NULL, ?, ?, NOW(), '1')";
            $query = $conectar->prepare($sql);
            $query->execute([$tick_id, $doc_nom]);
        }

        public function get_documento_x_ticket($tick_id) {
            $conectar = parent::conexion();
            $sql = "SELECT * FROM td_documento WHERE tick_id = ? AND est = 1";
            $query = $conectar->prepare($sql);
            $query->execute([$tick_id]);
            return $query->fetchAll();
        }
    }
?>