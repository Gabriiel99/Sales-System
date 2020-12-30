<?php include '../config/sesion.php';
         include 'class.php';
;?>
<html>
    <head>
       <?php include '../config/head.php'; ?>
       <link rel="stylesheet" type="text/css" href="bootstrap.css">
    </head>
    <body>
        <?php include '../config/menu.php'; ?>
        <br>
        <h1 class="text-center">Cuenta del Proveedor</h1>
        <a class="btn btn-primary" href="nuevopago.php"> Nuevo Pago (Haber)</a>
        <a class="btn btn-danger" href="nuevocredito.php"> Nuevo Credito (Debe)</a>
        
        <hr>
        
        <form class="form-inline" action="vercuenta.php" method="GET">
            
            <label> Desde </label>
            <input type="date" class="form-control" name="desde">
            <label> Hasta </label>
            <input type="date" class="form-control" name="hasta">
                <input type="submit" class="form-control btn btn-primary" value="Consultar">
        </form>
       <?php
       
       $objetomostrarcuenta=new registro2();
       $objetomostrarcuenta->mostrarcuentaproveedor($_GET['idusuario']);
       ?>
    </body>
</html>
