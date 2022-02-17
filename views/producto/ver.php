<?php if (isset($product)): ?>
	<h1><?= $product->nombre ?></h1>
	<div id="detail-product">
		<div class="image">
			<?php if ($product->imagen != null): ?>
				<img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" />
			<?php else: ?>
				<img src="<?= base_url ?>assets/img/camiseta.png" />
			<?php endif; ?>
		</div>
		<div class="data">
			<p class="description"><?= $product->descripcion ?></p>
			<?php if($product->oferta == "si"): ?>
                <p class="price" style="color:red;">REBAJAS <del><?=$product->precio?></del></p>
                <p><?=$product->precio*0.8-0.01?>€</p>
        <?php else: ?>
            <p class="price"><?= $product->precio ?>€</p>
        <?php endif; ?>
			
			<?php if($product->stock>0):?>
				<a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="button">Comprar</a>
				<?php else :?>
				<p class="button button-red">Agotado</p>
				<?php endif ?>
			</div>
		</div>
	</div>
<?php else: ?>
	<h1>El producto no existe</h1>
<?php endif; ?>
