<div id="resultado">
<?php
if (empty($_SESSION['traspaso'])) {
	session_start();
}

    if (isset($_REQUEST['cleantraspaso'])) {
    	if (empty($_REQUEST['cleantraspaso'])) {
    		$_SESSION['traspaso']= array();
    	}else{
    		$_SESSION['traspaso']=$_REQUEST['cleantraspaso'];
    		$_SESSION['traspaso'] = array_values($_SESSION['traspaso']);
    		//var_dump($_SESSION["pedido"]);
    	}
    }
    if (isset($_SESSION['traspaso'])) {
    	var_dump($_SESSION["traspaso"]);
    }
?>
</div>
