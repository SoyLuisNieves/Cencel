<?php 
$id_departamento = $_GET['parametro'];
$user = "root";
$pass = "nievedelimon";
$server = "localhost";
$bd = "cencel";

$conexion = mysqli_connect($server,$user,$pass,$bd);
echo '<option value="">-- Selecciona Catalogo --</option>';
$result = mysqli_query($conexion, "SELECT departamentos_catalogos.id_departamento, departamento, departamentos_catalogos.id_catalogo, catalogo from departamentos_catalogos
inner join departamentos on departamentos_catalogos.id_departamento = departamentos.id_departamento
inner join catalogos on departamentos_catalogos.id_catalogo = catalogos.id_catalogo
where departamentos_catalogos.id_departamento = $id_departamento;");

while($row = mysqli_fetch_array($result)){
	echo '<option value="'.$row['catalogo'].'">'.$row['catalogo'].'</option>';  
}
 ?>}
