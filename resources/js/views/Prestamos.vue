import { default } from './Login.vue';
<template>
    <div class="p-3">
        <v-card>
            <v-card-title class="black">
                <span class="white--text">Lista de clientes</span>
                <v-spacer></v-spacer>
                <v-text-field
                    append-icon="mdi-magnify"
                    label="Buscar..."
                    solo
                    single-line
                    hide-details
                    v-model="search"
                ></v-text-field>
                <v-spacer></v-spacer>
                <v-btn
                    class="ma-2"
                    id="btnHerramientas"
                    @click="isBtnSearchTools=!isBtnSearchTools"
                >Herramientas de búsqueda
                <v-icon>mdi-menu-down</v-icon></v-btn>
            </v-card-title>
            <v-card-actions
                v-if="isBtnSearchTools"
                class="contenedorHerramientas">
                <v-select
                    label="Seleccionar Estado"
                    solo
                    hide-details
                    class="cbBusqueda"
                ></v-select>
                <v-spacer></v-spacer>
                <v-select
                    label="Seleccionar Grupo"
                    solo
                    hide-details
                    class="cbBusqueda"
                ></v-select>
                <v-spacer></v-spacer>
                <v-select
                    label="Seleccionar Nivel"
                    solo
                    hide-details
                    class="cbBusqueda"
                ></v-select>
                <v-spacer></v-spacer>
                <v-select
                    label="Seleccionar Institución"
                    solo
                    hide-details
                    class="cbBusqueda"
                ></v-select>
                <v-spacer></v-spacer>
            </v-card-actions>
            <v-data-table
                :headers="headers"
                :items="loans"
                :search="search"
                show-select
                :item-class="colorRow">
                <template v-slot:item.name="{item}">
                    {{item.last_name+' '+item.name}}
                </template>
                <template v-slot:item.state="{item}">
                    {{item.state}}
                    <v-menu
                        top
                        offset>
                        <template v-slot:activator="{on,attrs}">
                            <v-btn
                                icon
                                v-bind="attrs"
                                v-on="on">
                                <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-item
                                v-for="(item2, index) in item.accions"
                                :key="index"
                                link
                                dense>
                                <v-list-item-title>
                                    {{item2.name}}
                                </v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                    
                </template>
                <template v-slot:item.base_amount="{item}">
                    {{mxCurrencyFormat.format(item.base_amount)}}
                </template>
                <template v-slot:item.term="{item}">
                    {{item.term + " días" }}
                </template>
                <template v-slot:item.accion="{item}">
                    <v-btn
                        icon>
                        <v-icon>mdi-eye</v-icon>
                    </v-btn>
                </template>
            </v-data-table>
        </v-card>

        <DialogActionsLoans></DialogActionsLoans>
    </div>
</template>

<script>
import DialogActionsLoans from '../components/DialogActionsLoans.vue';
import { mapState } from 'vuex';

export default ({
    data() {
        return {
            mxCurrencyFormat: new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }),
            headers: [
                {text:'Nombre(s)', value:'name'},
                {text:'Monto del préstamo', value:'base_amount'},
                {text:'Fecha', value:'application_date'},
                {text:'Plazo', value:'term'},
                {text:'Estado', value:'state'},
                {text:'Acción', value:'accion'},
                {text:'ID', value:'id'}],
            search:'',
            listStates:[
                {title:'Pendiente', icon:'mdi-clock-outline'},
                {title:'Revisión', icon: 'mdi-magnify'},
                {title:'Activo', icon: 'mdi-access-point'},
                {title:'Vencido', icon: 'mdi-exclamation'},
                {title:'Congelado', icon: 'mdi-snowflake-alert'},
                {title:'Pagado', icon: 'mdi-check'},
                {title:'Rechazado', icon: 'mdi-close'}
            ],
            isBtnSearchTools:false
        }
    },
    methods: {
        colorRow(item){
            let clase='No';
            if(item.name=="Pendiente")
                clase="colorPendiente";
            if(item.name=="Revisión")
                clase="colorRevision";
            if(item.name=="Activo")
                clase="colorActivo";
            if(item.name=="Vencido")
                clase="colorVencido";
            if(item.name=="Congelado")
                clase="colorCongelado";
            if(item.name=="Pagado")
                clase="colorPagado";
            if(item.name=="Rechazado")
                clase="colorRechazado";

            return clase;
        },
        iconState(state){
            let icono="";
            if(state.name=="Pendiente")
                icono="mdi-clock-outline";
            if(state.name=="Revisión")
                icono="mdi-magnify";
            if(state.name=="Activo")
                icono="mdi-access-point";
            if(state.name=="Vencido")
                icono="mdi-exclamation";
            if(state.name=="Congelado")
                icono="mdi-snowflake-alert"
            if(state.name=="Pagado")
                icono="mdi-check";
            if(state.name=="Rechazado")
                clase="mdi-close";
            return icono;
        }
    },
    computed:{
        ...mapState({
            loans: state=>state.loansStore.loans
        })
    },
    components:{
        DialogActionsLoans
    },
    created() {
        this.$store.dispatch('getLoans');
    }
})
</script>


<style>
    #btnHerramientas{
        font-size: 14px;
        text-transform: none;
        color: rgb(0, 0, 0);
        background-color: #d1d1d1f3;
    }
    .cbBusqueda{
        font-size: 10px;
    }
    .contenedorHerramientas{
        background-color: #a39d9d4d;
    }
    .colorPendiente{
        background-color: rgba(241, 241, 241, 0.26) !important;
    }
    .colorPendiente:hover{
        background-color: rgba(241, 241, 241, 0.450) !important;
    }
    .colorRevision{
        background-color: rgba(238, 255, 0, 0.26) !important;
    }
    .colorRevision:hover{
        background-color: rgba(44, 136, 250, 0.4) !important;
    }
    .colorActivo{
        background-color: rgba(33, 228, 49, 0.26) !important;
    }
    .colorActivo:hover{
        background-color: rgba(33, 228, 49, 0.450) !important;
    }
    .colorVencido{
        background-color: rgba(224, 140, 12, 0.26) !important;
    }
    .colorVencido:hover{
        background-color: rgba(224, 140, 12, 0.45) !important;
    }
    .colorCongelado{
        background-color: rgba(33, 215, 228, 0.26) !important;
    }
    .colorCongelado:hover{
        background-color: rgba(33, 215, 228, 0.450) !important;
    }
    .colorPagado{
        background-color: rgba(33, 118, 228, 0.26) !important;
    }
    .colorPagado:hover{
        background-color: rgba(33, 118, 228, 0.450) !important;
    }
    .colorRechazado{
        background-color: rgba(228, 33, 33, 0.26) !important;
    }
    .colorRechazado:hover{
        background-color: rgba(228, 33, 33, 0.450) !important;
    }
</style>
