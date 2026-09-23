<?php
session_start();
require_once("../config/conexion.php");
require_once("../models/Ticket.php");
require_once("../models/Usuario.php");
require_once("../models/Documento.php");

$ticket = new Ticket();
$usuario = new Usuario();
$documento = new Documento();

$usu_id = $_SESSION["usu_id"] ?? null;
$rol_id = $_SESSION["rol_id"] ?? null;
    
if (isset($_GET["op"])){
    switch($_GET["op"]){
        
        case "insert":

            $datos = $ticket->insert_ticket(
                $_POST["usu_id"],
                $_POST["id_nov"],
                $_POST["novedad"],
                $_POST["canal_id"],
                $_POST["tick_descripcion"]
            );
            
            if(is_array($datos) && count($datos) > 0){
                $tick_id = $datos[0]["tick_id"];

                if(isset($_FILES['files']['name']) && is_array($_FILES['files']['name']) && $_FILES['files']['name'][0] != ""){
                    $countfiles = count($_FILES['files']['name']);
                    $ruta="../public/document/". $tick_id . "/";

                    if (!file_exists($ruta)) {
                        mkdir($ruta, 0777, true);
                    }

                    for ($i = 0; $i < $countfiles; $i++) {
                        $tmp_path = $_FILES['files']['tmp_name'][$i];
                        $nombre_real = $_FILES['files']['name'][$i];
                        $destino = $ruta . $nombre_real;

                        if(move_uploaded_file($tmp_path, $destino)){
                            $documento->insert_documento($tick_id, $nombre_real);
                        }
                    }
                }
                echo json_encode($datos);
            } 
            break;

        case "listar":

            $datos = $ticket->listar_ticket_x_usu($usu_id, $rol_id);
            $data = Array();

            foreach($datos as $row){
                $sub_array = array();
                $sub_array [] = "INGS-" . $row["tick_id"];
                $sub_array [] = $row["div_nom"];
                $sub_array [] = $row["novedad"];

                $sub_array [] = ($row["tick_estado"] == "Abierto") ? 
                    '<span class="label label-pill label-success">Abierto</span>' :
                    '<span class="label label-pill label-danger">Cerrado</span>';

                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                $sub_array[] = $row["creador"];

                
                    if($row["tick_estado"] == "Cerrado"){
                        $sub_array[] = '<span class="label label-pill label-primary">'.($row["nombre_asig"] ?? "Cerrado") . '</span>';
                    } else {
                        if($row["usu_asig"] == null){
                            if($rol_id == 1){
                                $sub_array[] = '<button type="button" onClick="asignarTicket('.$row["tick_id"].');" class="btn btn-inline btn-warning btn-sm><i class="fa fa-user-plus"></i> Sin Asignar</button>';
                            } else {
                                $sub_array[] = '<span class = "label label-pill label-warning">Sin asignar</span>';
                            }
                        } else {
                            $sub_array[] = '<a onClick="asignarTicket(' . $row["tick_id"] . ');" style="cursor:pointer;"><span class="label label-pill label-primary">' . $row["nombre_asig"] . '</span></a>';
                        }
                    }

                $data[] = $sub_array;
            }        
            
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data,
                "debug_usu_id" => $usu_id,
                "debug_rol_id" => $rol_id);

            /*ob_clean();*/
            echo json_encode($results);
            /*exit();*/
        break;

        case "mostrar":
            $output=array();
            if(isset($_POST["tick_id"])){
                $datos=$ticket->listar_ticket_x_id($_POST["tick_id"]);
                if(is_array($datos) && count($datos) > 0){
                    $row = $datos[0];
                    if (empty($row["usu_asig"]) && $_SESSION["rol_id"] == 2){
                        $ticket->reemplazar_agente($_POST["tick_id"], $_SESSION["usu_id"]);
                        $row["usu_asig"] = $_SESSION["usu_id"];
                    }
                    $output["tick_id"] = $row["tick_id"];
                    $output["usu_asig"] = $row["usu_asig"];
                    $output["usu_id"] = $row["usu_id"];
                    $output["div_nom"] = $row["div_nom"];
                    $output["novedad"] = $row["novedad"];
                    $output["canal_nom"] = $row["canal_nom"];
                    $output["tick_descripcion"] = $row["tick_descripcion"];
                    $output["tick_estado_texto"] = $row["tick_estado"];
                    $output["fech_crea"] = date("d-m-Y H:i:s", strtotime($row["fech_crea"]));
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_ap"] = $row["usu_ap"];

                    $output["tick_estado"] = (strtolower($row["tick_estado"]) == "abierto") ?
                        '<span class = "label label-pill label-success">Abierto</span>' :
                        '<span class="label label-pill label-danger">Cerrado</span>';    
                }
            }    
            echo json_encode($output);  
        break;

        case "total": 
        case "totalabierto":
        case "totalcerrado":
            $metodo = "get_ticket_" . $_GET["op"];
            $datos=$ticket->$metodo($_POST["usu_id"]);
            $total = (is_array($datos) && isset($datos[0]["total"])) ? $datos[0]["total"] : 0;
            echo json_encode(["total" => $total]);
        break;

        case "update":
            $tick_id = $_POST["tick_id"] ?? null;
            $usu_id = $_POST["usu_id"] ?? $_SESSION["usu_id"];

            if($tick_id && $usu_id){
                $ticket->insert_ticketdetalle_cerrar($tick_id, $usu_id);
                echo "1";
            }else{
                echo "Error: faltan datos necesarios para cerrar el ticket";
            }
            
        break;
        
        case "reabrir":
            $ticket->reabrir_ticket($_POST["tick_id"]);
            echo "1";
            break;
        
        case "asignar":
            $ticket->update_ticket_asignacion($_POST["tick_id"],$_POST["usu_asig"]);
        break;

        case "reasignar":
            $ticket->reasignar_ticket(
                $_POST["tick_id"], 
                $_POST["usu_asig"], 
                $_SESSION["usu_id"], 
                $_POST["usu_asig_nom"]
                );
            echo "1";
            break;

        case "listardetalle":
            $datos=$ticket->listar_ticketdetalle_x_ticket($_POST["tick_id"]);
            $data = Array();

            if(is_array($datos) && count($datos) > 0){
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array[] = $row["usu_nom"] . ' ' . $row["usu_ap"];
                    $sub_array[] = $row["tickd_descrip"];
                    $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                    $data[] = $sub_array;
                }
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data
            );

            echo json_encode($results);
            break;

        case "insertardetalle":
            $ticket->insert_ticketdetalle(
                $_POST["tick_id"],
                $_POST["usu_id"],
                $_POST["tickd_descrip"]
            );
            echo "1";
            break;

        case "grafico":
            if(isset($_POST["usu_id"])){
                $datos = $ticket->get_ticket_grafico($_POST["usu_id"]);
                echo json_encode($datos);
            }
            break;

        case "grafico_funcionario":
            $datos = $ticket->get_grafico_funcionario();
            echo json_encode($datos ? $datos : array());
            break;

        case "combo_soporte":
            $datos = $usuario->get_usuario_x_rol();
            if(is_array($datos) && count($datos) > 0){
                $html = "<option lable='Seleccione un agente'></option>";
                foreach($datos as $row) {
                    $html .= "<option value='".$row['usu_id']."'>".$row['usu_nom']." ".$row['usu_ap']."</option>";
                }
                echo $html;
            }
            break;
        }
    }
    
?>