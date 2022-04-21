<template>
    <div>
        <v-dialog
            v-model="dialog"
            width="500px">
            <v-card>
                <v-card-title class="justify-center">
                    <span>¿Qué deseas hacer?</span>
                </v-card-title>
                <v-card-text>
                    <v-container class="d-flex justify-center">
                        <div class="containerActions">
                            <v-btn
                                fab
                                color="green">
                                <v-icon color="white">
                                    mdi-check
                                </v-icon>
                            </v-btn>
                            <p>Aceptar préstamo</p>
                        </div>
                        <v-spacer></v-spacer>
                        <div class="containerActions">
                            <v-btn
                                fab
                                color="red">
                                <v-icon color="white">
                                    mdi-close
                                </v-icon>
                            </v-btn>
                            <p>Rechazar préstamo</p>
                        </div>
                        <v-spacer></v-spacer>
                        <div class="containerActions">
                            <v-btn
                                fab
                                color="#FFD600">
                                <v-icon color="white">
                                    mdi-magnify
                                </v-icon>
                            </v-btn>
                            <p>Revisar préstamo</p>
                        </div>
                    </v-container>
                </v-card-text>
                <v-card-actions class="d-block">
                    <h5 class="px-4">Anotaciones</h5>
                    <p class="px-4">Indica la razón por la cual se x el préstamo</p>
                    <div class="containerActions">
                        <v-textarea
                        style="width: 100%"
                        class="px-4"
                        hide-details
                        outlined
                    ></v-textarea>
                    <v-checkbox
                        label="Enviar notificación al cliente.">
                    </v-checkbox>
                    <v-btn
                    color="blue"
                    >Continuar</v-btn>
                    </div>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default({
    name: 'DialogActionsLoans',
    data() {
        return {
            dialog: true
        }
    },
})
</script>

<style scoped>
.containerActions{
    display: flex;
    flex-direction: column;
    align-items: center;
}
</style>