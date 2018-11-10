<div id="resultado">
<?php
if (empty($_SESSION['aprobart'])) {
	session_start();
}

    if (isset($_REQUEST['cleanpedido'])) {
    	if (empty($_REQUEST['cleanpedido'])) {
    		$_SESSION['aprobart']= array();
    	}else{
    		$_SESSION['aprobart']=$_REQUEST['cleanpedido'];
    		$_SESSION['aprobart'] = array_values($_SESSION['aprobart']);
    		//var_dump($_SESSION["aprobar"]);
    	}
    }
    if (isset($_SESSION['aprobart'])) {
    	var_dump($_SESSION["aprobart"]);
    }
?>
</div>
