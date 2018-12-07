import moment from "moment";

export const transfomer = {
    turnosToCalendarFormat,
    turnosToConfirmadosFormat,
    turnosToSinConfirmarFormat,
};

/**
* Transforma el recurso Turnos, a uno con las claves necesarias
 * para fullcalendar
*/
function turnosToCalendarFormat(turnos) {
    return turnos.map(
        ({
             id: id,
             nombre: title, // el nombre del paciente, o "libre" si no está reservado
             fecha: start, // la fecha del turno
         }) => ({
            id,
            title,
            start
        }));
}

/**
 * Transforma el recurso Turnos, a uno con las claves
 * para la tabla de turnos confirmados
 */
function turnosToConfirmadosFormat(turnos) {
    let aux = []
    for (let turno of turnos) {
        let auxTurno = {
            id: turno.id,
            nombre: turno.nombre,
            documento: turno.paciente.documento,
            hora: moment(turno.fecha).format('HH:mm')
        }
        aux.push(auxTurno)
    }
    return aux
}

/**
 * Transforma el recurso Turnos, a uno con las claves necesarias
 * para la tabla de turnos sin confirmar
 */
function turnosToSinConfirmarFormat(turnos) {
    let aux = []
    for (let turno of turnos) {
        let auxTurno = {
            id: turno.id,
            nombre: turno.nombre,
            medico: turno.medico,
            especialidad: turno.especialidad,
            hora: moment(turno.fecha).format('HH:mm')
        }
        aux.push(auxTurno)
    }
    return aux
}
