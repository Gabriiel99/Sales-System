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
        <h1 class="text-center">Modificar Producto</h1>
        <form id="producto" action="formulariomodificar.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idproducto" value="<?php echo $_GET['idproducto']; ?>">
            <?php
            include 'class.php';
            if(isset($_GET['idproducto'])){
            $objetoproducto=new productos();
            $objetoproducto->mostrarmodificar($_GET['idproducto']);
            }
            ?>
            <div class="form-group">
                <label for="foto">Foto del Producto</label>
                <input type="file" class="form-control" id="foto" name="foto" >
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" >Guardar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </div>
          </form>
        <?php
        if(isset($_POST['idproducto'])){
         $objetoGuardar1=new productos();
         $objetoGuardar1->guardar($_POST['idproducto'],$_POST['nombre'],$_POST['descripcion'],$_POST['codigo'],$_POST['stock'],$_POST['preciocompra'],$_POST['precioventa'],$_POST['idrubro']);
         }
         error_reporting(E_ALL ^ E_NOTICE);
         $ubicaciontemporal = $_FILES['foto']['tmp_name'];
            if(move_uploaded_file($ubicaciontemporal,'fotos/'.$_POST['codigo'])){
                echo "<script>alert('Producto Registrado');window.location.href='index.php?pagina=1';</script>";
            }
         ?>
    </body>
</html>
