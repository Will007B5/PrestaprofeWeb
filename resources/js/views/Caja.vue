<template>
    <div>
        <v-row class="m-1">
                <v-col cols="12" md="6">
                    <div class="text-h5 white--text">Monto de dinero en caja</div>
                    <span class="text-h4 white--text" >$0.00 MXN</span>
                </v-col>
                <v-col cols="12" md="6">
                    <div class="d-block d-lg-flex">
                        <v-text-field
                            hint="Ingreso de dinero"
                            persistent-hint
                            outlined
                            class="white--text d-block"
                            prepend-inner-icon="mdi-currency-usd"
                        ></v-text-field>
                        <v-btn
                            class="d-block m-0 ml-lg-4"
                            tile
                            depressed
                            color="primary"
                        >Agregar dinero a caja</v-btn>
                    </div>
                    <div class="mt-5 d-block d-lg-flex">
                        <v-text-field
                            hint="Egreso de dinero"
                            persistent-hint
                            outlined
                            class="white--text d-block"
                            prepend-inner-icon="mdi-currency-usd"
                        ></v-text-field>
                        <v-btn
                            class="d-block m-0 ml-lg-4"
                            tile
                            depressed
                            color="primary"
                        >Retira dinero a caja</v-btn>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <v-col
                    cols="12">
                    <div class="black p-2 text-center text-md-left d-block d-md-flex">
                        <p class="d-block white--text text-h4 float-none">Reporte de ingresos</p>
                        <div class="d-flex justify-center d-md-block">
                            <div class="d-block d-md-flex justify-center" style="max-width: 200px">
                                <v-menu
                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="auto">
                                    <template
                                        v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            label="Picker without buttons"
                                            prepend-icon="mdi-calendar"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on">
                                        </v-text-field>
                                    </template>
                                    <v-date-picker
                                    ></v-date-picker>
                                </v-menu>
                            </div>
                        </div>
                        
                    </div>
                    <!---->
                    <v-data-table
                        :headers="headers"
                        :search="search"
                        
                        item-key="id">
                    </v-data-table>
                    <!---->
                    <div>
                        <p class="text-h5 text-right">Total:</p>
                    </div>
                </v-col>
            </v-row>
    </div>
</template>

<script>
export default {
    data(){
        return{
            search:'',
            headers: [
                {text:'Código', value:'codigo'},
                {text:'Ingreso', value:'ingreso'},
                {text:'Fecha', value:'fecha'},
                {text:'Motivo', value:'motivo'}
            ]
        }
    }
}
</script>
