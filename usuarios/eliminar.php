<?php include '../config/sesion.php'; ?>
<?php
   include 'class.php';
   
   $objetoEliminar =new eliminarusuario();
   $objetoEliminar->eliminar($_GET['idproveedor'])
   ?>

