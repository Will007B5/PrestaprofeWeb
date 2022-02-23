import Vue from 'vue';
import Vuex from 'vuex';

//MODULOS
import loginModule from './loginModule';
import clientsStore from './clientsStore';
import usersStore from './usersStore';

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        loginModule,
        clientsStore,
        usersStore
    },

});

export default store;
