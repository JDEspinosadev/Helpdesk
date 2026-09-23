<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION["usu_id"])){
require_once("../MainHeader/header.php"); 
?>
<!DOCTYPE html>
<html lang="es">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Auditoría de Sistema</title>
    <?php require_once("../MainHead/head.php");?>
</head>
<body class="with-side-menu">
    <?php require_once("../MainHeader/header.php");?>
    <?php require_once("../MainNav/nav.php");?>

    <div class="page-content">
        <div class="container-fluid">
            <header class="section-header">
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <h3>Auditoría y Logs del Sistema</h3>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li><a href="../Home/">Inicio</a></li>
                                <li class="active">Consultar Auditoría</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </header>

            <section class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <label class="form-label">Desde</label>
                                <input type="date" class="form-control" id="fecha_inicio">
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <label class="form-label">Hasta</label>
                                <input type="date" class="form-control" id="fecha_fin">
                            </fieldset>
                        </div> 
                        <div class="col-md-4">
                            <label class="form-label">&nbsp;</label>
                            <button id="btn_filtrar" class="btn btn-inline btn-primary btn-block">Filtrar por fecha</button>
                        </div>
                    </div>

                    <div class="tabs-section">
                        <div class="tabs-section-nav">
                            <ul class="nav" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab-usu" role="tab" data-toggle="tab">Logs de Usuarios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab-tick" role="tab" data-toggle="tab">Logs de Tickets</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="tab-usu">
                                <table id="tabla_logs_usuarios" class="table table-bordered table-striped table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Admin</th>
                                            <th>Acción</th>
                                            <th>Usuario afectado</th>
                                            <th>Detalle</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab-tick">
                                <table id="tabla_logs_tickets" class="table table-bordered table-striped table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Usuario</th>
                                            <th>ID Ticket</th>
                                            <th>Acción</th>
                                            <th>Detalle</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <?php require_once("../MainJs/js.php"); ?>
    <script src="consultar_logs.js"></script>
</body>
</html>
<?php
}else{
    header("Location:".Conectar::ruta()."index.php");
}
?>
