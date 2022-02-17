<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Tienda de Camisetas</title>
		<link rel="stylesheet" href="<?=base_url?>assets/css/styles.css"/>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	</head>
	<body>
		<div id="container">
			<!-- CABECERA -->
			<header id="header">
				<div id="logo">
					<img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta Logo" />
					<a href="<?=base_url?>">
						Tienda de camisetas
					</a>
				</div>
			</header>

			<!-- MENU -->
			<?php $categorias = Utils::showCategorias(); ?>
			
			<!-- modificar no me funciona el responsive-->
			
			<div class="row">
				<div class="col">
					<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #a7cbe6;">
						<div class="container-fluid">
							<a class="navbar-brand" href="#">TM</a>
							<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
								data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
								aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarNav">
								<ul class="navbar-nav">
									<li class="nav-item">
										<a class="nav-item nav-link" href="<?=base_url?>">INICIO</a>
									</li>
									<?php while($cat = $categorias->fetch_object()): ?>
									<li class="nav-item">
										<a class="nav-item nav-link" href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=strtoupper($cat->nombre)?></a>
									</li>
									<?php endwhile; ?>
								</ul>
							</div>
						</div>
					</nav>
				</div>
			</div>
			<div id="content">