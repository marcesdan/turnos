import moment from "moment";
import swal from "sweetalert";

const init = () => {
    datatable();
    deleteUser();
    datatableFechas();
};
export {init}

function deleteUser() {
    $(document).on('click', '#btn-user-delete', function (event) {
        event.preventDefault();
        let user = $(this).data('info').split(',');
        let userId = user[0];
        let userNombre = user[1];
        let userApellido = user[2];
        swal({
            title: "Aviso!",
            text: "¿Seguro desea eliminar al usuario " + userNombre + " " + userApellido + "?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    axios.delete('/admin/usuarios/' + userId);
                    swal("Usuario eliminado con éxito!", {
                        icon: "success",
                    });
                    //eliminamos la fila de la tabla
                    $('#row' + userId).remove();
                }
            });
    });
}

function datatableFechas() {
    $('.user-created-at').each(function (index, value) {
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
        text: 'Nuevo usuario',
        className: 'btnNuevoUsuario',
        action: function (e, dt, node, config) {
            window.location.href = '/admin/usuarios/nuevo';
        }
    };

    let tablaUsuario = $('#tabla-user-index').DataTable({
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

    tablaUsuario.buttons().container().appendTo('#tabla-user-index_wrapper .col-md-6:eq(0)');
    $(".btnNuevoUsuario").removeClass("btn-secondary").addClass("btn-primary");
    $('div.dataTables_filter input').focus()
}
