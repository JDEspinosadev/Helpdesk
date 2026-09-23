<?php
    require_once("../config/conexion.php");
    require_once("../models/Division.php");
    
    $division = new Division();

    switch($_GET["op"]){
        case "combo":
            $datos = $division->get_division();

            if(is_array($datos) && count($datos) > 0){
                
                $html = "<option label ='Seleccionar División' selecte disabled>Seleccionar División</option>";

                foreach($datos as $row) {
                    $html.="<option value ='".$row['div_id']."'>".$row['div_nom']."</option>";
                }
                echo $html;
            }else{
                echo "<option value = ''>No hay divisiones disponibles</option>";
            }
            break;
    }
?>