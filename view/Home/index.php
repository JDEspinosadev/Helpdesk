<?php
require_once("../../config/conexion.php");
if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html>
<?php require_once("../MainHead/head.php");?>
    <title>Helpdesk::Home</title>
</head>
<body class="with-side-menu">

    <?php require_once("../MainHeader/header.php");?>

    <div class="mobile-menu-left-overlay"></div>
    
    <?php require_once("../MainNav/nav.php");?>

    <div class="page-content">
        <div class="container-fluid">
            
            <input type="hidden" id="user_idx" value="<?php echo $_SESSION["usu_id"] ?>">
            <input type="hidden" id="rol_idx" value="<?php echo $_SESSION["rol_id"] ?>">

            <header class="section-header">
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <h3>Estadisticas de Soporte</h3>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Resumen de Tickets</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </header>

            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-sm-4">
                            <article class="statistic-box purple">
                                <div>
                                    <div class="number" id="lbltotal">0</div>
                                    <div class="caption"><div>Total de Tickets</div></div>
                                </div>
                            </article>
                        </div>
                        <div class="col-sm-4">
                            <article class="statistic-box yellow">
                                <div>
                                    <div class="number" id="lbltotalabierto">0</div>
                                    <div class="caption"><div>Tickets Abiertos</div></div>
                                </div>
                            </article>
                        </div>
                        <div class="col-sm-4">
                            <article class="statistic-box red">
                                <div>
                                    <div class="number" id="lbltotalcerrado">0</div>
                                    <div class="caption"><div>Tickets Cerrados</div></div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <section class="card">
                        <header class="card-header">
                            Tickets por tipo de Novedad
                        </header>
                        <div class="card-block">
                            <div id="divgrafico" style="height: 250px;"></div>
                        </div>
                    </section>
                </div>

                <div class="col-xl-6">
                    <section class="card">
                        <header class="card-header">
                            Tickets por Funcionario (Agente)
                        </header>
                        <div class="card-block">
                            <div id="grafico_func_div" style="height: 250px;"></div>
                        </div>
                    </section>
                </div>
            </div>

        </div></div><?php require_once("../MainJs/js.php");?>
    <script type="text/javascript" src="home.js"></script>
</body>
</html>
<?php
}else{
    header("Location:".Conectar::ruta()."index.php");
}
?>