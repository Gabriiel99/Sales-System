<?php include '../config/sesion.php'; ?>
<html>
    <head>
        <?php include '../config/head.php'; ?>
        <style type="text/css">
          form#rubro{width: 40%; 
                        margin: 0 auto;
                        border: 3px #000 solid;
                        padding: 20px;
                        border-radius: 10px;
                        -moz-border-radius: 10px;
                        -webkit-border-radius: 10px; 
          }
        </style>
    </head>
    <body>
        <?php include '../config/menu.php'; ?>
        <br>
        <h1 class="text-center">Registro de Nuevo Rubro</h1>
        <hr>
        <form id="rubro" class="form-group" action="formulariorubros.php" method="POST">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombrerubro" required="">
            </div>
            <div>
                <input type="submit" class="btn btn-success" value="Registrar Rubro">
                <a class="btn btn-danger" href="index.php">Cancelar Formulario</a>
            </div>
            
        </form>
        <?php
        if (isset($_POST['nombrerubro'])){
            include 'classrubro.php';
            $objetoNuevo=new nuevorubro();
            $objetoNuevo->registrar($_POST['nombrerubro']);
        }
        ?>
        </body>
</html>
