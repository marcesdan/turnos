import swal from "sweetalert";
import {turnoService} from "../../services/turnoService";

let tablaTurnosConfirmados;
const init = () => {
    tablaTurnosConfirmados = datatable();
    cargarTurnosConfirmados();
    // se ejecútará cada 15 minutos
    setInterval(cargarTurnosConfirmados,900000);
    finalizarTurno();
};
export {init}

function cargarTurnosConfirmados() {
    turnoService.getMisTurnosConfirmados().then(data =>
        refreshTabla(data)
    );
}

function refreshTabla(data) {
    tablaTurnosConfirmados.clear().draw();
    tablaTurnosConfirmados.rows.add(data).draw();
}

function finalizarTurno() {
    $(document).on('click', '#btn-finalizar', function (event) {
        event.preventDefault();
        let turno = $(this).data('info').split(',');
        let turnoId = turno[0];
        let turnoPaciente = turno[1];
        let turnoDocumento = turno[2];
        swal({
            title: "Aviso!",
            text: `Usted está a punto de finalizar el turno del paciente ${turnoPaciente} ?`,
            icon: "success",
            buttons: true,
        })
            .then((willSuccess) => {
                if (willSuccess) {
                    axios.put(`/api/turnos/${turnoId}/finalizar`);
                    swal("Turno finalizado con éxito!", {
                        icon: "success",
                    });
                    //eliminamos la fila de la tabla
                    $('#' + turnoId).remove();
                }
            });
    });
}

function datatable() {

    let tableButtons = (o) =>
        `
        <div class="wrapper text-center">
            <div class="btn-group btn-group-sm display-1">
                      <a href="#" class="btn btn-primary" id="btn-finalizar"
                          data-info="${o.id},${o.nombre},${o.documento}">
                          <i class="fa fa-heart"></i> Atender turno
                      </a>
             </div>
        </div>
        `;

    let tabla = $('#tabla-turnos-confirmados').DataTable({
        "dom": '<"toolbar">frtip',
        "columns": [
            {"mData": "id", "visible": false, "bSortable": false},
            {"data": "nombre"},
            {"data": "documento"},
            {"data": "hora"},
            {
                "mData": null,
                "bSortable": false,
                "mRender": function (o) {
                    return tableButtons(o);
                }
            }
        ],
        "rowId": 'id',
        "order": [[3, 'asc']],
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
    });

    $('div.dataTables_filter input').focus();
    $("div.toolbar").html('<p class="h4">Listado de turnos</p>');

    return tabla;
}
