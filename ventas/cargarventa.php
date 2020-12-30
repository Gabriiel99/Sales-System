<?php
    include 'class.php';
    $objetoCargarVenta = new ventas();
    $objetoCargarVenta->cargardetalle($_GET['buscar'],$_GET['idfactura'],$_GET['idregistrante']);
?>
