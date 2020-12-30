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
        <h1 class="text-center">Modificar Usuarios</h1>
        <hr>
        
        <?php
            include 'class.php';
            
            if(isset($_POST['nombre'])){
                $objetoMod=new modificarusuario();
                $objetoMod->modificar($_POST['idusuario'],$_POST['nombre'],$_POST['apellido'],$_POST['dni'],$_POST['nacimiento'],$_POST['domicilio'],$_POST['localidad'],$_POST['provincia'],$_POST['telefono'],$_POST['email'],$_POST['sexo'],$_POST['privilegio']);
            }else{
                $objetoDatos=new datosusuario();
                $objetoDatos->mostrar($_GET['id']);
            
            }
        ?>
        </body>
</html>
