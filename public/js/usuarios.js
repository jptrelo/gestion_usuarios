$(document).ready(function(){

/**
 * Evento del boton "eliminar", en el cual hacemos POST mediante ajax para eliminar usuarios seleccionados.
 */
    $('#elim-usuarios').click(function(e){

        //Si usuarios seleccionados, los asigna a var usuarios
        var usuarios = validaUsuarios();
        e.preventDefault(); 
    	if (confirm('Seguro que desea eliminar estos usuarios?')) {
    		eliminarUsuarios(usuarios);
    	}else{
    		return;
    	}        

    });

/**
 * Evento del boton "editar", en el cual hacemos POST mediante ajax para editar usuarios seleccionados.
 */
    $('#edit-usuarios').click(function(e){

        //Si usuarios seleccionados, los asigna a var usuarios
        var usuarios = validaUsuarios();
        e.preventDefault(); 
        //muestra botones de gestion de edicion 
    	$('.gestion-edita').show();
    	//oculta botones iniciales
    	$('.gestion-usuarios').hide();
    	//Ocultamos checkboxes para controlar la edicion de usuarios
    	$('input[type=checkbox]').parent().hide();
    	//Volvemos contenido editable de cada usuario a modificar
    	$(usuarios).each(function(){
        	$('#trUsuario' + $(this).val() +' td:nth-child(2), #trUsuario' + $(this).val() +' td:nth-child(3)')
        	.attr('contentEditable','true')
        	.focus()
        	.parent()
        	.toggleClass('warning');
        });   

    });

/**
 * Evento del boton "cancelar", en el cual cancelamos la edicion de usuarios.
 */
    $('.gestion-edita .cancela').click(function(e){
    	$('.gestion-edita').hide();
    	$('.gestion-usuarios').show();

    	$('td').removeAttr('contentEditable').parent().removeClass('warning');
    	$('input[type=checkbox]').parent().show();
	});

	$('.gestion-edita .guarda').click(function(e){

		var usuarios = validaUsuarios();
		var first_name = "";
		var last_name = "";
		var listaId = [];
		var row = {};
		$(usuarios).each(function(){
			first_name = $('#trUsuario' + $(this).val() +' td:nth-child(2)').html();
			last_name = $('#trUsuario' + $(this).val() +' td:nth-child(3)').html();
			row = { id : parseInt($(this).val()),
					first_name : first_name,
					last_name : last_name };
			listaId.push(row);
		}); 

		var formData = { listaUsuarios : listaId };

        $.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

		$.ajax({

            type: 'PUT',
            url: '/usuarios/update',
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                
                showMessage(data.message, 'success');    

                $('.gestion-edita .cancela').click();            
            },
            error: function (data) {
                console.log('Error:', data);
                showMessage('Ha ocurrido un error modificando.', 'danger');
            }
        });

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

	function validaUsuarios()
	{
		var usuarios = $('.tblUsuarios').find('input[type="checkbox"]:checked');

		//Si usuarios seleccionados
		if (usuarios.length > 0) {

			return usuarios;
	   		
	   	}else{
	   		showMessage('Debe seleccionar al menos un usuario.', 'warning');
	   		throw new Error('No hay usuarios seleccionados.');
	   	}
	}

	function eliminarUsuarios(usuarios){		

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

        $.ajax({

            type: 'POST',
            url: '/usuarios/eliminar',
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                
                showMessage(data.message, 'success');

                $(usuarios).each(function(){
		        	
		        	$('#trUsuario' + $(this).val()).remove();

		        });
            },
            error: function (data) {
                console.log('Error:', data);
                showMessage('Ha ocurrido un error eliminando.', 'danger');
            }
        });
	}

});