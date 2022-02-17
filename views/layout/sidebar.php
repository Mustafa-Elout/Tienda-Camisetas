<!-- BARRA LATERAL -->
<aside id="lateral">

	<div id="carrito" class="block_aside">
		<h3>Mi carrito</h3>
		<ul class="list-group">
			<?php $stats = Utils::statsCarrito(); ?>
			<li class="list-group-item list-group-item-action btn btn-primary"><a class="text-dark" href="<?=base_url?>carrito/index">Productos (<?=$stats['count']?>)</a></li>
			<li class="list-group-item list-group-item-action btn btn-primary"><a class="text-dark" href="<?=base_url?>carrito/index">Total: <?=$stats['total']?> $</a></li>
			<li class="list-group-item list-group-item-action btn btn-primary"><a class="text-dark" href="<?=base_url?>carrito/index">Ver el carrito</a></li>
		</ul>
	</div>
	
	<div id="login" class="block_aside">
		
		<?php if(!isset($_SESSION['identity'])): ?>
			<h3>Entrar a la web</h3>
			<form action="<?=base_url?>usuario/login" method="post">
				<label for="email">Email</label>
				<input type="email" name="email" placeholder="name@example.com"/>
				<label for="password">Contraseña</label>
				<input type="password" name="password" placeholder="Clave"/>
				<input type="submit" value="Enviar" />
			</form>
		<?php else: ?>
			<h3><?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h3>
		<?php endif; ?>

		<ul>
			<?php if(isset($_SESSION['admin'])): ?>
				<ul class="list-group ">
					<li class="list-group-item list-group-item-action btn btn-primary bg-light"><a class="text-dark" href="<?=base_url?>usuario/gestion">Gestionar usuarios</a></li>
					<li class="list-group-item list-group-item-action btn btn-primary bg-light"><a class="text-dark" href="<?=base_url?>categoria/index">Gestionar categorias</a></li>
					<li class="list-group-item list-group-item-action btn btn-primary bg-light"><a class="text-dark" href="<?=base_url?>producto/gestion">Gestionar productos</a></li>
					<li class="list-group-item list-group-item-action btn btn-primary bg-light"><a class="text-dark" href="<?=base_url?>pedido/gestion">Gestionar pedidos</a></li>
				</ul>
				
				<!-- -->
			<?php endif; ?>
			
			<?php if(isset($_SESSION['identity'])): ?>
				<ul class="list-group">
				<li class="list-group-item list-group-item-action btn btn-primary"><a class="text-dark" href="<?=base_url?>pedido/mis_pedidos">Mis pedidos</a></li>
				<!--Modificado por Musta-->
				<?php if(!isset($_SESSION['admin'])): ?>
				<li class="list-group-item list-group-item-action btn btn-primary"><a class="text-dark" href="<?=base_url?>usuario/gestionUsuario">Gestionar mis datos</a></li>
				<?php endif; ?>
				<li class="list-group-item list-group-item-action btn btn-primary bg-warning"><a class="text-dark" href="<?=base_url?>usuario/logout">Cerrar sesión</a></li>
			<?php else: ?> 
				<li class="list-group-item list-group-item-action btn btn-primary bg-warning"><a class="text-dark" href="<?=base_url?>usuario/registro">Registrate aqui</a></li>
				</ul>
			<?php endif; ?> 
		</ul>
	</div>

</aside>

<!-- CONTENIDO CENTRAL -->
<div id="central">