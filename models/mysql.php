<?php 

class Mysql{
	private $_conexion;

	/*public function __construct(){
		$host = "localhost";
		$user = "root";
		$pass = "root";
		$bd = "cencel";
		$this->_conexion = mysqli_connect(
			$host,
			$user,
			$pass,
			$bd);
	}*/

	public function __construct(){
		$host = "db678452669.db.1and1.com";
		$user = "dbo678452669";
		$pass = "cencelnuevo1";
		$bd = "db678452669";
		$this->_conexion = mysqli_connect(
			$host,
			$user,
			$pass,
			$bd);
	}

	public function query($sql){
		$result = mysqli_query($this->_conexion, $sql);
		return $result;
	}
	public function lastInsertId()
    {
        $result = mysqli_insert_id($this->_conexion);
        return $result;
    }
}

 ?>