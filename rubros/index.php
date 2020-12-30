<?php include '../config/sesion.php'; ?>
<html>
    <head>
       <?php include '../config/head.php'; ?>
    </head>
    <body>
        <?php include '../config/menu.php'; ?>
        <br>
        <h1 class="text-center">Listado de Rubros</h1>
        <hr>
        <p>
            <a href="formulariorubros.php" class="btn btn-success">Registrar un nuevo Rubro</a>
        </p>
        <form class="form-inline" action="index.php" method="GET">
            <input type="text" class="form-control" name="buscar" placeholder="Ingrese Rubro" required="">
                <input type="submit" class="form-control btn btn-primary" value="Consultar">
        </form>
        <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="table-warning">
                <tr align="center">
                    <th>IDRUBRO</th>
                    <th>NOMBRE DE RUBRO</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
               <?php
                include 'classrubro.php';
                if(isset($_GET['buscar'])){
                $objetoRubro = new registrorub();
                $objetoRubro->rub($_GET['buscar']);
                }
                else {
                 $objetoRubro1=new registrorubro();
                 $objetoRubro1->rubro();
               }
                ?>
            </tbody>
        </table>
    </body>
</html>


