
<div id="resultado">
<?php
if (empty($_SESSION['pedido'])) {
	@session_start();
}
    if (isset($_REQUEST['cleanpedido'])) {
    	if (empty($_REQUEST['cleanpedido'])) {
    		$_SESSION['pedido']= array();
    	}else{
            //session_start('pedido');
            //session_register('pedido');
    		$_SESSION['pedido']=$_REQUEST['cleanpedido'];
    		$_SESSION['pedido'] = array_values($_SESSION['pedido']);
    		//var_dump($_SESSION["pedido"]);
    	}
    }
    if (isset($_SESSION['pedido'])) {
    	var_dump($_SESSION["pedido"]);
        session_write_close();
    }
?>
</div>
