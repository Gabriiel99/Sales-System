<?php
   include '../conexion.php';?>
<html>
    
    <head>
        <?php include '../config/head.php';?>
    </head>
    
    <body>
          
        <br>
        <h1 class="text-center">Nuevo Pago (Haber)</h1>
        <hr>
        <form class="form-inline" action="nuevopago.php" method="POST">
            <input type="hidden" name="idusuario" value="<?php echo $_GET['idusuario']?>">
            <div class="form-inline">
                <label>Actividades</label> 
                <input type="text" class="form-control" name="actividad" required=""> 
            </div>
            <div class="form-inline">
                <label>Pago</label>
                 <input type="nombre" step="any" class="form-control" name="haber" required=""> 
            </div>
            
            <div>
                <input type="submit" class="btn btn-primary" value="Registrar Pago">
                <a class="btn btn-danger" href="vercuenta.php?idusuario=<?php echo $GET['idusuario'];CANCELAR?>
            </div>
        </form>
        
               <?php
               if(isset($_POST['actividad'])){
               include 'class.php';
               $objetoNuevo = new registros2();
               $objetoNuevo->guardar($_POST['idusuario'],$_POST['actividad'],$_POST['haber']);
               }
               ?>
    </body>
    
</html>