<div id="inicio_session">
<?php
if (empty($_SESSION['pedido'])||empty($_SESSION['aprobar'])) {
	session_start();
}
?>
</div>