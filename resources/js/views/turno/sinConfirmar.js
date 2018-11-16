import swal from "sweetalert";
import {turnoService} from "../../services/turnoService";

let tablaTurnosSinConfirmar;
const init = () => {
    tablaTurnosSinConfirmar = datatable();
    cargarTurnosSinConfirmar();
    // se ejecútará cada 15 minutos
    setInterval(cargarTurnosSinConfirmar,900000);
    confirmarTurno();
    cancelarTurno();
};
export {init}

function cargarTurnosSinConfirmar() {
    turnoService.getTurnosSinConfirmar().then(data =>
        refreshTabla(data)
    );
}

function refreshTabla(data) {
    tablaTurnosSinConfirmar.clear().draw();
    tablaTurnosSinConfirmar.rows.add(data).draw();
}

function confirmarTurno() {
    $(document).on('click', '#btn-confirmar', function (event) {
        event.preventDefault();
        let turno = $(this).data('info').split(',');
        let turnoId = turno[0];
        let turnoPaciente = turno[1];
        swal({
            title: "Aviso!",
            text: `Vas a confirmar el turno del paciente ${turnoPaciente}?`,
            customClass: 'sweet-alert',
            icon: "success",
            buttons: true,
        })
            .then((willSuccess) => {
                if (willSuccess) {
                    axios.put(`/api/turnos/${turnoId}/confirmar`);
                    swal("Turno confirmado con éxito!", {
                        icon: "success",
                    });
                    //eliminamos la fila de la tabla
                    $('#' + turnoId).remove();
                }
            });
    });
}

function cancelarTurno() {
    $(document).on('click', '#btn-cancelar', function (event) {
        event.preventDefault();
        let turno = $(this).data('info').split(',');
        let turnoId = turno[0];
        let turnoPaciente = turno[1];
        swal({
            title: "Aviso!",
            text: `¿Seguro desea cancelar del paciente ${turnoPaciente} ?`,
            width: '1000px',
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    axios.put(`/api/turnos/${turnoId}/cancelar`);
                    swal("Turno cancelado con éxito!", {
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
                      <a href="#" class="btn btn-primary" id="btn-confirmar"
                          data-info="${o.id},${o.paciente}">
                          <i class="fa fa-check"></i>
                      </a>
                      <a href="#" class="btn btn-primary" id="btn-cancelar"
                          data-info="${o.id},${o.paciente}">
                          <i class="fa fa-times"></i>
                      </a>
             </div>
        </div>
        `;

    let tabla = $('#tabla-turnos-sin-confirmar').DataTable({
        "dom": '<"toolbar">frtip',
        "columns": [
            {"mData": "id", "visible": false, "bSortable": false},
            {"data": "paciente"},
            {"data": "medico"},
            {"data": "especialidad"},
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
        "order": [[4, 'asc']],
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
