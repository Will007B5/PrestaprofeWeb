<template>
    <div>
        <v-dialog persistent v-model="isDialogDate">
            <v-card>
                <v-date-picker ></v-date-picker>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    name: 'DialogDate',
    data(){
        return{
            isDialogDate:false
        }
    }
}
</script>