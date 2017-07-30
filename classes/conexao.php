<?php

class Conexao{

	public function conectar($host="localhost", $database="teste", $user="root", $senha="teste")
	{
		$con = new PDO("mysql:host=".$host.";dbname=".$database, $user, $senha); 
		return  $con;
	}

}
?>