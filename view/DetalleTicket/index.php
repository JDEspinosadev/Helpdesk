<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
?>

<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php"); ?>
    <title>HelpDesk::Detalle Ticket</title>
</head>

<body class="with-side-menu">

    <?php require_once("../MainHeader/header.php"); ?>

    <div class="mobile-menu-left-overlay"></div>

    <?php require_once("../MainNav/nav.php"); ?>

    <!-- Contenido -->
    <div class="page-content">
        <div class="container-fluid">
            <input type="hidden" id="user_idx" value="<?php echo $_SESSION["usu_id"] ?>">
            <input type="hidden" id="rol_idx" value="<?php echo $_SESSION["rol_id"] ?>">

        <header class="section-header">
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <h3 id="lblnomidticket">Detalle Ticket - 1</h3>
                            <div id="lblestado"></div>
                            <span class="label label-pill label-primary" id="lblnomusuario"></span>
                            <span class="label label-pill label-default" id="lblfechcrea"></span>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li><a href="#">Home</a></li>
                                <li class="active">Detalle Ticket</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </header>

            <div class="box-typical box-typical-padding">
                <div class="row">

                    <div class="col-lg-6">
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="div_nom">División</label>
                            <input type="text" class="form-control" id="div_nom" name="div_nom" readonly>
                        </fieldset>
                    </div>

                    <div class="col-lg-6">
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="novedad">Novedad</label>
                            <input type="text" class="form-control" id="novedad" name="novedad" readonly>
                        </fieldset>
                    </div>

                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="canal_nom">Canal de Comunicación</label>
                            <input type="text" class="form-control" id="canal_nom" name="canal_nom" readonly>
                        </fieldset>
                    </div>

                    <div class="col-lg-12">
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="novedad">Documentos Adicionales</label>
                            <table id="documentos_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                <thead>
                                    <tr>
                                        <th style="width: 90%;">Nombre</th>
                                        <th class="text-center" style="width: 10%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </fieldset>
                    </div>

                    <div class="col-lg-12">
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="tickd_descripusu">Descripción</label>
                            <div class="summernote-theme-1">
                                <textarea id="tickd_descripusu" name="tickd_descripusu" class="summernote" name="name"></textarea>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

            <section class="activity-line" id="lbldetalle"></section>

                    <div class="box-typical box-typical-padding" id="pnldetalle">
                        <p>Ingresa la consulta</p>
                        <div class="row">
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                <label class="form-label semibold" for="tick_descripcion">Descripción</label>
                                <div class="summernote-theme-1">
                                    <textarea id="tickd_descrip" name="tick_descrip" class="summernote" name="name"></textarea>
                                </div>
                                </fieldset>
                            </div>
                        </div>
                    </div><div class="box-typical box-typical-padding">
                        <div class="row">
                                <div class="col-lg-12">
                                    <button type="button" id="btnenvia" class="btn btn-rounded btn-inline btn-primary">Enviar</button>
                                    <?php if ($_SESSION["rol_id"] == 1): ?>
                                    <button type="button" id="btnreasignar" class="btn btn-rounded btn-inline btn-info">Reasignar Agente</button>
                                    <?php endif; ?>
                                    <button type="button" id="btncerrarticket" class="btn btn-rounded btn-inline btn-danger">Cerrar Ticket</button>
                                    <button type="button" id="btnreabrirticket" class="btn btn-rounded btn-inline btn-warning" style="display:none;">Reabrir Ticket</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
</div>
    
    <!-- Contenido -->
    <div id="modalreasignar" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Reasignar Agente Responsable</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label semibold" for="usu_asig">Seleccione nuevo agente</label>
                        <select name="usu_asig" id="usu_asig" class="form-control" data-placeholder="Seleccionar..." style="width:100%"> 
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btn_ejecutar_reasignacion" class="btn btn-rounded btn-primary">Confirmar Reasignación</button>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("../MainJs/js.php"); ?>
    <script type="text/javascript" src="detalleticket.js"></script>

</body>
</html>
<?php
} else {
    header("Location: " . Conectar::ruta() . "index.php");
    exit();
}
?>