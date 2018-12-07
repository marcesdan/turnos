import moment from "moment";
import swal from "sweetalert";

const init = () => {
    datatable();
    deletePaciente();
    datatableFechas();
};
export {init}

function deletePaciente() {
    $(document).on('click', '#btn-paciente-delete', function (event) {
        event.preventDefault();
        let paciente = $(this).data('info').split(',');
        let pacienteId = paciente[0];
        let pacienteNombre = paciente[1];
        let pacienteApellido = paciente[2];
        swal({
            title: "Atención!",
            text: `Seguro desea eliminar al paciente ${pacienteNombre} ${pacienteApellido}?`,
            icon: "warning",
            buttons: ["Cancelar", "Eliminar"],
            dangerMode: true,
            closeOnClickOutside: false,
        })
            .then((willDelete) => {
                if (willDelete) {
                    axios.delete('/pacientes/' + pacienteId);
                    swal("Paciente eliminado con éxito!", {
                        icon: "success",
                    });
                    //eliminamos la fila de la tabla
                    $('#row' + pacienteId).remove();
                }
            });
    });
}

function datatableFechas() {
    $('.paciente-created-at').each(function (index, value) {
        let element = $(value);
        let date = moment(new Date(element.attr('data-date'))),
            update = function () {
                element.html(date.fromNow());
            };
        update();
        setInterval(update, 60000);
    });
}


function datatable() {

    $.fn.dataTable.ext.buttons.nuevo = {
        text: 'Nuevo paciente',
        className: 'btnNuevoPaciente',
        action: function (e, dt, node, config) {
            window.location.href = '/pacientes/nuevo';
        }
    };

    let tablaPaciente = $('#tabla-paciente-index').DataTable({
        "order": [[1, 'asc']],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
        },
        "lengthChange": false,
        paging: false,
        buttons: ['nuevo'],
    });

    tablaPaciente.buttons().container().appendTo('#tabla-paciente-index_wrapper .col-md-6:eq(0)');
    $(".btnNuevoPaciente").removeClass("btn-secondary").addClass("btn-primary");
    $('div.dataTables_filter input').focus()
}
