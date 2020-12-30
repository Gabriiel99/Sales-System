<?php
   include '../conexion.php';
include 'class.php';
?>
<html>
    
    <head>
        <?php include '../config/head.php';?>
    </head>
    
    <body>
            <?php include '..config/menu.php';?>
        <br>
        <h1 class="text-center">Modificar Pago (Haber)</h1>
        <hr>
        <?php
        $objetoMod= new registros2();
        $objetoMod->datospago($_GET['idproveedor']);
        ?>
        
               <?php
               if(isset($_POST['actividad'])){
               
               $objetoModificar = new registros2();
               $objetoModificar->modpago($_POST['idproveedor'],$_POST['idusuario'],$_POST['actividad'],$_POST['haber']);
               }
               ?>
    </body>
    
</html>