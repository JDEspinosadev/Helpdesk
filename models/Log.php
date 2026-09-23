<?php
class Log extends Conectar {

    //=========================================
    // 1. FUNCIONES DE INSERCIÓN (GUARDADO)
    //=========================================
    public function insert_log_usuario($usu_realiza, $usu_afectado, $accion, $detalle, $faudit){
        $conectar = parent::conexion();

        $sql = "INSERT INTO  tm_log_usuario (usu_id_realiza, usu_id_afectado, logu_accion, logu_detalle, fech_crea)
                VALUES (?,?,?,?,?);";
        $query = $conectar->prepare($sql);
        /*$sql->bindValue(1, $usu_realiza);
        $sql->bindValue(2, $usu_afectado);
        $sql->bindValue(3, $accion);
        $sql->bindValue(4, $detalle);
        $sql->bindValue(5, $faudit);*/
        $query->execute([$usu_realiza, $usu_afectado, $accion, $detalle, $faudit]);
    }

    public function insert_log_ticket($usu_id, $tick_id, $accion, $detalle, $faudit){
        $conectar = parent::conexion();
        $sql = "INSERT INTO tm_log_ticket (usu_id, tick_id, logt_accion, logt_detalle, faudit) 
                VALUES (?,?,?,?,?)";
        $query = $conectar->prepare($sql);
        /*$sql->bindValue(1, $usu_id);
        $sql->bindValue(2, $tick_id);
        $sql->bindValue(3, $accion);
        $sql->bindValue(4, $detalle);
        $sql->bindValue(5, $faudit);*/
        $query->execute([$usu_id, $tick_id, $accion, $detalle, $faudit]);
    }

    //=================================================
    // 2. FUNCIONES DE CONSULTA (PARA EL ADMINISTRADOR)
    //=================================================

    public function get_logs_usuarios(){
        $conectar = parent::conexion();
        $sql = "SELECT
                    l.fech_crea,
                    u_admin.usu_nom AS admin_nom, u_admin.usu_ap AS admin_ap,
                    u_afec.usu_nom AS sujeto_nom, u_afec.usu_ap AS sujeto_ap,
                    l.logu_accion,
                    l.logu_detalle
                FROM tm_log_usuario l
                LEFT JOIN tm_usuario u_admin ON l.usu_id_realiza = u_admin.usu_id
                LEFT JOIN tm_usuario u_afec ON l.usu_id_afectado = u_afec.usu_id
                ORDER BY l.fech_crea DESC;";
        $query = $conectar->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function get_logs_tickets(){
        $conectar = parent::conexion();
        $sql = "SELECT
                    l.fech_crea,
                    u.usu_nom, u.usu_ap,
                    l.tick_id,
                    l.logt_accion,
                    l.logt_detalle
                FROM tm_log_ticket l
                LEFT JOIN tm_usuario u ON l.usu_id = u.usu_id
                ORDER BY l.fech_crea DESC;";
        $query = $conectar->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}

?>