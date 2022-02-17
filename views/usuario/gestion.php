<h1>Gestión de usuarios</h1>


<?php if(isset($_SESSION['editar']) && $_SESSION['editar'] == 'complete'): ?>
		<strong class="alert_green">El usuario se ha modificado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('editar'); ?>
<?php if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == 'complete'): ?>
	<strong class="alert_green">El usuario se ha creado correctamente</strong>
<?php elseif(isset($_SESSION['usuario']) && $_SESSION['usuario'] != 'complete'): ?>	
	<strong class="alert_red">El usuario NO se ha creado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('usuario'); ?>
	
<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
	<strong class="alert_green">El usuario se ha borrado correctamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>	
	<strong class="alert_red">El usuario NO se ha borrado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>
<?php
$coun=0;
?>
<div class="table-responsive">
<table class="table">

	<?php if(isset($_SESSION['admin']) && $_SESSION['admin']== true):?>
		<thead>
		<tr>
			<th scope="col">ID</th>
			<th scope="col">NOMBRE</th>
			<th scope="col">APELLIDOS</th>
			<th scope="col">EMAIL</th>
			<th scope="col">ROL</th>
			<th scope="col">IMPORTE</th>
			<th scope="col">PEDIDOS PENDIENTES</th>
		</tr>
		</thead>
		<tbody>
	<?php while($usr = $usuarios->fetch_object()): ?>
		<?php $coun++;?>
		<tr <?php if(($coun%2)==0){echo 'class="table-active"' ;}?>>
			<td scope="row"><?=$usr->id;?></td>
			<td><?=$usr->nombre;?></td>
			<td><?=$usr->apellidos;?></td>
			<td><?=$usr->email;?></td>	
			<td><?=$usr->rol;?></td>
			<td>
				<?php
				$pedido=new Pedido();
				$pedido->setUsuario_id($usr->id);
				$gastoTotal=$pedido->totalGastadoUsuario();
				$gastoTotal=$gastoTotal->fetch_object();
				if($gastoTotal !=null){
					echo $gastoTotal->coste."€";
				}else{
					echo "0€";
				}
				?>
			</td>
			<td>
				<?php
				$pedidosPendientes=$pedido->getUsuarioPedidiosPendientes();
				$pedidosPendientes=$pedidosPendientes->fetch_object();
				
				if($pedidosPendientes !=null){
					echo $pedidosPendientes->pendientes;
				}else{
					echo "0";
				}
				?>
			</td>
			<td>
				<a href="<?=base_url?>usuario/editar&id=<?=$usr->id?>" class="button button-gestion">Editar</a>
				<?php if(isset($_SESSION['admin']) && $_SESSION['admin']== true):?>
				<a href="<?=base_url?>usuario/eliminar&id=<?=$usr->id?>" class="button button-gestion button-red">Eliminar</a>
				<?php endif; ?>
			</td>
		</tr>

	<?php endwhile; ?>
	
	<tbody>
</table>

<?php else: ?>
	<?php $usr = $usuarios ?>
	<tr>
			<th>ID</th>
			<th>NOMBRE</th>
			<th>APELLIDOS</th>
			<th>EMAIL</th>
			<th>ROL</th>

		
		</tr>
		<tr>
			<td><?=$usr->id;?></td>
			<td><?=$usr->nombre;?></td>
			<td><?=$usr->apellidos;?></td>
			<td><?=$usr->email;?></td>
			<td><?=$usr->rol;?></td>
			<td>
				<a href="<?=base_url?>usuario/editar&id=<?=$usr->id?>" class="button button-gestion">Editar</a>
			</td>
		</tr>

	
	</table>
	</div>
	<?php endif; ?>

