<?php
require_once("../config/conexion.php");
require_once("../models/Canal.php");
$canal = new Canal();

switch($_GET["op"]){
    case "combo":
        $datos = $canal->get_canal();
        if(is_array($datos) && count($datos) > 0){
            $html = "<option label='Seleccionar Canal'></option>";
            foreach($datos as $row){
                $html .= "<option value='".$row['canal_id']."'>".$row['canal_nom']."</option>";
            }
            echo $html;
        }
        break;
}