<?php
    require_once("../../config/conexion.php");
    if (isset($_SESSION["usu_id"]) && $_SESSION["rol_id"] == 1) {
    }else{
        header("Location:". Conectar::ruta() . "index.php");
    }
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php"); ?>
    <title>Helpdesk - Usuario</title>
    </head> 
    <body class="with-side-menu">

        <?php require_once("../MainHeader/header.php"); ?>

        <div class="mobile-menu-left-overlay"></div>

        <?php require_once("../MainNav/nav.php"); ?>

        <!-- Contenido -->
        <div class="page-content">
            <div class="container-fluid">

                <header class="section-header">
                    <div class="tbl">
                        <div class="tbl-row">
                            <div class="tbl-cell">
                                <h3>Mantenimiento Usuario</h3>
                                <ol class="breadcrumb breadcrumb-simple">
                                    <li><a href="#">Home</a></li>
                                    <li class="active">Mantenimiento Usuario</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </header>

                <div class="box-typical box-typical-padding">
                    <button type="button" id="btnnuevo" class="btn btn-rounded btn-inline btn-primary">Nuevo Registro</button>
                    <table id="usuario_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th style="width: 5%;">Foto</th>
                                <th style="width: 10%;">Nombre</th>
                                <th style="width: 10%;">Apellido</th>
                                <th class="d-none d-sm-table-cell" style="width: 40%;">Correo</th>
                                <th style="width: 10%;">Teléfono</th>
                                <th style="width: 10%;">Departamento/Área</th>
                                <th class="d-none d-sm-table-cell" style="width: 5%;">Rol</th>
                                <th class="d-none d-sm-table-cell" style="width: 5%;">Contraseña</th>
                                <th class="text-center" style="width: 5%;">Editar</th>
                                <th class="text-center" style="width: 5%;">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <?php require_once("modalmantenimiento.php"); ?>
        <?php require_once("../MainJs/js.php"); ?>
        <script type="text/javascript" src="mntusuario.js"></script>
        <style>
            select.select2{
                display: none !important;
            }

            .select2-container--default .select2-selection--single{
                border: 1px solid #d6dee5 !important;
                height: 38px !important;
            }
            .select2-container{
                width: 100% !important;
                display: block;
            }
        </style>
    </body>

</html>
<?php
    
?>