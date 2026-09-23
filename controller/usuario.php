<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");

    $usuario = new Usuario();

    if(isset($_GET["op"])){
        switch($_GET["op"]){

            case "guardaryeditar":
                if (empty($_POST["usu_id"])) {
                    $usuario->insert_usuario($_POST["usu_nom"],$_POST["usu_ap"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_telf"],$_POST["usu_dep"],$_POST["rol_id"]);
                } else {
                    $usuario->update_usuario($_POST["usu_id"],$_POST["usu_nom"],$_POST["usu_ap"],$_POST["usu_correo"],$_POST["usu_telf"],$_POST["usu_pass"], $_POST["usu_dep"],$_POST["rol_id"]);
                }
                echo "1";
                break;

            case "listar":

                /*if (ob_get_level()) ob_clean();
                header('Content-Type: application/json');

                if(!isset($_SESSION["rol_id"]) || $_SESSION["rol_id"] !=1){
                    echo json_encode(["draw" => 1,"recordsTotal" => 0,"recordsFiltered" => 0,"aaData" => []]);
                    exit();
                }*/

                $datos = $usuario->get_usuario();
                $data = array();

                /*if(is_array($datos) && count($datos) > 0) {*/
                    foreach($datos as $row){
                        $sub_array = array();
                        $img = (isset($row["usu_img"]) && !empty($row["usu_img"])) ? $row["usu_img"] :"no_photo.png";
                        $sub_array [] = $img;
                        $sub_array [] = $row["usu_nom"];
                        $sub_array [] = $row["usu_ap"];
                        $sub_array [] = $row["usu_correo"];
                        $sub_array [] = $row["usu_telf"] ?? "";
                        $sub_array [] = $row["usu_dep"] ?? "";
                        $sub_array [] = "******";
                        
                        if ($row["rol_id"] == "1"){
                            $sub_array [] = '<span class = "label label-pill label-success">Administrador</span>';
                        } elseif ($row["rol_id"] == "2"){
                            $sub_array[] = '<span class="label label-pill label-info">Soporte</span>';
                        }else{
                            $sub_array[] = '<span class="label label-pill label-primary">Usuario</span>';
                        }
                                
                        $sub_array [] = '<button type="button" onClick = "editar('.$row["usu_id"].');" id="'.$row["usu_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class ="fa fa-edit"></i></button>';
                        $sub_array [] = '<button type="button" onClick = "eliminar('.$row["usu_id"].');" id="'.$row["usu_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class ="fa fa-trash"></i></button>';
                        $data [] = $sub_array;
                    }
                

                $results = array(
                    "draw" => 1,
                    "iTotalRecords" => count($data),
                    "iTotalDisplayRecords" => count($data),
                    "aaData" => $data,
                    "data" => $data
                );

                echo json_encode($results, JSON_UNESCAPED_UNICODE);
                exit();
            break;

            case "eliminar":
                $usuario->delete_usuario($_POST["usu_id"]);
                echo "1";
            break;

            //Escenario interno/externo: El método que ejecuta el cambio final
            case "actualizar_pass_final":
                //Si el usuario está logueado, usamos su sesión fija
                // Si viene de recuperación externa, usamos la sesión temporal 'reset_id_autorizado'
                $usu_id = isset($_SESSION["usu_id"]) ? $_SESSION["usu_id"] : ($_SESSION["reset_id_autorizado"]?? null);
                /*$usu_pass = $_POST["usu_pass"];*/

                if($usu_id){
                    $usuario->actualizar_contrasena($usu_id, $_POST["usu_pass"]);
                    //Si era recuperacion externa, destruimos la sesión temporal por seguridad
                    if(isset($_SESSION["reset_id_autorizado"])) unset($_SESSION["reset_id_autorizado"]);
                    header("Location:".Conectar::ruta()."index.php?m=v");
                }
            break;

            case "mostrar":
                $usu_id = isset($_POST["usu_id"]) ? $_POST["usu_id"] : (isset($_SESSION["usu_id"]) ? $_SESSION["usu_id"] : null);
                
                if ($usu_id){
                    $datos = $usuario->get_usuario_x_id($usu_id);
                    if(is_array($datos) == true and count($datos)>0){
                        foreach($datos as $row){
                            $output["usu_id"] = $row["usu_id"];
                            $output["usu_nom"] = $row["usu_nom"];
                            $output["usu_ap"] = $row["usu_ap"];
                            $output["usu_correo"] = $row["usu_correo"];
                            $output["usu_telf"] = $row["usu_telf"];
                            $output["usu_dep"] = $row["usu_dep"];
                            $output["rol_id"] = $row["rol_id"];

                            if($row["rol_id"] == "1"){
                                $output["rol_nom"] = "Administrador";
                                }elseif ($row["rol_id"] == "2"){
                                    $output["rol_nom"] = "Soporte";
                            } else {
                                $output["rol_nom"] = "Usuario";
                            }
                        }
                        if (ob_get_level()) ob_clean();
                        echo json_encode($output);
                    }
                }
                break;

            case "password":
                $usuario->actualizar_contrasena($_POST["usu_id"], $_POST["usu_pass"]);
                break;

            case "total":
                $output = array("total => 0");
                $datos = $usuario->get_usuario_total_x_id($_POST["usu_id"]);
                if(is_array($datos) == true and count($datos) > 0){
                    foreach($datos as $row)
                    {
                        $output["total"] = $row["total"];
                    }
                    echo json_encode($output);
                }
            break;

            case "totalabierto":
                $datos = $usuario->get_usuario_totalabierto_x_id($_POST["usu_id"]);
                if(is_array($datos) == true and count($datos) > 0){
                    foreach($datos as $row)
                    {
                        $output["total"] = $row["TOTAL"];
                    }
                    echo json_encode($output);
                }
            break;

            case "totalcerrado":
                $datos = $usuario->get_usuario_totalcerrado_x_id($_POST["usu_id"]);
                if(is_array($datos) == true and count($datos) > 0){
                    foreach($datos as $row)
                    {
                        $output["total"] = $row["TOTAL"];
                    }
                    echo json_encode($output);
                }
            break;

            case "grafico":
                $datos = $usuario->get_usuario_grafico($_POST["usu_id"]);
                echo json_encode($datos);
            break;

            case "combo":
                $datos = $usuario -> get_usuario_x_rol();
                if(is_array($datos) == true and count($datos) > 0){
                    $html = "<option label='Seleccionar'></option>";
                    foreach($datos as $row){
                        $html.= "<option value='".$row['usu_id']."'>".$row['usu_nom']."</option>";
                    }
                    echo $html;
                }
            break;

            case "combo_soporte":
                $datos = $usuario->get_usuario_x_rol();
                if(is_array($datos) == true and count($datos) > 0){
                    $html = "<option label='Seleccionar'></option>";
                    foreach($datos as $row){
                        $html.= "<option value='".$row['usu_id']."'>".$row['usu_nom']."</option>";
                    }
                    echo $html;
                }
            break;    
                
                //Escenario Externo: Validar nombre y correo para permitir el cambio
            case "validar_datos_recuperar":
                $correo = $_POST["usu_correo"];
                $nombre = $_POST["usu_nom"];

                $datos = $usuario -> get_usuario_por_nombre_correo($nombre, $correo);

                if(is_array($datos)&& count ($datos) > 0){
                //Creamos una sesión temporal para que NO pueda cambiar la clave de otros
                    $_SESSION["reset_id_autorizado"] = $datos[0]["usu_id"];
                    header("Location:".Conectar::ruta()."reset-password.php?step=2");
                }else{
                    header("Location:".Conectar::ruta()."reset-password.php? e=invalid");
                }
                exit();
            break;

            case "stats":

                $output = array(
                    "total" => 0,
                    "abiertos" => 0,
                    "cerrados" => 0
                );

                if(isset($_POST["usu_id"])){
                    $id = $_POST["usu_id"];

                    $res_total = $usuario->get_usuario_total_tickets($id);
                    $res_abiertos = $usuario->get_usuario_tickets_abiertos($id);

                    /*$total = $usuario->get_usuario_total_tickets($_POST["usu_id"]);*/
                    $total = (isset($res_total["total"])) ? (int)$res_total["total"] : 0;
                    /*$abiertos = $usuario->get_usuario_tickets_abiertos($_POST["usu_id"]);*/
                    $abiertos = (isset($res_abiertos["total"])) ? (int)$res_abiertos["total"] : 0;

                    $output["total"] = $total;
                    $output["abiertos"] = $abiertos;
                    $output["cerrados"] = $total - $abiertos;
                }

                if (ob_get_level()) ob_clean();

                echo json_encode($output);
            break;

            case "subir_img":
                if (isset($_FILES["file"])){
                    $id_usuario = $_SESSION["usu_id"];
                    $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                    $nombre_archivo = "perfil_" . $id_usuario . "." . $extension;

                    $ruta_destino = "../public/img/usuario/" . $nombre_archivo;

                    if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta_destino)){
                        $usuario->actualizar_foto_perfil($id_usuario, $nombre_archivo);

                        $_SESSION["usu_img"] = $nombre_archivo;

                        if(ob_get_level()) ob_clean();
                        echo "1";
                    }else{
                        echo "0";
                    }
                }else{
                    echo "No llegó el archivo";
                }
            break;

            case "get_user_img":

                $output = array("usu_img" => "no_photo.png");

                if (isset($_POST["usu_correo"]) && !empty($_POST["usu_correo"])){
                    $usu_correo = $_POST["usu_correo"];
                    $datos = $usuario->get_usuario_x_correo($_POST["usu_correo"]);

                    if (is_array($datos) && count($datos) > 0){

                        if (!empty($datos[0]["usu_img"])){
                        $output["usu_img"] = $datos[0]["usu_img"];
                        }
                    }
                }
                if(ob_get_level()) ob_clean();
                echo json_encode($output);
                break;
        }
    }
?>
