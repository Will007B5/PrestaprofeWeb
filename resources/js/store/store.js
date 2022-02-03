import Vue from 'vue';
import Vuex from 'vuex';

//MODULOS
import loginModule from './loginModule';
import clientsStore from './clientsStore';

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        loginModule,
        clientsStore
    },

});

export default store;
