<template>
    <div>
      <v-app-bar
        color="#006a82"
        dark
        flat
        height="58px"
        app
        clipped-left
      >
        <v-toolbar-title>Prestaprofe</v-toolbar-title>

        <v-spacer></v-spacer>

        <div>
            <v-row no-gutters>
                <v-icon size="30" left>
                  mdi-home
                </v-icon>
                <div>
                    <div style="font-size: 1.09rem" class="font-weight-bold">José María</div>
                    <div style="font-size: 0.67rem">Administrador</div>
                </div>
            </v-row>
        </div>


      </v-app-bar>
      <v-navigation-drawer
          color="#002b32"
          dark
          permanent
          app
          height="100%"
          clipped
        >

          <v-list
            nav
            dense
          >
            <v-list-item link>
              <v-list-item-icon>
                <v-icon>mdi-home</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Inicio</v-list-item-title>
            </v-list-item>
            <v-list-item link>
              <v-list-item-icon>
                <v-icon>mdi-piggy-bank</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Caja</v-list-item-title>
            </v-list-item>
            <v-list-item link>
              <v-list-item-icon>
                <v-icon>mdi-cash-register</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Préstamos</v-list-item-title>
            </v-list-item>
                        <v-list-item link>
              <v-list-item-icon>
                <v-icon>mdi-badge-account</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Clientes</v-list-item-title>
            </v-list-item>
                        <v-list-item link>
              <v-list-item-icon>
                <v-icon>mdi-hand-coin</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Cobros</v-list-item-title>
            </v-list-item>
                        <v-list-item link>
              <v-list-item-icon>
                <v-icon>mdi-history</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Atrasos</v-list-item-title>
            </v-list-item>
                        <v-list-item link>
              <v-list-item-icon>
                <v-icon>mdi-file-chart</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Reportes</v-list-item-title>
            </v-list-item>
                        <v-list-item link>
              <v-list-item-icon>
                <v-icon>mdi-account-group</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Usuarios</v-list-item-title>
            </v-list-item>
                        <v-list-item link>
              <v-list-item-icon>
                <v-icon>mdi-logout-variant</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Salir</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-navigation-drawer>
        <v-main>
            <v-app-bar
              color="#212121"
              dark
              flat
              height="51px"
            >
                <v-row no-gutters align="center" >
                    <v-icon size="28" left>
                      mdi-home
                    </v-icon>
                    <div class="font-weight-bold">INICIO</div>
                </v-row>
            </v-app-bar>
            <v-sheet
              color="#006a82"
              elevation="0"
              height="27vh"
              width="100%"
            ></v-sheet>
        </v-main>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>
