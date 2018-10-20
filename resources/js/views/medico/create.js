$(function() {
	 // valores comunes a los selects2
    let selectEspecialidadOptions = { 
      width: '100%',
      placeholder: 'Especialidad',
      allowClear: true,
    };
    $('#especialidad').select2(selectEspecialidadOptions);   

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
				.attr("required", true)
				.prop('disabled', false);
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
				.attr("required", false)
				.prop('disabled', true);
			$(this).text('Crear nueva especialidad');	
			nuevaEspecialidad = false;
		}
	});
});