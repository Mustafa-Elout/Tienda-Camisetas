<h1>Gestión de productos</h1>

<a href="<?=base_url?>producto/crear" class="button button-small">
	Crear producto
</a>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
	<strong class="alert_green">El producto se ha creado correctamente</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>	
	<strong class="alert_red">El producto NO se ha creado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('producto'); ?>
	
<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
	<strong class="alert_green">El producto se ha borrado correctamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>	
	<strong class="alert_red">El producto NO se ha borrado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>
	<p>EL PRODUCTO MÁS VENDIDO ES: 
	<?php while ($pro = $proMasVendido->fetch_object()) : ?>
        <tr>
            <td><?= $pro->nombre; ?></td>
        </tr>
    <?php endwhile; ?>
	 </p><br>
	<a href="<?=base_url?>producto/mostrasSinVentas" class="button button-small">PRODUCTOS SIN VENTAS</a>
	<a href="<?=base_url?>producto/mostrarSinStock" class="button button-small button-red">PRODUCTOS SIN STOCK</a>

<table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>PRECIO</th>
		<th>OFERTA</th>
		<th>STOCK</th>
		<th>VENTAS REALIZADAS</th>
		<th>ACCIONES</th>
		
	</tr>
	<?php while($pro = $productos->fetch_object()): ?>
		<tr>
			<td><?=$pro->id;?></td>
			<td><?=$pro->nombre;?></td>
			<td><?=$pro->precio;?></td>
			<td><?=$pro->oferta;?></td>
			<td><?=$pro->stock;?></td>
			<td><?php
			$producto = new Producto();
			$producto->setId($pro->id);
			
			$ventas = $producto->venta();
			$ventas=$ventas->fetch_object();
			echo $ventas->venta;
			?>
			</td>
			<td>
				<a href="<?=base_url?>producto/editar&id=<?=$pro->id?>" class="button button-gestion">Editar</a>
				<a href="<?=base_url?>producto/eliminar&id=<?=$pro->id?>" class="button button-gestion button-red">Eliminar</a>
			</td>
		</tr>
	<?php endwhile; ?>
</table>

