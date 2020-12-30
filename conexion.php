<?php
     class conexion{
         public $con;
         
         public function __construct() {
             $this->con=new mysqli("localhost","root","","negocio");
         }
     }
?>

