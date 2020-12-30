<?php include '../config/sesion.php'; ?>
<?php
   include 'class.php';
   
   $objetoEliminar =new registro2();
   $objetoEliminar->eliminarpc($_GET['idusuario'],$_GET['idproveedor']);
   ?>

