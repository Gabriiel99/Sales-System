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
        <h1 class="text-center">Modificar Credito (Debe)</h1>
        <hr>
        <?php
        $objetoMod= new registros2();
        $objetoMod->datoscreditos($_GET['idproveedor']);
        ?>
        
               <?php
               if(isset($_POST['actividad'])){
               
               $objetoModificar = new registros2();
               $objetoModificar->moddebe($_POST['idproveedor'],$_POST['idusuario'],$_POST['actividad'],$_POST['debe']);
               }
               ?>
    </body>
    
</html>