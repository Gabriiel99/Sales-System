<?php
   include '../conexion.php';
   
   class registros extends conexion{
       public $campo;
       public $consulta;
       public $recorridos;
       
       
       public function datos(){
           $this->consulta=$this->con->query("SELECT * FROM usuarios");
           while($this->recorridos=$this->consulta->fetch_array()){
               echo "<tr>";
               echo "<td>".$this->recorridos["idusuario"]."</td>";
               echo "<td>".$this->recorridos["nombre"]."</td>";
               echo "<td>".$this->recorridos["apellido"]."</td>";
               echo "<td>".$this->recorridos["dni"]."</td>";
               echo "<td>".$this->recorridos["nacimiento"]."</td>";
               echo "<td>".$this->recorridos["domicilio"]."</td>";
               echo "<td>".$this->recorridos["localidad"]."</td>";
               echo "<td>".$this->recorridos["provincia"]."</td>";
               echo "<td>".$this->recorridos["telefono"]."</td>";
               echo "<td>".$this->recorridos["email"]."</td>";
               echo "<td>".$this->recorridos["sexo"]."</td>";
               echo "<td>".$this->recorridos["privilegio"]."</td>";
               
           }
       }
   }
   
   class registro2 extends conexion{
       public $consulta;
       public $recorridos;
       public $pagina;
       public $registrosporoagina;
       public $consultatotalregistros;
       public $totalregistros;
       public $paginacion;
       
       public function datos2($pag){
            $this->pagina=$pag;
            $this->registrosporoagina=5;
            $this->consultatotalregistros= $this->con->query("SELECT * FROM usuarios");
            $this->totalregistros= ceil($this->consultatotalregistros->num_rows/$this->registrosporoagina);
        $this->paginacion="SELECT * FROM usuarios LIMIT ".(($this->pagina-1)*$this->registrosporoagina)." , ".$this->registrosporoagina;
        $this->consulta= $this->con->query($this->paginacion);
            
           while($this->recorridos=$this->consulta->fetch_array()){
               ?>
               <tr>
                    <td><?php echo $this->recorridos["idusuario"]; ?></td>
                    <td><?php echo $this->recorridos["nombre"]; ?></td>
                    <td><?php echo $this->recorridos["apellido"]; ?></td>
                    <td><?php echo $this->recorridos["dni"]; ?></td>
                    <td><?php echo $this->recorridos["nacimiento"]; ?></td>
                    <td><?php echo $this->recorridos["domicilio"]; ?></td>
                    <td><?php echo $this->recorridos["localidad"]; ?></td>
                    <td><?php echo $this->recorridos["provincia"]; ?></td>
                    <td><?php echo $this->recorridos["telefono"]; ?></td>
                    <td><?php echo $this->recorridos["email"]; ?></td>
                    <td><?php echo $this->recorridos["sexo"]; ?></td>
                    <td><?php echo $this->recorridos["idregistrante"]; ?></td>
                    <td><?php 
                                       switch ($this->recorridos['privilegio']){
                                           case 1: echo 'ADMINISTRADOR';
                                               break;
                                           case 2: echo 'ESTANDAR';
                                               break;
                                           case 3: echo 'CLIENTE';
                                               break;
                                           case 4: echo 'EMPLEADO';
                                               break;
                                           case 5: echo 'PROVEEDOR';
                                               break;
                                           case 6: echo 'LIMITADO';
                                               break;
                                       }
                    ?></td>
                    <td>
                        <?php if($this->recorridos['privilegio']==5){ ?>
                        <a class="btn btn-primary btn-sm btn-block" href="vercuenta.php?idusuario=<?php echo $this->recorridos["idusuario"]; ?>">Ver Cuenta</a>
           <?php } ?>
                        <a class="btn btn-success btn-sm btn-block" href="formulariomodificar.php?id=<?php echo $this->recorridos["idusuario"]; ?>">Modificar</a>
                        <a class="btn btn-danger btn-sm btn-block" onclick="return confirm('Desea eliminar el registro seleccionado?');" href="eliminar.php?id=<?php echo $this->recorridos["idusuario"]; ?>">Eliminar</a>
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
       public $idproveedor;
       public $idusuario;
       public $actividad;
       public $haber;
       public $debe;
       public $fecha;
       public $consulta2;
       public $datos;
       public $sumahaber;
       public $sumadebe;
       public $saldo;


       public function mostrarcuentaproveedor($idu) {
           $this->idusuario=$idu;
           $this->consulta= $this->con->query("SELECT * FROM proveedores WHERE idusuario='$this->idusuario'");
           ?>
<table class="table" table-bordered>
    <thead>
        <tr class="bg-light">
            <th colspan="1" class="text-right">Nombre</th>
            <th colspan="5" class="text-left">
                <?php
                $this->consulta2= $this->con->query("SELECT apellido,nombre,telefono FROM usuarios WHERE idusuario='$this->idusuario'");
                if ($this->datos= $this->consulta2->fetch_array()){
                echo $this->datos['apellido'].", ".$this->datos['nombre']."<b> Telefono </b>".$this->datos['telefono'];
                               
                           }
                ?>
            </th>
        </tr>
        <tr class="bg-primary">
    <th>Fecha</th>
    <th>Actividad</th>
    <th>Debe</th>
    <th>Haber</th>
    <th>Saldo</th>
    <th>Accion</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $this->sumadebe=0;
        $this->sumahaber=0;
        $this->saldo=0;
        while ($this->recorridos= $this->consulta->fetch_array()){
        ?>
        <tr>
            <td><?php echo $this->recorridos['fecha'];?></td>
            <td><?php echo $this->recorridos['actividad'];?></td>
            <td><?php echo $this->recorridos['debe'];?></td>
            <td><?php echo $this->recorridos['haber'];?></td>
            <td><?php
            $this->sumadebe+= $this->recorridos['debe'];
            $this->sumahaber+= $this->recorridos['haber'];
            $this->saldo= round($this->sumadebe-$this->sumahaber,2);
            ?>
        </td>
        <td>
            <?php
            if ($this->recorridos['haber']==0){
                ?>
            <a class="btn btn-success" href="modificarc.php?idproveedor=<?php echo $this-> recorridos['idproveedor']; ?>">Modificar Credito</a>
            <?php
            
            } else{?>
            <a class="btn btn-success" href="modificarp.php?idproveedor=<?php echo $this-> recorridos['idproveedor']; ?>">Modificar Pago</a>
            <?php } ?>
            <a class="btn btn-danger" href="Eliminarpc.php?idusuario= <?php echo $this->recorridos['idusuario']?> &idproveedor=<?php echo $this->recorridos['idproveedor'];?>">Eliminar</a>
                
        </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php
       }
       
       //metodo guardar
       public function guardar($idu,$act, $hab){
           date_default_timezone_set("america/argentina/tucuman");
           $this->fecha=date("Y-m-d H:i:s");
           echo $this->idusuario=$idu;
           $this->actividades=$act;
           $this->haber=$hab;
           
           $this->con->query("INSERT INTO prooveedores (idusuario,actividad,haber,fecha) VALUES ('$this->idusuario','$this->actividad','$this->haber','$this->fecha',)");
           $this->con->close();
           echo "<script>alert('Pago registrado');window.location.href='vercuenta.php?idusuario=".$this->idusuario."';</script>";
       }
       
       
       //metodo guardar
       public function guardar2($idu,$act, $deb){
           date_default_timezone_set("america/argentina/tucuman");
           $this->fecha=date("Y-m-d H:i:s");
           echo $this->idusuario=$idu;
           $this->actividades=$act;
           $this->debe=$deb;
           
           $this->con->query("INSERT INTO prooveedores (idusuario,actividad,debe,fecha) VALUES ('$this->idusuario','$this->actividad','$this->debe','$this->fecha',)");
           $this->con->close();
           echo "<script>alert('Credito registrado');window.location.href='vercuenta.php?idusuario=".$this->idusuario."';</script>";
       }
       
       //metodo para mostrar datos a modificar credito
       public function datoscreditos($idp){
           $this->idproveedor = $idp;
           $this->consulta = $this->con->query("SELECT * FROM proveedores WHERE idproveedores = '$this->idproveedor'");
           if($this->recorridos=$this->consulta->fetch_array()){
               ?>
              <form class="form-inline" action="modificarc.php" method="POST">
                  <input type="hidden" name="idusuario" value="<?php echo $this->recorridos['idusuario']?>">
                   <input type="hidden" name="idproveedor" value="<?php echo $this->recorridos['idproveedor']?>">
                  <div class="form-inline">
                        <label>Actividades</label>
                        <input type="text" class="form-control" name="actividad" value="<?php echo $this->recorridos['actividad']; ?>" required="">
                 </div>
                 <div class="form-inline">
                    <label>Debe</label>
                    <input type="number" step="any" class="form-control" name="debe" value"<?php echo $this->recorridos['debe'];?>" required="">; 
                </div>
            
             <div>
                <input type="submit" class="btn btn-primary" value="Modificar Credito">
                <a class="btn btn-danger" href="vercuenta.php?idusuario=<?php echo $this->recorridos['idusuario'];?>
             </div>
        </form>
     
                <?php     
           }
           $this->con->close();
       }
    public function moddebe($idp,$idu,$act,$deb){   
        $this->proveedor=$idp;
        $this->idusuario=$idu;
        $this->actividad=$act;
        $this->debe=$deb;
        
        
        $this->con->query("UPDATE proveedores SET actividad='$this->actividad', debe='$this->debe' WHERE idproveedor=$this->idproveedor");
        $this->con->close();
        echo "<script>alert('Credito Modificado');window.location.href='vercuenta.php?idusuario=".$this->idusuario."';</script>";
   }
   
   //metodo para mostrar datos a modificar credito
       public function datospago($idp){
           $this->idproveedor = $idp;
           $this->consulta = $this->con->query("SELECT * FROM proveedores WHERE idproveedores = '$this->idproveedor'");
           if($this->recorridos=$this->consulta->fetch_array()){
               ?>
              <form class= "form-inline" action="modificarp.php" method="POST">
                  <input type="hidden" name="idusuario" value="<?php echo $this->recorridos['idusuario']?>">
                   <input type="hidden" name="idproveedor" value="<?php echo $this->recorridos['idproveedor']?>">
                  <div class="form-inline">
                        <label>Actividades</label>
                        <input type="text" class="form-control" name="actividad" value="<?php echo $this->recorridos['actividad']; ?>" required="">
                 </div>
                 <div class="form-inline">
                    <label>Pago</label>
                    <input type="number" step="any" class="form-control" name="haber" value== "<?php echo $this->recorridos['haber'];?>" required="">; 
                </div>
            
             <div>
                <input type="submit" class="btn btn-primary" value="Modificar Pago">
                <a class="btn btn-danger" href="vercuenta.php?idusuario=<?php echo $this->recorridos['idusuario'];?>
             </div>
        </form>
     
                <?php     
           }
           $this->con->close();
   }
   
   public function modpago($idp,$idu,$act,$hab){   
        $this->proveedor=$idp;
        $this->idusuario=$idu;
        $this->actividad=$act;
        $this->haber=$hab;
        
        
        $this->con->query("UPDATE proveedores SET actividad='$this->actividad', haber='$this->haber' WHERE idproveedor=$this->idproveedor");
        $this->con->close();
        echo "<script>alert('Pago Modificado');window.location.href='vercuenta.php?idusuario=".$this->idusuario."';</script>";
   }
   
   //metodo paar eleiminar pagos o creditos
   public function Eliminarpc($idu,$idp){
       $this->idusuario=$idu;
       $this->idproveedor=$idp;
       $this->con->query("DELETE FROM proveedores WHERE idproveedor =.'$this->idproveedor'");
       $this->con->close();
        echo "<script>alert('Registro Eliminado');window.location.href='vercuenta.php?idusuario=".$this->idusuario."';</script>";
   }
   
   }

   
   
   class registros3 extends conexion{
        public $consulta;
        public $recorridos;
        public $buscar;
        public $tipo;
        public $desde;
        public $hasta;

        public function datos3($bus, $tip){
            $this->buscar=$bus;
            $this->tipo=$tip;
            switch ($this->tipo){
                case 'dni':$this->consulta=$this->con->query("SELECT * FROM usuarios WHERE dni='$this->buscar'");
                    break;
                case 'apellido':$this->consulta=$this->con->query("SELECT * FROM usuarios WHERE apellido LIKE '%$this->buscar%'");
                    break;
                case 'telefono':$this->consulta=$this->con->query("SELECT * FROM usuarios WHERE telefono='$this->buscar'");
                
                    
            }
            
            
            while($this->recorridos=$this->consulta->fetch_array()){
                ?>
                <tr>
                  <td><?php echo $this->recorridos['idusuario']; ?> </td>
                  <td><?php echo $this->recorridos['nombre']; ?></td>
                  <td><?php echo $this->recorridos['apellido']; ?></td>
                  <td><?php echo $this->recorridos['dni']; ?></td>
                  <td><?php echo $this->recorridos['nacimiento']; ?></td>
                  <td><?php echo $this->recorridos['domicilio']; ?></td>
                  <td><?php echo $this->recorridos['localidad']; ?></td>
                  <td><?php echo $this->recorridos['provincia']; ?></td>
                  <td><?php echo $this->recorridos['telefono']; ?></td>
                  <td><?php echo $this->recorridos['email']; ?></td>
                  <td><?php echo $this->recorridos['sexo']; ?></td>
                  <td><?php 
                                       switch ($this->recorridos['privilegio']){
                                           case 1: echo 'ADMINISTRADOR';
                                               break;
                                           case 2: echo 'ESTANDAR';
                                               break;
                                           case 3: echo 'CLIENTE';
                                               break;
                                           case 4: echo 'EMPLEADO';
                                               break;
                                           case 5: echo 'PROVEEDOR';
                                               break;
                                           case 6: echo 'LIMITADO';
                                               break;
                                       }
                    ?></td>
                  <td>
                      <?php if($this->recorridos['privilegio']==5){ ?>
                      <a class="btn btn-primary btn-sm btn-block" href="vercuenta.php?id=<?php echo $this->recorridos["idusuario"]; ?>">Ver Cuenta</a><br>
           <?php } ?>
                      <a class="btn btn-success" href="formulariomodificar.php?id=<?php echo $this->recorridos['idusuario']; ?>" >Modificar</a></td>
                </tr>
               <?php
            }
        }
        
        public function buscarporfecha($des, $hast){
            $this->desde=$des;
            $this->hasta=$hast;
            
            
            $this->consulta=$this->con->query("SELECT * FROM usuarios WHERE nacimiento BETWEEN '$this->desde' AND '$this->hasta'");
            while($this->recorridos=$this->consulta->fetch_array()){
                ?>
                <tr>
                  <td><?php echo $this->recorridos['idusuario']; ?> </td>
                  <td><?php echo $this->recorridos['nombre']; ?></td>
                  <td><?php echo $this->recorridos['apellido']; ?></td>
                  <td><?php echo $this->recorridos['dni']; ?></td>
                  <td><?php echo $this->recorridos['nacimiento']; ?></td>
                  <td><?php echo $this->recorridos['domicilio']; ?></td>
                  <td><?php echo $this->recorridos['localidad']; ?></td>
                  <td><?php echo $this->recorridos['provincia']; ?></td>
                  <td><?php echo $this->recorridos['telefono']; ?></td>
                  <td><?php echo $this->recorridos['email']; ?></td>
                  <td><?php echo $this->recorridos['sexo']; ?></td>
                  <td><?php 
                                       switch ($this->recorridos['privilegio']){
                                           case 1: echo 'ADMINISTRADOR';
                                               break;
                                           case 2: echo 'ESTANDAR';
                                               break;
                                           case 3: echo 'CLIENTE';
                                               break;
                                           case 4: echo 'EMPLEADO';
                                               break;
                                           case 5: echo 'PROVEEDOR';
                                               break;
                                           case 6: echo 'LIMITADO';
                                               break;
                                       }
                    ?></td>
                  <td>
                      <?php if($this->recorridos['privilegio']==5){ ?>
                      <a class="btn btn-primary btn-sm btn-block" href="vercuenta.php?id=<?php echo $this->recorridos["idusuario"]; ?>">Ver Cuenta</a><br>
           <?php } ?>
                      <a class="btn btn-success" href="formulariomodificar.php?id=<?php echo $this->recorridos['idusuario']; ?>" >Modificar</a></td>
                </tr>
               <?php
            }
        }
    }
   class nuevousuario extends conexion{
       public $nombre;
       public $apellido;
       public $dni;
       public $nacimiento;
       public $domicilio;
       public $localidad;
       public $provincia;
       public $telefono;
       public $email;
       public $sexo;
       public $privilegio;
       public $idregistrante;
       public $consultadni;
       public $existedni;
       public $consultaemail;
       public $existeemail;
       
       public function registrar($nom,$ape,$dn,$nac,$dom,$loc,$pro,$tel,$em,$sex,$pri,$idre){
           $this->nombre=$nom;
           $this->apellido=$ape;
           $this->dni=$dn;
           $this->nacimiento=$nac;
           $this->domicilio=$dom;
           $this->localidad=$loc;
           $this->provincia=$pro;
           $this->telefono=$tel;
           $this->email=$em;
           $this->sexo=$sex;
           $this->privilegio=$pri;
           $this->idregistrante=$idre;
           
            $this->consultadni = $this->con->query("SELECT dni FROM usuarios WHERE dni='$this->dni'");
            $this->existedni= $this->consultadni->num_rows;
            $this->consultaemail= $this->con->query("SELECT email FROM usuarios WHERE email='$this->email'");
            $this->existeemail= $this->consultaemail->num_rows;
            
            if($this->existedni>0){
                echo "<script>alert('El dni ingresado ya existe');history.back(-1);</script>";
            }
            elseif($this->existeemail>0){
                echo "<script>alert('El email ingresado ya existe');history.back(-1);</script>";
            }
            else{
                $this->con->query("INSERT INTO usuarios (nombre,apellido,dni,nacimiento,domicilio,localidad,provincia,telefono,email,sexo,privilegio,idregistrante)VALUES "
                   . "('$this->nombre','$this->apellido','$this->dni','$this->nacimiento','$this->domicilio','$this->localidad','$this->provincia','$this->telefono','$this->email','$this->sexo','$this->privilegio','$this->idregistrante')") or die ($this->con->error());
                echo "<script>alert('Usuario Registrado');window.location.href='index.php?pagina=1';</script>";
            }
            $this->con->close();
            }
   }
   class datosusuario extends conexion{
       public $idusuario;
       public $recorridos;
       public $consulta;
       public $recorridos2;


       public function mostrar($id) {
           $this->idusuario=$id;
           $this->consulta=$this->con->query("SELECT * FROM usuarios WHERE idusuario='$this->idusuario'");
           if($this->recorridos=$this->consulta->fetch_array()){
               ?>
                 <form id="usuario" class="form-group" action="formulariomodificar.php" method="POST">
                     <input type="hidden" name="idusuario" value="<?php echo $this->recorridos['idusuario']; ?>" required="">
                    
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $this->recorridos['nombre']; ?>" required="">
            </div><br>
            <div class="form-group">
                <label>Apellido</label>
                <input type="text" class="form-control" name="apellido" value="<?php echo $this->recorridos['apellido']; ?>" required="">
            </div><br>
            <div class="form-group">
                <label>Dni</label>
                <input type="number" class="form-control" name="dni" value="<?php echo $this->recorridos['dni']; ?>" required="">
            </div><br>
            <div class="form-group">
                <label>Nacimiento</label>
                <input type="date" class="form-control" name="nacimiento" value="<?php echo $this->recorridos['nacimiento']; ?>" required="">
            </div><br>
            <div class="form-group">
                <label>Domicilio</label>
                <input type="text" class="form-control" name="domicilio" value="<?php echo $this->recorridos['domicilio']; ?>" required="">
            </div><br>
            <div class="form-group">
                <label>Localidad</label>
                <input type="text" class="form-control" name="localidad" value="<?php echo $this->recorridos['localidad']; ?>" required="">
            </div><br>
            <div class="form-group">
                <label>Provincia</label>
                <input type="text" class="form-control" name="provincia" value="<?php echo $this->recorridos['provincia']; ?>" required="">
            </div><br>
            <div class="form-group">
                <label>Telefono</label>
                <input type="text" class="form-control" name="telefono" value="<?php echo $this->recorridos['telefono']; ?>" required="">
            </div><br>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo $this->recorridos['email']; ?>" required="">
            </div><br>
            <div class="form-group">
                <label>Sexo</label>
                <input type="text" class="form-control" name="sexo" value="<?php echo $this->recorridos['sexo']; ?>" required="">
            </div><br>
            <div class="form-group">
                <label for="privilegio">Privilegio</label>
                
                <select class="form-control" name="privilegio" required="">
                    <option value="">Seleccionar</option>
                    <option value="3">Cliente</option>
                    <option value="1">Administrador</option>
                    <option value="2">Estandar</option>
                    <option value="4">Empleado</option>
                    <option value="5">Proveedor</option>
                    <option value="6">Limitado</option>
                </select>
                
            </div><br>
            <div>
                <input type="submit" class="btn btn-success" value="Modificar Usuario">
                <a class="btn btn-danger" href="index.php?pagina=1">Cancelar Formulario</a>
            </div>
            
        </form>
                <?php
           }
       }
   }
   /*class modificarus extends conexion{
       public $nombre;
       public $apellido;
       public $dni;
       public $nacimiento;
       public $idusuario;


       public function modus($idus,$nom,$ape,$dn,$nac){
           $this->idusuario=$idus;
           $this->nombre=$nom;
           $this->apellido=$ape;
           $this->dni=$dn;
           $this->nacimiento=$nac;
           
           $this->con->query("UPDATE usuarios SET nombre = '$nom',apellido= '$ape',dni = '$dn',nacimiento = '$nac' WHERE idusuario = '$idus'") or die ($this->con->error());
            
            $this->con->close();
            
            echo "<script>alert('Usuario Modificado');window.location.href='index.php';</script>";
   }
   }*/
   class modificarusuario extends conexion{
       public $nombre;
       public $apellido;
       public $dni;
       public $nacimiento;
       public $idusuario;
       public $domicilio;
       public $localidad;
       public $provincia;
       public $telefono;
       public $email;
       public $sexo;
       public $privilegio;
      


       public function modificar($id,$nom,$ape,$dn,$nac,$dom,$loc,$pro,$tel,$em,$sex,$pri){
           $this->nombre=$nom;
           $this->apellido=$ape;
           $this->dni=$dn;
           $this->nacimiento=$nac;
           $this->idusuario=$id;
           $this->domicilio=$dom;
           $this->localidad=$loc;
           $this->provincia=$pro;
           $this->telefono=$tel;
           $this->email=$em;
           $this->sexo=$sex;
           $this->privilegio=$pri;
           
           
           $this->con->query("UPDATE usuarios SET nombre='$this->nombre',apellido='$this->apellido',dni='$this->dni',nacimiento='$this->nacimiento',domicilio='$this->domicilio',localidad='$this->localidad',provincia='$this->provincia',telefono='$this->telefono',email='$this->email',sexo='$this->sexo',privilegio='$this->privilegio'WHERE idusuario=$this->idusuario ") or die ($this->con->error());
            
            $this->con->close();
            
            echo "<script>alert('Usuario Modificado');window.location.href='index.php?pagina=1';</script>";
   }
   }
   class eliminarusuario extends conexion{
       public $idusuario;
       
       public function eliminar($id){
           $this->idusuario=$id;
           $this->con->query("DELETE FROM usuarios WHERE idusuario='$this->idusuario'");
           $this->con->close();
           echo "<script>alert('Usuario Eliminado');window.location.href='index.php?pagina=1';</script>";
       }
       
       
   }
   
   
?>

