<template>
    <div style="height:100%">
        <v-dialog
            v-model="dialog"
            fullscreen
            class="dialogo">
            <v-toolbar
                color="#006a82">
                <v-spacer></v-spacer>
                <v-toolbar-title class="white--text">Detalles del préstamo / <span>#</span></v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn
                    icon
                    color="white">
                    <v-icon>mdi-printer</v-icon>
                </v-btn>
                <v-btn
                    icon
                    color="white">
                    <v-icon>mdi-clipboard-text-search-outline</v-icon>
                </v-btn>
                <v-btn
                    icon
                    color="white">
                    <v-icon>mdi-email</v-icon>
                </v-btn>
                <v-spacer></v-spacer>
                <v-btn
                    small
                    fab
                    dark
                    color="red"
                    v-on:click="closePdf()"
                >
                    <v-icon dark>mdi-close</v-icon>
                </v-btn>
            </v-toolbar>
            <div class="contenedor">
                <iframe class="estiloPdf" :src="pdfSrc"></iframe>
            </div>
            
        </v-dialog>
    </div>
</template>

<script>
export default({
    name: 'DialogActionsLoans',
    data() {
        return {
            dialog: true,
            pdfSrc:'http://127.0.0.1:8000/api/loan-pdf#toolbar=0'
        }
    },
    methods: {
        getPdf: async function(){
            try{
                const response = await axios.get('/api/loan-pdf');
                //this.pdfSrc=response.data;
                console.log(response);
            }catch(e){

            }
        },
        closePdf: function(){
            this.dialog=false;
        }
    },
    created() {
        this.getPdf();
    },
})
</script>

<style scoped>
    .contenedor{
        height: 100%;
        width: 100%;
        background: rgba(40, 43, 37, 0.726);
        height: calc(100% - 64px);
    }
    
    .estiloPdf{
        height: 100%;
        width: 50%;
        margin: 0 auto;
        display: block;
    }
    .dialogo{
        
    }
</style>