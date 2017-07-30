<?php	
	include("config.php");
	include("classes/atividade.php");	
	$atividade = new Atividade();
	$status = $atividade->listarStatus($con);
?>
<!DOCTYPE html>
<html lang="en">
	<?php include("header.php"); ?>
  <body>
    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Incluir nova atividade</h1>
      </div>

		<form id="formatividade" action="incluir_atividade.php" method="post">
		  <div class="form-group">
		    <label for="nome" class="control-label">Nome</label>
		    <input id="nome" name="nome" class="form-control" placeholder="Digite o nome..." type="text">
		  </div>
		  
		  <div class="form-group">
		    <label for="descricao" class="control-label">Descrição</label>
		    <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
		  </div>

		  <div class="form-group">
		    <label for="data_inicio" class="control-label">Data Inicio</label>
		    <input id="data_inicio" name="data_inicio" class="form-control" placeholder="Digite a data de inicio..." type="text">
		  </div>

		  <div class="form-group">
		    <label for="data_fim" class="control-label">Data Fim</label>
		    <input id="data_fim" name="data_fim" class="form-control" placeholder="Digite a data de termino..." type="text">
		  </div>		  

		  <div class="form-group">
		  	<label for="status" class="control-label">Status</label>
			<select class="form-control" id="status" name="status">
				<option selected="selected">Selecione o status</option>
				<?php

				foreach($status as $key => $value)
				{
				?>
				<option value="<?php echo $value['codigo'];?>"><?php echo utf8_encode($value['status']);?></option>
				<?php
				}
				?>
			</select>		  
		  </div>

		  <div class="form-group">
		  	<label for="situacao" class="control-label">Situação</label>
			<select class="form-control" id="situacao" name="situacao">
				<option selected="selected">Selecione a situação</option>
				<option value="1">Ativo</option>
				<option value="0">Inativo</option>
			</select>		  
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