<?php	
	include("config.php");
	include("classes/atividade.php");	
	$atividade = new Atividade();
	$listastatus = $atividade->listarStatus($con);	
?>
<!DOCTYPE html>
<html lang="en">
	<?php include("header.php"); ?>
  <body>
    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Atividades</h1>
      </div>

      <div class="col">

      <form id="filtro" class="form-inline">
	      <div class="form-group">
		  	<label for="status" class="control-label">Status</label>
			<select class="form-control" id="status" name="status">
				<option selected="selected" value="">Selecione o status</option>
				<?php
				foreach($listastatus as $key => $value)
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
				<option selected="selected" value="">Selecione a situação</option>
				<option value="1">Ativo</option>
				<option value="0">Inativo</option>
			</select>		  
		  </div>
		  <div class="form-group" style="text-align: right;">		  
		  	<button type="button" class="btn btn-secondary" id="bt_filtro">Filtrar</button>	  
		  </div>	
      </form>

      </div>

      <div class="listagem"></div>
      <div class="form-group" style="text-align: right;">		  
    	<a href="incluir.php" class="btn btn-primary right">Incluir</a>
      </div>	
    </div>

    <footer class="footer">
      <div class="container">        
      </div>
    </footer>

    <?php include("scripts.php"); ?>
    <script>
		$(document).ready(function(){
		    $("#bt_filtro").click(function(){
		        var filtros = $("#filtro").serialize();
				$(".listagem").load("listagem.php?"+filtros);		        
		    });

		    $(".listagem").load("listagem.php");
		});        	
    </script>
  </body>
</html>