<?php	
	include("config.php");
	include("classes/atividade.php");	
	$atividade = new Atividade();
	$listastatus = $atividade->listarStatus($con);	
	$codigo = isset($_REQUEST["codigo"]) ? $_REQUEST["codigo"] : NULL;
	$dados = $atividade->carregar($con,$codigo);	
	if(count($dados))
	{
		$dados = $dados[0];		
		$nome = $dados['nome'];
		$descricao = $dados['descricao'];
      	$data_inicio = ($dados['data_inicio'] <> '0000-00-00') ? $atividade->dataview($dados['data_inicio']) : NULL;
      	$data_fim = ($dados['data_fim'] <> '0000-00-00') ? $atividade->dataview($dados['data_fim']) : NULL;		
		$status = $dados['status'];
		$situacao = $dados['situacao'];		
		$enable = $status == 4 ? ' readonly="readonly"' : NULL;
	}else{
		header('Location: index.php?msg=erro');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<?php include("header.php"); ?>
  <body>
    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Editar atividade</h1>
      </div>

		<form id="formatividade" data-toggle="validator" role="form" action="editar_atividade.php" method="post">
			<input type="hidden" name="codigo" value="<?php echo $codigo;?>">
		  <div class="form-group">
		    <label for="nome" class="control-label">Nome</label>
		    <input id="nome" name="nome" class="form-control" placeholder="Digite o nome..." type="text" value="<?php echo $nome;?>"<?php echo $enable;?>>
		  </div>
		  
		  <div class="form-group">
		    <label for="descricao" class="control-label">Descrição</label>
		    <textarea class="form-control" id="descricao" name="descricao" rows="3"<?php echo $enable;?>><?php echo $descricao;?></textarea>
		  </div>

		  <div class="form-group">
		    <label for="data_inicio" class="control-label">Data Inicio</label>
		    <input id="data_inicio" name="data_inicio" class="form-control" placeholder="Digite a data de inicio..." type="text" value="<?php echo $data_inicio;?>"<?php echo $enable;?>>
		  </div>

		  <div class="form-group">
		    <label for="data_fim" class="control-label">Data Fim</label>
		    <input id="data_fim" name="data_fim" class="form-control" placeholder="Digite a data de termino..." type="text" value="<?php echo $data_fim;?>"<?php echo $enable;?>>
		  </div>		  

		  <div class="form-group">
		  	<label for="status" class="control-label">Status</label>
		  	<?php
		  	if($status <> '4')
		  	{
		  	?>		  	
			<select class="form-control" id="status" name="status"<?php echo $enable;?>>
				<option selected="selected">Selecione o status</option>
				<?php
				foreach($listastatus as $key => $value)
				{					
					$selected = $value['codigo'] == $status ? "selected" : NULL;
				?>
				<option value="<?php echo $value['codigo'];?>" <?php echo $selected;?> ><?php echo utf8_encode($value['status']);?></option>
				<?php
				}
				?>
			</select>	
			<?php
			}else{
			?>
			<input type="hidden" name="status" id="status" value="<?php echo $status;?>">
			<?php echo utf8_encode($atividade->nomeStatus($con,$status));?>
			<?php
			}
			?>
		  </div>

		  <div class="form-group">
		  	<label for="situacao" class="control-label">Situação</label>
		  	<?php
		  	if($status <> '4')
		  	{
		  	?>
			<select class="form-control" id="situacao" name="situacao"<?php echo $enable;?>>
				<option selected="selected">Selecione a situação</option>
				<option value="1" <?php if($situacao == "1"){ echo "selected";}?> >Ativo</option>
				<option value="0" <?php if($situacao == "0"){ echo "selected";}?> >Inativo</option>
			</select>		  
			<?php
			}else{
			?>
			<input type="hidden" name="situacao" id="situacao" value="<?php echo $situacao;?>">
			<?php if($situacao == "1"){ echo "Ativo";}else{echo "Inativo";} ?>
			<?php
			}
			?>
		  </div>
		  <a href="index.php" class="btn btn-warning">Voltar</a>
		  <button type="submit" class="btn btn-success">Salvar</button>
		</form>

    </div>



    <footer class="footer">
      <div class="container">        
      </div>
    </footer>

    <?php include("scripts.php"); ?>

  </body>
</html>