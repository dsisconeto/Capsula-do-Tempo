export default {
  SET_DISTANCIA: (state, distancia) => {
    state.distancia = distancia
  },
  SET_COORDENADAS: (state, {latitude, longitude}) => {
    state.coordenadas.latitude = latitude;
    state.coordenadas.longitude = longitude;
  }
}
