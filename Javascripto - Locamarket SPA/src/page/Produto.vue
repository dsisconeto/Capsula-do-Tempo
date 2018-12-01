<template>
  <div class="container">
    <loading v-if="loading"/>
    <div class="row" v-show="!loading" id="page">
      <div class="col-md-12">
        <h1 class="text-center">{{produto.nome}}</h1>
      </div>
      <div class="col-md-6">
        <img :src="produto.img">
      </div>
      <div class="col-md-6">
        <div class="form-group row">
          <div class="col-md-6 offset-md-3">
            <button class="btn btn-primary" @click="addCarrinho">
              Adicionar ao Carrinho
            </button>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-6">
            <label for="ordem">Orderna Por</label>
            <select id="ordem" v-model="sort" class="form-control">
              <option value="valor">Valor</option>
              <option value="distancia">Distancia</option>
            </select>
          </div>
        </div>
        <table class="table" v-if="valores">
          <thead>
          <tr>
            <th>
              mercado
            </th>
            <th>
              distancia
            </th>
            <th>
              valor
            </th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(valor, index) in getValores">
            <td>
              {{valor.mercado.nome}}
            </td>
            <td>
              KM {{valor.distancia}}
            </td>
            <td>
              <b-badge variant="success" v-if="index ===0">
                R$ {{valor.valor}}
              </b-badge>
              <b-badge variant="danger" v-else-if="valores.length-1 === index">
                R$ {{valor.valor}}
              </b-badge>
              <b-badge v-else>
                R$ {{valor.valor}}
              </b-badge>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from '@/axios'
  import Loading from '@/components/Loading'
  import {mapActions, mapGetters} from 'vuex'

  export default {
    name: 'produto',
    components: {Loading},
    data() {
      return {
        produto: [],
        valores: [],
        sort: "valor",
        loading: true,
      }

    },
    async mounted() {
      await this.setProduto(this.getDistancia);
      this.loading = false
    },
    watch: {
      async getDistancia(newDistancia) {
        await this.setProduto(newDistancia);
      }
    },
    computed: {
      ...mapGetters({
        getDistancia: "distancia/getDistancia",
        getCoordenadas: "distancia/getCoordenadas"
      }),
      getValores() {

        if (this.sort === "valor") {
          return this.valores.sort((v1, v2) => {
            if (v1.valor === v2.valor) {
              return v1.distancia - v2.distancia;
            }
            return v1.valor - v2.valor;
          });
        }
        return this.valores.sort((v1, v2) => {
          return v1.distancia - v2.distancia;
        });
      },
    },

    methods: {
      ...mapActions({addItem: 'carrinho/addItem'}),
      addCarrinho() {
        this.addItem(this.produto);
      },
      async setProduto(distancia) {
        const response = await  axios.get('/rpc/produto/PesquisarValores', {
          params: {
            distancia: distancia,
            produto: this.$route.params.id,
            latitude: this.getCoordenadas.latitude,
            longitude: this.getCoordenadas.longitude,
          }
        });
        this.valores = response.data.valores;
        this.produto = response.data.produto;


        this.valores = this.valores.map(valor => {
          valor.distancia = Number(valor.distancia).toFixed(2);
          return valor
        })
      }

    },


  }
</script>

<style scoped>
  h1 {
    width: 100%;
    text-align: center;
    border-bottom: #ccc solid 1px;
    padding-bottom: 30px;
    margin-bottom: 20px;
  }

  img {
    width: 250px;
    padding: 10px;
    border-bottom: #ccc solid 1px;
  }
</style>
