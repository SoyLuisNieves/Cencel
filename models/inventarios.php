<?php 
require_once("mysql.php");
	class Inventarios extends Mysql{
		public function get_productos(){
			$sql = "SELECT * from productos,catalogos_productos,catalogos WHERE catalogos_productos.id_catalogo=catalogos.id_catalogo and catalogos_productos.cve=productos.cve and catalogos.id_catalogo=".$_POST['subcat'];
			return $this->query($sql);
		}
		public function get_productos_dep(){
			$sql = "SELECT * from productos,catalogos_productos,departamentos_catalogos WHERE departamentos_catalogos.id_catalogo=catalogos_productos.id_catalogo and catalogos_productos.cve=productos.cve and id_departamento=".$_POST['cat'];
			return $this->query($sql);
		}
		/*public function get_productos_marca(){
		echo	$sql = "SELECT * from productos,catalogos_productos,catalogos WHERE catalogos_productos.id_catalogo=catalogos.id_catalogo and catalogos_productos.cve=productos.cve and marca='".$_POST['marca']."' and catalogos_productos.id_catalogo=".$_POST['subcat'];
			return $this->query($sql);
		}*/
		public function get_productos_m(){
			if ($_POST['marca']=="todos") {
				$sql = "select * from productos,catalogos_productos,almacenes_productos where almacenes_productos.cve=productos.cve and catalogos_productos.cve=productos.cve and status=1 and id_catalogo=".$_POST['subcat']." GROUP BY productos.cve";
			}else{
				$sql = 'select * from productos,catalogos_productos,almacenes_productos where almacenes_productos.cve=productos.cve and catalogos_productos.cve=productos.cve and status=1 and id_catalogo='.$_POST['subcat'].' and marca="'.$_POST['marca'].'" GROUP BY productos.cve';
			}
			return $this->query($sql);
		}
		public function get_productos_stock($cve){
			$sql = "SELECT * from productos,almacenes_productos WHERE productos.cve=almacenes_productos.cve and productos.cve='".$cve."'";
			return $this->query($sql);
		}
		public function get_series(){
			$sql = "SELECT tipo from productos,catalogos_productos,catalogos WHERE catalogos_productos.id_catalogo=catalogos.id_catalogo and catalogos_productos.cve=productos.cve and (tipo=1 or tipo=2) and catalogos.id_catalogo=".$_POST['subcat'];
			return $this->query($sql);
		}
		public function get_catalogo(){
			$sql = "SELECT * from catalogos,productos,catalogos_productos,almacenes_productos WHERE catalogos.id_catalogo=catalogos_productos.id_catalogo and productos.cve=catalogos_productos.cve and productos.cve=almacenes_productos.cve and almacenes_productos.id_almacen=".$_POST['almacen']." GROUP BY catalogos.catalogo";
			return $this->query($sql);
		}
		public function get_stock_almacen($id){
			$sql = "SELECT * from catalogos,productos,catalogos_productos,almacenes_productos WHERE catalogos.id_catalogo=catalogos_productos.id_catalogo and productos.cve=catalogos_productos.cve and productos.cve=almacenes_productos.cve and catalogos.id_catalogo=".$id;
			return $this->query($sql);
		}
		//======PARA_OBTENER_DATOS_INVENTARIO_GLOBAL
		public function get_inventario(){
			$sql = "SELECT * from catalogos";
			return $this->query($sql);
		}
		public function get_almacen(){
			$sql = "SELECT * from almacenes";
			return $this->query($sql);
		}
		public function get_catalogo_global(){
			$sql = "SELECT * from catalogos";
			return $this->query($sql);
		}

		//=========Cantidades
		public function get_(){
			$sql = "SELECT * from almacenes";
			return $this->query($sql);
		}

	}	
 ?>
