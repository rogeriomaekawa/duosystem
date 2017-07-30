<?php
class Atividade{
	
	public function listarStatus($con)
	{
		$rs = $con->query("SELECT codigo, status FROM status");
		$rs->execute();
		$dados = $rs->fetchAll();
		return $dados;
	}

	public function nomeStatus($con,$codigo=NULL)
	{
		if($codigo)
		{
			$rs = $con->query("SELECT status FROM status WHERE codigo = ".$codigo);
			$rs->execute();
			$dados = $rs->fetchAll();
			return $dados[0][0];			
		}else{
			return "";
		}

	}

	public function listar($con,$dadosfiltro=array())
	{
		$str = "";
		if(count($dadosfiltro))
		{
			$str = " WHERE ";
			$count = 0;	
			foreach ($dadosfiltro as $key => $value) {
				if($count == 0)
				{
					$str .= $key ." = " .$value 	;
				}else{
					$str .= " AND ".$key ." = " .$value 	;					
				}
				$count++;
			}
		}		
		
		$rs = $con->query("SELECT * FROM atividades".$str);
		$rs->execute();
		$dados = $rs->fetchAll();
		return $dados;
	}	

	public function carregar($con,$codigo=null)
	{
		$dados = array();

		if($codigo)
		{
			$rs = $con->query("SELECT * FROM atividades WHERE codigo = ".$codigo);
			$rs->execute();
			$dados = $rs->fetchAll();
		}
		
		return $dados;
	}		

	public function incluir($con, $dados = array())
	{
		
		if(count($dados))
		{
			$nome = isset($dados['nome']) ? $dados['nome'] : "";
			$descricao = isset($dados['descricao']) ? $dados['descricao'] : "";
			$data_inicio = isset($dados['data_inicio']) ? $this->databanco($dados['data_inicio']) : NULL;
			$data_fim = isset($dados['data_fim']) ? $this->databanco($dados['data_fim']) : NULL;
			$status = isset($dados['status']) ? $dados['status'] : "";
			$situacao = isset($dados['situacao']) ? $dados['situacao'] : "";		

			$cmd = $con->prepare("INSERT INTO atividades(nome, descricao, data_inicio, data_fim, status, situacao) VALUES(?, ?, ?, ?, ?, ?)");
			$cmd->bindParam(1,$nome);
			$cmd->bindParam(2,$descricao);
			$cmd->bindParam(3,$data_inicio);
			$cmd->bindParam(4,$data_fim);
			$cmd->bindParam(5,$status);
			$cmd->bindParam(6,$situacao);
			$excute = $cmd->execute();			
			return $excute;			
		}else{
			return 0;
		}		
	}

	public function editar($con, $dados = array())
	{
		
		if(count($dados))
		{
			$codigo = isset($dados['codigo']) ? $dados['codigo'] : "";
			$nome = isset($dados['nome']) ? $dados['nome'] : "";
			$descricao = isset($dados['descricao']) ? $dados['descricao'] : "";
			$data_inicio = isset($dados['data_inicio']) ? $this->databanco($dados['data_inicio']) : NULL;
			$data_fim = isset($dados['data_fim']) ? $this->databanco($dados['data_fim']) : NULL;
			$status = isset($dados['status']) ? $dados['status'] : "";
			$situacao = isset($dados['situacao']) ? $dados['situacao'] : "";		

			$stmt = $con->prepare("UPDATE pessoa SET nome = ?, email = ? WHERE idpessoa = ?");
			$cmd = $con->prepare("UPDATE atividades SET nome = ?, descricao = ?, data_inicio = ?, data_fim = ?, status = ?, situacao = ? WHERE codigo = ?");			
			$cmd->bindParam(1,$nome);
			$cmd->bindParam(2,$descricao);
			$cmd->bindParam(3,$data_inicio);
			$cmd->bindParam(4,$data_fim);
			$cmd->bindParam(5,$status);
			$cmd->bindParam(6,$situacao);
			$cmd->bindParam(7,$codigo);

			$excute = $cmd->execute();						
			return $excute;			
		}else{
			return 0;
		}

	}

	public function databanco($data)
	{
		if($data)
		{
			$data = explode("/", $data);
			return $data[2]."-".$data[1]."-".$data[0];
		}
	}

	public function dataview($data)
	{
		if($data)
		{
			$data = explode("-", $data);
			return $data[2]."/".$data[1]."/".$data[0];
		}
	}	
}

?>