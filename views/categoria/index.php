<h1>Gestionar categorias</h1>

<a href="<?=base_url?>categoria/crear" class="button button-small">
	Crear categoria
</a>
<?php if(isset($_SESSION['creado']) && $_SESSION['creado'] == 'complete'): ?>
		<strong class="alert_green">La categoría se ha modificado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>
<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
		<strong class="alert_red">La categoría se ha eliminado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('editado'); ?>
<?php if(isset($_SESSION['editado']) && $_SESSION['editado'] == 'complete'): ?>
		<strong class="alert_red">La categoría se ha modificado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('editado'); ?>

<table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>PRODUCTOS</th>
		<th>VALOR ALMACÉN</th>
	</tr>
	<?php while($cat = $categorias->fetch_object()): ?>
		<tr>
			<td><?=$cat->id;?></td>
			<td><?=$cat->nombre;?></td>
			<td><?=$cat->stock;?></td>
			<td><?=$cat->valor;?></td>
			<td>
				<a href="<?=base_url?>categoria/editar&id=<?=$cat->id?>" class="button button-gestion">Editar</a>
				<?php if(isset($_SESSION['admin']) && $_SESSION['admin']== true):?>
				<a href="<?=base_url?>categoria/eliminar&id=<?=$cat->id?>" class="button button-gestion button-red">Eliminar</a>
				<?php endif; ?>
			</td>
		</tr>
	<?php endwhile; ?>
</table>
