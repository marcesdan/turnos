import moment from "moment";
import swal from "sweetalert";
import {turnoService} from "../../services/turnoService";

let especialidad = $('#especialidad');
let medico = $('#medico');
let calendar = $('#calendar-create');

const init = () => {
    initCalendar();
    selectEspecialidad();
    selectMedico();
};
export {init}

function selectEspecialidad() {
    especialidad.select2({
        width: '100%',
        placeholder: 'Especialidad',
        allowClear: true,
    }).on('select2:select', async function (e) {
        buscarPorEspecialidad(e.params.data.id);
    });
}

function buscarPorEspecialidad(id) {
    turnoService.buscarPorEspecialidad(id)
        .then(
            data => resetCalendar(data),
            error => {
            }
        );
}

function selectMedico() {
    medico.select2({
        width: '100%',
        placeholder: 'Médico',
        allowClear: true,
    }).on('select2:select', function (e) {
        buscarPorMedico(e.params.data.id);
    });
}

function buscarPorMedico(id) {
    turnoService.buscarPorMedico(id)
        .then(
            data => resetCalendar(data),
            error => {
            }
        );
}

function initCalendar() {
    let header = {
        left: 'prev,next today planificacionBtn',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek,'
    };
    let businessHours = {
        // days of week. an array of zero-based day of week integers (0=Sunday)
        dow: [1, 2, 3, 4, 5], // Monday - Thursday
        start: '09:00', // a start time (10am in this example)
        end: '18:00', // an end time (6pm in this example)
    };
    calendar.fullCalendar({
        themeSystem: 'bootstrap4',
        header: header,
        defaultDate: moment(),
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        businessHours: businessHours,
        minTime: '09:00:00',
        maxTime: '17:00:00',
        forceEventDuration: true,
        slotDuration: '00:15:00',
        defaultTimedEventDuration: '00:30:00',
        eventClick(calEvent, jsEvent, view) {
            reservarTurno(calEvent.id, calEvent.start);
        },
    })
}

function reservarTurno(turno, start) {
    let dia = moment(start).format('DD/MM/YY');
    let hora = moment(start).format('hh:mm a');
    let paciente = $('#id').val();
    swal({
        title: "Aviso",
        text: `Va a reservar un turno para el dia ${dia} a las ${hora}`,
        icon: "warning",
        buttons: true,
    }).then(reservado => {
        if (reservado) {
            turnoService.reservarTurno(turno, paciente)
                .then(response => {
                    swal("Turno reservado con éxito!", "Pulse ok para continuar", "success")
                        .then(value => {
                            location.href = "/pacientes";
                        })
                },
                error => {
                    swal("No se ha podido reservar el turno!", {
                        icon: "warning",
                    });
                }
            );
        }
    });
}

/**
 * Agrega eventos dinámicamente al calendario
 * @param events
 */
function refreshCalendar(events) {
    calendar.fullCalendar('addEventSource', events);
}

/**
 * Elimina todos los eventos y agrega nuevos dinámicamente
 * @param events
 */
function resetCalendar(events) {
    calendar.fullCalendar('removeEvents');
    refreshCalendar(events);
}
