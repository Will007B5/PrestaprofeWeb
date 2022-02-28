<template>
    <v-row no-gutters style="background-color: #006a82" justify="center" align="center">
        <v-col cols="6" class="d-flex justify-center">
            <v-card flat dense max-width="550" >
                <v-card-title class="v-flex justify-center black white--text">INICIAR SESIÓN EN PRESTAPROFE</v-card-title>
                <v-card-text style="padding: 32px 32px 16px 32px;">
                    <v-row>
                        <v-col cols="12">
                            <v-text-field
                            v-model="email"
                            prepend-icon="mdi-account"
                            color="pprimary"
                            dense
                            filled
                            rounded
                            placeholder="Usuario">
                            </v-text-field>

                             <v-text-field
                             :error-messages="passwordError"
                             v-model="password"
                             prepend-icon="mdi-lock"
                             color="pprimary"
                             append-icon="mdi-eye"
                             dense
                             filled
                             rounded
                             placeholder="Contraseña"
                             type="password">
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" class="text-center">
                            <router-link style="color: #006a82" to="#">¿Olvidaste tu Contraseña?</router-link>
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                    :loading="isLoadingButton"
                    @click="intentLogin()"
                    text
                    depressed
                    color="#006a82" >Entrar</v-btn>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
import axios from 'axios';
import { logIn } from '../utils/auth';

export default {
    data(){
        return{
            isLoadingButton: false,
            email: '',
            password: '',
            passwordError: ''
        }
    },
    methods: {
        intentLogin: async function(){
            /*this.isLoadingButton = true;

            setTimeout(() => {
                if(this.password == 'prestaprofe'){
                    this.$store.dispatch('login')
                    this.$router.push({name: 'Inicio'})
                    this.isLoadingButton = false;
                }else{
                    this.passwordError = 'Contraseña incorrecta'
                    this.isLoadingButton = false;
                }
            }, 2000);*/
            try {
                await axios.get('/sanctum/csrf-cookie');
                await axios.post("/login",{
                    email: this.email,
                    password: this.password
                });
                logIn();
                this.$store.dispatch('login');
                this.$store.dispatch('loadUser');
                this.$router.push({name: 'Inicio'});
            } catch (error) {
                
            }
        }
    },
    async beforeCreate(){
       
    }
}
</script>

