<?php

// Genera PDF
require_once 'vendor/autoload.php';

ob_start();
?>
<h2 style="text-align: center;">FACTURA</h2>
Nº:<?= $pedido->id ?> <br />
NOMBRE: <?= $usuario->nombre . " " . $usuario->apellidos ?> <br />
EMAIL: <?= $usuario->email ?> <br /><br />
DIRECCIÓN DE ENVIO:
<ul>
    <li>Provincia: <?= $pedido->provincia ?></li>
    <li>Cuidad: <?= $pedido->localidad ?></li>
    <li>Direccion: <?= $pedido->direccion ?></li>
</ul>
Total a pagar: <?= $pedido->coste ?> € <br /><br />


<h3 style="text-align: center;">PRODUCTOS</h3>
<?php while ($producto = $productos->fetch_object()) : ?>
        <ul>
            <li>IMÁGEN:
                <?php if ($producto->imagen != null) : ?>
                    <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" width="100" height="130" class="img_carrito" />
                <?php else : ?>
                    <img src="<?= base_url ?>assets/img/camiseta.png" class="img_carrito" width="100" height="130" />
                <?php endif; ?>
            </li>
            <li>NOMBRE:
                <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
            </li>
            <li>PRECIO:
                <?= $producto->precio ?>
            </li>
            <li>UNIDADES:
                <?= $producto->unidades ?>
            </li>
        </ul>
    <?php endwhile; ?>

<?php
//Finalizamos la generación del HTML
$html = ob_get_contents();
ob_end_clean();
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->SetTitle('Factura Simple');
$mpdf->Output();
?>