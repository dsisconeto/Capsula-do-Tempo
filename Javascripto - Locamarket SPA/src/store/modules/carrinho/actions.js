export default {
  addItem(context, produto) {
    const index = context.state.items.findIndex((item) => {
      return item.produto.id === produto.id
    });
    if (index !== -1) {
      context.commit('INCREMENT_ITEM', index);
      return
    }

    context.commit('ADD_ITEM', {produto, quantidade: 1});
  },
  removeItem(context, id) {
    const index = context.state.items.findIndex((item) => {
      return item.produto.id === id
    });
    if (index === -1) {
      return;
    }
    context.commit('REMOVER_ITEM', index);
  }
}
