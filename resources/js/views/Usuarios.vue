<template>
    <div>
        <v-card>
            <v-card-title>
                <v-text-field append-icon="mdi-magnify"
                label="Buscar..."
                single-line
                hide-details=""
                v-model="search"></v-text-field>
            </v-card-title>
            <v-card-text>
                <v-data-table
                :headers="headers"
                :items="usuarios"
                item-key="id"
                :search="search">
                    <template v-slot:item.active="{item}">
                        <v-switch color="success" inset v-model="item.active"  @mousedown="abrirDialogo(item)"></v-switch>
                    </template>
                    <template v-slot:item.actions="{item}">
                        <v-icon>mdi-account-edit</v-icon>
                    </template>
                </v-data-table>
            </v-card-text>
        </v-card>

        <v-dialog v-model="dialog" persistent>
            <v-card>
                <v-card-title>¿Estas seguro que deseas continuar con esta acción?</v-card-title>
                <v-card-text>Al modificar el estatus del usuario, estarás permitiendo o negando al usuario poder acceder al sistema</v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text color="green" @click="cambiarEstatus">Aceptar</v-btn>
                    <v-btn text color="red" @click="dialog=false">Cancelar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
    data(){
        return{
            search:'',
            headers:[
                {text:'Nombre(s)', value:'name'},
                {text:'Apellidos', value:'last_name'},
                {text:'Correo', value:'email'},
                {text:'Role', value:'role'},
                {text:'Estatus', value:'active'},
                {text: 'Acciones',value:'actions'}
            ],
            dialog:false,
            usuarioSelected:''
        }
    },
    created(){
        this.$store.dispatch('getUsuarios');
    },
    computed:{
        ...mapState({
            usuarios: state=>state.usersStore.usuarios
        })
    },
    methods:{
        cambiarEstatus(){
            var index=this.usuarios.map(usuario=>usuario.id).indexOf(this.usuarioSelected);
            //this.usuarios[index].active=(this.usuarios[index].active==0)?1:0;
            this.dialog=false;
            this.$store.dispatch('changeStatusUser',this.usuarios[index].id, index);

        },
        abrirDialogo(usuario){
            this.dialog=true;
            this.usuarioSelected=usuario.id;
        }
    }
}

</script>