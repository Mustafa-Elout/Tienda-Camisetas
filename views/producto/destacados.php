<div class="col-xs-12">
<h1>Algunos de nuestros productos</h1>
<?php
if(isset($_GET['max']) && isset($_GET['min'])){
    $max=$_GET['max'];
    $min=$_GET['min'];
}
?>
<!-- Intentar que el formulario aparezca en una linea-->
<form method="GET">
Desde<input type="number" name="min" style="width : 5%;" value="<?php if(isset($_GET['min'])){echo $_GET['min'];}?>">
Hasta<input type="number" name="max" style="width : 5%;" value="<?php if(isset($_GET['max'])){echo $_GET['max'];}?>">
<input type="submit" value="filtrar">
</form>

<?php
$conteo = $numPro->num;
$paginas = ceil($conteo / $productosPorPagina);

?>
<?php /*
<?php while($product = $productos->fetch_object()): ?>

	<div class="product">
        
    <?php if(isset($_GET['max']) && isset($_GET['min'])): ?>
        <?php if($product->precio>=$min && $product->precio<=$max): ?>
            <a href="<?=base_url?>producto/ver&id=<?=$product->id?>">
                <?php if($product->imagen != null): ?>
                    <img src="<?=base_url?>uploads/images/<?=$product->imagen?>" />
                <?php else: ?>
                    <img src="<?=base_url?>assets/img/camiseta.png" />
                <?php endif; ?>
                <h2><?=$product->nombre?></h2>
            </a> 
            <?php if($product->oferta == "si"): ?>
                <p style="color:red;">REBAJAS <del><?=$product->precio?></del></p>
                <p><?=$product->precio*0.8-0.01?>€</p>
            <?php else: ?>
                <p><?=$product->precio?>€</p>
            <?php endif; ?>
            
            <?php if($product->stock>0):?>
                <a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="button">Comprar</a>
            <?php else :?>
                <p class="button button-red">Agotado</p>
            <?php endif ?>
        <?php endif; ?>
    <?php else :?>
        <a href="<?=base_url?>producto/ver&id=<?=$product->id?>">
			<?php if($product->imagen != null): ?>
				<img src="<?=base_url?>uploads/images/<?=$product->imagen?>" />
			<?php else: ?>
				<img src="<?=base_url?>assets/img/camiseta.png" />
			<?php endif; ?>
			<h2><?=$product->nombre?></h2>
		</a> 
        <?php if($product->oferta == "si"): ?>
                <p style="color:red;">REBAJAS <del><?=$product->precio?></del></p>
                <p><?=$product->precio*0.8-0.01?>€</p>
        <?php else: ?>
            <p><?=$product->precio?>€</p>
        <?php endif; ?>
		
		<?php if($product->stock>0):?>
				<a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="button">Comprar</a>
		<?php else :?>
				<p class="button button-red">Agotado</p>
		<?php endif ?>
    <?php endif; ?>	
	</div>

<?php endwhile; ?>
   */?>    

<div class="container-fluid mt-3">
    <div class="row">
    <?php while($product = $productos->fetch_object()): ?>
        <div class="col-xl-5 mx-auto my-3">
        <?php if(isset($_GET['max']) && isset($_GET['min'])): ?>
            <?php if($product->precio>=$min && $product->precio<=$max || $product->oferta == "si" && $product->precio*0.8-0.01>=$min && $product->precio*0.8-0.01<=$max): ?>
                <div class="card border-0">
                    <div class="product">
                    <a href="<?=base_url?>producto/ver&id=<?=$product->id?>">
                        <?php if($product->imagen != null): ?>
                            <img class="card-img-top" src="<?=base_url?>uploads/images/<?=$product->imagen?>" alt="<?=$product->descripcion?>"/>
                        <?php else: ?>
                            <img class="card-img-top" src="<?=base_url?>assets/img/camiseta.png" alt="<?=$product->descripcion?>"/>
                        <?php endif; ?>
                        <h2 class="card-title text-center"><?=$product->nombre?></h2>
                    </a> 
                    <div class="card-body text-center d-flex flex-column">
                        <?php if($product->oferta == "si"): ?>
                            <h3 class="card-subtitle mb-2 text-danger" style="color:red;">REBAJAS <del><?=$product->precio?></del></h3>
                            <h3 class="card-subtitle mb-2 text-dark"><?=$product->precio*0.8-0.01?>€</h3>
                        <?php else: ?>
                            <h3 class="card-subtitle mb-2 text-dark"><?=$product->precio?>€</h3>
                        <?php endif; ?>
                    
                        <?php if($product->stock>0):?>
                            <a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="btn btn-success mt-auto">Comprar</a>
                        <?php else :?>
                            <h3 class="btn btn-danger  mt-auto">Agotado</h3>
                        <?php endif ?>
                    </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php else :?>
            <div class="card border-0" style="width: 13rem; height:30rem">
                   
                    <a href="<?=base_url?>producto/ver&id=<?=$product->id?>">
                        <?php if($product->imagen != null): ?>
                            <img class="card-img-top" style="width:13rem; height:13rem" src="<?=base_url?>uploads/images/<?=$product->imagen?>" />
                        <?php else: ?>
                            <img class="card-img-top" style="width:13rem; height:13rem" src="<?=base_url?>assets/img/camiseta.png" />
                        <?php endif; ?>
                    </a> 
                    <h2 class="card-title text-center"><?=$product->nombre?></h2>
                    <div class="card-body text-center d-flex flex-column">
                        <?php if($product->oferta == "si"): ?>
                            <h3 class="card-subtitle mb-2 text-danger">REBAJAS <del><?=$product->precio?></del></h3>
                            <h3 class="card-subtitle mb-2 text-dark"><?=$product->precio*0.8-0.01?>€</h3>
                        <?php else: ?>
                            <h3 class="card-subtitle mb-2 text-dark"><?=$product->precio?>€</h3>
                        <?php endif; ?>
                        <?php if($product->stock>0):?>
                            <a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="btn btn-success mt-auto">Comprar</a>
                        <?php else :?>
                            <p class="btn btn-danger mt-auto">Agotado</p>
                        <?php endif ?>
                    </div>
                </div>
        <?php endif; ?>	
        </div>
    <?php endwhile; ?>
    </div>
</div>


<!-- Añadido para la paginacion-->
<nav>
 
        <div class="cointaner my-4">
           
            <div class="row">
                <br><br>
                
                    
                
            </div>
           
        </div>  

</nav>

<div class="container">

    <ul class="pagination pagination-lg pagination justify-content-center">
            <?php if ($pagina > 1) { ?>
                <li class="page-item">
                        <a class="page-link" href="<?=base_url ?>?pagina=<?php echo $pagina - 1 ?>">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                </li>
            <?php } ?>

            <?php for ($x = 1; $x <= $paginas; $x++) { ?>
                <li class="page-item" class="<?php if ($x == $pagina) echo "active" ?>">
                        <a class="page-link" href="<?=base_url ?>?pagina=<?php echo $x ?>">
                            <?php echo $x ?></a>
                </li>
            <?php } ?>

            <?php if ($pagina < $paginas) { ?>
                <li class="page-item">
                        <a class="page-link" href="<?=base_url ?>?pagina=<?php echo $pagina + 1 ?>">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                </li>
            <?php } ?>
    </ul>
 
</div>
</div>
