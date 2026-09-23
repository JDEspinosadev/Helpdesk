<?php echo "Mi rol actual es " .$_SESSION["rol_id"]; ?>
<nav class="side-menu">
	    <ul class="side-menu-list">
	        <li class="blue-dirty">
	            <a href="..\Home\">
	                <span class="glyphicon glyphicon-th"></span>
	                <span class="lbl">Inicio</span>
	            </a>
	        </li>
	        <li class="blue-dirty">
	            <a href="..\NuevoTicket\">
	                <i class="glyphicon glyphicon-th"></i>
	                <span class="lbl">Nuevo Ticket</span>
	            </a>
	        </li>   
            <li class="blue-dirty">
	            <a href="..\ConsultarTicket\">
	                <i class="glyphicon glyphicon-th"></i>
	                <span class="lbl">Consultar Ticket</span>
	            </a>
	        </li>

			<?php if ($_SESSION["rol_id"] == 1) : ?>
				<li class="blue-dirty">
					<a href="..\MntUsuario\">
						<i class="glyphicon glyphicon-cog"></i>
						<span class="lbl">Mantenimiento usuario</span>
					</a>
				</li>
				<?php endif; ?>
			
			<?php if($_SESSION["rol_id"] == 1) : ?>
			<li class="blue-dirty">
				<a href="../ConsultarLogs/">
					<span class="glyphicon glyphicon-list-alt"></span>
					<span class="lbl">Auditoría General</span>
				</a>
			</li>
			<?php endif; ?>

			<li class="blue-dirty">
				<a href="..\MntPerfil\">
					<i class="glyphicon glyphicon-user"></i>
					<span class="lbl">Perfil</span>
				</a>
			</li>

			<li class="blue-dirty">
				<a href="..\Logout\logout.php">
					<i class="glyphicon glyphicon-log-out"></i>
					<span class="lbl">Cerrar sesión</span>
				</a>
			</li>
</ul>
	</nav>