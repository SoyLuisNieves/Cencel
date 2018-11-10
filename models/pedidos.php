<?php 
require_once("mysql.php");
	class Pedidos extends Mysql{
		//SECCIÓN DE PEDIDOS
		//---------Mostrar productos existentes de acuerdo a producto y costo
		public function get_productos_pedido(){ //sin usar			
			$sql = "select * from productos,catalogos_productos where catalogos_productos.cve=productos.cve and status=1 and id_catalogo=".$_POST['subcat']." ";
			return $this->query($sql);
		}
/*modificado_para_almacen*/		
		public function get_productos_m(){
			if ($_POST['marca']=="todos") {
				$sql = "select * from productos,catalogos_productos,almacenes_productos where almacenes_productos.cve=productos.cve and catalogos_productos.cve=productos.cve and status=1 and id_catalogo=".$_POST['subcat']." and id_almacen=".$_SESSION['id_almacen'];
			}else{
				$sql = 'select * from productos,catalogos_productos,almacenes_productos where almacenes_productos.cve=productos.cve and catalogos_productos.cve=productos.cve and status=1 and id_catalogo='.$_POST['subcat'].' and marca="'.$_POST['marca'].'" and id_almacen='.$_SESSION['id_almacen'];
			}
			return $this->query($sql);
		}
		public function get_marca(){
			$sql = "select marca from productos,catalogos_productos where catalogos_productos.cve=productos.cve and id_catalogo=".$_POST['subcat']." and status=1 GROUP BY marca";
			return $this->query($sql);
		}
/**/		public function get_producto(){
			$sql = "SELECT catalogo from catalogos where id_catalogo=".$_POST['subcat'];
			return $this->query($sql);
		}
		public function get_catalogo_sel(){
			$sql = "select id_catalogo,catalogo from catalogos where id_catalogo=".$_POST['subcat'];
			return $this->query($sql);
		}
		public function get_marca_sel(){
			$sql = "select marca from productos where marca='".$_POST['marca']."' GROUP BY marca";
			return $this->query($sql);
		}
		//---------Mostrar pedidos
		public function get_pedidos_alm(){ 		
			$sql = "SELECT * from pedidos,productos_pedidos,usuarios where pedidos.folio=productos_pedidos.folio and pedidos.id_usuario=usuarios.id_usuario GROUP BY pedidos.folio";
			return $this->query($sql);
		}
		public function get_pedidos_pa(){ 		
			$sql = "SELECT * from pedidos,productos_pedidos,usuarios where pedidos.folio=productos_pedidos.folio and pedidos.id_usuario=usuarios.id_usuario and estado=".$_POST['estado']." GROUP BY pedidos.folio";
			return $this->query($sql);
		}
		//---------Mostrar pedidos_a_editar
		public function get_pedidos_pendiente(){ 		
			$sql = "SELECT * from pedidos,productos_pedidos,usuarios where pedidos.folio=productos_pedidos.folio and pedidos.id_usuario=usuarios.id_usuario and estado=0  GROUP BY pedidos.folio";
			return $this->query($sql);
		}
		public function get_pedidos_alm_sel_pendiente(){ 		
			$sql = "SELECT * from pedidos,productos_pedidos,usuarios where pedidos.folio=productos_pedidos.folio and pedidos.id_usuario=usuarios.id_usuario and estado=0 and almacen='".$_POST['almacen']."' GROUP BY pedidos.folio";
			return $this->query($sql);
		}		
		//---------Mostrar pedidos seleccionado por folio
/*-*/		public function get_pedido_folio(){ 		
			$sql = "SELECT * from productos,productos_pedidos where productos.cve=productos_pedidos.cve and folio =".$_POST['folio'];
			return $this->query($sql);
		}
		public function get_pagos_folio(){ 		
			$sql = "SELECT * from pagos where folio ='".$_POST['pagos']."' OR (folio ='".$_POST['pago']."' and id='".$_POST['bpagos']."') OR folio='".$_POST['folio']."'";
			return $this->query($sql);
		}
		//obtener producto por clave
		public function get_pedido_prod($i){
			$sql = 'SELECT * FROM productos WHERE cve="'.$_SESSION['pedido'][$i][0].'"';
			return $this->query($sql);
		}
		//consultar folios
		public function get_folios(){
			$sql = 'SELECT max(folio) as folio FROM productos_pedidos';
			return $this->query($sql);
		}
		//ingresar pedido a la DB
		public function obtener_folio(){
			return $this->lastInsertId();
		}
		//ingresar pedido a la DB
		public function insert_pedido_prod($folio,$i){
			$sql = 'INSERT INTO productos_pedidos (folio,cve,cant_solicitada) VALUES ('.$folio.',"'.$_SESSION['pedido'][$i][0].'",'.$_SESSION['pedido'][$i][1].')';
			$resul = $this->query($sql);
		}
		//ingresar pedido a la DB
		public function insert_pedido_prod2($folio,$i,$cantidad){
			$precio=$precio*$_SESSION['pedido'][$i][1];
			$sql = 'INSERT INTO productos_pedidos (folio,cve,cant_solicitada) VALUES ('.$folio.',"'.$_SESSION['pedido'][$i][0].'",'.$cantidad.')';
			$resul = $this->query($sql);
		}

		//ingresar pedido a la DB
		public function insert_prod_cant_pedido($i){
			$sql = 'INSERT INTO productos_pedidos (folio,cve,cant_solicitada) VALUES ('.$_SESSION['folio'].',"'.$_SESSION['pedido'][$i][0].'",'.$_SESSION['pedido'][$i][1].')';
			$resul = $this->query($sql);
		}
		//ingresar pedido a la DB
		public function insert_prod_cant_pedido2($i,$cantidad){
			$precio=$precio*$_SESSION['pedido'][$i][1];
			$sql = 'INSERT INTO productos_pedidos (folio,cve,cant_solicitada) VALUES ('.$_SESSION['folio'].',"'.$_SESSION['pedido'][$i][0].'",'.$cantidad.')';
			$resul = $this->query($sql);
		}



		//registrar el folio del pedido el usuario esta estatico
		public function insert_pedido($n_remision){
			$sql = 'INSERT INTO pedidos (id_usuario,n_remision,importe,fecha_inicio,estado,pagado) VALUES('.$_SESSION['id_usuario'].','.$n_remision.','.$_POST['costo_total'].',"'.date("Y-m-d").'",0,0)';
			$resul = $this->query($sql);
		}

		//consultar folios
		public function get_folios_rem(){
		echo	$sql = 'SELECT max(n_remision) as n_remision FROM pedidos WHERE fecha_inicio>="'.date("Y-m-1").'"';
			return $this->query($sql);
		}
		
		//---------Mostrar productos seleccionado por pedido/traspaso
		public function get_productos_series(){ 		
			$sql = "SELECT * from productos,productos_series,catalogos,catalogos_productos where catalogos_productos.id_catalogo=catalogos.id_catalogo and catalogos_productos.cve=productos_series.cve and productos.cve=productos_series.cve and vendido=0 and productos.cve ='".$_POST['clave']."'";
			return $this->query($sql);
		}
		
		//------------------ Mostrar productos aprobados para el pedido con iccid----------------------
		public function get_productos_aprobar_iccid($i){
			$sql = "SELECT *
				FROM productos, productos_series, catalogos, catalogos_productos
				WHERE catalogos_productos.id_catalogo = catalogos.id_catalogo
				AND catalogos_productos.cve = productos_series.cve
				AND productos.cve = productos_series.cve
				AND productos_series.iccid =".$_SESSION['aprobar'][$i];
				return $this->query($sql);
		}

		//-------------Mostrar productos aprobados par imei del pedido-------------------
		public function get_productos_aprobar_imei($i){
			$sql = 'SELECT *
				FROM productos, productos_series, catalogos, catalogos_productos
				WHERE catalogos_productos.id_catalogo = catalogos.id_catalogo
				AND catalogos_productos.cve = productos_series.cve
				AND productos.cve = productos_series.cve
				AND productos_series.imei ='.$_SESSION['aprobar'][$i];
				return $this->query($sql);
		}

		//------------- Obtener la clave del producto
		public function get_poducto_clave_iccid($i){
			echo $sql = 'SELECT cve FROM productos_series WHERE iccid='.$_SESSION['aprobar'][$i];
			return $this->query($sql);
		}

		//------------- Obtener la clave del producto
		public function get_poducto_clave_imei($i){
			echo $sql = 'SELECT cve FROM productos_series WHERE imei='.$_SESSION['aprobar'][$i];
			return $this->query($sql);
		}

		//--------------Obtener la cantidad ya ingresada-----------------
		public function get_cant_asignada($clave){
			$sql = 'SELECT cant_asignada FROM productos_pedidos WHERE folio='.$_SESSION['folio']
			.' AND cve="'.$clave.'"';
			return $this->query($sql);
		}

		//---------Nuevo pago
		public function new_pago(){ 		
			$sql = "INSERT INTO `pagos` (`folio` ,`efectivo` ,`cheque` ,`nota_credito` ,`fecha`)
				VALUES ('".$_POST['folio']."', '".$_POST['efectivo']."', '".$_POST['cheque']."', '".$_POST['nota_credito']."', '".$_POST['fecha']."')";
			return $this->query($sql);
		}
		//---------Actualizar pagos
		public function udp_pagos(){ 		
			$sql = "UPDATE pagos SET efectivo ='".$_POST['efectivo']."', cheque='".$_POST['cheque']."', nota_credito=".$_POST['credito'].",fecha='".$_POST['fecha']."' WHERE folio=".$_POST['folio']." and id=".$_POST['id'];
			return $this->query($sql);
		}
/**/	//---------Numero pagos
		public function pagos_sum(){ 		
			$sql = "SELECT sum(efectivo+cheque+nota_credito) as pago from pagos WHERE folio ='".$_POST['pagos']."' OR folio ='".$_POST['pago']."' OR folio='".$_POST['folio']."'";
			return $this->query($sql);
		}
/**/	//---------Numero pagos
		public function importe(){ 		
			$sql = "SELECT importe from pedidos WHERE folio ='".$_POST['pagos']."' OR folio ='".$_POST['pago']."' OR folio='".$_POST['folio']."'";
			return $this->query($sql);
		}
/**/	//---------Aprobar pedido - PAGADO -
		public function importe_pago(){ 		
			$sql = "UPDATE pedidos SET pagado = '1' WHERE `folio` =".$_POST['folio'];
			return $this->query($sql);
		}
	/**/	//---------Aprobar pedido - PAGADO -
			public function importe_p(){ 		
				$sql = "UPDATE pedidos SET pagado = '0' WHERE `folio` =".$_POST['folio'];
				return $this->query($sql);
			}

		//---------- Actualizar productos series a vendido y agregar folio----------------
		public function update_productos_iccid_ven($i){
			echo $sql = 'UPDATE productos_series SET folio='.$_SESSION['folio']
			.', vendido=1 WHERE iccid="'.$_SESSION['aprobar'][$i].'"';
			$resul= $this->query($sql);
		}

		//---------- Actualizar productos series a vendido y agregar folio----------------
		public function update_productos_imei_ven($i){
			echo $sql = 'UPDATE productos_series SET folio='.$_SESSION['folio']
			.', vendido=1 WHERE imei="'.$_SESSION['aprobar'][$i].'"';
			$resul= $this->query($sql);
		}

		//---------- Actualizar el estado de pedidos y fechas---------------------
		public function update_pedidos(){
			$sql = 'UPDATE pedidos SET fecha_cierre="'.date("Y-m-d").'", fecha_vencimiento="'.$_POST['vencimiento'].'", estado=1 WHERE folio='.$_SESSION['folio'];
			$reul = $this->query($sql);
		}

		//----------Actualizar el stock del los almacenes-------------------
		public function update_almacen_stock($i,$clave){
			$sql = 'SELECT stock FROM almacenes_productos WHERE id_almacen='.$_SESSION['id_almacen']
			.' AND cve="'.$clave.'"';
			$resul = $this->query($sql);
			$row = mysqli_fetch_array($resul);
			$stock = $row['stock']-1;
			echo $sql = 'UPDATE almacenes_productos SET stock='.$stock.' WHERE id_almacen='.$_SESSION['id_almacen']
			.' AND cve="'.$clave.'"';
			$resul = $this->query($sql);
		}

		//---------Actualizar productos pedidos la cantidad asignada------------
		public function update_prod_ped_cantidad($cantidad,$clave){
			echo $sql = 'UPDATE productos_pedidos SET cant_asignada='.$cantidad.' WHERE folio='.$_SESSION['folio']
			.' AND cve="'.$clave.'"';
			$resul = $this->query($sql);
		}

		//---------SECCIÓN ELIMINAR PEDIDO
		public function eliminar_pedido(){ 		
			$sql = "DELETE FROM `productos_pedidos` WHERE `folio` = ".$_POST['del_pedido'];
			$this->query($sql);
			$sql1 = "DELETE FROM `pedidos` WHERE `folio` = ".$_POST['del_pedido'];
			return $this->query($sql1);
		}

		//---------PEDIDO CANTIDADES APROBAR
		public function get_productos_cantidades(){ 		
			$sql = "SELECT * FROM catalogos,catalogos_productos,productos_pedidos,productos,pedidos,almacenes_productos,almacenes WHERE almacenes_productos.id_almacen=almacenes.id_almacen and almacenes_productos.cve=productos_pedidos.cve and pedidos.folio=productos_pedidos.folio and catalogos_productos.id_catalogo=catalogos.id_catalogo and productos_pedidos.cve=catalogos_productos.cve and productos.cve=productos_pedidos.cve and tipo=0 and almacenes.id_almacen=".$_SESSION['id_almacen']." and pedidos.folio=".$_SESSION['folio'];
			return $this->query($sql);
		}
/**/	//---------PEDIDO IMPORTE
		public function get_importe(){ 		
			$sql = "SELECT importe FROM pedidos WHERE folio=".$_POST['folio'];
			return $this->query($sql);
		}
		//---------PEDIDO SERIES APROBAR
		public function aprobar_productos_series(){ 		
			$sql = "SELECT * FROM catalogos,catalogos_productos,productos_pedidos,productos WHERE catalogos_productos.id_catalogo=catalogos.id_catalogo and productos_pedidos.cve=catalogos_productos.cve and productos.cve=productos_pedidos.cve and (tipo=1 OR tipo=2) and folio=".$_POST['folio'];
			return $this->query($sql);
		}
		//---------APROBAR PEDIDO CANTIDADES
		public function udp_pedido_cant(){
			$sql1 = "UPDATE productos_pedidos SET stock ='".$_POST['']."' WHERE id_almacen=1 and cve=".$_POST[''];
			$sql1 = "UPDATE almacenes_productos SET cant_asignada ='".$_POST['']."' WHERE folio=".$_POST['folio']." and cve=".$_POST[''];
			$sql = "UPDATE pedidos SET importe ='".$_POST['total']."', fecha_cierre='".date("Y-m-d")."', fecha_vencimiento=".$_POST['fecha_v'].", estado=1 WHERE folio=".$_POST['folio'];
				return $this->query($sql);
		}

		//------------obtener productos del pedido---------------------
		public function get_pedido_productos(){
			$sql = 'SELECT * FROM productos_pedidos WHERE folio='.$_SESSION['folio'];
			return $this->query($sql);
		}

		//------------eliminar producto del pedido-------------------
		public function delete_productos_pedido($clave){
			$sql = 'DELETE FROM productos_pedidos WHERE folio='.$_SESSION['folio'].' AND cve="'.$clave.'"';
			$resul= $this->query($sql);
		}

		//-------------actualiza los productos del pedido---------------
		public function update_pedido_prod($i){
			$sql = 'UPDATE productos_pedidos SET cant_solicitada='.$_SESSION['pedido'][$i][1].' WHERE folio='.$_SESSION['folio'].' AND cve="'.$_SESSION['pedido'][$i][0].'"';
			$resul = $this->query($sql);
		}
		//---------Mostrar productos seleccionado por pedido/traspaso
/**/	public function num_productos_cantidades(){ 		
			$sql = "SELECT count(productos_pedidos.cve) as cantidades FROM catalogos,catalogos_productos,productos_pedidos,productos,pedidos WHERE pedidos.folio=productos_pedidos.folio and catalogos_productos.id_catalogo=catalogos.id_catalogo and productos_pedidos.cve=catalogos_productos.cve and productos.cve=productos_pedidos.cve and tipo=0 and pedidos.folio=".$_POST['folio'];
			return $this->query($sql);
		}
/**/	public function num_productos_series(){ 		
			$sql = "SELECT count(productos_pedidos.cve) as series FROM catalogos,catalogos_productos,productos_pedidos,productos WHERE catalogos_productos.id_catalogo=catalogos.id_catalogo and productos_pedidos.cve=catalogos_productos.cve and productos.cve=productos_pedidos.cve and (tipo=1 OR tipo=2) and folio=".$_POST['folio'];
			return $this->query($sql);
		}
/**/	public function num_total_productos(){ 		
			$sql = "SELECT count(productos_pedidos.cve) as productos FROM catalogos,catalogos_productos,productos_pedidos,productos WHERE catalogos_productos.id_catalogo=catalogos.id_catalogo and productos_pedidos.cve=catalogos_productos.cve and productos.cve=productos_pedidos.cve and folio=".$_POST['folio'];
			return $this->query($sql);
		}
/**/	public function get_stock(){
			$sql = 'select * from productos,catalogos_productos,almacenes_productos where almacenes_productos.cve=productos.cve and catalogos_productos.cve=productos.cve and status=1 and id_catalogo='.$_POST['subcat'].' and marca="'.$_POST['marca'].'" and id_almacen='.$_SESSION['id_almacen'];
			return $this->query($sql);
		}

/*new*/		//----------------eliminar producto del pedio por cantidad----------------
		public function delete_produto_ped($clave){
			$sql = 'DELETE FROM productos_pedidos WHERE folio='.$_SESSION['folio'].' AND cve="'.$clave.'"';
			$resul= $this->query($sql);
		}
/*new*/		//--------------actualizar la cantidad asiganada al pedido---------------
		public function update_pedido_cant($i){
			$sql = 'UPDATE productos_pedidos SET cant_asignada='.$_SESSION['pedcant'][$i][1].' WHERE folio='.$_SESSION['folio'].' AND cve="'.$_SESSION['pedcant'][$i][0].'"';
			$resul = $this->query($sql);
		}

/*new*/		//----------Actualizar el stock del los almacenes por cantidades-------------------
		public function update_almacen_stock_cant($i){
			$sql = 'SELECT stock FROM almacenes_productos WHERE id_almacen='.$_SESSION['id_almacen']
			.' AND cve="'.$_SESSION['pedcant'][$i][0].'"';
			$resul = $this->query($sql);
			$row = mysqli_fetch_array($resul);
			$stock = $row['stock']-$_SESSION['pedcant'][$i][1];
			$sql = 'UPDATE almacenes_productos SET stock='.$stock.' WHERE id_almacen='.$_SESSION['id_almacen']
			.' AND cve="'.$_SESSION['pedcant'][$i][0].'"';
			$resul = $this->query($sql);
		}

/*new*/		// ----------------obtener producto y cantidad por clave---------
		public function get_prod_cant($i){
			$sql = "SELECT * FROM catalogos,catalogos_productos,productos_pedidos,productos,pedidos,almacenes_productos,almacenes WHERE almacenes_productos.id_almacen=almacenes.id_almacen and almacenes_productos.cve=productos_pedidos.cve and pedidos.folio=productos_pedidos.folio and catalogos_productos.id_catalogo=catalogos.id_catalogo and productos_pedidos.cve=catalogos_productos.cve and productos.cve=productos_pedidos.cve and tipo=0 and almacenes.id_almacen=".$_SESSION['id_almacen']." and pedidos.folio=".$_SESSION['folio']." AND productos_pedidos.cve='".$_SESSION['pedcant'][$i][0]."'";
			//$sql = 'SELECT * FROM productos WHERE cve="'.$_SESSION['pedcant'][$i][0].'"';
			return $this->query($sql);
		}

	}	
 ?>
