<!--<?php if(isset($edit) && isset($usr) && is_object($usr)): ?>
	<h1>Editar usuario <?=$usr->nombre?></h1>
	<?php if(isset($_SESSION['admin']) && $_SESSION['admin']== true):?>
	<?php $url_action = base_url."usuario/saveAdmin&id=".$usr->id; ?>
	<?php else: ?>
	<?php $url_action = base_url."usuario/save&id=".$usr->id; ?>
	<?php endif; ?>
<?php else: ?>
	<h1>Crear nuevo usuario</h1>
	<?php $url_action = base_url."usuario/saveAdmin"; ?>
	<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
	<strong class="alert_green">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
	<strong class="alert_red">Registro fallido, introduce bien los datos</strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>
<?php endif; ?>-->
	
<div class="form_container">
	
	<form action="" method="POST" enctype="multipart/form-data">
		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" value="<?=isset($usr) && is_object($usr) ? $usr->nombre : ''; ?>"/>

		<label for="apellidos">Apellidos</label>
		<textarea name="apellidos"><?=isset($usr) && is_object($usr) ? $usr->apellidos : ''; ?></textarea>

		<label for="email">Email</label>
		<input type="text" name="email" value="<?=isset($usr) && is_object($usr) ? $usr->email : ''; ?>"/>

	
		<label for="password">Password</label>
		<input type="text" name="password" value="<?=isset($usr) && is_object($usr) ? $usr->password : ''; ?>"/>
	
		<?php if(isset($_SESSION['admin']) && $_SESSION['admin']== true):?>
			<label for="rol">Rol</label>
			<input type="text" name="rol" value="<?=isset($usr) && is_object($usr) ? $usr->rol : '';  ?>" />
		<?php else: ?>
			<label for="rol">Rol</label>
			<input type="text" name="rol" value="<?=isset($usr) && is_object($usr) ? $usr->rol : ''; ?>" disabled/>
		<?php endif; ?>

		
		<label for="imagen">Imagen</label>
		<?php if(isset($usr) && is_object($usr) && !empty($usr->imagen)): ?>
			<img src="<?=base_url?>uploads/images/<?=$usr->imagen?>" class="thumb"/> 
		<?php endif; ?>
		<input type="file" name="imagen" />
		
		<input type="submit" value="Guardar" />
	</form>
</div>