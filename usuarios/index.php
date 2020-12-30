<?php include '../config/sesion.php';?>
<html>
    <head>
       <?php include '../config/head.php'; ?>
       <link rel="stylesheet" type="text/css" href="bootstrap.css">
    </head>
    <body>
        <?php include '../config/menu.php'; ?>
        <br>
        <h1 class="text-center">Listado de usuarios</h1>
        <hr>
        <p>
            <a href="formulariousuario.php" class="btn btn-success">Registrar nuevo Usuario</a>
        </p>
        <form class="form-inline" action="index.php" method="GET">
            <input type="text" class="form-control" name="buscar" placeholder="Ingrese el dato">
            |
            <select class="form-control" name="tipo">
                <option value="">Seleccionar</option>
                <option value="dni">Dni</option>
                <option value="apellido">Apellido</option>
                <option value="telefono">Telefono</option>
            </select>
            <label> Desde </label>
            <input type="date" class="form-control" name="desde">
            <label> Hasta </label>
            <input type="date" class="form-control" name="hasta">
                <input type="submit" class="form-control btn btn-primary" value="Consultar">
        </form>
        <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="table-warning">
                <tr align="center">
                    <th>IDUSUARIO</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>DNI</th>
                    <th>FECHA DE NACIMIENTO</th>
                    <th>DOMICILIO</th>
                    <th>LOCALIDAD</th>
                    <th>PROVINCIA</th>
                    <th>TELÉFONO</th>
                    <th>EMAIL</th>
                    <th>SEXO</th>
                    <th>IDREGISTRANTE</th>
                    <th>PRIVILEGIO</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'class.php';
                if(isset($_GET['buscar']) && $_GET['buscar']!=''){
                $objetoConsulta3 = new registros3();
                $objetoConsulta3->datos3($_GET['buscar'],$_GET['tipo']);
                }
                elseif (isset ($_GET['desde'])) {
                    $objetoConsulta4=new registros3();
                    $objetoConsulta4->buscarporfecha($_GET['desde'],$_GET['hasta']);
                }
                else {
                 $objetoConsulta2=new registro2();
                 $objetoConsulta2->datos2($_GET['pagina']);
               }
                ?>
            </tbody>
        </table>
    </body>
</html>
