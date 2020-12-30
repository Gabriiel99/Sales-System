<?php
include '../conexion.php';

class ventas extends conexion{
    //atributos
    public $i;
    public $idproducto;
    public $cantidad;
    public $preciocompra;
    public $codigo;
    public $consulta;
    public $registros;
    public $sumaidfactura;
    public $idfactura;
    public $factura;
    public $facturadisponible;
    public $estado;
    public $cantidadventa;
    public $cantidaddisponible;
    public $subtotal;
    public $idregistrante;
    public $total;
    public $iddetalleventa;
    public $encontrados;
    public $consulta2;
    public $registros2;
    public $idcliente;
    public $idvendedor;
    public $totalventa;
    public $condicionventa;
    public $comprobantetarjeta;
    public $fechaventa;
    public $totalinteres;
    
    //metodo para iniciar facturas
    public function iniciarfactura() {
        $this->consulta= $this->con->query("SELECT idfactura, estado FROM facturas ORDER BY idfactura DESC LIMIT 1");
        while ($this->registros= $this->consulta->fetch_array()){
            $this->idfactura= $this->registros['idfactura'];
            $this->sumaidfactura= $this->idfactura + 1;
            $this->facturadisponible= $this->sumaidfactura;
            $this->estado= $this->registros['estado'];
            
            if ($this->estado == 0){
            header("location:index.php?idfactura=$this->idfactura");
            }
                else{
                $this->con->query("INSERT INTO facturas (idfactura,estado) VALUES ('$this->facturadisponible','0')");
                header("location:index.php?idfactura=$this->idfactura");
            }
            
        }
        
    }
    public function cargardetalle($cod,$idf,$idr) {
        $this->codigo=$cod;
        $this->idfactura=$idf;
        $this->idregistrante=$idr;
        
        $this->consulta= $this->con->query("SELECT * FROM productos WHERE codigo='$this->codigo'");
        
        $this->encontrados= $this->consulta->num_rows;
        if ($this->encontrados>0){
        
        if ($this->registros= $this->consulta->fetch_array()){
            $this->idproducto= $this->registros['idproducto'];
            $this->cantidad= $this->registros['stock'];
            $this->preciocompra= $this->registros['preciocompra'];
            
            if ($this->cantidad==0){
                 echo "<script>alert('El producto no tiene stock');window.location.href='index.php?idfactura=$this->idfactura';</script>";
            }
            else{
                $this->cantidadventa=1;
                $this->subtotal= $this->preciocompra *$this->cantidadventa;
                $this->cantidaddisponible= $this->cantidad-$this->cantidadventa;
                
                $this->con->query("INSERT INTO detalleventa (idfactura,idproducto,cantidadventa,precio,subtotal,idregistrante) VALUES ('$this->idfactura','$this->idproducto','$this->cantidadventa','$this->preciocompra','$this->subtotal','$this->idregistrante')");
                    $this->con->query("UPDATE productos SET stock='$this->cantidaddisponible' WHERE idproducto='$this->idproducto'");
                    header("location:index.php?idfactura=$this->idfactura");
            }
        }
        }
        else{
           echo "<script>alert('El código ingresado no existe');window.location.href='index.php?idfactura=$this->idfactura';</script>"; 
        }
    }
    public function mostrardetalle($idf) {
        $this->idfactura=$idf;
        $this->cantidad=0;
         $this->total=0;
        $this->consulta= $this->consulta= $this->con->query("SELECT detalleventa.*, productos.* FROM detalleventa INNER JOIN productos ON detalleventa.idproducto = productos.idproducto WHERE detalleventa.idfactura='$this->idfactura' ORDER BY detalleventa.iddetalleventa DESC") or die ($this->con->error());
        while($this->registros= $this->consulta->fetch_array()){
                ?>
                <tr>
                    <td><?php echo $this->idfactura; ?></td>
                    <td><?php echo $this->registros['codigo']; ?></td>
                    <td><?php echo $this->registros['producto']; ?></td>
                    <td><?php echo $this->registros['cantidadventa']; ?></td>
                    <td>$<?php echo $this->registros['precio']; ?></td>
                    <td>$<?php echo $this->registros['subtotal']; ?></td>
                    <td><a class="btn btn-danger" onclick="return confirm('¿Desea quitar este producto?')" href="quitar.php?iddetalleventa=<?php echo $this->registros['iddetalleventa'] ?>">Quitar</a></td>
                </tr>
                <?php
                $this->total+=$this->registros['subtotal'];
                $this->cantidad+= $this->registros['cantidadventa'];
            }
            ?>
                <tr>
                    <td colspan="4" class="text-right"><b>Cantidad Total= <?php echo $this->cantidad; ?></b></td>
                    <td colspan="1" class="text-right"><b>TOTAL</b></td>
                    <td colspan="2" class="text-left"><b>$<?php echo $this->total; ?></b></td>
                </tr>
                <tr>
                    <td colspan="7" class="text-center"><a class="btb btn-warning" onclick="return confirm('Desea finalizar la venta')" href="finalizar.php?idfactura=<?php echo $this->idfactura; ?>&totalventa=<?php echo $this->total; ?>">Finalizar venta</a></td>
                </tr>
            <?php
        
        $this->con->close();
    }
    //METODO PARA QUITAR DETALLE Y DEVOLVER EL PRODUCTO
    public function quitar($idd) {
        $this->iddetalleventa=$idd;
        
        $this->consulta= $this->con->query("SELECT * FROM detalleventa WHERE iddetalleventa='$this->iddetalleventa'");
        if ($this->registros= $this->consulta->fetch_array()){
            $this->idproducto= $this->registros['idproducto'];
            $this->cantidadventa= $this->registros['cantidadventa'];
             $this->idfactura= $this->registros['idfactura'];
            
            $this->consulta2= $this->con->query("SELECT stock FROM productos WHERE idproducto='$this->idproducto'");
            if ($this->registros2= $this->consulta2->fetch_array()){
                $this->cantidaddisponible= $this->registros2['stock'];
            }
            $this->cantidad= $this->cantidadventa + $this->cantidaddisponible;
            $this->con->query("UPDATE productos SET stock='$this->cantidad' WHERE idproducto='$this->idproducto'");
            $this->con->query("DELETE FROM detalleventa WHERE iddetalleventa='$this->iddetalleventa'");
            echo "<script>window.location.href='index.php?idfactura=$this->idfactura';</script>";
        }
        
    }
    public function cancelar($idf){
            $this->idfactura=$idf;
            
            $this->consulta= $this->con->query("SELECT * FROM detalleventa WHERE idfactura='$this->idfactura'");
            while($this->registros= $this->consulta->fetch_array()){
                $this->idproducto=$this->registros['idproducto'];
                $this->cantidadventa= $this->registros['cantidadventa'];

                $this->consulta2= $this->con->query("SELECT stock FROM productos WHERE idproducto='$this->idproducto'");
                if($this->registros2= $this->consulta2->fetch_array()){
                    $this->cantidaddisponible= $this->registros2['stock'];
                }
                
                $this->cantidad= $this->cantidadventa + $this->cantidaddisponible;
                $this->con->query("UPDATE productos SET stock='$this->cantidad' WHERE idproducto='$this->idproducto'");
                $this->con->query("DELETE FROM detalleventa WHERE idfactura='$this->idfactura'");
                $this->con->query("DELETE FROM facturas WHERE idfactura='$this->idfactura'");
                echo "<script>alert('Factura Cancelada');window.location.href='../productos/';</script>";
            }
            
        }
        public function vendedor() {
            $this->consulta= $this->con->query("SELECT * FROM usuarios WHERE privilegio='2'ORDER BY apellido ASC, nombre ASC");
            while ($this->registros= $this->consulta->fetch_array()){
                ?>
                <option value="<?php echo $this->registros['idusuario']; ?>"><?php echo $this->registros['apellido'].", ".$this->registros['nombre']; ?></option>
                <?php
            }
        }
        //metodo para mostrar clientes
        public function cliente() {
            $this->consulta= $this->con->query("SELECT * FROM usuarios WHERE privilegio='5'ORDER BY apellido ASC, nombre ASC");
            while ($this->registros= $this->consulta->fetch_array()){
                ?>
                <option value="<?php echo $this->registros['idusuario']; ?>"><?php echo $this->registros['apellido'].", ".$this->registros['nombre']; ?></option>
                <?php
            }
        }
        //metodo para terminar la venta
        public function terminar($idf,$idc,$idv,$tv,$cv,$ct,$idr) {
            date_default_timezone_set("america/argentina/tucuman");
            $this->idfactura=$idf;
            $this->idcliente=$idc;
            $this->idvendedor=$idv;
            $this->totalventa=$tv;
            $this->condicionventa=$cv;
            $this->comprobantetarjeta=$ct;
            $this->fechaventa=date('Y-m-d H:i:s');
            $this->idregistrante=$idr;
            $this->estado=2;
            
            switch ($this->condicionventa){
                //efectivo
                case 1: $this->totalinteres= $this->totalventa;
                    break;
                //debito
                case 2: $this->totalinteres= $this->totalventa;
                    break;
                //tarjeta naranja 1 pago
                case 3: $this->totalinteres= $this->totalventa;
                    break;
                //tarjeta naranja 3 pago
                case 4: $this->totalinteres= ($this->totalventa*0.1) + $this->totalventa;
                    break;
                //tarjeta naranja 6 pago
                case 5: $this->totalinteres= ($this->totalventa*0.15) + $this->totalventa;
                    break;
                //tarjeta naranja plan z
                case 6: $this->totalinteres= $this->totalventa;
                    break;
                //tarjeta visa 1 pago
                case 7: $this->totalinteres= $this->totalventa;
                    break;
                //tarjeta visa 3 pago
                case 8: $this->totalinteres= ($this->totalventa*0.12) + $this->totalventa;
                    break;
                //tarjeta visa 6 pago
                case 9: $this->totalinteres= ($this->totalventa*0.22) + $this->totalventa;
                    break;
                //Tarjeta Visa 7 Pago (Ahora 12)
                case 10: $this->totalinteres= ($this->totalventa*0.12) + $this->totalventa;
                    break;
                //Tarjeta Visa 8 Pago (Ahora 18)
                case 11: $this->totalinteres= ($this->totalventa*0.19) + $this->totalventa;
                    break;
                //Tarjeta Visa 12 Pago
                case 12: $this->totalinteres= ($this->totalventa*0.39) + $this->totalventa;
                    break;
                //Tarjeta Visa 18 Pago
                case 13: $this->totalinteres= ($this->totalventa*0.63) + $this->totalventa;
                    break;
            }
            
            $this->consulta= $this->con->query("UPDATE facturas SET idcliente='$this->idcliente',idvendedor='$this->idvendedor',totalventa='$this->totalinteres',condicionventa='$this->condicionventa',comprobantetarjeta='$this->comprobantetarjeta',fechaventa='$this->fechaventa', idregistrante='$this->idregistrante',estado='$this->estado' WHERE idfactura='$this->idfactura'");
            
            echo "<script>alert('VENTA FINALIZADA');window.location.href='../facturas/index.php';</script>";
        }
    }
?>
