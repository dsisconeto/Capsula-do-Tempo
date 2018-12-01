/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package paq_adjunto6;

/**
 *
 * @author usuario
 */
public class ajVarios {
    /**
     * Recibe el texto completo a partir de la busqueda entre el dato a buscar y un vector, toda vez que el vector encuentre una minima coincidencia. <br><br>
     * Ejemplo: "po"(datoBuscar) y {"poderoso","admin","postgres"} entonces como encontro uno que coincida "po" en el vector retorna la palabra completa: poderoso.
     * <br><br> Este metodo le llama a la clase de ajVector porque trabaja con vectores
     * @param datoBuscar
     * @param veDatos
     * @return
     */
    public static String getTextoApartirVector(String datoBuscar, String[]veDatos)
    {
        return ajVector.getTextoApartirVector(datoBuscar, veDatos);
    }
   
}
