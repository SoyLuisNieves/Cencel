<?php 
require_once("mysql.php");
	class Producto extends Mysql{

		//------------------ querys para ingresar productos al stock con factura ------------------
		public function get_productos(){
			$sql = "SELECT * from productos,catalogos_productos WHERE productos.cve=catalogos_productos.cve and  status=1 and id_catalogo=".$_POST['subcat'];
			return $this->query($sql);
		}
		public function get_producto_id(){
			$sql = 'SELECT * FROM productos WHERE cve ="'.$_POST['clave'].'" AND status=1';
			return $this->query($sql);
		}
		public function get_proveedores(){
			$sql = 'SELECT * FROM proveedores,departamentos_proveedores where departamentos_proveedores.id_proveedor=proveedores.id_proveedor and status=1 and id_departamento='.$_POST['cat'];
			return $this->query($sql);
		}

		//obtener proveedor por id
		public function get_proveedor_id(){
			$sql = 'SELECT * FROM proveedores WHERE id_proveedor='.$_POST['subpro'].' AND status=1';
			return $this->query($sql);
		}
		//obtener factura por no. de factura
		public function get_factura(){
			$sql= 'SELECT * FROM facturas WHERE n_factura='.$_POST['factura'];
			return $this->query($sql);
		}

		//obtener departamento por id
		public function get_depto_id(){
			$sql = 'SELECT * from departamentos where id_departamento='.$_POST['cat'].' AND status=1';
			return $this->query($sql);
		}
		//obtener categoria por id
		public function get_categoria_id(){
			$sql = 'SELECT * from catalogos WHERE id_catalogo='.$_POST['subcat'].' AND status=1';
			return $this->query($sql);
		}
		//registra los productos de una factura
		public function insert_productos($productos){
			$sql ='INSERT INTO facturas (n_factura,fecha_factura,id_proveedor,monto) VALUES ("'.$_POST['factura'].'","'.$_POST['fecha_facturacion'].'","'.$_POST['subpro'].'",'.$_POST['monto'].')';
			$resul= $this->query($sql);
			$id_factura=$this->lastInsertId();
			for ($i=0; $i < count($productos); $i++) { 
				//ingresa las cantidades de productos de una factura
				$sql ='SELECT * FROM almacenes WHERE id_almacen="'.$_SESSION['id_almacen'].'"';
				$resul4= $this->query($sql);
				$rowa=mysqli_fetch_array($resul4);
				$sql2 = 'INSERT INTO productos_cantidades (id_factura,cve,clave,cant_ingresada) VALUES ('.$id_factura.',"'.$productos[$i][0].'","'.$rowa['clave'].'",'.$productos[$i][3].')';
				$resul= $this->query($sql2);

				//consulta si exite el producto en el almacen
				$sql ='SELECT * FROM almacenes_productos WHERE cve="'.$productos[$i][0].'"';
			    $resul= $this->query($sql);
			    if ($row=mysqli_fetch_array($resul)) {
			    	$stock_total = $row['stock']+$productos[$i][3];
					$sql='UPDATE almacenes_productos SET stock = '.$stock_total.' WHERE cve ="'.$productos[$i][0].'"';
					$resul=$this->query($sql);
			    }else{
			    	$sql= 'SELECT * FROM almacenes WHERE id_almacen="'.$_SESSION['id_almacen'].'"';
			    	$resul=$this->query($sql);
					$row=mysqli_fetch_array($resul);
			    	$sql='INSERT INTO almacenes_productos (id_almacen,cve,stock) VALUES ('.$row['id_almacen'].',"'.$productos[$i][0].'",'.$productos[$i][3].')';
					$resul=$this->query($sql);
			    }
			}
		}

		//----------------- querys de capturar series o por bloques----------------------
		public function get_almacen_central(){
			$sql= 'SELECT * FROM almacenes WHERE id_almacen="'.$_SESSION['id_almacen'].'"';
			return $this->query($sql);
		}
		//obtener las facturas
		public function get_facturas(){
			$sql= 'SELECT * FROM facturas';
			return $this->query($sql);
		}
		public function get_casados($id_factura){
			$sql='SELECT count(cve) FROM productos_series WHERE cve="'.$_POST['clave'].'" AND id_factura='.$id_factura;
			return $this->query($sql);
		}

		//obtener el numero de productos de una factura
		public function get_productos_fac(){
			$sql = 'SELECT * FROM facturas WHERE n_factura="'.$_POST['factura'].'"';
			$resul=$this->query($sql);
			$row=mysqli_fetch_array($resul);
			$sql='SELECT cve,cant_ingresada FROM productos_cantidades WHERE cve="'.$_POST['clave'].'" AND  id_factura='.$row['id_factura'];
			return $this->query($sql);
		}

		public function get_factura_prod(){
			$sql = 'SELECT * FROM facturas WHERE n_factura="'.$_POST['factura'].'"';
			$resul=$this->query($sql);
			$row=mysqli_fetch_array($resul);
			$sql='SELECT productos.cve,productos.catalogo FROM  facturas,productos_cantidades,productos WHERE facturas.id_factura=productos_cantidades.id_factura 
			AND productos.cve=productos_cantidades.cve
			AND facturas.id_factura='.$row['id_factura'];
			return $this->query($sql);
		}
		public function get_catalogo_serie($tipo){
			$sql = 'SELECT * FROM catalogos WHERE catalogo="'.$tipo.'"';
			return $this->query($sql);
		}
		//el id_factura se obtiene del get_factura()
		//el valor de $almacen se obtiene con la funcion get_almacen_central

		//ingresa el imei y el iccid de los equipos que poseen una serie
		public function insert_casar($id_factura,$almacen){
			$sql='INSERT INTO productos_series (id_factura,cve,clave,imei,iccid,fecha_activacion) VALUES ('.$id_factura.',"'.$_POST['clave'].'","'.$almacen.'","'.$_POST['imei'].'","'.$_POST['iccid'].'","'.date("Y-m-d").'")';
			$resul=$this->query($sql);
		}
		//ingresa el iccid por blockes
		public function insert_serie($id_factura,$almacen,$serie){
		echo	$sql='INSERT INTO productos_series (id_factura,cve,clave,iccid) VALUES ('.$id_factura.',"'.$_POST['clave'].'","'.$almacen.'","'.$_POST['iccids']."".$serie.'")';
			$resul=$this->query($sql);
		}

		//ingresa el iccid individual
		public function insert_serie_ind($id_factura,$almacen){
			$sql='INSERT INTO productos_series (id_factura,cve,clave,iccid,fecha_activacion) VALUES ('.$id_factura.',"'.$_POST['clave'].'","'.$almacen.'","'.$_POST['iccid'].'","'.date("Y-m-d").'")';
			$resul=$this->query($sql);
		}
		//obtener producto serie
		public function get_catalogos(){
			$sql='SELECT * FROM catalogos WHERE tipo=1 or tipo=2';
			return $this->query($sql);
		}
		//obtener el imei
		public function get_imei(){
			$sql='SELECT * FROM productos_series WHERE imei!=""';
			return $this->query($sql);
		}
		//obtener el iccid
		public function get_iccid(){
			$sql='SELECT * FROM productos_series WHERE iccid!=""';
			return $this->query($sql);
		}
		//busqueda de considencias
		public function get_considencias_iccid(){
			$sql='SELECT * FROM productos_series,facturas,catalogos,catalogos_productos WHERE productos_series.cve=catalogos_productos.cve and catalogos_productos.id_catalogo=catalogos.id_catalogo and productos_series.id_factura=facturas.id_factura and tipo="'.$_POST['tipo'].'" and  iccid LIKE "%'.$_POST['iccid'].'%"';
			return $this->query($sql);
		}

		public function get_considencias_imei(){
			$sql = 'SELECT * FROM productos_series,facturas WHERE productos_series.id_factura=facturas.id_factura and imei LIKE "%'.$_POST['imei'].'%"';
			return $this->query($sql);
		}

		//busqueda de productos_series_IMEI
		public function get_imei_editar(){
			$sql='SELECT * FROM productos_series,facturas,catalogos,catalogos_productos WHERE productos_series.id_factura=facturas.id_factura and productos_series.cve=catalogos_productos.cve and catalogos.id_catalogo=catalogos_productos.id_catalogo and imei="'.$_POST['editarimei'].'"';
			return $this->query($sql);
		}
		public function get_iccid_editar(){
			$sql='SELECT * FROM productos_series,facturas,catalogos,catalogos_productos WHERE productos_series.id_factura=facturas.id_factura and productos_series.cve=catalogos_productos.cve and catalogos.id_catalogo=catalogos_productos.id_catalogo and iccid="'.$_POST['editariccid'].'"' ;
			return $this->query($sql);
		}

		//Actualizar de productos_series_IMEI
		public function udp_imei_editar(){
			$sql='UPDATE `productos_series` SET `imei` = "'.$_POST['imei'].'",
			`iccid` = "'.$_POST['iccid'].'",
			`n_telefono` = "'.$_POST['num_tel'].'",
			`fecha_activacion` = "'.$_POST['fecha_activacion'].'",
			`folio` = "'.$_POST['folio'].'",
			`vendido` = "'.$_POST['venta'].'",
			`observaciones` = "'.$_POST['observaciones'].'" WHERE imei='.$_POST['imei_id'] ;
			return $this->query($sql);
		}
		public function udp_iccid_editar(){
			$sql='UPDATE `productos_series` SET `imei` = "'.$_POST['imei'].'",
			`iccid` = "'.$_POST['iccid'].'",
			`n_telefono` = "'.$_POST['num_tel'].'",
			`fecha_activacion` = "'.$_POST['fecha_activacion'].'",
			`folio` = "'.$_POST['folio'].'",
			`vendido` = "'.$_POST['venta'].'",
			`observaciones` = "'.$_POST['observaciones'].'" WHERE iccid="'.$_POST['iccid_id'].'"' ;
			return $this->query($sql);
		}
	}	
 ?>
