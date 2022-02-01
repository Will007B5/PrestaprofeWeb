import axios  from 'axios';
const clientsStore = {
    state: {
        clients:[]
    },

    mutations: {
        setClients(state,clients){
            state.clients=clients;
        }
    },

    actions: {
        getClients: async function({commit}){
            try {
                const response = await axios.get("http://127.0.0.1:8000/api/getClients");
                commit('setClients',response.data);
                
            } catch (error) {
                
            }
        },
        checkClients: async function({commit},clients){
            try {
                const response = await axios.post("http://127.0.0.1:8000/api/checkClients",{clients});
                
                
            } catch (error) {
                
            }
        }
    }
}

export default clientsStore;
