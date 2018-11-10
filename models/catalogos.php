<?php 
require_once("mysql.php");

class Catalogo extends Mysql{

    public function new_catalogo(){
       echo $sql = 'INSERT INTO catalogos(id_catalogo,catalogo, status) VALUES ("'.strtoupper($_POST['catalogos']).'",'.$_POST['status'].');';
        return $this->query($sql);
    }


    public function get_catalogo(){
            $sql = "SELECT * from catalogos WHERE id_catalogo=".$_POST['act_catalogo'];
            return $this->query($sql);
        }


    public function upt_catalogo(){
            echo $sql = "UPDATE `cencel`.`catalogos` SET `catalogo` = '".$_POST['catalogo']."',`status` = '".$_POST['status']."' WHERE `catalogos`.`id_catalogo` = ".$_POST['id_catalogo'];
            return $this->query($sql);
        }


    public function get_catalogos(){
    	echo $sql = "SELECT * from catalogos";
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