<?php	
	include("config.php");
	include("classes/atividade.php");	
	$atividade = new Atividade();
	
	if($_POST)
	{	
		if($atividade->incluir($con, $_POST))		
		{
			header('Location: index.php');
		}else{
			header('Location: index.php?msg=erro');
		}
	}

?>