<?php include '../config/sesion.php';?>
<html>
    <head>
       <?php include '../config/head.php'; ?>
       <link rel="stylesheet" type="text/css" href="bootstrap.css">
    </head>
    <body>
        <?php include '../config/menu.php'; ?>
        <br>
        <h1 class="text-center">Lista de Facturas Finalizadas</h1>
        <hr>
        
        <form class="form-inline" action="index.php" method="GET">
                <a class="btn btn-primary" href="../ventas/index.php"><- Regresar</a>
        </form>
        <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="table-dark">
                <tr align="center">
                    <th>IDFACTURA</th>
                    <th>CLIENTE</th>
                    <th>VENTA TOTAL</th>
                    <th>CONDICIÓN VENTA</th>
                    <th>NRO° COMPROBANTE</th>
                    <th>FECHA VENTA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'class.php';
                 $objetoConsulta2=new mostrarfacturas();
                 $objetoConsulta2->resultado();    
                ?>
            </tbody>
        </table>
    </body>
</html>
