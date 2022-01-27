import Vue from 'vue';
import Vuex from 'vuex';

//MODULOS
import loginModule from './loginModule';

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        loginModule,
    },

});

export default store;
