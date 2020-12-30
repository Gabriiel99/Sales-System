<?php include '../config/sesion.php'; ?>
<html>
    <head>
        <?php include '../config/head.php'; ?>
        <style type="text/css">
          form#usuario{width: 40%; 
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
        <h1 class="text-center">Registro de Nuevo Usuarios</h1>
        <hr>
       <form id="usuario" class="form-group" action="formulariousuario.php" method="POST">
                <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" required="">
                    </div><br>
            <div class="form-group">
                <label>Apellido</label>
                <input type="text" class="form-control" name="apellido" required="">
            </div><br>
            <div class="form-group">
                <label>Dni</label>
                <input type="number" class="form-control" name="dni" required="">
            </div><br>
           <div class="form-group">
                <label>Nacimiento</label>
                <input type="date" class="form-control" name="nacimiento" required="">
            </div><br>
           <div class="form-group">
                <label>Domicilio</label>
                <input type="text" class="form-control" name="domicilio" required="">
            </div><br>
          <div class="form-group">
                <label>Localidad</label>
                <input type="text" class="form-control" name="localidad" required="">
            </div><br>
           <div class="form-group">
                <label>Provincia</label>
                <input type="text" class="form-control" name="provincia" required="">
            </div><br>
          <div class="form-group">
                <label>Telefono</label>
                <input type="text" class="form-control" name="telefono" required="">
            </div><br>
           <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" required="">
            </div><br>
          <div class="form-group">
                <label>Sexo</label>
                <input type="text" class="form-control" name="sexo" required="">
            </div><br>
           <div class="form-group">
                <label>Idregistrante</label>
                <input type="number" class="form-control" name="idregistrante" required="">
            </div><br>
            <div class="form-group">
                <label>Privilegio</label>
                <select class="form-control" name="privilegio" required="">
                    <option value="">Seleccionar</option>
                    <option value="1">Cliente</option>
                    <option value="2">Administrador</option>
                    <option value="3">Estandar</option>
                    <option value="4">Empleado</option>
                    <option value="5">Proveedor</option>
                    <option value="6">Limitado</option>
                </select>
            </div><br>
            <div>
                <input type="submit" class="btn btn-success" value="Registrar Usuario">
                <a class="btn btn-danger" href="index.php?pagina=1">Cancelar Formulario</a>
            </div>
        </form>
        <?php
        if (isset($_POST['nombre'])){
            include 'class.php';
            $objetoNuevo=new nuevousuario();
            $objetoNuevo->registrar($_POST['nombre'],$_POST['apellido'],$_POST['dni'],$_POST['nacimiento'],$_POST['domicilio'],$_POST['localidad'],$_POST['provincia'],$_POST['telefono'],$_POST['email'],$_POST['sexo'],$_POST['privilegio'],$_POST['idregistrante']);
        }
        ?>
        </body>
</html>
