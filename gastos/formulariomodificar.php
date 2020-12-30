<?php include '../config/sesion.php'; ?>
<html>
    <head>
       <?php include '../config/head.php'; ?>
        <style type="text/css">
          form#producto{width: 40%; 
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
        <h1 class="text-center">Modificar Gasto</h1>
             <form id="producto" action="formulariomodificar.php" method="POST">
                 <input type="hidden" name="idgastos" value="<?php echo $_GET['idgastos']; ?>">
            <?php
            include 'class.php';
            if(isset($_GET['idgastos'])){
            $objetoproducto=new gastos();
            $objetoproducto->mostrarmodificar($_GET['idgastos']);
            }
            ?>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" >Guardar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </div>
          </form>
        <?php
        if(isset($_POST['idgastos'])){
         $objetoGuardar1=new gastos();
         $objetoGuardar1->guardar($_POST['idgastos'],$_POST['detalle'],$_POST['totalgastos']);
         }
         ?>
    </body>
</html>
