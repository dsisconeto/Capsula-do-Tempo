import Vue from 'vue'
import Router from 'vue-router'
import PesquisarProduto from '@/page/PesquisarProduto'
import Produto from '@/page/Produto'
import Carrinho from '@/page/Carrinho'

Vue.use(Router)

window.getPosition = function (options) {
  return new Promise(function (resolve, reject) {
    navigator.geolocation.getCurrentPosition(resolve, reject, options);
  });
};


export default new Router({
  routes: [
    {
      path: '/',
      name: 'pesquisarProduto',
      component: PesquisarProduto
    },
    {
      path: '/produto/:id/',
      name: 'produto',
      component: Produto
    },
    {
      path: '/carrinho/',
      name: 'carrinho',
      component: Carrinho
    }
  ]
})
