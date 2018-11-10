<?php 
require_once("mysql.php");
	class Almacen extends Mysql{
		public function get_almacenes(){
			$sql = "SELECT * from almacenes WHERE status=1";
			return $this->query($sql);
		}

		public function new_almacen(){
			$sql ='INSERT INTO almacenes(clave,almacen,direccion,contacto,telefono1,telefono2,status) VALUES ("'.$_POST['clave'].'","'.$_POST['almacen'].'","'.$_POST['direccion'].'","'.$_POST['contacto'].'","'.$_POST['tel1'].'","'.$_POST['tel2'].'",1)';
			return $this->query($sql);
		}

		public function get_almacen(){
			$sql = "SELECT * from almacenes WHERE id_almacen=".$_POST['act_alm'];
			return $this->query($sql);
		}
		public function get_almacen_s(){ 		
			$sql = "SELECT * from almacenes where id_almacen='".$_POST['almacen']."'";
			return $this->query($sql);
		}
		public function get_almacen_sel(){ 		
			$sql = "SELECT almacen from almacenes where almacen='".$_POST['almacen']."'";
			return $this->query($sql);
		}


		public function upt_almacen(){
			$sql = "UPDATE `cencel`.`almacenes` SET `clave` = '".$_POST['clave']."',`almacen` = '".$_POST['almacen']."',`direccion` = '".$_POST['direccion']."',`contacto` = '".$_POST['contacto']."',`telefono1` = '".$_POST['tel1']."',`telefono2` = '".$_POST['tel2']."',`status` = 1 WHERE `almacenes`.`id_almacen` =".$_POST['id'];
			return $this->query($sql);
		}

		public function del_almacen(){
			$sql = "UPDATE `almacenes` SET `status` = '0' WHERE `almacenes`.`id_almacen` =".$_POST['delete'];
			return $this->query($sql);
		}

		public function get_almacenes_in(){
			$sql = "SELECT * from almacenes WHERE status=0";
			return $this->query($sql);
		}
		public function act_almacen(){
			$sql = "UPDATE `almacenes` SET `status` = '1' WHERE `almacenes`.`id_almacen` =".$_POST['activar_alm'];
			return $this->query($sql);
		}

		// SECCIÓN PARA DEPARTAMENTO / CATEGORIAS

		public function get_categorias(){
			$sql = "SELECT * from catalogos,departamentos,departamentos_catalogos WHERE departamentos.id_departamento=departamentos_catalogos.id_departamento and departamentos_catalogos.id_catalogo=catalogos.id_catalogo and catalogos.status=1 and departamentos.status=1";
			return $this->query($sql);
		}
		public function get_departamentos(){
			$sql = "SELECT * from departamentos WHERE departamentos.status=1";
			return $this->query($sql);
		}
		public function get_dep_cat($id){
			$sql = "SELECT count(catalogo) as num,departamentos.id_departamento,departamentos.status from catalogos,departamentos,departamentos_catalogos WHERE departamentos.id_departamento=departamentos_catalogos.id_departamento and departamentos_catalogos.id_catalogo=catalogos.id_catalogo and catalogos.status=1 and departamentos.id_departamento=".$id;
			return $this->query($sql);
		}
		public function get_depto(){//get_categorias
			$sql = "SELECT * from departamentos where status=1";
			return $this->query($sql);
		}
		public function get_depto_alm(){//get_categorias
			$sql = "SELECT * from departamentos,almacenes_productos,departamentos_catalogos,catalogos_productos where almacenes_productos.cve=catalogos_productos.cve and departamentos_catalogos.id_catalogo=catalogos_productos.id_catalogo and departamentos_catalogos.id_departamento=departamentos.id_departamento and status=1 and id_almacen=".$_POST['almacen']." GROUP BY departamento";
			return $this->query($sql);
		}

		public function get_dep(){//get_cat
			$sql = "SELECT * from departamentos WHERE id_departamento=".$_POST['act_depto'];
			return $this->query($sql);
		}
		public function get_catalog(){//get_cat
			$sql = "SELECT * from catalogos,departamentos,departamentos_catalogos WHERE departamentos.id_departamento=departamentos_catalogos.id_departamento and departamentos_catalogos.id_catalogo=catalogos.id_catalogo and catalogos.id_catalogo=".$_POST['act_catalog'];
			return $this->query($sql);
		}
		//NUEVA
		public function new_categoria(){
			if ($_POST['nivel']==1) {
				$sql ='INSERT INTO departamentos(departamento,status) VALUES ("'.$_POST['categoria'].'",1)';
			}elseif ($_POST['nivel']==2) {
				$sql1 ='INSERT INTO catalogos(catalogo,tipo,status) VALUES ("'.$_POST['categoria'].'","'.$_POST['tipo'].'",1)';
				$res1 = $this ->query($sql1);	
				$sql='INSERT INTO departamentos_catalogos(id_departamento,id_catalogo) VALUES ('.$_POST['cat'].','.$this->lastInsertId().') ';			
			}
			return $this->query($sql);
		}

		//ACTUALIZAR
		public function upd_depto(){
			$sql = "UPDATE `departamentos` SET `departamento` = '".$_POST['categoria']."' WHERE `departamentos`.`id_departamento` =".$_POST['id'];
			return $this->query($sql);
		}
		public function upd_catalogo(){
			$sql = "UPDATE `catalogos` SET `catalogo` = '".$_POST['categoria']."',`tipo` = '".$_POST['tipo']."' WHERE `id_catalogo` =".$_POST['id'];
			return $this->query($sql);
		} public function upd_catalogo_dep(){
			$sql = "UPDATE `departamentos_catalogos` SET `id_departamento` = '".$_POST['cat']."' WHERE `id_catalogo` =".$_POST['id'];
			return $this->query($sql);
			}
		//ELIMINAR
		public function del_depto(){
			$sql = "UPDATE `departamentos` SET `status` = '0' WHERE `id_departamento` =".$_POST['del_depto'];
			return $this->query($sql);
		}
		public function del_cat(){
			$sql = "UPDATE `catalogos` SET `status` = '0' WHERE `id_catalogo` =".$_POST['del_catalog'];
			return $this->query($sql);
		}

//Obtener ctegoria de productos para actualizar
		public function get_categoria_prod(){
			$sql = "SELECT * from productos,catalogos,catalogos_productos where productos.cve= catalogos_productos.cve AND catalogos.id_catalogo=catalogos_productos.id_catalogo AND catalogos_productos.cve='".$_POST['actualizar']."'";
			return $this->query($sql);
		}
		public function get_dep_prod(){
			$sql = "SELECT * from departamentos,departamentos_catalogos,catalogos_productos where departamentos_catalogos.id_catalogo=catalogos_productos.id_catalogo and departamentos.id_departamento=departamentos_catalogos.id_departamento and catalogos_productos.cve='".$_POST['actualizar']."'";
			return $this->query($sql);
		}




//Consulta para obtener catalogos dependiente del departamento
		public function get_categorias_dep(){
			$sql = "select * from catalogos,departamentos_catalogos where departamentos_catalogos.id_catalogo=catalogos.id_catalogo and id_departamento=".$_POST['cat'];
			return $this->query($sql);
		}
		public function get_categorias_sel(){
			$sql = "select id_departamento,departamento from departamentos where id_departamento=".$_POST['cat'];
			return $this->query($sql);
		}



		

		//SECCIÓN DE PRODUCTOS
		public function get_productos(){
			$sql = "SELECT * from productos,catalogos_productos where status=1 and productos.cve=catalogos_productos.cve and id_catalogo='".$_POST['subcat']."'";
			return $this->query($sql);
		}
		public function get_productos_dep(){
			$sql = "SELECT * from productos,catalogos_productos,departamentos_catalogos where status=1 and productos.cve=catalogos_productos.cve and catalogos_productos.id_catalogo=departamentos_catalogos.id_catalogo and id_departamento='".$_POST['cat']."'";
			return $this->query($sql);
		}
		public function get_productos_all(){
			$sql = "SELECT * from productos where status=1";
			return $this->query($sql);
		}
		public function get_producto(){
			$sql = "SELECT * from productos where cve='".$_POST['actualizar']."'";
			return $this->query($sql);
		}
		public function reg_cat(){
			$sql ='SELECT catalogo from catalogos where id_catalogo='.$_POST['sub'];
			return $this->query($sql);
		}
		public function reg_dep(){
			$sql ='SELECT departamento from departamentos_catalogos,departamentos where departamentos_catalogos.id_departamento=departamentos.id_departamento and id_catalogo='.$_POST['sub'];
			return $this->query($sql);
		}
		public function new_producto($cat){
			$sql ='INSERT INTO productos(cve,departamento,catalogo,clase,proveedor,marca,modelo,color,tamano,co,ma,mm,ds,mb,pb,status) VALUES ("'.$_POST['clave'].'","'.$_POST['cat'].'","'.$cat.'","'.$_POST['clase'].'" , "'.$_POST['proveedor'].'" ,"'.$_POST['marca'].'","'.$_POST['modelo'].'","'.$_POST['color'].'","'.$_POST['tamano'].'","'.$_POST['co'].'","'.$_POST['ma'].'","'.$_POST['mm'].'","'.$_POST['ds'].'","'.$_POST['mb'].'","'.$_POST['pb'].'",1)';
			$res1 = $this ->query($sql);

			$sql ='INSERT INTO catalogos_productos(id_catalogo,cve) VALUES ('.$_POST['sub'].',"'.$_POST['clave'].'")';
			return $this->query($sql);
		}

		public function upd_prod($cat){
			$sql = "UPDATE `productos` SET `cve` = '".$_POST['clave']."',`departamento` = '".$_POST['cat']."',`catalogo` = '".$cat."',`proveedor`='".$_POST['proveedor']."',`marca` = '".$_POST['marca']."',`modelo` = '".$_POST['modelo']."',`color` = '".$_POST['color']."',`tamano` = '".$_POST['tamano']."',`co` = '".$_POST['co']."',`ma` = '".$_POST['ma']."',`mm` = '".$_POST['mm']."',`ds` = '".$_POST['ds']."',`mb` = '".$_POST['mb']."',`pb` = '".$_POST['pb']."',`clase` = '".$_POST['clase']."',`status` = '1' WHERE `cve` ='".$_POST['id']."'";
			$res = $this->query($sql);
			$sql ="UPDATE `catalogos_productos` SET `id_catalogo` = '".$_POST['sub']."' WHERE `cve` ='".$_POST['id']."'";
			return $this->query($sql);

		}
		public function del_prod(){
			$sql = "UPDATE `productos` SET `status` = '0' WHERE `cve` ='".$_POST['delete']."'";
			return $this->query($sql);
		}
		
	}	
 ?>
