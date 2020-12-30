<?php
    include 'class.php';
    
    $objetoCancelar=new ventas();
    $objetoCancelar->cancelar($_GET['idfactura']);
?>