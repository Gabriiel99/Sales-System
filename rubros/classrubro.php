<?php
include '../conexion.php';
class registrorubro extends conexion{
       public $consulta;
       public $recorridos;
       
       public function rubro(){
           $this->consulta=$this->con->query("SELECT * FROM rubros");
           while($this->recorridos=$this->consulta->fetch_array()){
               ?>
               <tr>
                    <td><?php echo $this->recorridos["idrubro"]; ?></td>
                    <td><?php echo $this->recorridos["nombrerubro"]; ?></td>
                  <td>
                      <a class="btn btn-success" href="formulariomodificarru.php?id=<?php echo $this->recorridos["idrubro"]; ?>">Modificar</a>
                        <a class="btn btn-danger" onclick="return confirm('Desea eliminar el registro seleccionado?');" href="Eliminarrubro.php?id=<?php echo $this->recorridos["idrubro"]; ?>">Eliminar</a>
                    </td>
                </tr>
               <?php
           }
       }
   }
class nuevorubro extends conexion{
       public $rubro;
       
       public function registrar($rub){
           $this->rubro=$rub;
           
           $this->con->query("INSERT INTO rubros (nombrerubro)VALUES "
                   . "('$this->rubro')") or die ($this->con->error());
            
            $this->con->close();
            
            echo "<script>alert('Rubro Registrado');window.location.href='index.php';</script>";
   }
   }
   class registrorub extends conexion{
       public $consulta;
       public $recorridos;
       public $buscar;
       
       public function rub($bus){
           $this->buscar=$bus;
           $this->consulta=$this->con->query("SELECT * FROM rubros WHERE nombrerubro='$this->buscar'");
           while($this->recorridos= $this->consulta->fetch_array()){
               ?>
               <tr>
                    <td><?php echo $this->recorridos["idrubro"]; ?></td>
                    <td><?php echo $this->recorridos["nombrerubro"]; ?></td>
                    <td><a class="btn btn-success" href="formulariomodificarru.php?id=<?php echo $this->recorridos["idrubro"]; ?>">Modificar</a></td>
                        
                </tr>
               <?php
           }
       }
   }
   class datosrubro extends conexion{
       public $idrubro;
       public $recorridos;
       public $consulta;
       
       public function mostrarrub($id) {
           $this->idrubro=$id;
           $this->consulta=$this->con->query("SELECT * FROM rubros WHERE idrubro='$this->idrubro'");
           if($this->recorridos=$this->consulta->fetch_array()){
               ?>
                <form id="rubro" class="form-group" action="formulariomodificarru.php" method="POST">
                     <input type="hidden" name="idrubro" value="<?php echo $this->recorridos['idrubro']; ?>" required="">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombrerubro" value="<?php echo $this->recorridos['nombrerubro']; ?>" required="">
            </div>
            <div>
                <input type="submit" class="btn btn-success" value="Modificar Rubro">
                <a class="btn btn-danger" href="index.php">Cancelar Formulario</a>
            </div>
            
        </form>
                <?php
           }
       }
   }
   class modificarrubro extends conexion{
       public $nombrerubro;
       public $idrubro;


       public function modificar($id,$rub){
           $this->nombrerubro=$rub;
           $this->idrubro=$id;
           
           $this->con->query("UPDATE rubros SET nombrerubro='$this->nombrerubro'WHERE idrubro=$this->idrubro ") or die ($this->con->error());
            
            $this->con->close();
            
            echo "<script>alert('Rubro Modificado');window.location.href='index.php';</script>";
   }
   }
   class eliminarrubro extends conexion{
       public $idrubro;
       
       public function eliminar($id){
           $this->idrubro=$id;
           $this->con->query("DELETE FROM rubros WHERE idrubro='$this->idrubro'");
           $this->con->close();
           echo "<script>alert('Rubro Eliminado');window.location.href='index.php';</script>";
       }
   }
   ?>

