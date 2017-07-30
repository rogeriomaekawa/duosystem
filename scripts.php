    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" crossorigin="anonymous"></script>
	<script src="js/jquery.maskedinput.min.js" crossorigin="anonymous"></script>
	<script>
	$(function($){
		$("#data_inicio").mask("99/99/9999");
		$("#data_fim").mask("99/99/9999");  
	});	
	$( "#formatividade" ).validate( {
		rules: {
			nome: {
				required: true,
				maxlength: 255
			},			
			descricao: {
				required: true,
				maxlength: 600
			},						
			data_inicio: "required",
			data_fim: {
	            required: {
	                depends: function(element) {
	                    return $('#status').val() == '4'
	                }
	            }
	        }			
		},
		messages: {						
			nome: {
				required: "O campo nome é obrigatório",
				maxlength: "O campo nome deve conter no máximo 255 caracteres"
			},
			descricao: {
				required: "O campo descrição é obrigatório",
				maxlength: "O campo nome deve conter no máximo 600 caracteres"
			},
			data_inicio: "O campo data de inicio é obrigatório",
			data_fim: "O campo data fim é obrigatório quando o status da atividade está como concluido",			
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );
			// Add `has-feedback` class to the parent div.form-group
			// in order to add icons to inputs
			element.parents( ".col-sm-5" ).addClass( "has-feedback" );

			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.parent( "label" ) );
			} else {
				error.insertAfter( element );
			}
			// Add the span element, if doesn't exists, and apply the icon classes to it.
			if ( !element.next( "span" )[ 0 ] ) {
				$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
			}
		},
		success: function ( label, element ) {
			// Add the span element, if doesn't exists, and apply the icon classes to it.
			if ( !$( element ).next( "span" )[ 0 ] ) {
				$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
			$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
			$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
		}
	} );
	</script>	
