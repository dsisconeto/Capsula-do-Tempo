import Vue from 'vue'
import Vuex from 'vuex'
import carrinho from './modules/carrinho'
import distancia from './modules/distancia'

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    carrinho,
    distancia,
  }
})
