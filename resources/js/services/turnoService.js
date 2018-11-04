import axios from 'axios';

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
        url: `/api/turnos/especialidad/${id}`,
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

function buscarPorMedico(id) {
    const requestOptions = {
        method: 'GET',
        url: `/api/turnos/medico/${id}`,
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

function getTurnosSinConfirmar() {
    const requestOptions = {
        method: 'GET',
        url: '/api/turnos/sin-confirmar/',
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

function reservarTurno(turno, paciente) {
    const requestOptions = {
        method: 'POST',
        url: `/api/turnos/${turno}/paciente/${paciente}/`,
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
        url: '/api/turnos',
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

function getMisTurnosConfirmados() {
    const requestOptions = {
        method: 'GET',
        url: '/api/turnos/confirmados/',
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

function planificarSemana(data) {
    const requestOptions = {
        method: 'POST',
        url: '/api/turnos',
        headers: {'Content-Type': 'application/json'},
        data: {
            hora_desde: data.hora_desde,
            hora_hasta: data.hora_hasta,
            duracion: data.duracion,
            dias: data.dias,
        }
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

