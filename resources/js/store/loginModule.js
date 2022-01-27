import { isLoggedIn, logOut, logIn } from '../utils/auth';
const loginModule = {
    state: {
        isLoggedIn: localStorage.getItem('isLoggedIn') || false,
    },

    mutations: {
        setLoggedIn (state, isLogged){
            state.isLoggedIn = isLogged;
        }
    },

    actions: {
        login: async function ({commit}){
            try {
                commit('setLoggedIn', true);
                logIn();
            } catch (error) {
                error.dispose();
            }
        },

        logout: async function ({commit}){
            try {
                commit('setLoggedIn', false);
                logOut();
            } catch (error) {
                error.dispose();
            }
        },

        loadStoredState(context) {
            context.commit("setLoggedIn", isLoggedIn());
        },


    }
}

export default loginModule;
