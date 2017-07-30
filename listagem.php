<?php	
	include("config.php");
	include("classes/atividade.php");	
	$atividade = new Atividade();
	$listastatus = $atividade->listarStatus($con);	
	$status = isset($_REQUEST['status']) ? $_REQUEST['status'] : "";
	$situacao = isset($_REQUEST['situacao']) ? $_REQUEST['situacao'] : "";
	$dadosfiltro = array();
	if($status <> "")
	{
		$dadosfiltro['status'] = $status;		
	}
	if($situacao <> "")
	{
		$dadosfiltro['situacao'] = $situacao;		
	}
	$dados = $atividade->listar($con,$dadosfiltro);
	$css = NULL;	
	?>
	<?php
	if(count($dados) > 0)
	{
	?>
	<table class="table table-striped">
	    <thead>
	      <tr>
	        <th>Nome</th>
	        <th>Descrição</th>
	        <th>Data inicio</th>
	        <th>Data fim</th>
	        <th>Status</th>
	        <th>Situação</th>
	      </tr>
	    </thead>
	    <tbody>
      	<?php
      	foreach ($dados as $key => $value) {
      		$css = $value['status'] == 4 ? 'style="background-color: #9ff9ae;"' : NULL;
      		$data_inicio = ($value['data_inicio'] <> '0000-00-00') ? $atividade->dataview($value['data_inicio']) : NULL;
      		$data_fim = ($value['data_fim'] <> '0000-00-00') ? $atividade->dataview($value['data_fim']) : NULL;
      		$status = $atividade->nomeStatus($con,$value['status']);
      		$situacao = $value['situacao'] == "1" ? "Ativo" : "Inativo";
      	?>
	      <tr <?php echo $css;?>>
	        <td><?php echo $value['nome'];?></td>
	        <td><?php echo $value['descricao'];?></td>
	        <td><?php echo $data_inicio;?></td>
	        <td><?php echo $data_fim;?></td>
	        <td><?php echo utf8_encode($status);?></td>
	        <td><?php echo $situacao;?></td>
			<td><a href="editar.php?codigo=<?php echo $value['codigo'];?>" class="btn btn-sm btn-success">Editar</a></td>	        
	      </tr>
        <?php
    	}
        ?>
	    </tbody>
	</table>
    <?php
    }else{
    ?>	
    <p style="text-align: center; margin:2rem;"><strong>Não há atividades cadastradas!</strong></p>
    <?php
	}
    ?>