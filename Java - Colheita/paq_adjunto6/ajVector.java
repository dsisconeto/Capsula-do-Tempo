/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package paq_adjunto6;

/**
 *
 * @author usuario
 */
public class ajVector {
     /**
     * Recibe el texto completo a partir de la busqueda entre el dato a buscar y un vector, toda vez que el vector encuentre una minima coincidencia. <br><br>
     * Ejemplo: "po"(datoBuscar) y {"poderoso","admin","postgres"} entonces como encontro uno que coincida "po" en el vector retorna la palabra completa: poderoso
     * @param datoBuscar
     * @param veDatos
     * @return
     */
    public static String getTextoApartirVector(String datoBuscar, String[]veDatos)
    {

        int nroPosicion = getPositionVectorBusSemi(datoBuscar, veDatos);
        if (nroPosicion==-1)
            return datoBuscar;
        return veDatos[nroPosicion];
    }
    /**
     * Recibe la posicion del vector a partir de la busqueda entre el dato a buscar y un vector, toda vez que el vector encuentre una minima coincidencia. <br><br>
     * Ejemplo: "po"(datoBuscar) y {"poderoso","admin","postgres"} entonces como encontro uno que coincida "po" en el vector retorna la posicion. En caso de que no encuentre retorna el valor -1
     * @param datoBuscar
     * @param veDatos
     * @return
     */
    public static int getPositionVectorBusSemi(String datoBuscar, String[]veDatos)
    {
        try {
            for (int i = 0; i < veDatos.length; i++)
                if (datoBuscar.equals(veDatos[i].substring(0, datoBuscar.length())))
                    return i;
        } catch (Exception e) {
            return -1;
        }
        return -1;
    }
}
