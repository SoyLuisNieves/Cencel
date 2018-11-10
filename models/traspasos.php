<?php 
require_once("mysql.php");
	class Traspasos extends Mysql{
		//SECCIÓN DE PEDIDOS
		//---------Mostrar productos existentes de acuerdo a producto y costo
		public function get_productos_pedido(){ //sin usar			
			$sql = "select * from productos,catalogos_productos where catalogos_productos.cve=productos.cve and status=1 and id_catalogo=".$_POST['subcat']." ";
			return $this->query($sql);
		}
		public function get_almacen(){
			$sql = "SELECT almacen from almacenes where id_almacen=".$_POST['almacen'];
			return $this->query($sql);
		}
		//---------Mostrar pedidos
		public function get_traspasos_alm(){ 		
			$sql = "SELECT * from traspasos,usuarios where traspasos.id_usuario=usuarios.id_usuario GROUP BY traspasos.folio";
			return $this->query($sql);
		}
		public function get_traspasos_pa(){ 		
			$sql = "SELECT * from traspasos,usuarios where traspasos.id_usuario=usuarios.id_usuario and estado=".$_POST['estado']." GROUP BY traspasos.folio";
			return $this->query($sql);
		}
		//---------Mostrar Traspasos_a_editar
		public function get_traspasos_pendiente(){ 		
			$sql = "SELECT * from traspasos,productos_traspasos,usuarios where traspasos.folio=productos_traspasos.folio and traspasos.id_usuario=usuarios.id_usuario and estado=0  GROUP BY traspasos.folio";
			return $this->query($sql);
		}
		public function get_pedidos_alm_sel_pendiente(){ 		
			$sql = "SELECT * from pedidos,productos_pedidos,usuarios where pedidos.folio=productos_pedidos.folio and pedidos.id_usuario=usuarios.id_usuario and estado=0 and almacen='".$_POST['almacen']."' GROUP BY pedidos.folio";
			return $this->query($sql);
		}		
		//---------Mostrar traspasos seleccionado por folio
/*-*/		public function get_traspaso_folio(){ 		
			$sql = "SELECT * from productos,productos_traspasos where productos.cve=productos_traspasos.cve and folio =".$_POST['folio'];
			return $this->query($sql);
		}
		public function get_pagos_folio(){ 		
			$sql = "SELECT * from pagos_traspaso where folio ='".$_POST['pagos']."' OR (folio ='".$_POST['pago']."' and id='".$_POST['bpagos']."') OR folio='".$_POST['folio']."'";
			return $this->query($sql);
		}
	//---------Numero pagos
		public function pagos_sum(){ 		
			$sql = "SELECT sum(efectivo+cheque+nota_credito) as pago from pagos_traspaso WHERE folio ='".$_POST['pagos']."' OR folio ='".$_POST['pago']."' OR folio='".$_POST['folio']."'";
			return $this->query($sql);
		}
	//---------Numero pagos
		public function importe(){ 		
			$sql = "SELECT importe from traspasos WHERE folio ='".$_POST['pagos']."' OR folio ='".$_POST['pago']."' OR folio='".$_POST['folio']."'";
			return $this->query($sql);
		}
	//---------Aprobar pedido - PAGADO -
		public function importe_pago(){ 		
			$sql = "UPDATE traspasos SET pagado = '1' WHERE `folio` =".$_POST['folio'];
			return $this->query($sql);
		}
	/**/	//---------Aprobar pedido - PAGADO -
			public function importe_p(){ 		
				$sql = "UPDATE traspasos SET pagado = '0' WHERE `folio` =".$_POST['folio'];
				return $this->query($sql);
			}
/*mod*/		//obtener producto por clave
		public function get_pedido_prod($i){
			$sql = 'SELECT * FROM productos WHERE cve="'.$_SESSION['traspaso'][$i][0].'"';
			return $this->query($sql);
		}
/*mod*/		//consultar folios
		public function get_folios(){
		echo	$sql = 'SELECT max(n_remision) as n_remision FROM traspasos WHERE fecha_inicio>="'.date("Y-m-1").'"';
			return $this->query($sql);
		}

/*mod*/		//ingresar pedido a la DB
		public function insert_pedido_prod($folio,$i){
		echo	$sql = 'INSERT INTO productos_traspasos (folio,cve,cant_solicitada) VALUES ('.$folio.',"'.$_SESSION['traspaso'][$i][0].'",'.$_SESSION['traspaso'][$i][1].')';
			$resul = $this->query($sql);
		}
/*mod*/		//ingresar pedido a la DB
		public function insert_pedido_prod2($folio,$i,$cantidad){
			$precio=$precio*$_SESSION[$i][1];
		echo	$sql = 'INSERT INTO productos_traspasos (folio,cve,cant_solicitada) VALUES ('.$folio.',"'.$_SESSION['traspaso'][$i][0].'",'.$cantidad.')';
			$resul = $this->query($sql);
		}

/*mod*/		//registrar el folio del pedido el usuario esta estatico
		public function insert_traspaso($n_remision,$origen){
		echo	$sql = 'INSERT INTO traspasos (id_usuario,n_remision,importe,fecha_inicio,estado,pagado,almacen_origen,almacen_destino) VALUES('.$_SESSION['id_usuario'].','.$n_remision.','.$_POST['costo_total'].',"'.date("Y-m-d").'",0,0,'.$_SESSION['origen'].','.$_SESSION['destino'].')';
			$resul = $this->query($sql);
		}
/*new*/		//ingresar pedido a la DB
		public function obtener_folio(){
			return $this->lastInsertId();
		}

/*new*/		//------------obtener productos del pedido---------------------
		public function get_pedido_productos(){
			$sql = 'SELECT * FROM productos_traspasos WHERE folio='.$_SESSION['folio'];
			return $this->query($sql);
		}

/*new*/		//------------eliminar producto del pedido-------------------
		public function delete_productos_pedido($clave){
			$sql = 'DELETE FROM productos_traspasos WHERE folio='.$_SESSION['folio'].' AND cve="'.$clave.'"';
			$resul= $this->query($sql);
		}
		
/*new*/		//-------------actualiza los productos del pedido---------------
		public function update_pedido_prod($i){
			$sql = 'UPDATE productos_traspasos SET cant_solicitada='.$_SESSION['traspaso'][$i][1].' WHERE folio='.$_SESSION['folio'].' AND cve="'.$_SESSION['traspaso'][$i][0].'"';
			$resul = $this->query($sql);
		}

/*new*/		//ingresar pedido a la DB
		public function insert_prod_cant_pedido($i){
			$sql = 'INSERT INTO productos_traspasos (folio,cve,cant_solicitada) VALUES ('.$_SESSION['folio'].',"'.$_SESSION['traspaso'][$i][0].'",'.$_SESSION['traspaso'][$i][1].')';
			$resul = $this->query($sql);
		}
/*new*/		//ingresar pedido a la DB
		public function insert_prod_cant_pedido2($i,$cantidad){
			$precio=$precio*$_SESSION['traspaso'][$i][1];
			$sql = 'INSERT INTO productos_traspasos (folio,cve,cant_solicitada) VALUES ('.$_SESSION['folio'].',"'.$_SESSION['traspaso'][$i][0].'",'.$cantidad.')';
			$resul = $this->query($sql);
		}

		//---------Mostrar productos seleccionado por pedido
		public function get_productos_series(){ 		
			$sql = "SELECT * from productos,productos_series,catalogos,catalogos_productos where catalogos_productos.id_catalogo=catalogos.id_catalogo and catalogos_productos.cve=productos_series.cve and productos.cve=productos_series.cve and vendido=0 and productos.cve ='".$_POST['clave']."'";
			return $this->query($sql);
		}
		//---------TRASPASO CANTIDADES APROBAR
		public function get_productos_cantidades(){ 		
			$sql = "SELECT * FROM catalogos,catalogos_productos,productos_traspasos,productos,traspasos WHERE traspasos.folio=productos_traspasos.folio and catalogos_productos.id_catalogo=catalogos.id_catalogo and productos_traspasos.cve=catalogos_productos.cve and productos.cve=productos_traspasos.cve and tipo=0 and traspasos.folio=".$_SESSION['folio'];
			return $this->query($sql);
		}
		//---------TRASPASO SERIES APROBAR
		public function aprobar_productos_series(){ 		
			$sql = "SELECT * FROM catalogos,catalogos_productos,productos_traspasos,productos WHERE catalogos_productos.id_catalogo=catalogos.id_catalogo and productos_traspasos.cve=catalogos_productos.cve and productos.cve=productos_traspasos.cve and (tipo=1 OR tipo=2) and folio=".$_SESSION['folio'];
			return $this->query($sql);
		}

		//---------Nuevo pago
		public function new_pago(){ 		
			$sql = "INSERT INTO `pagos_traspaso` (`folio` ,`efectivo` ,`cheque` ,`nota_credito` ,`fecha`)
				VALUES ('".$_POST['folio']."', '".$_POST['efectivo']."', '".$_POST['cheque']."', '".$_POST['nota_credito']."', '".$_POST['fecha']."')";
			return $this->query($sql);
		}
		//---------Actualizar pagos
		public function udp_pagos(){ 		
			$sql = "UPDATE pagos_traspaso SET efectivo ='".$_POST['efectivo']."', cheque='".$_POST['cheque']."', nota_credito=".$_POST['credito'].",fecha='".$_POST['fecha']."' WHERE folio=".$_POST['folio']." and id=".$_POST['id'];
			return $this->query($sql);
		}

		//---------SECCIÓN ELIMINAR PEDIDO
		public function eliminar_pedido(){ 		
			$sql = "DELETE FROM `productos_pedidos` WHERE `folio` = ".$_POST['del_pedido'];
			$this->query($sql);
			$sql1 = "DELETE FROM `pedidos` WHERE `folio` = ".$_POST['del_pedido'];
			return $this->query($sql1);
		}
		//---------Mostrar productos seleccionado por pedido/traspaso
	public function num_productos_cantidades(){ 		
			$sql = "SELECT count(productos_traspasos.cve) as cantidades FROM catalogos,catalogos_productos,productos_traspasos,productos,traspasos WHERE traspasos.folio=productos_traspasos.folio and catalogos_productos.id_catalogo=catalogos.id_catalogo and productos_traspasos.cve=catalogos_productos.cve and productos.cve=productos_traspasos.cve and tipo=0 and traspasos.folio=".$_POST['folio'];
			return $this->query($sql);
		}
	public function num_productos_series(){ 		
			$sql = "SELECT count(productos_traspasos.cve) as series FROM catalogos,catalogos_productos,productos_traspasos,productos WHERE catalogos_productos.id_catalogo=catalogos.id_catalogo and productos_traspasos.cve=catalogos_productos.cve and productos.cve=productos_traspasos.cve and (tipo=1 OR tipo=2) and folio=".$_POST['folio'];
			return $this->query($sql);
		}
	public function num_total_productos(){ 		
			$sql = "SELECT count(productos_traspasos.cve) as productos FROM catalogos,catalogos_productos,productos_traspasos,productos WHERE catalogos_productos.id_catalogo=catalogos.id_catalogo and productos_traspasos.cve=catalogos_productos.cve and productos.cve=productos_traspasos.cve and folio=".$_POST['folio'];
			return $this->query($sql);
		}

/*new*/		//---------- Actualizar productos series a vendido y agregar folio----------------
		public function update_productos_iccid_ven($i,$almacend){
			echo $sql = 'UPDATE productos_series SET clave='.$almacend
			.' WHERE iccid="'.$_SESSION['aprobart'][$i].'"';
			$resul= $this->query($sql);
		}

/*new*/		//---------- Actualizar productos series a vendido y agregar folio----------------
		public function update_productos_imei_ven($i,$almacend){
			$sql = 'UPDATE productos_series SET clave='.$almacend
			.' WHERE imei="'.$_SESSION['aprobart'][$i].'"';
			$resul= $this->query($sql);
		}

/*new*/		//------------- Obtener la clave del producto
		public function get_poducto_clave_iccid($i){
			$sql = 'SELECT cve FROM productos_series WHERE iccid='.$_SESSION['aprobart'][$i];
			return $this->query($sql);
		}

/*new*/		//------------- Obtener la clave del producto
		public function get_poducto_clave_imei($i){
			$sql = 'SELECT cve FROM productos_series WHERE imei='.$_SESSION['aprobart'][$i];
			return $this->query($sql);
		}

/*new*/		//----------Actualizar el stock del los almacenes-------------------
		public function update_almacen_stock($i,$clave){
			$sql = 'SELECT stock FROM almacenes_productos WHERE id_almacen='.$_SESSION['destino']
			.' AND cve="'.$clave.'"';
			$resul = $this->query($sql);
			$row = mysqli_fetch_array($resul);
			$stock = $row['stock']+1;
			echo $sql = 'UPDATE almacenes_productos SET stock='.$stock.' WHERE id_almacen='.$_SESSION['destino']
			.' AND cve="'.$clave.'"';
			$resul = $this->query($sql);

			$sql = 'SELECT stock FROM almacenes_productos WHERE id_almacen='.$_SESSION['origen']
			.' AND cve="'.$clave.'"';
			$resul = $this->query($sql);
			$row2 = mysqli_fetch_array($resul);
			$stock2 = $row2['stock']-1;
			echo $sql = 'UPDATE almacenes_productos SET stock='.$stock2.' WHERE id_almacen='.$_SESSION['origen']
			.' AND cve="'.$clave.'"';
			$resul = $this->query($sql);
		}

/*new*/		//--------------Obtener la cantidad ya ingresada-----------------
		public function get_cant_asignada($clave){
			$sql = 'SELECT cant_asignada FROM productos_traspasos WHERE folio='.$_SESSION['folio']
			.' AND cve="'.$clave.'"';
			return $this->query($sql);
		}

/*new*/		//---------Actualizar productos pedidos la cantidad asignada------------
		public function update_prod_ped_cantidad($cantidad,$clave){
			 $sql = 'UPDATE productos_traspasos SET cant_asignada='.$cantidad.' WHERE folio='.$_SESSION['folio']
			.' AND cve="'.$clave.'"';
			$resul = $this->query($sql);
		}

/*new*/		//--------------actualizar la cantidad asiganada al pedido---------------
		public function update_pedido_cant($i){
			$sql = 'UPDATE productos_traspasos SET cant_asignada='.$_SESSION['tracant'][$i][1].' WHERE folio='.$_SESSION['folio'].' AND cve="'.$_SESSION['tracant'][$i][0].'"';
			$resul = $this->query($sql);
		}

/*new*/		//---------- Actualizar el estado de pedidos y fechas---------------------
		public function update_pedidos(){
			$sql = 'UPDATE traspasos SET fecha_cierre="'.date("Y-m-d").'", fecha_vencimiento="'.$_POST['vencimiento'].'", estado=1 WHERE folio='.$_SESSION['folio'];
			$reul = $this->query($sql);
		}

/*new*/		//----------Actualizar el stock del los almacenes por cantidades-------------------
		public function update_almacen_stock_cant($i){
			$sql = 'SELECT stock FROM almacenes_productos WHERE id_almacen='.$_SESSION['destino']
			.' AND cve="'.$_SESSION['tracant'][$i][0].'"';
			$resul = $this->query($sql);
			$row = mysqli_fetch_array($resul);
			$stock = $row['stock']+$_SESSION['tracant'][$i][1];
			$sql = 'UPDATE almacenes_productos SET stock='.$stock.' WHERE id_almacen='.$_SESSION['destino']
			.' AND cve="'.$_SESSION['tracant'][$i][0].'"';
			$resul = $this->query($sql);

			$sql = 'SELECT stock FROM almacenes_productos WHERE id_almacen='.$_SESSION['origen']
			.' AND cve="'.$_SESSION['tracant'][$i][0].'"';
			$resul = $this->query($sql);
			$row = mysqli_fetch_array($resul);
			$stock = $row['stock']-$_SESSION['tracant'][$i][1];
			$sql = 'UPDATE almacenes_productos SET stock='.$stock.' WHERE id_almacen='.$_SESSION['origen']
			.' AND cve="'.$_SESSION['tracant'][$i][0].'"';
			$resul = $this->query($sql);
		}

/*new*/		//--------------- alta registros de productos al almacen-----------------------
		public function insert_prod_almacen($i){
		echo	$sql = 'SELECT stock FROM almacenes_productos WHERE id_almacen='.$_SESSION['origen']
			.' AND cve="'.$_SESSION['tracant'][$i][0].'"';
			$resul = $this->query($sql);
			$row = mysqli_fetch_array($resul);
			$stock = $row['stock']-$_SESSION['tracant'][$i][1];
			$sql = 'UPDATE almacenes_productos SET stock='.$stock.' WHERE id_almacen='.$_SESSION['origen']
			.' AND cve="'.$_SESSION['tracant'][$i][0].'"';
			$resul = $this->query($sql);

		echo	$sql = 'INSERT INTO almacenes_productos (id_almacen,cve,stock) VALUES ('.$_SESSION['destino'].',"'.$_SESSION['tracant'][$i][0].'",'.$_SESSION['tracant'][$i][1].')';
			$resul = $this->query($sql);
		}

/*new*/		//------------------ Mostrar productos aprobados para el pedido con iccid----------------------
		public function get_productos_aprobar_iccid($i){
			$sql = "SELECT *
				FROM productos, productos_series, catalogos, catalogos_productos
				WHERE catalogos_productos.id_catalogo = catalogos.id_catalogo
				AND catalogos_productos.cve = productos_series.cve
				AND productos.cve = productos_series.cve
				AND productos_series.iccid =".$_SESSION['aprobart'][$i];
				return $this->query($sql);
		}

/*new*/		//-------------Mostrar productos aprobados par imei del pedido-------------------
		public function get_productos_aprobar_imei($i){
			$sql = 'SELECT *
				FROM productos, productos_series, catalogos, catalogos_productos
				WHERE catalogos_productos.id_catalogo = catalogos.id_catalogo
				AND catalogos_productos.cve = productos_series.cve
				AND productos.cve = productos_series.cve
				AND productos_series.imei ='.$_SESSION['aprobart'][$i];
				return $this->query($sql);
		}

/*new*/		// ----------------obtener producto y cantidad por clave---------
		public function get_prod_cant($i){
			$sql = "SELECT * FROM catalogos,catalogos_productos,productos_traspasos,productos,pedidos,almacenes_productos,almacenes WHERE almacenes_productos.id_almacen=almacenes.id_almacen and almacenes_productos.cve=productos_traspasos.cve and pedidos.folio=productos_traspasos.folio and catalogos_productos.id_catalogo=catalogos.id_catalogo and productos_traspasos.cve=catalogos_productos.cve and productos.cve=productos_traspasos.cve and tipo=0 and almacenes.id_almacen=".$_SESSION['id_almacen']." and pedidos.folio=".$_SESSION['folio']." AND productos_traspasos.cve='".$_SESSION['tracant'][$i][0]."'";
			//$sql = 'SELECT * FROM productos WHERE cve="'.$_SESSION['pedcant'][$i][0].'"';
			return $this->query($sql);
		}

/*new*/		//----------------eliminar producto del pedio por cantidad----------------
		public function delete_produto_ped($clave){
			$sql = 'DELETE FROM productos_traspasos WHERE folio='.$_SESSION['folio'].' AND cve="'.$clave.'"';
			$resul= $this->query($sql);
		}
/*new*/		public function get_almacentra(){
			$sql = 'SELECT clave FROM almacenes WHERE id_almacen='.$_SESSION['destino'];
			$resul= $this->query($sql);
		}

/*new*/		//----------obtener el contenido del almacen destino-------------
		public function get_prod_almacen($i){
			$sql ='SELECT * FROM almacenes_productos WHERE id_almacen='.$_SESSION['destino'].' AND cve="'.$_SESSION['tracant'][$i][0].'"';
			return $this->query($sql);
		}
	}	
 ?>
