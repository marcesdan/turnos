import moment from "moment";
import swal from "sweetalert";
import {turnoService} from "../../services/turnoService";


$(function () {

    calendar();
    selectEspecialidad();
    selectMedico();
    planificarTurnos();
    
    function planificarTurnos() {

        $('#planificarBtn').click(function () {
            let data = {
                hora_desde: $('#hora_desde').val(),
                hora_hasta: $('#hora_hasta').val(),
                duracion: $('#duracion').val(),
                dias: dias,
            };
            turnoService.planificarSemana(data)
                .then(
                    data => {
                        refreshCalendar(data);
                        $('#planificarModal').modal('hide');
                        swal("Planificación realizada con éxito!", {
                            icon: "success",
                        });
                    },
                    error => {
                    }
                );
            });
    }

    function selectEspecialidad() {
         // valores comunes a los selects2
        let selectEspecialidadOptions = { 
          width: '100%',
          placeholder: 'Especialidad',
          allowClear: true,
        };
        $('#especialidad').select2(selectEspecialidadOptions);   
    }

    function selectMedico() {
         // valores comunes a los selects2
        let selectMedicoOptions = { 
          width: '100%',
          placeholder: 'Médico',
          allowClear: true,
        };
        $('#medico').select2(selectMedicoOptions);   
    }

    async function calendar() {
        let events = [];
        await turnoService.misTurnosActuales().then(
            data => events = data,
            error => {}
        );
        let misTurnos = $('#calendarDisponibilidad');
        let header = {
            left: 'prev,next today planificacionBtn',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek,'
        };
        let businessHours = {
            // days of week. an array of zero-based day of week integers (0=Sunday)
            dow: [1, 2, 3, 4], // Monday - Thursday
            start: '09:00', // a start time (10am in this example)
            end: '18:00', // an end time (6pm in this example)
        };
        misTurnos.fullCalendar({
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
            events: events
        })
    }

    function refreshCalendar(events) {
        $("#calendarDisponibilidad").fullCalendar('addEventSource', events);
    }
});
