<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
?>

<header class="site-header">
	    <div class="container-fluid">
	
	        <a href="#" class="site-logo">
	            <img class="hidden-md-down" src="../../public/img/logo satlock.jpg" alt="">
	            <img class="hidden-lg-up" src="../../public/img/logo-2-mob.png" alt="">
	        </a>
	
	        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
	            <span>toggle menu</span>
	        </button>
	
	        <button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>
	        <div class="site-header-content">
	            <div class="site-header-content-in">
	                <div class="site-header-shown">
							<div class="dropdown user-menu">
								<button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<img src="../../public/img/usuario/<?php echo (isset($_SESSION["usu_img"]) && !empty($_SESSION["usu_img"])) ? $_SESSION["usu_img"] : 'no_photo.png'; ?>?v=<?php echo time(); ?>" alt="Foto de Perfil">	
								</button>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
									<a class="dropdown-item" href="../MntPerfil/index.php"><span class="font-icon glyphicon glyphicon-user"></span>Perfil</a>	                            
									<a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-question-sign"></span>Ayuda</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="../Logout/logout.php"><span class="font-icon glyphicon glyphicon-log-out"></span>Salir</a>
								</div>
							</div>
						</div>
	
	                	<div class="mobile-menu-right-overlay"></div>

						<input type="hidden" id="user_idx" value="<?php echo $_SESSION["usu_id"] ?>">
	
	                        <div class="dropdown dropdown-typical">
						<a href="../Home/index.php" class="dropdown-toggle no-arr">
							<span class="font-icon font-icon-user"></span>
							<?php echo $_SESSION["usu_nom"] ?> <?php echo isset($_SESSION["usu_ap"]) ? $_SESSION["usu_ap"] : '' ?>
						</a>		
						</div>
	</header><!--.site-header-->