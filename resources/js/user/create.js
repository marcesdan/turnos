$(function() {

	 // valores comunes a los selects2
    let selectEspecialidadOptions = { 
      width: '100%', allowClear: true, language: "es",
      placeholder: {text: 'Especialidad'},
    };
    $('#especialidad').select2(selectEspecialidadOptions);

   
	$('#rol').change(function() {
		// si es un médico se deberá asignarle una especialidad
		if ($(this).val() === 'Médico') {
			$('#form-group-especialidad').removeClass('d-none');
			$('#especialidad').attr('required', true);
		}
		else {
			$('#form-group-especialidad').addClass('d-none');
			$('#especialidad').attr('required', false);
			$('#nueva-especialidad').attr('required', false);
		}
	});

	let nuevaEspecialidad = false;
	// es como un "toggle"
	$('#crear-nueva-especialidad').on('click', function(event) {
		event.preventDefault();
		if (!nuevaEspecialidad) {
			//se oculta select2 con todas las especialidades y ya no es "requerido"
			$('#especialidad')
				.next(".select2-container")
				.hide();
			$('#especialidad').attr("required", false)
			// aparece un campo de texto donde irá la nueva especialidad y es "requerido"
			$('#nueva-especialidad')
				.removeClass('d-none')
				.attr("required", true);
			$(this).text('Asignar especialidad ya existente');	
			nuevaEspecialidad = true;
		} else {
			// el caso inverso, se vuelve a mostrar todas las especialidades con select2
			$('#especialidad')
				.next(".select2-container")
				.show();
			$('#especialidad').attr('required', true);
			$('#nueva-especialidad')
				.addClass('d-none')
				.attr("required", false);
			$(this).text('Crear nueva especialidad');	
			nuevaEspecialidad = false;
		}
	});
});