<?php include '../config/sesion.php'; ?>
<?php
   include 'classrubro.php';
   
   $objetoEliminar =new eliminarrubro();
   $objetoEliminar->eliminar($_GET['id'])
   ?>

