<?php
   session_start();
   include 'conexion.php';
   
   class seguridad extends conexion{
       //atributos
       public $usuario;
       public $password;
       public $consulta;
       public $datos;
       
       //metodo
       public function ingresar($usu,$pass) {
           $this->usuario=$usu;
           $this->password=$pass;
           $this->consulta = $this->con->query("SELECT * FROM usuarios WHERE usuario='$this->usuario' AND password='$this->password'");
           if ($this->datos= $this->consulta->fetch_array()){
               $_SESSION['idusu']= $this->datos['idusuario'];
               $_SESSION['usu']= $this->datos['usuario'];
               $_SESSION['nom']= $this->datos['nombre'].", ".$this->datos['apellido']; 
               $_SESSION['rol']= $this->datos['privilegio'];
               header("location: usuarios/index.php?pagina=1");
           }
           else{
               echo "<script>alert('Usuario y contraseña incorrectos');window.location.href='index.php';</script>";
           }
       }
   }
   $objetoValidar = new seguridad();
   $objetoValidar->ingresar($_POST['usuario'],$_POST['password']);
?>
