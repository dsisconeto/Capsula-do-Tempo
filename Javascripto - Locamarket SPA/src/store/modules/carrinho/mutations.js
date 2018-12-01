export default {
  ADD_ITEM: (state, produtoQuantidade) => {
    state.items.push(produtoQuantidade)
  },
  INCREMENT_ITEM(state, indexItem) {
    state.items[indexItem].quantidade++
  },
  REMOVER_ITEM(state, indexItem) {
    state.items.splice(indexItem, 1);
  }

}
