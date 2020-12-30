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
        <h1 class="text-center">MODIFICAR CAJA</h1>
        <hr>
        
        <form id="finalizar" action="modificarcaja.php" method="POST">
            
            <div class="form-group">
                
                <label for="importecaja">Dinero Inicial</label>
                <?php 
                $objetoMostrarD=new Caja();
                $objetoMostrarD->datosmodificar($_GET['idcaja']);
                ?>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Modificar</button>
                <a class="btn btn-danger" href="index.php">Cancelar</a>
            </div>
                                              
        </form>
        <?php
        if(isset($_POST['importecaja'])){
            $objetoModificar=new Caja();
            $objetoModificar->Modificar($_POST['idcaja'],$_POST['importecaja']);
        }
        ?>
        
    </body>
</html>
