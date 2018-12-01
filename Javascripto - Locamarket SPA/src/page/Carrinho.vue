s
<template>
  <div class="container">
    <loading v-if="loading"/>
    <div class="row" v-if="!loading">
      <div class="col-md-12">
        <table class="table">
          <thead>
          <tr>
            <th>Foto</th>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Ações</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="item in getItems">
            <td><img :src="item.produto.img"></td>
            <td>
              <a href="#"
                 v-html="item.produto.nome"
                 @click.prevent="$router.push({ name: 'produto', params:{ id: item.produto.id }})"
              >
              </a>

            </td>
            <td>{{item.quantidade}}</td>
            <td>
              <a href="#" @click.prevent="removeItem(item.produto.id)">Remover</a>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6 offset-3">
        <label for="ordem">Ordenar por </label>
        <select id="ordem" name="ordem" v-model="ordem" class="form-control">
          <option value="valor">Valor</option>
          <option value="distancia">Distancia</option>
        </select>
      </div>
    </div>
    <div class="row">
      <table style="margin: 20px 20px 20px 0" v-if="mercados.length > 0" class="table col-md-5"
             v-for="mercado in getMercados">
        <thead>
        <tr>
          <th>{{mercado.mercado.nome}}</th>
          <th>{{mercado.distancia | distancia}}</th>
          <th>R$ {{mercado.valor | valorFilter}}</th>

        </tr>

        </thead>
        <tbody>
        <tr v-for="produto in mercado.produtos">
          <td colspan="2">
            <a
              style="font-size:12px"
              href="#"
              v-html="produto.nome"
              @click.prevent="$router.push({ name: 'produto', params:{ id:produto.id }})"
            >
            </a>
          </td>
          <td>
            <small>
             {{produto.valor}}
            </small>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
  import {mapGetters, mapActions} from 'vuex';
  import axios from '@/axios'

  export default {
    name: "carrinho",
    data() {
      return {
        produtosId: [],
        loading: false,
        latitude: 0.0,
        mercados: [],
        ordem: "valor"
      }
    },
    computed: {
      ...mapGetters({
        getItems: 'carrinho/getItems',
        getDistancia: "distancia/getDistancia",
        getCoordenadas: "distancia/getCoordenadas"
      }),
      getMercados() {

        if (this.ordem === "valor") {
          return this.mercados.sort((a, b) => {
            if (a.valor === b.valor) {
              return a.distancia - b.distancia
            }
            return a.valor - b.valor
          });
        }

        return this.mercados.sort((a, b) => {
          return a.distancia - b.distancia
        });


      }
    },
    async mounted() {
      await this.calcularPreco(this.getDistancia);

    },

    watch: {
      async getDistancia(newDistancia) {
        await this.calcularPreco(newDistancia)
      }
    },
    filters: {
      valorFilter(value) {
        return "R$ " + Number(value).toFixed(2);
      },
      distancia(value) {

        return "KM " + Number(value).toFixed(3);
      }
    },
    methods: {
      ...mapActions({removeItem: 'carrinho/removeItem'}),
      async calcularPreco(distancia) {
        this.getItems.forEach(item => {
          this.produtosId.push(item.produto.id)
        });
        let response = null;
        try {
          let data = {
            produtos: this.produtosId,
            latitude: this.getCoordenadas.latitude,
            longitude: this.getCoordenadas.longitude,
            distancia: distancia
          };
          response = await axios.post('/rpc/produto/PesquisarValoresPorLista', data);
        } catch (e) {
          response = e.response
        }
        if (response.status !== 200) {
          return;
        }
        this.mercados = response.data


      },


    }
  }
</script>

<style scoped>

</style>
