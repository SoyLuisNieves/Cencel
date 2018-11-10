<?php 
require_once("mysql.php");

class Departamento extends Mysql{

    public function new_departamento(){
       echo $sql = 'INSERT INTO departamentos(id_departamento,departamento, status) VALUES ("'.$_POST['departamentos'].'",'.$_POST['status'].');';
        return $this->query($sql);
    }


    public function get_departamento(){
            $sql = "SELECT * from departamento WHERE id_departamento=".$_POST['act_departamento'];
            return $this->query($sql);
        }


    public function upt_departamento(){
            echo $sql = "UPDATE `cencel`.`departamentos` SET `departamento` = '".$_POST['departamento']."',`status` = '".$_POST['status']."' WHERE `departamentos`.`id_departamento` = ".$_POST['id_departamento'];
            return $this->query($sql);
        }


    public function get_departamentos(){
    	echo $sql = "SELECT * from departamentos";
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

    
}
?>