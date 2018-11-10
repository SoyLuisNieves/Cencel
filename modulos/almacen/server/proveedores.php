<?php 
$id_proveedor = $_GET['parametro'];
$user = "root";
$pass = "nievedelimon";
$server = "localhost";
$bd = "cencel";

$conexion = mysqli_connect($server,$user,$pass,$bd);
echo '<option value="">-- Selecciona Proveedor --</option>';
$result = mysqli_query($conexion, "SELECT departamentos_proveedores.id_departamento, departamento, departamentos_proveedores.id_proveedor, proveedor from departamentos_proveedores
inner join departamentos on departamentos_proveedores.id_departamento = departamentos.id_departamento
inner join proveedores on departamentos_proveedores.id_proveedor = proveedores.id_proveedor
where departamentos_proveedores.id_departamento = $id_proveedor;");

while($row = mysqli_fetch_array($result)){
	echo '<option value="'.$row['proveedor'].'">'.$row['proveedor'].'</option>';  
}
 ?>}

