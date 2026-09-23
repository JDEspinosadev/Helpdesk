<?php
    require_once("config/conexion.php");
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk::Recuperar Contraseña</title>

    <link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="img/favicon.png" rel="icon" type="image/png">

    <link rel="stylesheet" href="public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="public/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/main.css">
</head>
<body>

    <div class="page-center">
        <div class="container-fluid">
            <?php
            // PASO 1: VALIDAR DATOS (Nombre y Correo)
            if (!isset($_GET["step"]) || $_GET["step"] == 1){
                ?>
            <form class="sign-box" action="controller/usuario.php?op=validar_datos_recuperar" method="post" id="reset_form">
            <div class="sign-avatar">
                <img src="public/img/avatar-sign.png" alt="">
            </div>
            <header class="sign-title">Validar Identidad</header>

            <p class="text-center">Ingrese sus datos registrados para continuar.</p>

            <?php
            if (isset($_GET["e"])&& $_GET["e"]=="invalid"): ?>
                <div class="alert alert-danger" role="alert">Los datos no coinciden.</div> <?php endif; ?>
            
            <div class="form-group">
                <input type="text" name="usu_nom" class="form_control" placeholder="Nombre registrado" required/>
            </div>
            <div class="form-group">
                <input type="email" name="usu_correo" class="form-control" placeholder="Correo electrónico" required/>
            </div>

            <button type="submit" class="btn btn-rounded">Verificar Datos</button>

            <div class="form-group text-center" style="margin-top: 20px;">
                <a href="index.php">Regresar al Login</a>
            </div>
        </form>

        <?php
        // PASO 2: CAMBIAR CONTRASEÑA (Solo si la sesión temporal existe)
            }else if($_GET["step"] == 2 && isset($_SESSION["reset_id_autorizado"])){
                ?>
                <form class="sign-box" action="controller/usuario.php?op=actualizar_pass_final" method="post" id="password_form">
                    <div class="sign-avatar">
                        <img src="public/img/avatar-sign.png" alt="">
                    </div>
                    <header class="sign-title">Nueva Contraseña</header>
                    <p class="text-center">Establezca su nueva clave de acceso.</p>

                    <div class="form-group">
                        <input type="password" id="usu_pass" name="usu_pass" class="form-control" placeholder="Nueva Contraseña" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" id="usu_pass_confirm" class="form-control" placeholder="Confirmar Contraseña" required/>
                    </div>

                    <button type="submit" class="btn btn-rounded">Actualizar Contraseña</button>
                </form>
                <?php
            }else{
                //Si intentan entrar al paso 2 sin validarse, los regresa al paso 1
                header("Location: reset_password.php?step=1");
            }
            ?>
        </div>
    </div>
            

<script src="public/js/lib/jquery/jquery.min.js"></script>
<script src="public/js/lib/tether/tether.min.js"></script>
<script src="public/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="public/js/plugins.js"></script>
<script type="text/javascript" src="public/js/lib/match-height/jquery.matchHeight.min.js"></script>
<script>
    $(function() {
        $('.page-center').matchHeight({
            target: $('html')
        });

        //Validación de contraseñas iguales en el paso 2
        $("#password_form").on("submit", function(e){
            var pass = $("#usu_pass").val();
            var conf = $("#usu_pass_confirm").val();
            if(pass != conf){
                alert("Las contraseñas no coinciden.");
                e.preventDefault();
            }
        });
    });

</script>
<script src="public/js/app.js"></script>
    
</body>
</html>