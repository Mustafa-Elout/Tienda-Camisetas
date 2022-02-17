
<?php if(isset($cat) && is_object($cat)): ?>
    <h1>Editar producto: <?=$cat->nombre?></h1>
    <?php $url = base_url."categoria/guardado&id=".$cat->id; ?>  
<?php else: ?>
    <h1>Crear nueva categoria</h1>
    <?php $url = base_url."categoria/save"; ?>
<?php endif; ?>

<form action="<?=$url?>" method="POST">
	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" required value="<?=isset($cat) && is_object($cat) ? $cat->nombre : ''; ?>"/>
	
	<input type="submit" value="Guardar" />
</form>