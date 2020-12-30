<?php 
    include '../config/sesion.php'; 
    include 'class.php';
?>
<html>
    <head>
        <?php include '../config/head.php'; ?>
        <style type="text/css">
            form#caja{
                width: 35%;
                margin: 0 auto;
                margin-top: 20px;
                margin-bottom: 20px;
            }
            form#finalizar{
                width: 40%;
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
        <h1 class="text-center">CONTROL DE CAJA</h1>
        <hr>
        <div class="text-center">
            <?php 
            $objetoDesactivar=new Caja();
            $objetoDesactivar->desactivar();
            ?>
            
            <form id="caja" class="form-inline" action="index.php" method="GET">
            <div class="form-group">
            <label for="desde">Desde</label> 
            <input type="date" class="form-control" id="desde" name="desde" required="">
            <label for="hasta">Hasta</label>
            <input type="date" class="form-control" id="hasta" name="hasta" required="">
            <button type="submit" class="btn btn-primary">Consultar</button>
            </div>
            </form>
           </div>
        
        <?php 
        if(isset ($_GET['desde'])){
            $objetoMostrarB=new Caja();
            $objetoMostrarB->buscartotalcaja($_GET['desde'], $_GET['hasta']);
        }
        else{
        ?>
        <form id="finalizar">
            <div class="form-group">
                <label for="importecaja">Dinero Inicial</label>
                <input type="text" class="form-control" id="importecaja" name="importecaja" value="$<?php $objetoCaja=new Caja(); $objetoCaja->inicial(); ?>" readonly="">
            </div>
            <div class="form-group">
                <label for="ventas">Dinero de Ventas</label>
                <input type="text" class="form-control" id="ventas" name="ventas" value="$<?php $objetoVenta=new Caja(); $objetoVenta->ventas();?>" readonly="">                   
            </div>
            <div class="form-group">
                <label for="ventas">Gastos</label>
                <input type="text" class="form-control" id="gastos" name="gastos" value="$<?php $objetoVenta=new Caja(); $objetoVenta->gastos();?>" readonly="">                   
            </div>
            <div class="form-group">
                <label for="total">Total $</label>
                <input type="text" class="form-control" id="total" name="total" value="$<?php $objetototal=new Caja(); $objetototal->totalcaja();?>" readonly="">
            </div>
                                              
        </form>
        <?php } ?>
        
    </body>
</html>
