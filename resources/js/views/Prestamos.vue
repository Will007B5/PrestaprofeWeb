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
                >Herramientas de búsqueda
                <v-icon>mdi-menu-down</v-icon></v-btn>
            </v-card-title>
            <v-card-actions
                v-if="false"
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
                :search="search">
                <template v-slot:item.false="{item}">
                    <v-switch></v-switch>
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
            headers: [
                {text:'Nombre(s)', value:'name'},
                {text:'Monto del préstamo', value:'base_amount'},
                {text:'Fecha', value:'application_date'},
                {text:'Plazo', value:'term'},
                {text:'Estado', value:false},
                {text:'Acción', value:''},
                {text:'ID', value:'id'}],
            search:''
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


<style scoped>
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
</style>
