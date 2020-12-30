<?php include '../config/sesion.php'; ?>
<html>
    <head>
       <?php include '../config/head.php'; ?>
       <link rel="stylesheet" type="text/css" href="bootstrap.css">
    </head>
    <body>
        <?php include '../config/menu.php'; ?>
        <br>
        <h1 class="text-center">Listado de Gastos</h1>
        <hr>
        <p>
            <a href="formulariogastos.php" class="btn btn-success">Registrar Nuevo Gasto</a>
        </p>
        <form class="form-inline" action="index.php" method="GET">
            <input type="text" class="form-control" name="buscar" placeholder="Ingrese el Dato">
            <label for="desde">Desde</label>
            <input type="date" class="form-control" id="desde" name="desde" required="">
            <label for="hasta">Hasta</label>
            <input type="date" class="form-control" id="hasta" name="hasta" required="">
                <input type="submit" class="form-control btn btn-primary" value="Consultar">
        </form>
        <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="table-primary">
                <tr align="center">
                    <th>DETALLE DE GASTO</th>
                    <th>IMPORTE GASTO</th>
                    <th>FECHA</th>
                    <th>HORA</th>
                    <th>ACCIONES</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                include 'class.php';
                if(isset($_GET['buscar']) && $_GET['buscar']!=''){
                $objetoMostrar=new gastos();
                $objetoMostrar->buscargasto($_GET['buscar']);
                }
                elseif (isset ($_GET['desde'])) {
                    $objetoConsultagasto=new gastos();
                    $objetoConsultagasto->buscarfechagasto($_GET['desde'],$_GET['hasta']);
                }
                else{
                    $objetoMostrar1=new gastos();
                    $objetoMostrar1->mostrar();
                }
                ?>
            </tbody>
        </table>
    </body>
</html>
