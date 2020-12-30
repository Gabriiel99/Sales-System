<?php include '../config/sesion.php'; ?>
<html>
    <head>
       <?php include '../config/head.php'; ?>
       <link rel="stylesheet" type="text/css" href="bootstrap.css">
    </head>
    <body>
        <?php include '../config/menu.php'; ?>
        <br>
        <h1 class="text-center">Productos Agotados</h1>
        <hr>
        <form class="form-inline" action="sinstock.php" method="GET">
        <a class="btn btn-primary" href="index.php"><- Regresar</a>
        </form>
        <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="table-dark">
                <tr align="center">
                    <th>CODIGO</th>
                    <th>NOMBRE</th>
                    <th>DESCRIPCION</th>
                    <th>CANTIDAD</th>
                    <th>FECHA</th>  
                </tr>
            </thead>
            <tbody>
                <?php
                include 'class.php';
                $objetoMostrarSinStock=new sinstock();
                $objetoMostrarSinStock->stockcero();
                ?>
            </tbody>
        </table>
    </body>
</html>
