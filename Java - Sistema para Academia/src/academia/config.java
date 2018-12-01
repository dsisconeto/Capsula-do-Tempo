/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package academia;

import java.text.SimpleDateFormat;
import javax.swing.JFrame;
import javax.swing.JOptionPane;
import javax.swing.JTextField;

public class config {

    public static void converteCampos(JTextField texto) {
        texto.setText(texto.getText().replace(",", "."));
        float valor;
        if (texto.getText().length() != 0) {
            try {
                valor = Float.valueOf(texto.getText());
                texto.setText(String.valueOf(valor));
            } catch (NumberFormatException e) {

                JOptionPane.showMessageDialog(null, "Este compo só aceita Numeros e Virgula");
                texto.setText("");
            }

        } else {
            texto.setText("0.0");

        }


    }

    public static String dataDoOS() {
        SimpleDateFormat dateFor = new SimpleDateFormat("dd/MM/YY");
        String dateS = dateFor.format(new java.util.Date());
        return dateS;
    }

    public static String dataDoProMes() {
        SimpleDateFormat dateFor = new SimpleDateFormat("dd/MM/yy");
        String dateS = dateFor.format(new java.util.Date());
         System.out.print(dateS);
        int dateD = Integer.valueOf(dateS.substring(0, 2));
        int dateM = Integer.valueOf(dateS.substring(3, 5));
        int dateA = Integer.valueOf(dateS.substring(6, 8));
        String  dateF;
        int datePro;
        for (int i = 0; i < 10; i++) {
             
            datePro = dateM +1;
            System.out.print(dateM);
        }
     
        if (dateM == 12) {
            dateM = 01;
            dateA += 1;
            dateF = dateD + "" + dateM + "" + dateA;
        } else {
           // int datePro = dateM +1;
           // dateF = ""+dateD +""+ ""+datePro+"" + ""+dateA+"";
        }

      //  System.out.print(dateF);
        return dateS;
    }
}
