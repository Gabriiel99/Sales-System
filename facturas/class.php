<?php
include '../conexion.php';

class mostrarfacturas extends conexion{
       public $consulta;
       public $recorridos;

       public function resultado(){
           $this->consulta=$this->con->query("SELECT facturas.*, usuarios.* FROM usuarios "
                . "INNER JOIN facturas ON usuarios.idusuario=facturas.idcliente");
           while($this->recorridos=$this->consulta->fetch_array()){
               ?>
               <tr>
                    <td><?php echo $this->recorridos["idfactura"]; ?></td>
                    <td><?php echo $this->recorridos["nombre"]; ?> <?php echo $this->recorridos["apellido"]; ?></td>
                    <td><?php echo $this->recorridos["totalventa"]; ?></td>
                    <td><?php echo $this->recorridos["condicionventa"]; ?></td>
                    <td><?php echo $this->recorridos["comprobantetarjeta"]; ?></td>
                    <td><?php echo $this->recorridos["fechaventa"]; ?></td>  
                </tr>
               <?php
           }
       }
       
   }

?>

