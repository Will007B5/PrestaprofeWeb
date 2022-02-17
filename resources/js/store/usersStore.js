import axios  from 'axios';
const usersStore={
    state:{
        usuarios: []
    },
    mutations:{
        setUsuarios(state, usuarios){
            state.usuarios=usuarios;
        },
        setStatusUser(state, data){
            var index=state.usuarios.map(usuario=>usuario.id).indexOf(data.id);
            state.usuarios[index].active=data.active;
        }
    },
    actions:{
        getUsuarios: async function({commit}){
            try{
                const response = await axios.get("/api/users");
                commit('setUsuarios',response.data);
            }catch(error){
                
            }
        },
        changeStatusUser: async function({commit}, id, index){
            try{
                const response = await axios.get("/api/changeStatusUser/"+id);
                const datos={active:response.data, id:id}
                commit('setStatusUser',datos);
            }catch(error){

            }
        }
    }
}

export default usersStore;