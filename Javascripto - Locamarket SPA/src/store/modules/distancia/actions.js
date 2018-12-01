export default {
  setDistancia(context, distancia) {
    context.commit('SET_DISTANCIA',  parseInt(distancia));
  },
  setCoordenadas(context, {latitude, longitude}) {
    context.commit('SET_COORDENADAS', {latitude, longitude});
  },
}
