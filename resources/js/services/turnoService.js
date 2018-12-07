import axios from 'axios';
import {internalApiPrefix, publicApiPrefix} from '../helpers/config';
import {transfomer} from "../helpers/transformer";

export const turnoService = {
    buscarPorEspecialidad,
    buscarPorMedico,
    getTurnosSinConfirmar,
    getMisTurnosActuales,
    getMisTurnosConfirmados,
    planificarSemana,
    reservarTurno,
};

/*
|--------------------------------------------------------------------------
| Para el usuario recepcionista
|--------------------------------------------------------------------------
*/
function buscarPorEspecialidad(id) {
    const requestOptions = {
        method: 'GET',
        url: `/${internalApiPrefix}/turnos/especialidad/${id}`,
        headers: {'Content-Type': 'application/json'},
    };
    return axios(requestOptions)
        .then(response =>
            // se transforma al formato de fullcalendar
            transfomer.turnosToCalendarFormat(response.data.data)
        )
        .catch(error => {
            if (error.response.status === 401) {
                // auto logout if 401 response returned from api
                location.reload(true);
            }
        });
}

function buscarPorMedico(id) {
    const requestOptions = {
        method: 'GET',
        url: `/${internalApiPrefix}/turnos/medico/${id}`,
        headers: {'Content-Type': 'application/json'},
    };
    return axios(requestOptions)
        .then(response =>
            // se transforma al formato de fullcalendar
            transfomer.turnosToCalendarFormat(response.data.data)
        )
        .catch(error => {
            if (error.response.status === 401) {
                // auto logout if 401 response returned from api
                location.reload(true);
            }
        });
}

function getTurnosSinConfirmar() {
    const requestOptions = {
        method: 'GET',
        url: `/${internalApiPrefix}/turnos/sin-confirmar/`,
        headers: {'Content-Type': 'application/json'},
    };
    return axios(requestOptions)
        .then(response =>
            transfomer.turnosToSinConfirmarFormat(response.data.data)
        )
        .catch(error => {
            if (error.response.status === 401) {
                // auto logout if 401 response returned from api
                location.reload(true);
            }
        });
}

function reservarTurno(turno, paciente) {
    const requestOptions = {
        method: 'POST',
        url: `/${internalApiPrefix}/turnos/${turno}/paciente/${paciente}/`,
        headers: {'Content-Type': 'application/json'},
    };
    return axios(requestOptions)
        .then(response => response.data.data)
        .catch(error => {
            if (error.response.status === 401) {
                // auto logout if 401 response returned from api
                location.reload(true);
            }
        });
}

/*
|--------------------------------------------------------------------------
| Para el médico
|--------------------------------------------------------------------------
*/
function getMisTurnosActuales() {
    const requestOptions = {
        method: 'GET',
        url: `/${internalApiPrefix}/turnos`,
        headers: {'Content-Type': 'application/json'},
    };
    return axios(requestOptions)
        .then(response =>
            // se transforma al formato de fullcalendar
            transfomer.turnosToCalendarFormat(response.data.data)
        )
        .catch(error => {
            if (error.response.status === 401) {
                // auto logout if 401 response returned from api
                location.reload(true);
            }
        });
}

function getMisTurnosConfirmados() {
    const requestOptions = {
        method: 'GET',
        url: `/${internalApiPrefix}/turnos/confirmados/`,
        headers: {'Content-Type': 'application/json'},
    };
    return axios(requestOptions)
        .then(response =>
            transfomer.turnosToConfirmadosFormat(response.data.data)
        )
        .catch(error => {
            if (error.response.status === 401) {
                // auto logout if 401 response returned from api
                location.reload(true);
            }
        });
}

function planificarSemana(data) {
    const requestOptions = {
        method: 'POST',
        url: `/${internalApiPrefix}/turnos`,
        headers: {'Content-Type': 'application/json'},
        data: {
            hora_desde: data.hora_desde,
            hora_hasta: data.hora_hasta,
            duracion: data.duracion,
            dias: data.dias,
        }
    };
    return axios(requestOptions)
        .then(response => 
            // se transforma al formato de fullcalendar
            transfomer.turnosToCalendarFormat(response.data.data)
        )
        .catch(error => {
            if (error.response.status === 401) {
                // auto logout if 401 response returned from api
                location.reload(true);
            }
        });
}

