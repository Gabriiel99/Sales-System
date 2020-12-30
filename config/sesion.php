<?php
   session_start();
   if (isset($_SESSION['usu'])){
       echo "Bienvenido ";
       echo $_SESSION['nom'];
       echo " | <a href='../config/salir.php' class='btn btn-danger'>Salir</a>";
   }
   else{
       header("location:../index.php");
   }
?>


