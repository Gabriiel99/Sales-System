<?php include '../config/sesion.php'; ?>
<?php
    include 'class.php';
    if(!isset($_GET['idfactura'])){
        $objetoFactura = new ventas();
        $objetoFactura->iniciarfactura();
    }
?>
<html>
    <head>
        <?php include '../config/head.php'; ?>
    </head>
    <body>
        <?php include '../config/menu.php'; ?>
        <br>
        <h1 class="text-center">NUEVA VENTA</h1>
        <hr>
        <p>
            
        </p>
        <form class="form-inline" action="cargarventa.php" method="GET">
            <input type="hidden" name="idfactura" value="<?php echo $_GET['idfactura']; ?>">
            <input type="hidden" name="idregistrante" value="<?php echo $_SESSION['idusu']; ?>">
            <input type="text" class="form-control" name="buscar" placeholder="Ingrese Codigo" required="">
            <input type="submit" class="form-control btn btn-primary" value="Consultar">
        </form>
        <table class="table">
            <thead class="table-primary">
                <tr>
                    <th>FACTURA</th>
                    <th>CODIGO</th>
                    <th>NOMBRE</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO</th>
                    <th>SUBTOTAL</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $objetoMostrarDetalles = new ventas();
                $objetoMostrarDetalles->mostrardetalle($_GET['idfactura']);
                ?>
            </tbody>
        </table>
        <a class="btn btn-danger" onclick="return confirm('¿Desea cancelar toda la factura?')" href="cancelar.php?idfactura=<?php echo $_GET['idfactura']; ?>">Cancelar Venta</a>
    </body>
</html>
