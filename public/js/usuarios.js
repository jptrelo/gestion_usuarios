$(document).ready(function(){

/**
 * Evento del boton "eliminar", en el cual hacemos POST mediante ajax para eliminar usuarios seleccionados.
 */
    $('#elim-usuarios').click(function(e){
        
        var usuarios = $('.tblUsuarios').find('input[type="checkbox"]:checked');

		//Si usuarios seleccionados
		if (usuarios.lenght > 0) {

	        var listaId = [];

	        $(usuarios).each(function(){
	        	listaId.push($(this).val());
	        });

	        var formData = { listaUsuarios : listaId };

	        $.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

			e.preventDefault(); 

	        $.ajax({

	            type: 'POST',
	            url: 'usuarios/eliminar',
	            data: formData,
	            dataType: 'json',
	            success: function (data) {
	                console.log(data);
	                
	                showMessage(data.message, 'success');

	                $(usuarios).each(function(){
			        	
			        	$('#usuario' + $(this).val()).slideUp();

			        });
	            },
	            error: function (data) {
	                console.log('Error:', data);
	                showMessage('Ha ocurrido un error eliminando.', 'danger');
	            }
	        });

        } else{

        	showMessage('Debe seleccionar al menos un usuario.', 'warning');

        };
    });

	/**
	 * [showMessage Funcion general para mostrar alertas de cualquier tipo]
	 * @param  {[type]} message [Texto de la alerta]
	 * @param  {[type]} type    [info, success, danger, warning]
	 */
	function showMessage(message, type = null){

		if (type == null) { type = 'info'; }

		$('#opcionesLista div div form').append('<div class="alert alert-' + type + ' alert-important">'+
                	'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                            message +'</div>');
	}

});