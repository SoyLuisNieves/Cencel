<div id="inicio_session">
<?php
if (empty($_SESSION['pedido'])) {
	session_start();
}
?>
</div>