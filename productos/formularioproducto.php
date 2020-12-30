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
        <h1 class="text-center">Nuevo Producto</h1>
        <form id="producto" action="formularioproducto.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre de producto</label>
                <input type="hidden" name="idusuario" value="<?php echo $_SESSION['idusu']; ?>">
                <input type="text" class="form-control" name="nombre" id="nombre" required="">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" required="">
            </div>
            <div class="form-group">
                <label for="codigo">Codigo</label>
                <input type="text" class="form-control" name="codigo" id="codigo" required="">
            </div>
            <div class="form-group">
                <label for="stock">Cantidad</label>
                <input type="number" class="form-control" name="stock" id="stock" required="">
            </div>
            <div class="form-group">
                <label for="preciocompra">Precio Compra</label>
                <input type="number" step="any" class="form-control" name="preciocompra" id="preciocompra" required="">
            </div>
            <div class="form-group">
                <label for="precioventa">Precio Venta</label>
                <input type="number" step="any" class="form-control" name="precioventa" id="precioventa" required="">
            </div>
            <div class="form-group">
                <label for="idrubro">Rubro</label>
                <select class="form-control" name="idrubro" required="">
                    <option value="">Seleccionar</option>
                    <?php 
                    include 'class.php';
                    $objetoRubro=new productos();
                    $objetoRubro->rubros();
                    ?>
                </select>
                <div class="form-group">
                    <label for="foto">Foto del Producto</label>
                    <input type="file" class="form-control" id="foto" name="foto" required="">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
        <?php
        if (isset($_POST['nombre'])){
            $objetoGuardar=new productos();
            $objetoGuardar->guardarproducto($_POST['nombre'],$_POST['descripcion'],$_POST['codigo'],$_POST['stock'],$_POST['preciocompra'],$_POST['precioventa'],$_POST['idrubro'],$_POST['idusuario']);
        
            $ubicaciontemporal = $_FILES['foto']['tmp_name'];
            if(move_uploaded_file($ubicaciontemporal,'fotos/'.$_POST['codigo'])){
                echo "<script>alert('Producto Registrado');window.location.href='index.php?pagina=1';</script>";
            }
        }
        
        ?>
    </body>
</html>
