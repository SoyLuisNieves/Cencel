
<div id="resultado">
<?php
if (empty($_SESSION['aprobar'])) {
	session_start();
}

    if (isset($_REQUEST['cleanpedido'])) {
    	if (empty($_REQUEST['cleanpedido'])) {
    		$_SESSION['aprobar']= array();
    	}else{
    		$_SESSION['aprobar']=$_REQUEST['cleanpedido'];
    		$_SESSION['aprobar'] = array_values($_SESSION['aprobar']);
    		//var_dump($_SESSION["aprobar"]);
    	}
    }
    if (isset($_SESSION['aprobar'])) {
    	var_dump($_SESSION["aprobar"]);
    }
?>
</div>
