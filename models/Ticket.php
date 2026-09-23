<?php
require_once("Log.php");

class Ticket extends Conectar{

    public function insert_ticket($usu_id, $id_nov, $novedad, $canal_id, $tick_descripcion){
        $conectar=parent::conexion();
        $sql = "INSERT INTO tm_ticket (tick_id, usu_id, id_nov, novedad, canal_id, tick_descripcion, tick_estado, fech_crea, usu_asig, fech_asig, est) 
                VALUES (NULL,?,?,?,?,?,'Abierto',NOW(),NULL,NULL,'1')";
        $query = $conectar->prepare($sql);
        /*$sql->bindValue(1, $usu_id);
        $sql->bindValue(2, $id_nov);
        $sql->bindValue(3, $novedad);
        $sql->bindValue(4, $canal_id);
        $sql->bindValue(5, $tick_descripcion);*/
        $query->execute([$usu_id, $id_nov, $novedad, $canal_id, $tick_descripcion]);

        $tick_id_nuevo = $conectar->lastInsertId();

        $log = new Log();
        $log->insert_log_ticket($usu_id, $tick_id_nuevo, 'CREACION', "El usuario generó un nuevo ticket de soporte.", date('Y-m-d H:i:s'));

        return [["tick_id" => $tick_id_nuevo]];
    }

    public function insert_ticketdetalle($tick_id,$usu_id,$tickd_descrip){
        $conectar=parent::conexion();

        $sql="INSERT INTO td_ticketdetalle (tickd_id, tick_id, usu_id, tickd_descrip, fech_crea, est) VALUES (NULL,?,?,?,now(),'1');";
        
        $query = $conectar->prepare($sql);
        /*$sql->bindValue(1, $tick_id);
        $sql->bindValue(2, $usu_id);
        $sql->bindValue(3, $tickd_descrip);*/
        $query->execute([$tick_id, $usu_id, $tickd_descrip]);

        $sql_update="UPDATE tm_ticket SET tick_descripcion = CONCAT(tick_descripcion,?) WHERE tick_id = ?;";
        $query_update=$conectar->prepare($sql_update);
        /*$sql_update->bindValue(1, $tickd_descrip);
        $sql_update->bindValue(2, $tick_id);*/
        $query_update->execute(["\n" . $tickd_descrip, $tick_id]);

        $log = new Log();
        $log->insert_log_ticket($usu_id, $tick_id, 'COMENTARIO', "Se añadio respuesta al ticket: " . substr($tickd_descrip, 0, 100), date('Y-m-d H:i:s'));
        
        return array("status" => "ok");
    }

    public function insert_ticketdetalle_cerrar($tick_id,$usu_id){
        $conectar = parent::conexion();
        $mensaje = "<br><hr><b>[Ticket Cerrado por el sistema]</b>";
        $sql = "INSERT INTO td_ticketdetalle (tick_id, usu_id, tickd_descrip, fech_crea, est) 
        VALUES (?, ?, 'Ticket Cerrado Correctamente', NOW(), '1')";
        $query = $conectar->prepare($sql);
        $query->execute([$tick_id, $usu_id]);

        $sql_update_estado = "UPDATE tm_ticket SET tick_estado = 'Cerrado' WHERE tick_id = ?";
        $query_update_estado = $conectar->prepare($sql_update_estado);
        $query_update_estado->execute([$tick_id]);

        return ["status" => "ok"];
    }

    public function insert_ticketdetalle_reabrir($tick_id,$usu_id,$tickd_descrip){
        $conectar=parent::conexion();

        $sql="INSERT INTO td_ticketdetalle (tick_id, usu_id, tickd_descrip, fech_crea, est) VALUES (?,?,?,now(),'1');";
        $query=$conectar->prepare($sql);
        $query->execute([$tick_id, $usu_id, $tickd_descrip]);

        $sql_update = "UPDATE tm_ticket SET tick_descripcion = CONCAT(tick_descripcion, ?) WHERE tick_id = ?;";
        $query_update = $conectar->prepare($sql_update);
        $query_update->execute([$tickd_descrip, $tick_id]);
        return ["status" => "ok"];
    }

    public function update_ticket($tick_id){
        $conectar=parent::conexion();
        $sql="UPDATE tm_ticket SET tick_estado ='Cerrado'WHERE tick_id = ?;";
        $query = $conectar->prepare($sql);
        $query->execute([$tick_id]);

        
        $usu_audit = $_SESSION['usu_id'] ?? 0;
        $log = new Log();
        $log->insert_log_ticket($usu_audit, $tick_id, 'CIERRE', "El ticket ha sido marcado como cerrado.", date('Y-m-d H:i:s'));

        return ["status" => "ok"];
    }

    public function reabrir_ticket($tick_id){
        $conectar=parent::conexion();

        $sql ="UPDATE tm_ticket SET tick_estado ='Abierto' WHERE tick_id = ?";
        $query = $conectar->prepare($sql);
        $query->execute([$tick_id]);

        $sql_detalle = "INSERT INTO td_ticketdetalle (tick_id, usu_id, tickd_descrip, fech_crea, est) VALUES (?, ?, 'El ticket ha sido reabierto por el usuario.', NOW(), '1')";
        $query_detalle = $conectar->prepare($sql_detalle);
        $query_detalle->execute([$tick_id, $_SESSION['usu_id']]);

        $log = new Log();
        $log->insert_log_ticket($_SESSION['usu_id'], $tick_id, 'REAPERTURA', "El ticket ha sido reabierto por el usuario.", date('Y-m-d H:i:s'));
        return ["status" => "ok"];
    }

    public function reasignar_ticket($tick_id, $usu_asig, $usu_id, $usu_asig_nom){
        $conectar = parent::conexion();

        $sql = "UPDATE tm_ticket SET usu_asig = ?, fech_asig = NOW() WHERE tick_id = ?;";
        $query = $conectar->prepare($sql);
        $query->execute([$usu_asig, $tick_id]);

        $fecha = date("d-m-Y H:i:s");
        $mensaje = "<br><hr><p><strong>[Ticket reasignado el día $fecha]</strong><br>";
        $mensaje .= "El ticket ha sido transferido al agente: <b>$usu_asig_nom</b>.</p>";

        $sql_update = "UPDATE tm_ticket SET tick_descripcion = CONCAT(tick_descripcion, ?) WHERE tick_id = ?;";
        $query_update = $conectar->prepare($sql_update);
        $query_update->execute([$mensaje, $tick_id]);

        $sql_detalle = "INSERT INTO td_ticketdetalle (tick_id, usu_id, tickd_descrip, fech_crea, est) VALUES (?, ?, ?, NOW(), '1')";
        $query_detalle = $conectar->prepare($sql_detalle);
        $query_detalle->execute([$tick_id, $usu_id, "Ticket reasignado al agente: " . $usu_asig_nom]);
        
        $log = new Log();
        $log->insert_log_ticket($usu_id, $tick_id, 'REASIGNACION', "Ticket transferido al agente: $usu_asig_nom", date('Y-m-d H:i:s'));

        return ["status" => "ok"];     
    }
        
    /*public function update_ticket_asignacion($tick_id,){
        $conectar=parent::conexion();
        parent::set_names();
        $sql="UPDATE tm_ticket SET tick_estado= 'Cerrado' WHERE tick_id=?;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $tick_id);
        $sql->execute();

        $log = new Log();
        $log->insert_log_ticket($_SESSION["usu_id"], $tick_id, 'CIERRE', "Ticket cerrado satisfactoriamente.", date('Y-m-d H:i:s'));
        return array ("status" => "ok");
    }*/
    public function update_ticket_asignacion($tick_id, $usu_asig){
        $conectar=parent::conexion();
        $sql="UPDATE tm_ticket SET usu_asig = ?, fech_asig = NOW() WHERE tick_id = ?;";
        $query=$conectar->prepare($sql);
        $query->execute([$usu_asig, $tick_id]);

        $log = new Log();
        $log->insert_log_ticket($_SESSION["usu_id"], $tick_id, 'ASIGNACION', "Ticket asignado al usuario: $usu_asig", date('Y-m-d H:i:s'));
        return ["status" => "ok"];
    }

    public function listar_ticket(){
            $conectar= parent::conexion();
            $sql = "SELECT
                        t.tick_id, 
                        d.div_nom,
                        n.novedad,
                        t.tick_estado,
                        t.fech_crea,
                        u.usu_nom as creador
                    FROM tm_ticket t
                    INNER JOIN tm_novedades n ON t.id_nov = n.id_nov
                    INNER JOIN tm_division d ON n.div_id = d.div_id
                    INNER JOIN tm_usuario u ON t.usu_id = u.usu_id
                    WHERE t.est = 1";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        }

    public function listar_ticket_x_usu($usu_id, $rol_id){
        $conectar = parent::conexion();
        $sql = "SELECT 
                    t.tick_id,t.usu_id,t.usu_asig,d.div_nom,n.novedad,t.tick_estado,t.fech_crea,
                    u_creador.usu_nom as creador,
                    u_asig.usu_nom as nombre_asig
                FROM tm_ticket t
                INNER JOIN tm_novedades n ON t.id_nov = n.id_nov
                INNER JOIN tm_division d ON n.div_id = d.div_id
                INNER JOIN tm_usuario u_creador ON t.usu_id = u_creador.usu_id
                LEFT JOIN tm_usuario u_asig ON t.usu_asig = u_asig.usu_id
                WHERE t.est = 1"; 

        if ($rol_id == 2) {// Soporte Agente
            $sql .= " AND (t.usu_asig = ? OR t.usu_id = ?)";
            $query = $conectar->prepare($sql);
            $query->execute([$usu_id, $usu_id]);
        } elseif ($rol_id == 3) {// USUARIO: Solo lo que él creó.
            $sql .= " AND t.usu_id = ?";
            $query = $conectar->prepare($sql);
            $query->execute([$usu_id]);
        }else{ //Admin (Rol 1)
            $query = $conectar->prepare($sql);
            $query->execute();
        }
        return $query->fetchAll();
    }

    public function listar_ticket_x_id($tick_id){
        $conectar = parent::conexion();
        $sql = "SELECT t.*,d.div_nom,n.novedad,u.usu_nom,u.usu_ap,u.usu_correo,c.canal_nom
                FROM tm_ticket t
                LEFT JOIN tm_usuario u ON t.usu_id = u.usu_id
                LEFT JOIN tm_novedades n ON t.id_nov = n.id_nov 
                LEFT JOIN tm_division d ON n.div_id = d.div_id
                LEFT JOIN tm_canal c ON t.canal_id = c.canal_id
                WHERE t.tick_id = ?";
        $query = $conectar->prepare($sql);
        $query->execute([$tick_id]);
        return $query->fetchAll();                
    }

    public function listar_ticketdetalle_x_ticket($tick_id){
        $conectar = parent::conexion();
        $sql = "SELECT td.*,u.usu_nom,u.usu_ap,u.rol_id
                FROM td_ticketdetalle td
                INNER JOIN tm_usuario u on td.usu_id = u.usu_id
                WHERE td.tick_id =? AND td.est = 1";
        $query=$conectar->prepare($sql);
        $query->execute([$tick_id]);
        return $query->fetchAll();
    }

    public function get_ticket_total(){
        $conectar=parent::conexion();
        $sql = "SELECT COUNT(*) AS total FROM tm_ticket WHERE est = 1";
        $query=$conectar->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function get_ticket_totalabierto(){
        $conectar=parent::conexion();
        $sql="SELECT COUNT(*) AS total FROM tm_ticket WHERE tick_estado = 'Abierto'";
        $query=$conectar->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function get_ticket_totalcerrado($usu_id){
        $conectar=parent::conexion();
        $sql="SELECT COUNT(*) AS total FROM tm_ticket WHERE tick_estado = 'Cerrado' AND est = 1";
        if ($usu_id) $sql .= " AND usu_id = $usu_id";
        $query=$conectar->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function get_ticket_grafico($usu_id){
        $conectar=parent::conexion();
        $sql = "SELECT n.novedad AS nom, COUNT(*) AS total 
                FROM tm_ticket t
                JOIN tm_novedades n ON t.id_nov = n.id_nov
                WHERE t.est = 1 AND t.usu_id = ?
                GROUP BY n.novedad ORDER BY total DESC";
        $query = $conectar->prepare($sql);
        $query->execute([$usu_id]);
        return $query->fetchAll();
    }

    public function get_grafico_funcionario(){
        $conectar = parent::conexion();

        $sql = "SELECT u.usu_nom AS funcionario, COUNT(*) AS total
                FROM tm_ticket t
                INNER JOIN tm_usuario u ON t.usu_asig = u.usu_id
                WHERE t.est = 1 GROUP BY u.usu_nom ORDER BY total DESC";
        $query = $conectar->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }     
    
    public function reemplazar_agente($tick_id, $usu_asig){
        $conectar = parent::conexion();
        $sql = "UPDATE tm_ticket SET usu_asig = ? WHERE tick_id = ?";
        $query = $conectar->prepare($sql);
        $query->execute([$usu_asig, $tick_id]);
        return $query->fetchAll();
    }

}

        ?>