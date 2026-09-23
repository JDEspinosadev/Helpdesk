<?php
require_once("../config/conexion.php");
require_once("../models/Novedad.php");
    
$novedad = new Novedad();

if(isset($_GET["op"])){
    switch($_GET["op"]){
        
        case "combo":

            $div_id = (isset($_POST["div_id"]) && is_numeric($_POST["div_id"])) ? $_POST["div_id"] : null;

            $html = "";

            if ($div_id !== null){
                $datos = $novedad->get_novedad($div_id);

                if(is_array($datos) && count($datos) > 0){
                    $html .= "<option value='' selected>Seleccionar Novedad</option>";
                    foreach($datos as $row){
                        $html .= "<option value='" . $row['id_nov'] . "'>" . $row['novedad'] . "</option>";
                    }
                } else {
                    $html .= "<option value=''>No hay novedades para esta división</option>";
                }
            }else{
                $html = "<option value=''>Seleccione una división primero</option>";
            }

            echo $html;
        break;  
    }
}
?>