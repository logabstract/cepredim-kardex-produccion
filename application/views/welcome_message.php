<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<!--<META HTTP-EQUIV="refresh" CONTENT="5">-->
		<meta http-equip="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="description" content="">
		<meta name="autor" content="">
    	<link rel="icon" href="<?php echo base_url('UNMSM.png'); ?>">
    	<link rel="shortcut icon" href="<?php echo base_url('UNMSM.png'); ?>"/>


		<title>CEPREDIM-KARDEX</title>

		<!-- Bootstrap core CSS -->

		<link href="<?php echo base_url('bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

	</head>

	<body role="document">
		<div class="container-fluid" >

			<div class="page-header">
				<h2>Insumos en el Almacén del CEPREDIM <small>(partidas con nueva nomenclatura)</small></h2>
			</div>

			<?php echo form_open('welcome/buscar','role="form" class="form"') ; ?>
				<div class="row">
      				<div class="col-md-12">
						<div class="input-group input-group-lg">
							<input type="text" class="form-control" id="search_term" name="search_term" value="<?=isset($search_term)? $search_term : '' ?>" placeholder="Busqueda por descripción">
							<div class="input-group-btn">
								<button type="submit" class="btn btn-default">buscar</button>
							</div>
						</div>
					</div>
				</div>
			</form>

			<div class="row">
				<div class="col-md-12">
					<p></p>
				</div>
			</div>

			<div class="panel panel-default"> 
				<div class="panel-body">
						<table class="table table-bordered table-condensed">
							<thead>
								<tr>
									<th>PARTIDA</th>
									<th>DESCRIPCION</th>
									<th>MARCA</th>
									<th>UNIDAD</th>
									<th>FECHA ULTIMA ENTRADA</th>
									<th>OC ULTIMA ENTRADA</th>
									<th>P/U ULTIMA ENTRADA</th>
									<th>STOCK ACTUAL</th>								
								</tr>
							</thead>
							<tbody>
							<?php if ($query->num_rows() > 0): ?>
								<?php foreach ($query->result() as $row): ?>
										<td><?php echo $row->PAR_COD; ?></td>
										<td><?php echo utf8_encode($row->INS_DES); ?></td>
										<td><?php echo utf8_encode($row->MAR_NOM); ?></td>
										<td><?php echo utf8_encode($row->UNIM_NOM); ?></td>
										<td><?php echo date('d-m-Y', strtotime($row->ESD_FECHA)); ?></td>
										<td><?php echo $row->TIPES_NUM; ?></td>
										<td><?php echo $row->ESD_PRECIO_UNIT; ?></td>
										<td><?php echo $row->ESD_CANT_SALDO; ?></td>	
										</td>
									</tr>
								<?php endforeach; ?>
							<?php else : ?>
								<tr>
									<td colspan="8" class="info">No Insumos here!</td>
								</tr>
							<?php endif; ?>
							</tbody>
						</table>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 text-center">
					<?php echo $pagination; ?>
				</div>
			</div>

		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>

	    <script>

        //When DOM loaded we attach click event to button and set focus
        $(document).ready(function() {
            
            //set focus to 1st input field
            //$("#search_term").focus();

            (function($){
			    $.fn.focusTextToEnd = function(){
			        this.focus();
			        var $thisVal = this.val();
			        this.val('').val($thisVal);
			        return this;
			    }
			}(jQuery));

			$('#search_term').focusTextToEnd();
            

        });

    </script>

  	</body>
</html>