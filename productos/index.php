<?php include '../config/sesion.php'; ?>
<html>
    <head>
       <?php include '../config/head.php'; ?>
       <link rel="stylesheet" type="text/css" href="bootstrap.css">
    </head>
    <body>
        <?php include '../config/menu.php'; ?>
        <br>
        <h1 class="text-center">Listado de Productos</h1>
        <hr>
        <p>
            <a href="formularioproducto.php" class="btn btn-success">Registrar Nuevo Producto</a>
            <a href="stockminimo.php" class="btn btn-warning">Productos con bajo Stock</a>
            <a href="sinstock.php" class="btn btn-dark">Productos Sin Stock</a>
        </p>
        <form class="form-inline" action="index.php" method="GET">
            <input type="text" class="form-control" name="buscar" placeholder="Ingrese el Dato">
            |
            <select class="form-control" name="tipo">
                <option value="">Seleccionar</option>
                <option value="codigo">Código</option>
                <option value="producto">Nombre</option>
                <option value="descripcion">Descripción</option>
            </select>
                <input type="submit" class="form-control btn btn-primary" value="Consultar">
        </form>
        <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="table-primary">
                <tr align="center">
                    <th>FOTO</th>
                    <th>CODIGO</th>
                    <th>NOMBRE</th>
                    <th>DESCRIPCION</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO DE COMPRA</th>
                    <th>PRECIO DE VENTA</th>
                    <th>RUBRO</th>
                    <th>REGISTRANTE</th>
                    <th>FECHA</th>
                    <th>ACCIONES</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                include 'class.php';
                if(isset($_GET['buscar']) && $_GET['buscar']!=''){
                $objetoMostrar=new productos();
                $objetoMostrar->mostrarproducto($_GET['buscar'],$_GET['tipo']);
                }else{
                    $objetoMostrar1=new productos();
                    $objetoMostrar1->mostrar($_GET['pagina']);
                }
                ?>
            </tbody>
        </table>
    </body>
</html>
