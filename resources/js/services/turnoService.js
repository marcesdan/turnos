import axios from 'axios';

export const turnoService = {
    planificarSemana,
    misTurnosActuales,
};

function planificarSemana(data) {
    const requestOptions = {
        method: 'POST',
        url: 'api/turno',
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

function misTurnosActuales() {
    const requestOptions = {
        method: 'GET',
        url: 'api/turno',
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

