<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="bootstrap.css">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table class="table table-striped table-bordered table-hover table-sm">
            <caption>Tabla de Registros</caption>
            <thead class="table-danger">
                <tr align="center">
                    <th>IDUSUARIO</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>DNI</th>
                    <th>FECHA DE NACIMIENTO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 include 'class.php';
                 $objetoConsulta=new registros();
                 $objetoConsulta->datos();
                ?>
            </tbody>
        </table>
    </body>
</html>
