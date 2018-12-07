/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./init');

// document ready
$(function () {

    import('./valiadmin' /* webpackChunkName: "js/valiadmin" */)
        .then(module => {
            module.init();
        });

    // poco feliz, y aún menos elegante...
    if ($("#tabla-user-index").length) {
        import('./views/user/index' /* webpackChunkName: "js/user-index" */)
            .then(module => {
                module.init();
            });
    } else if ($("#tabla-medico-index").length) {
        import('./views/medico/index' /* webpackChunkName: "js/medico-index" */)
            .then(module => {
                module.init();
            });
    } else if ($("#form-medico").length) {
        import('./views/medico/create' /* webpackChunkName: "js/medico-create" */)
            .then(module => {
                module.init();
            });
    } else if ($("#form-profile-medico").length) {
        import('./views/profile/medico' /* webpackChunkName: "js/profile-medico" */)
            .then(module => {
                module.init();
            });
    } else if ($("#tabla-paciente-index").length) {
        import('./views/paciente/index' /* webpackChunkName: "js/paciente-index" */)
            .then(module => {
                module.init();
            });
    } else if ($("#tabla-turnos-sin-confirmar").length) {
        import('./views/turno/sinConfirmar' /* webpackChunkName: "js/turnos-sin-confirmar" */)
            .then(module => {
                module.init();
            });
    } else if ($("#tabla-turnos-confirmados").length) {
        import('./views/turno/confirmados' /* webpackChunkName: "js/turnos-confirmados" */)
            .then(module => {
                module.init();
            });
    } else if ($("#calendar-index").length) {
        import('./views/turno/index' /* webpackChunkName: "js/turno-index" */)
            .then(module => {
                module.init();
            });
    } else if ($("#calendar-create").length) {
        import('./views/turno/create' /* webpackChunkName: "js/turno-create" */)
            .then(module => {
                module.init();
            });
    }
});


//window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//Vue.component('example-component', require('./components/ExampleComponent.vue'));

/*
import TablaUsuario from './components/TablaUsuario.vue'

const app = new Vue({
    el: '#app',
    components: {
   	 'tabla-usuario': TablaUsuario,
	}
});

*/

