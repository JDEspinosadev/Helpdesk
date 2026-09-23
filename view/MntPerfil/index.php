<?php
    require_once("../../config/conexion.php");
    if (isset($_SESSION["usu_id"])) {
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php"); ?>
    <title>Helpdesk - Perfil</title>
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
                                <h3>Perfil</h3>
                                
                        <ol class="breadcrumb breadcrumb-simple">
                                    <li><a href="#">Home</a></li>
                                    <li class="active">Cambiar Contraseña</li>
                        </ol>     
                    </div>
            </header>

            <h5 class="m-t-lg with-border">Resumen de Actividad</h5>
            <div class="row">
                <div class="col-sm-4">
                    <article class="statistic-box yellow">
                        <div>
                            <div class="number" id="lbltotal">0</div>
                            <div class="caption"><div>Total de Tickets</div></div>
                        </div>
                    </article>
                </div>
                <div class="col-sm-4">
                    <article class="statistic-box green">
                        <div>
                            <div class="number" id="lblabiertos">0</div>
                            <div class="caption"><div>Tickets Abiertos</div></div>
                        </div>
                    </article>
                </div>
                <div class="col-sm-4">
                    <article class="statistic-box red">
                        <div>
                            <div class="number" id="lblcerrados">0</div>
                            <div class="caption"><div>Tickets Cerrados</div></div>
                        </div>
                    </article>
                </div>
            </div>

            <div class="box-typical box-typical-padding">

                <h5 class="m-t-lg with-border">Datos Personales</h5> 
                <div class="row">
                    <div class="col-lg-3 text-center">
                        <fieldset class="form-group">
                            <label class="form-label semibold">Foto de Perfil</label>
                            <img src="../../public/img/usuario/<?php echo (isset($_SESSION["usu_img"]) && $_SESSION["usu_img"] != '') ? $_SESSION["usu_img"] : 'no_photo.png'; ?>?v=<?php echo time(); ?>" id="previsualizacion_img" class="img-thumbnail img-circle" style="width: 150px; height: 150px; object-fit: cover; margin-bottom: 10px;">

                            <div id="lblrol" style="margin-bottom: 10px;"></div>

                            <input type="file" id="usu_img_file" name="usu_img_file" style="display:none;" accept="image/x-png, image/gif, image/jpeg">

                            <button type="button" class="btn btn-sm btn-inline btn-primary" onclick="$('#usu_img_file').click();">
                                <i class="fa fa-camera"></i> Cambiar Foto
                            </button>
                            <small class="text-muted d-block m-t-xs">Máx: 2MB (.jpg, .png)</small>
                        </fieldset>
                    </div>

                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-6">
                                <fieldset class="form-group">
                                    <label class="form-label semibold">Nombre</label>
                                    <input type="text" class="form-control" id="usu_nom" readonly>
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset class="form-group">
                                    <label class="form-label semibold">Apellido</label>
                                    <input type="text" class="form-control" id="usu_ap" readonly>
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset class="form-group">
                                    <label class="form-label semibold">Área / Departamento</label>
                                    <input type="text" class="form-control" id="usu_area" readonly> 
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset class="form-group">
                                    <label class="form-label semibold">Teléfono / Extensión</label>
                                    <input type="text" class="form-control" id="usu_telf" readonly>
                                </fieldset>
                            </div>
                            <div class="col-lg-12 m-t-md">
                                <fieldset class="form-group">
                                    <label class="form-label semibold">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="usu_correo" readonly>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-typical box-typical-padding">
                <h5 class="m-t-lg with-border">Cambiar Contraseña</h5>

                <div class="row">
                    <div class="col-lg-6">
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="exampleInput">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="txtpass" name="txtpass">
                        </fieldset>
                    </div>

                    <div class="col-lg-6">
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="exampleInput">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="txtpassnew" name="txtpassnew">
                        </fieldset>
                    </div>

                    <div class="col-lg-12">
                        <button type="button" id="btnactualizar" class="btn btn-rounded btn-inline btn-primary">Actualizar</button> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once("../MainJs/js.php"); ?>
        <script type="text/javascript" src="mntperfil.js"></script>
        </body>
</html>
<?php
    } else {
        header("Location:".Conectar::ruta()."index.php");
    }
?>