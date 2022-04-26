import axios from "axios";

const loansStateStore={
    state:{
        
    },
    mutations:{
        getStates(state, states){
            
        }
    },
    actions:{
        getStates: async function({commit},id){
            try{
                const response = await axios.get('/api/loam-states/'+id);
                commit('getStates', response.data);
            }catch(e){

            }
            
        }
    }
}