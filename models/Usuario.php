<?php
require_once("Log.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Usuario extends Conectar{

    public function login(){
        $conectar = parent::Conexion();

        if(isset($_POST["enviar"])){
            $correo = $_POST["usu_correo"];
            $pass = $_POST["usu_pass"];

            if(empty($correo) || empty($pass)){
                header("Location:" . conectar::ruta() . "index.php?m=2");
                exit();
            }else{
                    $sql = "SELECT * FROM tm_usuario WHERE usu_correo = ? AND est = 1";
                    $stmt = $conectar->prepare($sql);
                    $stmt->bindvalue(1, $correo);
                    $stmt->execute();
                    $resultado = $stmt->fetch();

                    if($resultado){
                        $pass_db = $resultado["usu_pass"];
                    
                    if(password_verify($pass, $pass_db)){
                        $_SESSION["usu_id"] = $resultado["usu_id"];
                        $_SESSION["usu_nom"] = $resultado["usu_nom"];
                        $_SESSION["usu_ap"] = $resultado["usu_ap"];
                        $_SESSION["rol_id"] = $resultado["rol_id"];
                        $_SESSION["usu_img"] = $resultado["usu_img"];
                        header("Location:" . Conectar::ruta() . "view/Home/");
                        exit();
                    }else{
                        header("Location:" . Conectar::ruta() . "index.php?m=1");
                        exit();
                    }
                }else{
                    header("Location:".Conectar::ruta()."index.php?m=1");
                }
            }
        }
    }

    public function insert_usuario($usu_nom, $usu_ap, $usu_correo, $usu_pass, $rol_id, $usu_telf, $usu_dep){
        $conectar = parent::conexion();
        $pass_encriptada = password_hash($usu_pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO tm_usuario (usu_id, usu_nom, usu_ap, usu_correo, usu_pass, rol_id, usu_telf, usu_dep, fech_crea, est) 
                VALUES (NULL,?,?,?,?,?,NOW(),'1');";
        $query = $conectar->prepare($sql);
        $query->execute([$usu_nom, $usu_ap, $usu_correo, $pass_encriptada, $rol_id, $usu_telf, $usu_dep]);
        /*$sql->bindValue(1, $usu_nom);
        $sql->bindValue(2, $usu_ap);
        $sql->bindValue(3, $usu_correo);
        $sql->bindValue(4, $pass_encriptada);
        $sql->bindValue(5, $rol_id);
        $sql->execute();*/

        $id_generado = $conectar->lastInsertId();

       if ($id_generado){
            $log = new Log();
            $log->insert_log_usuario($_SESSION["usu_id"], $id_generado, 'CREACION', "Se creó el usuario: $usu_nom $usu_ap con rol $rol_id", 
             date('Y-m-d H:i:s'));
       }
       return $id_generado;     
    }

    public function update_usuario($usu_id, $usu_nom, $usu_ap, $usu_correo, $usu_telf, $usu_pass, $usu_dep, $rol_id){
        $conectar = parent::conexion();

        $query_old = $conectar->prepare("SELECT usu_correo, rol_id FROM tm_usuario WHERE usu_id = ?");
        $query_old->execute([$usu_id]);
        $old = $query_old->fetch();

        if(empty($usu_pass)){
            $sql = "UPDATE tm_usuario SET usu_nom=?, usu_ap=?, usu_correo=?, usu_telf=?, usu_dep=?, rol_id=?, fech_modi = NOW() WHERE usu_id=?;";
            $query = $conectar->prepare($sql);
            $res = $query->execute([$usu_nom, $usu_ap, $usu_correo, $usu_telf, $usu_dep, $rol_id, $usu_id]);
            /*$sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_ap);
            $sql->bindValue(3, $usu_correo);
            $sql->bindValue(4, $rol_id);
            $sql->bindValue(5, $usu_id);*/
        } else {
            $pass_encriptada = password_hash($usu_pass, PASSWORD_DEFAULT);
            $sql = "UPDATE tm_usuario set usu_nom=?, usu_ap=?, usu_correo=?, usu_telf=?, usu_dep=?, usu_pass=?, rol_id=?, fech_modi=NOW() WHERE 
                usu_id=?";
            $query = $conectar->prepare($sql);
            $res = $query->execute([$usu_nom, $usu_ap, $usu_correo, $usu_telf, $usu_dep, $pass_encriptada, $rol_id, $usu_id]);
            /*$sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_ap);
            $sql->bindValue(3, $usu_correo);
            $sql->bindValue(4, $pass_encriptada);
            $sql->bindValue(5, $rol_id);
            $sql->bindValue(6, $usu_id);*/
        }
        /*$res = $sql->execute();*/

        if($res){
            $detalle = "Actualizacion de perfil.";
            if($old['rol_id'] != $rol_id) $detalle .= "Cambio de Rol de ".$old['rol_id']." a ".$rol_id.".";
            if($old['usu_correo'] != $usu_correo) $detalle .= "Cambio de Correo.";
            /*if(!empty($usu_pass)) $detalle .= "Se cambio la contraseña";*/

            $log = new Log();
            $log->insert_log_usuario($_SESSION["usu_id"], $usu_id, 'ACTUALIZACIÓN', $detalle, date('Y-m-d H:i:s'));
        }
        return $res;

    }

    public function get_usuario_x_id($usu_id){
        $conectar = parent::conexion();
        $sql = "SELECT usu_id, usu_nom, usu_ap, usu_correo, usu_img ,usu_telf, usu_dep, rol_id
                FROM tm_usuario
                WHERE usu_id = ?";
        $query = $conectar->prepare($sql);
        $query->execute([$usu_id]);
        return $query->fetchAll();
    }

    public function get_usuario_total_tickets($usu_id){
        $conectar = parent::conexion();
        $sql = "SELECT COUNT(*) as total FROM tm_ticket WHERE usu_id = ? AND est = 1";
        $query = $conectar->prepare($sql);
        $query->execute([$usu_id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function get_usuario_grafico($usu_id){
        $conectar = parent::conexion();
        $sql = "SELECT tm_division.div_nom as nom, COUNT(*) AS total
                FROM tm_ticket
                JOIN tm_division ON tm_ticket.div_id = tm_division.div_id
                WHERE tm_ticket.est = 1
                AND tm_ticket.usu_id = ?
                GROUP BY tm_division.div_nom
                ORDER BY total DESC";
        $query = $conectar->prepare($sql);
        $query->execute([$usu_id]);
        return $query->fetchAll();
    }

    public function delete_usuario($usu_id){
        $conectar = parent::conexion();
        $sql = "UPDATE tm_usuario SET est = 0, fech_elim = NOW() WHERE usu_id = ?";
        $query = $conectar->prepare($sql);
        $res = $query->execute([$usu_id]);

        if($res){
            $log =  new Log();
            $log->insert_log_usuario($_SESSION["usu_id"], $usu_id, 'ELIMINACION', "Usuario desactivado en el sistema (est=0).", date('Y-m-d H:i:s'));
        }
        return $res;
    }

    public function actualizar_contrasena($usu_id, $usu_pass){
        $conectar = parent::conexion();

        $id_realiza = (isset($_SESSION["usu_id"])) ? $_SESSION["usu_id"] : $usu_id; // Si el usuario no ha iniciado sesión, registramos el cambio con su propio ID
        $pass_encriptada = password_hash($usu_pass, PASSWORD_DEFAULT);   
        
        $sql = "UPDATE tm_usuario SET usu_pass = ?, fech_modi = NOW() WHERE usu_id = ?";
        $query = $conectar->prepare($sql);   
        $res = $query->execute([$pass_encriptada, $usu_id]);

        if($res){
            $log = new Log();
            $log -> insert_log_usuario($id_realiza, $usu_id, 'CAMBIO PASSWORD', "Actualización de credenciales de acceso.", date('Y-m-d H:i:s'));
        }
        return $res;
    }

    public function get_usuario(){
        $conectar = parent::conexion();
        $sql = "SELECT  tm_usuario.usu_id, 
                        tm_usuario.usu_nom, 
                        tm_usuario.usu_ap, 
                        tm_usuario.usu_correo, 
                        tm_usuario.rol_id, 
                        tm_usuario.usu_img,
                        tm_usuario.usu_telf,
                        tm_usuario.usu_dep,
                        tm_rol.rol_nom 
                FROM tm_usuario
                INNER JOIN tm_rol ON tm_usuario.rol_id = tm_rol.rol_id
                WHERE tm_usuario.est = 1";
        $query = $conectar->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    
    public function get_usuario_por_nombre_correo($usu_nom, $usu_correo){
        $conectar = parent::conexion();
        $sql = "SELECT * FROM tm_usuario WHERE usu_nom = ? AND usu_correo = ? AND est = 1";
        $query = $conectar->prepare($sql);
        $query->execute([$usu_nom, $usu_correo]);
        return $query->fetchAll();
    }

    public function get_usuario_x_rol(){
        $conectar = parent::conexion();
        $sql = "SELECT * FROM tm_usuario WHERE rol_id = 2 AND est = 1";
        $query = $conectar->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function get_usuario_total_x_id($usu_id){
        $conectar = parent::conexion();
        $sql = "SELECT COUNT (*) as total FROM tm_ticket WHERE usu_id = ?";
        $query = $conectar->prepare($sql);
        $query->execute([$usu_id]);
        return $query->fetchAll();
    }

    public function get_usuario_totalabierto_x_id($usu_id){
        $conectar=parent::conexion();
        $sql="SELECT COUNT (*) as total FROM tm_ticket WHERE usu_id = ? AND tick_estado = 'Abierto'";
        $query=$conectar->prepare($sql);
        $query->execute([$usu_id]);
        return $query->fetchAll();
    }

    public function get_usuario_totalcerrado_x_id($usu_id){
        $conectar = parent::conexion();
        $sql = "SELECT COUNT (*) as total FROM tm_ticket WHERE usu_id = ? AND tick_estado = 'Cerrado'";
        $query = $conectar->prepare($sql);
        $query->execute([$usu_id]);
        return $query->fetchAll();
    }

    public function get_usuario_tickets_abiertos($usu_id){
        $conectar = parent::conexion();
        $sql = "SELECT COUNT(*) as total FROM tm_ticket WHERE usu_id = ? AND tick_estado = 'Abierto' AND est = 1";
        $query = $conectar->prepare($sql);
        $query->execute([$usu_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function actualizar_foto_perfil($usu_id, $usu_img){
        $conectar = parent::conexion();

        $sql = "UPDATE tm_usuario
                SET usu_img = ?,
                    fech_modi = NOW()
                WHERE usu_id = ?";

        $query = $conectar->prepare($sql);
        $res = $query->execute([$usu_img, $usu_id]);
        return $res;
    }

    public function get_usuario_x_correo($usu_correo){
        $conectar = parent::conexion();
        $sql = "SELECT usu_img FROM tm_usuario WHERE usu_correo = ? AND est = 1";
        $query = $conectar->prepare($sql);
        $query->execute([$usu_correo]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

