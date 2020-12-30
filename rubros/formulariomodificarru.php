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
        <h1 class="text-center">Modificar Rubro</h1>
        <hr>
        
        <?php
            include 'classrubro.php';
            
            if(isset($_POST['nombrerubro'])){
                $objetoMod=new modificarrubro();
                $objetoMod->modificar($_POST['idrubro'],$_POST['nombrerubro']);
            }else{
                $objetoDatos=new datosrubro();
                $objetoDatos->mostrarrub($_GET['id']);
            
            }
        ?>
        </body>
</html>
