<?php
include '../conexion.php';

class gastos extends conexion{
    //atributos
    public $i;
    public $consulta;
    public $registros;
    public $idgastos;
    public $detalle;
    public $totalgastos;
    public $stock;
    public $preciocompra;
    public $precioventa;
    public $fechagastos;
    public $horagastos;
    public $idusuario;
    public $consultacodigo;
    public $existecodigo;
    public $consultanombreproducto;
    public $existenombreproducto;
    public $idproducto;
    public $consulta2;
    public $registros2;
    public $buscar;
    public $tipo;
    public $registros3;
    public $consulta3;
    public $desde;
    public $hasta;


    //metodo mostrar productos
    public function buscargasto($bus) {
        $this->buscar=$bus;
        //$this->tipo=$tip;
        $this->consulta= $this->con->query("SELECT * FROM gastos WHERE detalle LIKE '%$this->buscar%'");
        while ($this->registros= $this->consulta->fetch_array()){
            ?> 
<tr>
    <td><?php echo $this->registros['detalle']; ?></td>
    <td><?php echo $this->registros['totalgastos']; ?></td>
    <td><?php echo $this->registros['fechagastos']; ?></td>
    <td><?php echo $this->registros['horagastos']; ?></td>
    <td>
        <a class="btn btn-success btn-sm btn-block" href="formulariomodificar.php?idgastos=<?php echo $this->registros["idgastos"]; ?>">Modificar</a>
        <a class="btn btn-danger btn-sm btn-block" href="eliminar.php?idgastos=<?php echo $this->registros["idgastos"]; ?>">Eliminar</a>
    </td>
</tr>
                <?php
        }
        $this->con->close();
    }
    //metodo para buscar la fecha del gasto
    public function buscarfechagasto($des,$has) {
      $this->desde=$des;
      $this->hasta=$has;
      
      $this->consulta=$this->con->query("SELECT * FROM gastos WHERE fechagastos BETWEEN '$this->desde' AND '$this->hasta'");
      while ($this->registros= $this->consulta->fetch_array()){
            ?> 
<tr>
    <td><?php echo $this->registros['detalle']; ?></td>
    <td><?php echo $this->registros['totalgastos']; ?></td>
    <td><?php echo $this->registros['fechagastos']; ?></td>
    <td><?php echo $this->registros['horagastos']; ?></td>
    <td>
        <a class="btn btn-success btn-sm btn-block" href="formulariomodificar.php?idgastos=<?php echo $this->registros["idgastos"]; ?>">Modificar</a>
        <a class="btn btn-danger btn-sm btn-block" href="eliminar.php?idgastos=<?php echo $this->registros["idgastos"]; ?>">Eliminar</a>
    </td>
</tr>
                <?php
        }
        
    }
    public function mostrar() {

        $this->consulta= $this->con->query("SELECT * FROM gastos");
        
        while ($this->registros= $this->consulta->fetch_array()){
            ?> 
<tr>
    <td><?php echo $this->registros['detalle']; ?></td>
    <td><?php echo $this->registros['totalgastos']; ?></td>
    <td><?php echo $this->registros['fechagastos']; ?></td>
    <td><?php echo $this->registros['horagastos']; ?></td>
    <td>
       <a class="btn btn-success btn-sm btn-block" href="formulariomodificar.php?idgastos=<?php echo $this->registros["idgastos"]; ?>">Modificar</a>
        <a class="btn btn-danger btn-sm btn-block" href="eliminar.php?idgastos=<?php echo $this->registros["idgastos"]; ?>">Eliminar</a>
    </td>
</tr>
                <?php
        }
        $this->con->close();
    }
    
    //metodo guardar gastos
    public function guardargasto($det,$tog){
        date_default_timezone_set("america/argentina/tucuman");
        $this->detalle=$det;
        $this->totalgastos=$tog;
        $this->fechagastos=date("Y-m-d");
        $this->horagastos=date("H:i:s");
        
        $this->consulta= $this->con->query("INSERT INTO gastos (detalle,totalgastos,fechagastos,horagastos) VALUES ('$this->detalle','$this->totalgastos','$this->fechagastos','$this->horagastos')");
        $this->con->close();
        
        echo "<script>alert('Gasto Registrado');window.location.href='index.php';</script>";
        
    }
    //metod mostrar datos modificar
public function mostrarmodificar($id){
    $this->idgastos=$id;
    $this->consulta= $this->con->query("SELECT * FROM gastos WHERE idgastos='$this->idgastos'");
    if ($this->registros= $this->consulta->fetch_array()){
        ?>
         
         <div class="form-group">
                <label for="detalle">Detalle</label>
                <input type="text" class="form-control" name="detalle" id="detalle" value="<?php echo $this->registros['detalle']; ?>" required="">
            </div>
            </div> 
            <div class="form-group">
                <label for="totalgastos">Total</label>
                <input type="text" class="form-control" name="totalgastos" id="totalgastos" value="<?php echo $this->registros['totalgastos']; ?>" required="">
            </div> 
             
            
                 <?php
              }
              $this->con->close();
    }
public function guardar($id,$det,$tot){
        $this->idgastos=$id;
        $this->detalle=$det;
        $this->totalgastos=$tot;
        
        $this->con->query("UPDATE gastos SET detalle = '$this->detalle',totalgastos= '$this->totalgastos' WHERE idgastos = '$this->idgastos'") or die ($this->con->error());

            $this->con->close();
            
            
            echo "<script>alert('Gasto Modificado');window.location.href='index.php';</script>";
            
        }
}   
   class eliminargasto extends conexion{
       public $idgastos;
       
       public function eliminar($id){
           $this->idgastos=$id;
           $this->con->query("DELETE FROM gastos WHERE idgastos='$this->idgastos'");
           $this->con->close();
           echo "<script>alert('Gasto Eliminado');window.location.href='index.php';</script>";
       }
   }
?>
