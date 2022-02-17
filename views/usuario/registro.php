<h1>Registrarse</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
	<strong class="alert_green">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
	<strong class="alert_red">Registro fallido, introduce bien los datos</strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>


<form class="row g-3" action="<?=base_url?>usuario/save" method="POST">
  <div class="col-md-6">
	<label for="nombre" class="form-label">Nombre</label>
	<input type="text" class="form-control" name="nombre" placeholder="nombre" required/>
  </div>
  <div class="col-md-6">
 	<label for="apellidos"  class="form-label">Apellidos</label>
	<input type="text" class="form-control" name="apellidos" placeholder="apellido" required/>
  </div>
  <div class="col-12">
  	<label for="email" class="form-label">Email</label>
	<input type="email" class="form-control" id="inputEmail4" name="email" placeholder="nombre@apellido.com" required/>
  </div>
  <div class="col-12">
  	<label for="password" class="form-label">Contraseña</label>
	<input type="password" class="form-control" id="inputPassword4" name="password" placeholder="clave"  required/>
  </div>
  <div>
  	<label for="provincia" class="form-label">Provincia</label>
	<input type="provincia" class="form-control" id="inputAddress" name="provincia" placeholder="Ej:Madrid" required/>
  </div>
  <div>
	<label for="localidad" class="form-label">Ciudad</label>
	<input type="localidad" class="form-control" id="inputAddress2" name="localidad" placeholder="Ej:Alcorcón" required/>
  </div>
  <div>
	<label for="direccion" class="form-label">Dirección</label>
	<input type="direccion" class="form-control" id="inputAddress3" name="direccion" placeholder="Ej:Calle Velazquez Nº3 3B" required/>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Registrar</button>
  </div>
</form>