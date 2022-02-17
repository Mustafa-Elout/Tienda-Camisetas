<table>
    PRODUCTOS SIN VENTAS
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
    </tr>
    <?php while ($pro = $ventasCero->fetch_object()) : ?>
        <tr>
            <td><?= $pro->id; ?></td>
            <td><?= $pro->nombre; ?></td>
        </tr>
    <?php endwhile; ?>
</table