const init = () => {
    selectEspecialidad();
    nuevaEspecialidad();
};

export {init}

function selectEspecialidad() {
    // valores comunes a los selects2
    let selectEspecialidadOptions = {
        width: '100%',
        placeholder: 'Especialidad',
        allowClear: true,
    };
    $('#especialidad').select2(selectEspecialidadOptions);
}

function nuevaEspecialidad() {
    let nuevaEspecialidad = false;
    // es como un "toggle"
    $('#crear-nueva-especialidad').on('click', function (event) {
        event.preventDefault();
        let selectEspecialidad = $('#especialidad');
        let inputNuevaEspecialidad = $('#nueva-especialidad');
        if (!nuevaEspecialidad) {
            //se oculta select2 con todas las especialidades y ya no es "requerido"
            selectEspecialidad.next(".select2-container").hide();
            selectEspecialidad.attr("required", false);

            // aparece un campo de texto donde irá la nueva especialidad y es "requerido"
            inputNuevaEspecialidad.removeClass('d-none').attr("required", true).prop('disabled', false);
            $(this).text('Asignar especialidad ya existente');
            nuevaEspecialidad = true;
        } else {
            // el caso inverso, se vuelve a mostrar todas las especialidades con select2
            selectEspecialidad.next(".select2-container").show();
            selectEspecialidad.attr('required', true);
            inputNuevaEspecialidad.addClass('d-none').attr("required", false).prop('disabled', true);
            $(this).text('Crear nueva especialidad');
            nuevaEspecialidad = false;
        }
    });
}
