<?php
ob_start();
require_once("../config/conexion.php");
require_once("../models/Log.php");
$log = new Log();

/* Validamos la sesión y que solo el Rol 1(Admin) pueda acceder a este controlador */
if(isset($_SESSION["usu_id"])&&$_SESSION["rol_id"] == 1){
    
    $op = $_GET["op"] ?? '';

    switch($op){
        case "listar_logs_usuarios":
            $datos = $log->get_logs_usuarios();
            $data = Array();

            if(is_array($datos)){
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                    $sub_array[] = $row["admin_nom"] . ' ' . $row["admin_ap"];
                    $sub_array[] = '<span class="label label-pill label-primary">'.$row["logu_accion"].'</span>';
                    $sub_array[] = $row["sujeto_nom"] . ' ' . $row["sujeto_ap"];
                    $sub_array[] = $row["logu_detalle"];
                    $data[] = $sub_array;
                }
            }
            
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data
            );
            
            ob_clean();  
            echo json_encode($results);
            break;

        case "listar_logs_tickets":
            $datos = $log->get_logs_tickets();
            $data = Array();

            if(is_array($datos)){
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                    $sub_array[] = $row["usu_nom"] . ' ' . $row["usu_ap"];
                    $sub_array[] = '<span class="label label-pill label-primary">'.trim($row["logt_accion"]).'</span>';
                    $sub_array[] = "Ticket ID: " . $row["tick_id"];
                    $sub_array[] = $row["logt_detalle"];
                    $data[] = $sub_array;
                }
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data
            );
            
            ob_clean();    
            echo json_encode($results);
            break;
    }
} else {

    ob_clean();
    echo json_encode(["aaData" => []]);
}
?>