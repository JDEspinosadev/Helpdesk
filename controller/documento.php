<?php

    require_once("../config/conexion.php");
    require_once("../models/Documento.php");

    $documento = new Documento();

    if (isset($_GET["op"])){
        switch ($_GET["op"]){
            
            case "listar":
                $tick_id = $_POST["tick_id"] ?? null;
                $data = Array();

                if($tick_id){
                    $datos=$documento->get_documento_x_ticket($_POST["tick_id"]);
                    if(is_array($datos)==true and count($datos)>0){
                        foreach($datos as $row){
                            $sub_array = array();
                            $sub_array[] = '<a href="../../public/document/'.$row["tick_id"].'/'.$row["det_nom"].'" target="_blank">'.$row["det_nom"].'</a>';
                            $sub_array[] = '<a type="button" href="../../public/document/'.$row["tick_id"].'/'.$row["det_nom"].'" target="_blank" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></a>';
                            $data[] = $sub_array;
                        }
                    }
                }

                $results = array(
                    "sEcho" => 1,
                    "iTotalRecords" => count($data),
                    "iTotalDisplayRecords" => count($data),
                    "aaData" => $data
                );
                echo json_encode($results);
            break;
                
        }
    }
?>