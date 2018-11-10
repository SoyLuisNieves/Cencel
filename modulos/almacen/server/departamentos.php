<?php 
$user = "root";
$pass = "nievedelimon";
$server = "localhost";
$bd = "cencel";

$conexion = mysqli_connect($server,$user,$pass,$bd);

$result = mysqli_query($conexion, "SELECT * from departamentos");
echo '<option value="">-- Selecciona Departamento --</option>';
while($row = mysqli_fetch_array($result)){
	echo '<option value="'.$row['id_departamento'].'">'.$row['departamento'].'</option>';  
}
 ?>
