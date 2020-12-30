<?php
include '../conexion.php';

class productos extends conexion{
    //atributos
    public $i;
    public $consulta;
    public $registros;
    public $producto;
    public $descripcion;
    public $codigo;
    public $stock;
    public $preciocompra;
    public $precioventa;
    public $fechaproducto;
    public $idrubro;
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
    public $pagina;
    public $registrosporoagina;
    public $consultatotalregistros;
    public $totalregistros;
    public $paginacion;

    //metodo mostrar productos
    public function mostrarproducto($bus, $tip) {
        $this->buscar=$bus;
        $this->tipo=$tip;
        
        /*$this->consulta= $this->con->query("SELECT productos.*, rubros.*, usuarios.* FROM productos "
                . "INNER JOIN rubros ON productos.idrubro=rubros.idrubro INNER JOIN usuarios ON productos.idusuario = usuarios.idusuario ORDER BY producto ASC");*/
        switch ($this->tipo){
                case 'codigo':$this->consulta= $this->con->query("SELECT productos.*, rubros.*, usuarios.* FROM productos "
                . "INNER JOIN rubros ON productos.idrubro=rubros.idrubro INNER JOIN usuarios ON productos.idusuario = usuarios.idusuario WHERE codigo='$this->buscar' ORDER BY producto ASC ");
                    break;
                case 'producto':$this->consulta= $this->con->query("SELECT productos.*, rubros.*, usuarios.* FROM productos "
                . "INNER JOIN rubros ON productos.idrubro=rubros.idrubro INNER JOIN usuarios ON productos.idusuario = usuarios.idusuario WHERE producto LIKE '%$this->buscar%' ORDER BY producto ASC ");
                    break;
                case 'descripcion':$this->consulta= $this->con->query("SELECT productos.*, rubros.*, usuarios.* FROM productos "
                . "INNER JOIN rubros ON productos.idrubro=rubros.idrubro INNER JOIN usuarios ON productos.idusuario = usuarios.idusuario WHERE descripcion LIKE '%$this->buscar%' ORDER BY producto ASC ");
                
                    
            }
        while ($this->registros= $this->consulta->fetch_array()){
            ?> 
<tr>
    <td><?php echo $this->registros['codigo']; ?></td>
    <td><?php echo $this->registros['producto']; ?></td>
    <td><?php echo $this->registros['descripcion']; ?></td>
    <td><?php echo $this->registros['stock']; ?></td>
    <td>$<?php echo $this->registros['preciocompra']; ?></td>
    <td>$<?php echo $this->registros['precioventa']; ?></td>
    <td><?php echo $this->registros['nombrerubro']; ?></td>
    <td><?php echo $this->registros['nombre']; ?> <?php echo $this->registros['apellido']; ?></td>
    <td><?php echo $this->registros['fechaproducto']; ?></td>
    <td>
        <a class="btn btn-success btn-sm btn-block" href="formulariomodificar.php?idproducto=<?php echo $this->registros["idproducto"]; ?>">Modificar</a>
        <a class="btn btn-danger btn-sm btn-block" href="eliminar.php?idproducto=<?php echo $this->registros["idproducto"]; ?>">Eliminar</a>
    </td>
</tr>
                <?php
        }
        $this->con->close();
    }
    public function mostrar($pag){
        $this->pagina=$pag;
        $this->registrosporoagina=3;
        $this->consultatotalregistros= $this->con->query("SELECT * FROM productos");
        $this->totalregistros= ceil($this->consultatotalregistros->num_rows/$this->registrosporoagina);
        $this->paginacion="SELECT productos.*, rubros.*, usuarios.* FROM productos "
                . "INNER JOIN rubros ON productos.idrubro=rubros.idrubro INNER JOIN usuarios ON productos.idusuario = usuarios.idusuario ORDER BY producto ASC LIMIT ".(($this->pagina-1)*$this->registrosporoagina)." , ".$this->registrosporoagina;
        $this->consulta= $this->con->query($this->paginacion);
        
        while ($this->registros= $this->consulta->fetch_array()){
            ?> 
<tr>
    <td><img src="imagenes/<?php echo $this->registros['foto']; ?>" /></td>
    <td><?php echo $this->registros['idproducto']; ?></td>
    <td><?php echo $this->registros['producto']; ?></td>
    <td><?php echo $this->registros['descripcion']; ?></td>
    <td><?php echo $this->registros['stock']; ?></td>
    <td>$<?php echo $this->registros['preciocompra']; ?></td>
    <td>$<?php echo $this->registros['precioventa']; ?></td>
    <td><?php echo $this->registros['idrubro']; ?></td>
    <td><?php echo $this->registros['nombre']; ?> <?php echo $this->registros['apellido']; ?></td>
    <td><?php echo $this->registros['fechaproducto']; ?></td>
    <td>
        <a class="btn btn-success btn-sm btn-block" href="formulariomodificar.php?idproducto=<?php echo $this->registros["idproducto"]; ?>">Modificar</a>
        <a class="btn btn-danger btn-sm btn-block" href="eliminar.php?idproducto=<?php echo $this->registros["idproducto"]; ?>">Eliminar</a>
    </td>
</tr>
                <?php
        }
        
     ?>
<tr>
    <td colspan="10">
        <nav aria-label="Page navigation example">
  <ul class="pagination">
      <li class="page-item"><a class="page-link" href="index.php?pagina=1"><<</a></li>
      <li class="page-item"><a class="page-link" href="index.php?pagina=<?php if($_GET['pagina']==0){ echo '<a href="index.php?pagina=1"></a>';}else{ echo $_GET['pagina']-1 ;}?>">Anterior</a></li>
    <?php 
    for($this->i=1;$this->i<= $this->totalregistros;$this->i++){
     ?>
    <li class="page-item <?php if($_GET['pagina']== $this->i){ echo 'active';} ?>"><a class="page-link" href="index.php?pagina=<?php echo $this->i; ?>"><?php echo $this->i; ?></a></li>
     <?php
    }
    ?>
    <li class="page-item"><a class="page-link" href="index.php?pagina=<?php echo $_GET['pagina']+1 ?>">Siguiente</a></li>
    <li class="page-item"><a class="page-link" href="index.php?pagina=<?php echo $this->i-1; ?>">>></a></li>
  </ul>
</nav>
    </td>
</tr>
    <?php 
    
    
        $this->con->close();
    }
    //metodo seleccion rubro
    public function rubros() {
        $this->consulta = $this->con->query("SELECT * FROM rubros ORDER BY nombrerubro ASC");
        while ($this->registros = $this->consulta->fetch_array()){
            ?> 
         <option value="<?php echo $this->registros['idrubro']; ?>"> <?php echo $this->registros['nombrerubro']; ?></option>
         <?php
        }
        $this->con->close();
    }
    //metodo guardar productos
    public function guardarproducto($nom,$des,$cod,$sto,$prec,$prev,$idr,$idu) {
        date_default_timezone_set("america/argentina/tucuman");
        $this->producto=$nom;
        $this->descripcion=$des;
        $this->codigo=$cod;
        $this->stock=$sto;
        $this->preciocompra=$prec;
        $this->precioventa=$prev;
        $this->idrubro=$idr;
        $this->idusuario=$idu;
        $this->fechaproducto= date("Y-m-d H:i:s");
        
        $this->consultacodigo = $this->con->query("SELECT codigo FROM productos WHERE codigo='$this->codigo'");
            $this->existecodigo= $this->consultacodigo->num_rows;
            $this->consultanombreproducto= $this->con->query("SELECT producto FROM productos WHERE producto='$this->producto'");
            $this->existenombreproducto= $this->consultanombreproducto->num_rows;
            
            if($this->existecodigo>0){
                echo "<script>alert('El codigo con el codigo ingresado ya existe');history.back(-1);</script>";
            }
            elseif($this->existenombreproducto>0){
                echo "<script>alert('El producto con el nombre ingresado ya existe');history.back(-1);</script>";
            }
            else{
                $this->consulta= $this->con->query("INSERT INTO productos (producto,descripcion,codigo,stock,preciocompra,precioventa,fechaproducto,idrubro,idusuario) VALUES ('$this->producto','$this->descripcion','$this->codigo','$this->stock','$this->preciocompra','$this->precioventa','$this->fechaproducto','$this->idrubro','$this->idusuario')");
                echo "<script>alert('Producto Registrado');window.location.href='index.php';</script>";
            }
        $this->con->close();
        //header("location: index.php");
        
    }
    //metod mostrar datos modificar
public function mostrarmodificar($id){
    $this->idproducto=$id;
    $this->consulta= $this->con->query("SELECT * FROM productos WHERE idproducto='$this->idproducto'");
    if ($this->registros= $this->consulta->fetch_array()){
        ?>
         
         <div class="form-group">
                <label for="nombre">Nombre de producto</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $this->registros['producto']; ?>" required="">
            </div>
            </div> 
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $this->registros['descripcion']; ?>" required="">
            </div> 
            <div class="form-group">
                <label for="codigo">Codigo</label>
                <input type="text" class="form-control" name="codigo" id="codigo" value="<?php echo $this->registros['codigo']; ?>" required="">
            </div> 
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" name="stock" id="stock" value="<?php echo $this->registros['stock']; ?>" required="">
            </div>
            <div class="form-group">
                <label for="preciocompra">Precio Compra</label>
                <input type="number" step="any" class="form-control" name="preciocompra" id="preciocompra" value="<?php echo $this->registros['preciocompra']; ?>" required="">
            </div> 
                
            <div class="form-group">
                <label for="precioventa">Precio Venta</label>
                <input type="number" step="any" class="form-control" name="precioventa" id="precioventa" value="<?php echo $this->registros['precioventa']; ?>" required="">
            </div> 
            <div class="form-group">
                <label for="idrubro">Rubro</label>
                <select  class="form-control" name="idrubro" id="idrubro" required="">
                <option value="0">Seleccionar</option>
                <?php
                    $this->consulta2= $this->con->query("SELECT * FROM rubros ORDER BY nombrerubro ASC");
                    while ($this->registros2= $this->consulta2->fetch_array()){
                        ?>
                    <option value=" <?php echo $this->registros2['idrubro']; ?>" <?php if ($this->registros2['idrubro']== $this->registros['idrubro']){echo "selected='selected'";}?>><?php echo $this->registros2['nombrerubro']; ?></option>
                    
                             <?php
                }
                    ?>
                   </select>
            </div> 
                 <?php
              }
              $this->con->close();
    }
public function guardar($id,$nom,$des,$cod,$sto,$pc,$pv,$idr){
        $this->idproducto=$id;
        $this->producto=$nom;
        $this->descripcion=$des;
        $this->codigo=$cod;
        $this->stock=$sto;
        $this->preciocompra=$pc;
        $this->precioventa=$pv;
        $this->idrubro=$idr;
        
        $this->con->query("UPDATE productos SET producto = '$this->producto',descripcion= '$this->descripcion',codigo = '$this->codigo',stock = '$this->stock',preciocompra='$this->preciocompra',precioventa='$this->precioventa',idrubro='$this->idrubro' WHERE idproducto = '$this->idproducto'") or die ($this->con->error());

            $this->con->close();
            
            
            echo "<script>alert('Producto Modificado');window.location.href='index.php';</script>";
            
        }
}
class modificarproducto extends conexion{
       public $idproducto;
       public $producto;
       public $descripcion;
       public $codigo;
       public $stock;
       public $preciocompra;
       public $precioventa;
       public $nombrerubro;


       public function guardar1($id,$nom,$des,$cod,$sto,$pc,$pv,$idr){
        $this->idproducto=$id;
        $this->producto=$nom;
        $this->descripcion=$des;
        $this->codigo=$cod;
        $this->stock=$sto;
        $this->preciocompra=$pc;
        $this->precioventa=$pv;
        $this->nombrerubro=$idr;
        
        $this->con->query("UPDATE productos SET producto = '$this->producto',descripcion= '$this->descripcion',codigo = '$this->codigo',stock = '$this->stock',preciocompra='$this->preciocompra',precioventa='$this->precioventa',idrubro='$this->idrubro' WHERE idproducto = '$this->idproducto'") or die ($this->con->error());

            $this->con->close();
            
            
            echo "<script>alert('Producto Modificado Satisfactoriamente');window.location.href='index.php';</script>";
            
        }
   }
   
   class eliminarproducto extends conexion{
       public $idproducto;
       
       public function eliminar($id){
           $this->idproducto=$id;
           $this->con->query("DELETE FROM productos WHERE idproducto='$this->idproducto'");
           $this->con->close();
           echo "<script>alert('Producto Eliminado');window.location.href='index.php';</script>";
       }
   }
   class sinstock extends conexion{
       public $stock;


       public function stockcero() {
           $this->stock=0;
           $this->consulta= $this->con->query("SELECT * FROM productos WHERE stock='$this->stock'");
           while ($this->registros= $this->consulta->fetch_array()){
           ?>
           <tr>
                <td><?php echo $this->registros['codigo']; ?></td>
                <td><?php echo $this->registros['producto']; ?></td>
                <td><?php echo $this->registros['descripcion']; ?></td>
                <td style="color: red"><?php echo $this->registros['stock']; ?></td>
                <td><?php echo $this->registros['fechaproducto']; ?></td>
            </tr>
            <?php
            }
       }
       
   }
   class stockminimo extends conexion{
       public $stock;


       public function valordestock() {
           $this->stock=0;
           $this->consulta= $this->con->query("SELECT * FROM productos WHERE stock BETWEEN '1' AND '10'");
           while ($this->registros= $this->consulta->fetch_array()){
           ?>
           <tr>
                <td><?php echo $this->registros['codigo']; ?></td>
                <td><?php echo $this->registros['producto']; ?></td>
                <td><?php echo $this->registros['descripcion']; ?></td>
                <td style="color: #B88B24"><?php echo $this->registros['stock']; ?></td>
                <td><?php echo $this->registros['fechaproducto']; ?></td>
            </tr>
            <?php
            }
       }
       
   }
?>
