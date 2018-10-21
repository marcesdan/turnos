import moment from "moment";
import swal from "sweetalert";

const init = () => {
    datatable();
    deleteMedico();
    datatableFechas();
};
export {init}

function deleteMedico() {
    $(document).on('click', '#btn-medico-delete', function (event) {
        event.preventDefault();
        let medico = $(this).data('info').split(',');
        let medicoId = medico[0];
        let medicoNombre = medico[1];
        let medicoApellido = medico[2];

        swal({
            title: "Aviso!",
            text: "¿Seguro desea eliminar al médico " + medicoNombre + " " + medicoApellido + "?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    axios.delete('/admin/medicos/' + medicoId);
                    swal("Médico eliminado con éxito!", {
                        icon: "success",
                    });
                    //eliminamos la fila de la tabla
                    $('#row' + medicoId).remove();
                }
            });
    });
}

function datatableFechas() {

    $('.medico-created-at').each(function (index, value) {
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
        text: 'Nuevo médico',
        className: 'btnNuevoMedico',
        action: function (e, dt, node, config) {
            window.location.href = '/admin/medicos/nuevo';
        }
    };

    let tablaMedico = $('#tabla-medico-index').DataTable({
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

    tablaMedico.buttons().container().appendTo('#tabla-medico-index_wrapper .col-md-6:eq(0)');
    $(".btnNuevoMedico").removeClass("btn-secondary").addClass("btn-primary");
    $('div.dataTables_filter input').focus()
}
