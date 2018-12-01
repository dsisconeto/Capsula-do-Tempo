<template>
  <div id="app">
    <b-navbar toggleable="md" type="dark" variant="info">
      <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

      <b-navbar-brand href="#" @click.prevent="$router.push({name:'pesquisarProduto'})">LocalMarket</b-navbar-brand>

      <b-collapse is-nav id="nav_collapse">
        <b-navbar-nav>
          <b-nav-item href="#" @click.prevent="$router.push({name:'carrinho'})">Carrinho ({{getCountItem}})</b-nav-item>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">

          <b-nav-form>
            <label style="color:#fff; margin-right: 5px">Distância</label>
            <b-form-input
              v-model="distancia"
              type="number"
              min="1"
              size="sm"
              class="mr-sm-2"
              placeholder="Distancia"
            />

          </b-nav-form>
        </b-navbar-nav>


      </b-collapse>
    </b-navbar>
    <router-view/>
  </div>
</template>

<script>
  import {mapGetters, mapActions, mapState} from 'vuex';

  export default {
    name: 'App',

    async mounted() {
      const position = await window.getPosition();
      position.coords.latitude;
      position.coords.longitude;
      this.setCoordenadas({latitude: position.coords.latitude, longitude: position.coords.longitude});

    },
    computed: {
      ...mapGetters({getCountItem: 'carrinho/getCountItem', getDistancia: "distancia/getDistancia"}),
      distancia: {
        set(value) {
          this.setDistancia(value)
        },
        get() {
          return this.getDistancia
        }
      },
    },
    methods: {
      ...mapActions({setDistancia: "distancia/setDistancia", setCoordenadas: "distancia/setCoordenadas"}),
    }

  }
</script>

<style>
  .navbar {
    margin-bottom: 50px;
  }
</style>
