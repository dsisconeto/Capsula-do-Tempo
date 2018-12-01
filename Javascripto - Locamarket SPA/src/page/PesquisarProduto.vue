<template>
  <div class="container">
    <div class="form-group row">
      <div class="col-md-12">
        <label for="nome">Pesquise pelo nome do produto</label>
        <input type="text" autocomplete="off" minlength="2" id="nome" v-model="nome" @keyup="pesquisar" class="form-control">
      </div>
    </div>


    <div class="row">
      <div class="col-md-12">
        <loading v-if="loading"/>
        <table class="table" v-if="!this.loading &&produtos.length">
          <tbody>
          <tr v-for="produto in produtos">
            <td><img :src="produto.img"></td>
            <td>
              <h3>
                <a href="#"
                   v-html="produto.nome"
                   @click.prevent="$router.push({ name: 'produto', params:{ id: produto.id }})"
                >

                </a>
              </h3>
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

  export default {
    name: "Produto",
    components: {Loading},
    data() {
      return {
        loading: false,
        nome: '',
        produtos: []
      }
    },
    async mounted() {
      await getPosition()
    },
    methods: {

      async pesquisar() {
        if (this.loading) {
          return
        }
        this.loading = true;
        let response;
        try {
          response = await axios.get('/rpc/produto/pesquisarProduto', {params: {nome: this.nome}})
        } catch (e) {
          response = e.response;
          return
        }
        this.produtos = response.data;

        setTimeout(() => {
          this.loading = false;
        }, 1000)
      }
    }
  }
</script>

<style scoped>

</style>
