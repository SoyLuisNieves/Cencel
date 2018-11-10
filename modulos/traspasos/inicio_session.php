<div id="inicio_session">
<?php
if (empty($_SESSION['traspaso'])||empty($_SESSION['aprobar'])) {
	session_start();
}
?>
</div>