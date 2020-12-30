<?php
include '../conexion.php';
class Caja extends conexion {
    public $idcaja;
    public $idusuario;
    public $importecaja;
    public $fechacaja;
    public $horacaja;
    public $consulta;
    public $datos;
    public $consulta2;
    public $datos2;
    public $total;
    public $fecha2;
    public $totalventas;
    public $totalcaja;
    public $encontrados;
    public $fechacaja2;
    public $fecha3;
    public $total2;
    public $desde;
    public $hasta;
    public $desde2;
    public $hasta2;
    public $fechagastos;
    public $consulta3;
    public $fechagastos2;
    public $total3;
    public $datos3;
    public $desde3;
    public $hasta3;



    //metodo para dar apertura a la caja
    public function Apertura($idu, $imp) {
        $this->idusuario=$idu;
        $this->importecaja=$imp;
        date_default_timezone_set("america/argentina/tucuman");
        $this->fechacaja= date("Y-m-d");
        $this->horacaja=date("H:i:s");
        
        $this->consulta= $this->con->query("INSERT INTO caja (idusuario,importecaja,fechacaja,horacaja) VALUE ('$this->idusuario','$this->importecaja','$this->fechacaja','$this->horacaja')");
        $this->con->close();
        echo "<script>alert('Caja Iniciada');window.location.href='index.php';</script>";
        
    }
    //metodo desactivar boton apertura
    public function desactivar() {
         date_default_timezone_set("america/argentina/tucuman");
         $this->fechacaja= date('Y-m-d');
         $this->consulta= $this->con->query("SELECT * FROM caja WHERE fechacaja='$this->fechacaja'");
         $this->encontrados= $this->consulta->num_rows;
                 
         if($this->encontrados==0){
             echo '<a class="btn btn-primary" href="apertura.php">Apertura de Caja</a>';
         }else{
             if($this->datos= $this->consulta->fetch_array()){
                 $this->idcaja= $this->datos['idcaja'];
                 echo '<a class="btn btn-success" href="modificarcaja.php?idcaja='.$this->idcaja.'">Modificar</a>';
                 
             }
         }
         $this->con->close();
    }
    //metodo para mostrar datos a modificar
    public function datosmodificar($idc) {
        $this->idcaja=$idc;
        
        $this->consulta=$this->con->query("SELECT * FROM caja WHERE idcaja='$this->idcaja'");
        if($this->datos= $this->consulta->fetch_array()){
            $this->importecaja= $this->datos['importecaja'];
            ?>
            <input type="hidden" name="idcaja" value="<?php echo $this->idcaja; ?>">
            <input type="number" step="any" class="form-control" id="importecaja" name="importecaja" value="<?php echo $this->importecaja; ?>" required="">
            <?php
            
        }
        $this->con->close();
    }
    //metodo para modificar la caja
    public function Modificar($idc,$imp) {
        $this->idcaja=$idc;
        $this->importecaja=$imp;
        
        $this->consulta= $this->con->query("UPDATE caja SET importecaja='$this->importecaja' WHERE idcaja='$this->idcaja'");
        $this->con->close();
        echo "<script>alert('Caja Modificada');window.location.href='index.php';</script>";
    }
    
    //metodo para saber el dinero de las ventas
    public function ventas (){
        date_default_timezone_set("america/argentina/tucuman");
        $this->fechacaja= date('Y-m-d H:i:s');
        $this->fecha2=date('Y-m-d 00:00:00');
        $this->consulta=$this->con->query("SELECT * FROM facturas WHERE condicionventa='1' AND fechaventa BETWEEN '$this->fecha2' AND '$this->fechacaja' ");
        $this->total=0;
        while ($this->datos= $this->consulta->fetch_array()){
            $this->total+= $this->datos['totalventa'];
            
        }
        echo $this->total;
    }
    
     //metodo para saber el dinero de la caja
    public function inicial (){
        date_default_timezone_set("america/argentina/tucuman");
        $this->fechacaja= date('Y-m-d');
        
        $this->consulta=$this->con->query("SELECT * FROM caja WHERE fechacaja='$this->fechacaja' ");
        $this->total=0;
        while ($this->datos= $this->consulta->fetch_array()){
            $this->total+= $this->datos['importecaja'];
            
        }
        echo $this->total;
    }
    //metodo para mostrar los gastos
    public function gastos (){
        date_default_timezone_set("america/argentina/tucuman");
        $this->fechagastos= date('Y-m-d');
        $this->consulta=$this->con->query("SELECT * FROM gastos WHERE fechagastos='$this->fechagastos' ");
        $this->total=0;
        while ($this->datos= $this->consulta->fetch_array()){
            $this->total+= $this->datos['totalgastos'];
            
        }
        echo $this->total;
    }
    //metodo para calcular el total de la caja
    public function totalcaja(){
        date_default_timezone_set("america/argentina/tucuman");
        $this->fechacaja= date('Y-m-d H:i:s');
        $this->fecha2=date('Y-m-d 00:00:00');
        $this->consulta=$this->con->query("SELECT * FROM facturas WHERE condicionventa='1' AND fechaventa BETWEEN '$this->fecha2' AND '$this->fechacaja' ");
        $this->total=0;
        while ($this->datos= $this->consulta->fetch_array()){
            $this->total+= $this->datos['totalventa'];
            
        }
        $this->total;
        
        $this->fechacaja2= date('Y-m-d');
        
        $this->consulta2=$this->con->query("SELECT * FROM caja WHERE fechacaja='$this->fechacaja2' ");
        $this->total2=0;
        while ($this->datos2= $this->consulta2->fetch_array()){
            $this->total2+= $this->datos2['importecaja'];
            
        }
        $this->total2;
        
        $this->fechagastos2= date('Y-m-d');
        
        $this->consulta3=$this->con->query("SELECT * FROM gastos WHERE fechagastos='$this->fechagastos2' ");
        $this->total3=0;
        while ($this->datos3= $this->consulta3->fetch_array()){
            $this->total3+= $this->datos3['totalgastos'];
            
        }
        $this->total3;
        
         echo $this->totalcaja= $this->total+$this->total2-$this->total3;
    }
    public function buscartotalcaja($des, $hast){
        date_default_timezone_set("america/argentina/tucuman");
        
        $this->desde= $des." 00:00:00";
        $this->hasta=$hast." 23:59:59";
        $this->consulta=$this->con->query("SELECT * FROM facturas WHERE condicionventa='1' AND fechaventa BETWEEN '$this->desde' AND '$this->hasta' ");
        $this->total=0;
        while ($this->datos= $this->consulta->fetch_array()){
            $this->total+= $this->datos['totalventa'];
            
        }
        $this->total;
        
        $this->desde2= $des;
        $this->hasta2= $hast;
        
        $this->consulta2=$this->con->query("SELECT * FROM caja WHERE fechacaja BETWEEN '$this->desde2' AND '$this->hasta2'");
        $this->total2=0;
        while ($this->datos2= $this->consulta2->fetch_array()){
            $this->total2+= $this->datos2['importecaja'];
            
        }
        $this->total2;
        
        $this->desde3= $des;
        $this->hasta3= $hast;
        
        $this->consulta3=$this->con->query("SELECT * FROM gastos WHERE fechagastos BETWEEN '$this->desde3' AND '$this->hasta3' ");
        $this->total3=0;
        while ($this->datos3= $this->consulta3->fetch_array()){
            $this->total3+= $this->datos3['totalgastos'];
            
        }
        $this->total3;
        
        $this->totalcaja= $this->total+$this->total2-$this->total3;
        
        ?>
        <form id="finalizar">
            <div class="form-group">
                <label for="importecaja">Dinero Inicial</label>
                <input type="text" class="form-control" id="importecaja" name="importecaja" value="$<?php echo $this->total2; ?>" readonly="">
            </div>
            <div class="form-group">
                <label for="ventas">Dinero de Ventas</label>
                <input type="text" class="form-control" id="ventas" name="ventas" value="$<?php echo $this->total;?>" readonly="">                   
            </div>
            <div class="form-group">
                <label for="gastos">Gastos</label>
                <input type="text" class="form-control" id="gastos" name="gastos" value="$<?php echo $this->total3;?>" readonly="">                   
            </div>
            <div class="form-group">
                <label for="total">Total $</label>
                <input type="text" class="form-control" id="total" name="total" value="$<?php echo $this->totalcaja;?>" readonly="">
            </div>
                                              
        </form>
        <?php
    }
}
?>

