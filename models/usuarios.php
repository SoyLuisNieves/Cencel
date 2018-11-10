<?php 
require_once("mysql.php");

class Usuario extends Mysql{

	 public function new_user(){
            echo $sql = 'INSERT INTO usuarios(nombre,ape_pat, ape_mat, fecha_nac, direccion, poblacion, codigo_postal, telefono1, telefono2, email, rfc, login, pass, perfil, precio_asignado, almacen, tipo_cliente, status) VALUES ("'.strtoupper($_POST['nombre']).'","'.strtoupper($_POST['ape_pat']).'","'.strtoupper($_POST['ape_mat']).'","'.$_POST['fecha_nac'].'","'.strtoupper($_POST['direccion']).'","'.strtoupper($_POST['poblacion']).'","'.$_POST['codigo_postal'].'","'.$_POST['telefono1'].'","'.$_POST['telefono2'].'","'.$_POST['email'].'","'.strtoupper($_POST['rfc']).'","'.$_POST['login'].'","'.$_POST['pass'].'","'.$_POST['perfil'].'","'.$_POST['precio_asignado'].'","'.$_POST['almacen'].'","'.$_POST['tipo_cliente'].'",1)';
            return $this->query($sql);
    }

    public function get_userslogin(){
        $sql = "SELECT login from usuarios";
            return $this->query($sql);
    }
    public function get_users(){
        $sql = "SELECT * from usuarios where status = 1";
            return $this->query($sql);
    }

    public function block_user(){
        echo $sql = "UPDATE `cencel`.`usuarios` set status = 0 WHERE `usuarios`.`id_usuario` = ".$_POST['bloq_usuario']."";
            return $this->query($sql);

    }
    
    public function unlock_user(){
        echo $sql = "UPDATE `cencel`.`usuarios` set status = 1 WHERE `usuarios`.`id_usuario` = ".$_POST['id_usuario']."";
            return $this->query($sql);
        
    }

    public function get_user(){
            $sql = "SELECT * from usuarios WHERE id_usuario=".$_POST['act_usuario'];
            return $this->query($sql);
        }


    public function upt_user(){
            echo $sql = "UPDATE `cencel`.`usuarios` SET `nombre` = '".strtoupper($_POST['nombre'])."',`ape_pat` = '".strtoupper($_POST['ape_pat'])."',`ape_mat` = '".strtoupper($_POST['ape_mat'])."',`fecha_nac` = '".strtoupper($_POST['fecha_nac'])."',`direccion` = '".strtoupper($_POST['direccion'])."',`poblacion` = '".strtoupper($_POST['poblacion'])."',`codigo_postal` = '".$_POST['codigo_postal']."',`telefono1` = '".$_POST['telefono1']."', `telefono2` = '".$_POST['telefono2']."' ,`email` = '".$_POST['email']."',`rfc`='".strtoupper($_POST['rfc'])."',`login`='".$_POST['login']."',`pass`='".$_POST['perfil']."',`precio_asignado`='".$_POST['precio_asignado']."',`almacen`='".$_POST['almacen']."',`tipo_cliente`='".$_POST['tipo_cliente']."' WHERE `usuarios`.`id_usuario` = ".$_POST['id_usuario'];
            return $this->query($sql);
        }


     public function update_user($datos,$id_user){
        echo $sql = "UPDATE cencel.usuarios"
                . " set "
                . "nombre = '{$datos['nombre']}', "
                . "direccion = '{$datos['direccion']}', "
                . "poblacion = '{$datos['poblacion']}', "
                . "codigo_postal = '{$datos['codigo_postal']}', "
                . "telefono1 = '{$datos['telefono1']}', "
                . "telefono2 = '{$datos['telefono2']}', "
                . "email = '{$datos['email']}', "
                . "rfc = '{$datos['rfc']}', "
                . "precio_asignado = '{$datos['precio_asignado']}', "
                . "almacen = '{$datos['almacen']}', "
                . "tipo_cliente = '{$datos['tipo_cliente']}' "
                . "where id_usuario = {$id_user}; ";
        return $this->query($sql);
     }
     public function update_login($datos, $id_user){
        echo $sql = "UPDATE cencel.usuarios"
                    . " set "
                    ."login = '{$datos['login']}', "
                    ."pass = '{$datos['pass']}', "
                    ."perfil = '{$datos['perfil']}'"
                    ."where id_usuario = {$id_user}; ";
        return $this->query($sql);

     }

    public function get_emails(){
        echo $sql = "SELECT email FROM usuarios";
        return $this->query($sql);
    }

    public function get_by_id($id){
        $sql = "SELECT * from usuarios "
                . "where id_usuario = {$id};";
        return $this->query($sql);
    }

    public function search($data){
           echo $sql = "select * from cencel.usuarios where nombre like '%{$data}%';";
        return $this->query($sql);
    }
    
}
?>