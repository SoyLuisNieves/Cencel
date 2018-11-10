<?php 
require_once("mysql.php");

class Proveedor extends Mysql{

    public function new_proveedor(){
       echo $sql = 'INSERT INTO proveedores(proveedor, direccion, telefono,sitio, status) VALUES ("'.strtoupper($_POST['proveedor']).'","'.strtoupper($_POST['direccion']).'","'.$_POST['telefono'].'","'.$_POST['sitio'].'",'.$_POST['status'].');';
        return $this->query($sql);
    }



    public function new_departamentos_proveedores(){
        echo $sql = 'INSERT INTO departamentos_proveedores(id_departamento,id_proveedor) VALUES ('.$_POST['id_departamento'].','.$_POST['id_proveedor'].');';
        return $this->query($sql);
    }

    // No me quedo :(
    public function new_depa_prov(){
        echo $sql1 ='INSERT INTO proveedores(clave_prov,proveedor, direccion,telefono,telefono2,sitio,status) VALUES ("'.$_POST['clave'].'","'.$_POST['proveedor'].'","'.$_POST['direccion'].'","'.$_POST['telefono'].'","'.$_POST['telefono2'].'","'.$_POST['sitio'].'",'.$_POST['status'].');';

            echo $res1 = $this ->query($sql1);       
                echo $sql='INSERT INTO departamentos_proveedores(id_departamento,id_proveedor) VALUES ('.$_POST['id_departamento'].','.$this->lastInsertId().'); ';          
            
            return $this->query($sql);
    }

    public function get_proveedor(){
            $sql = "SELECT * from proveedores WHERE id_proveedor=".$_POST['act_proveedor'];
            return $this->query($sql);
        }


    public function upt_proveedor(){
            echo $sql = "UPDATE `cencel`.`proveedores` SET `clave` = '".$_POST['clave']."',`proveedor` = '".$_POST['proveedor']."',`direccion` = '".$_POST['direccion']."',`telefono` = '".$_POST['telefono']."', `sitio`='".$_POST['sitio']."',`status` = '".$_POST['status']."' WHERE `proveedores`.`id_proveedor` = ".$_POST['id_proveedor'];
            return $this->query($sql);
        }
     public function proveedor_activo(){
            $sql = "UPDATE `proveedores` SET `status` = 1 WHERE `proveedores`.`id_proveedor` = ".$_POST['open'];
            return $this->query($sql);
        }
        public function proveedor_inactivo(){
            $sql = "UPDATE `proveedores` SET `status` = 0 WHERE `proveedores`.`id_proveedor` = ".$_POST['lock'];
            return $this->query($sql);
        }

     public function update_proveedor($datos,$id_proveedor){
        echo $sql = "UPDATE cencel.usuarios"
                . " set "
                . "proveedor = '{$datos['proveedor']}', "
                . "direccion = '{$datos['direccion']}', "
                . "telefono1 = '{$datos['telefono1']}', "
                . "email = '{$datos['email']}', "
                . "sitio = '{$datos['sitio']}', "
                . "status = '{$datos['status']}' "
                . "where id_usuario = {$id_user}; ";
        return $this->query($sql);
     }

    public function get_proveedores(){
    	$sql = "SELECT * from proveedores";
    	return $this->query($sql);
    }

    public function get_by_id($id){
        $sql = "SELECT * from proveedores "
                . "where id_proveedor = {$id};";
        return $this->query($sql);
    }

    public function search($data){
           echo $sql = "select * from cencel.proveedores where proveedor like '%{$data}%';";
        return $this->query($sql);
    }
    public function  new_liga_proveedor(){
       $sql = 'INSERT INTO departamentos_proveedores(id_departamento,id_proveedor) VALUES ('.$_POST['cat'].','.$_POST['proveedor'].')';
        return $this->query($sql);

    }
    public function  get_prov_prod(){
       $sql = 'SELECT * FROM departamentos_proveedores,proveedores,departamentos WHERE departamentos_proveedores.id_departamento=departamentos.id_departamento and proveedores.id_proveedor=departamentos_proveedores.id_proveedor';
        return $this->query($sql);

    }

     public function  delete_prov_prod(){
       $sql = 'DELETE FROM `departamentos_proveedores` WHERE `id_departamento` = '.$_POST['id_prod'].' AND `id_proveedor` = '.$_POST['id_prov'];
        return $this->query($sql);

    }
    
}
?>