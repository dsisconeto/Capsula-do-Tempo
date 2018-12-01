/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package paq_adjunto6;

import java.sql.ResultSet;
import javax.swing.JOptionPane;

/**
 *
 * @author usuario
 */
public class ajSQL {
    /**
     * Recibe una consulta sql y retorna un String de la primera columna
     * @param sql
     * @return
     */
    public static String getCampoUnicoStrin(String sql)
    {
        String xTmp="";
        System.out.println("\nsql: "+sql);
        conexion d = new conexion();
        d.estaConectado();
        ResultSet rs = d.dameLista(sql);
        try
        {
            while (rs.next())
            {
                xTmp=rs.getString(1);
                break;
            }
        } catch (Exception e)
        {
            JOptionPane.showMessageDialog(null, "No fue posible procesar el sql, por favor verifique su estructura", "Error de integridad", 0);
            d.cierraConexion();
            return xTmp="";
        }

        d.cierraConexion();
        return xTmp;
    }
}
