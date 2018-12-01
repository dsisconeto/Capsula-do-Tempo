/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package classes;

import java.text.SimpleDateFormat;
import javax.swing.JOptionPane;
import javax.swing.JTextField;

public class function {

    public static void converteCamposParaFloat(JTextField texto) {
        texto.setText(texto.getText().replace(",", "."));
        float valor;
        if (texto.getText().length() != 0) {
            try {
                valor = Float.valueOf(texto.getText());

                if (valor > 100000) {
                    JOptionPane.showMessageDialog(null, "O campo " + texto.getToolTipText() + " não aceita um valor tão grande");
                    texto.setText("");
                } else {
                    texto.setText(String.valueOf(valor));
                }

            } catch (NumberFormatException e) {

                JOptionPane.showMessageDialog(null, "O campo " + texto.getToolTipText() + " só aceita Numeros e Virgula");
                texto.setText("");

            }

        } else {
            texto.setText("0.0");

        }


    }

    public static void FormateJTextFieldParaM(JTextField texto, java.awt.event.KeyEvent evt) {


        switch (evt.getKeyCode()) {

            case 37:
                ;
                break;
            case 38:
                ;
                break;
            case 39:
                ;
                break;
            case 40:
                ;

            case 32:
                ;
                break;
            default:
                texto.setText(texto.getText().toUpperCase().replace("\'", ""));
                break;
        }



    }

    public static int converteCamposParaInteger(JTextField texto) {
    

        int valor =0;
        if (texto.getText().length() != 0) {
            if (texto.getText().length() > 6) {
                JOptionPane.showMessageDialog(null, "O campo " + texto.getToolTipText() + " não aceita um valor tão grande");
                texto.setText("");
            } else {

                try {
                    valor = Integer.valueOf(texto.getText());
                    texto.setText(String.valueOf(valor));
                    
                } catch (NumberFormatException e) {
                    valor = 0;
                    JOptionPane.showMessageDialog(null, "O campo " + texto.getToolTipText() + " só aceita Números");
                    texto.setText("");

                }
            }



        } else {
            texto.setText("0");

        }
        return valor;
    }

    public static int converterStringInt(String termo) {
        int valor;
        int re;
        try {
            valor = Integer.valueOf(termo);
            re = 1;
        } catch (NumberFormatException e) {
            re = 0;
        }
        return re;
    }

    public static String dataDoOS() {
        SimpleDateFormat dateFor = new SimpleDateFormat("ddMMYY");
        String dateS = dateFor.format(new java.util.Date());
        return dateS;
    }

    public static String dataDoProMes() {
        SimpleDateFormat dateFor = new SimpleDateFormat("ddMMyy");
        String dateS = dateFor.format(new java.util.Date());
        System.out.println(dateS);
        String daPro;
        int dateProM;

        int dateD = Integer.valueOf(dateS.substring(0, 2));
        int dateM = Integer.valueOf(dateS.substring(2, 4));
        int dateA = Integer.valueOf(dateS.substring(4, 6));
        String dateDString;
        String dateMString;
        dateProM = dateM + 1;

        if (dateM == 12) {
            dateM = 01;
            dateA += 1;



            daPro = "0" + dateD + "0" + dateM + "" + dateA;


        } else {
            if (dateD < 10) {
                dateDString = "0" + dateD;
            } else {
                dateDString = "" + dateD;
            }
            if (dateM < 10) {
                dateMString = "0" + dateProM;
            } else {
                dateMString = "" + dateProM;
            }

            daPro = dateDString + dateMString + "" + dateA + "";

        }


        return daPro;
    }

    public static int MsgdeCadastro(String funcao, int op) {
        String texto = null;
        int re= 0;
        switch (op) {
            case 0:
                texto = " Não foi possível " + funcao + ", tente novamente mais tarde.\n"
                        + "Se o error persistir contate o suporte (While) – Hard and System";
                re = 0;
                break;
            case 1:
                texto = funcao + " Concluído com sucesso";
                re = 1;
                break;

            case 3:
                texto = "já existe um registro com esse mesmo nome, tente outro nome";
                re = 3;
                break;

        }

        JOptionPane.showMessageDialog(null, texto);
        return re;
    }

    public static int ComposVazios(javax.swing.JTextField array[], int op) {
        System.out.println("verifica campos vazios");
        int re = 1;
        if (op == 1 || op == 3) {

            // verificando se algum campo esta vazio
            for (int i = 0; i < array.length; i++) {
                // percorrendo o  array
                if ("".equals(array[i].getText())) {

                    // 0 =  vazio
                    System.out.println("O campo esta vazio " + array[i].getName());
                    re = 0;
                    // se encontra algum vazio para aki
                    i = 1000000;
                } else {
                    // 1 = nenhum campo vazio
                    re = 1;
                }
            }
        }

        if (op == 2 || op == 3) {
            // verificando se algum campo ultrapassa o limite 180
            // se não tive nenhum vazio 
            if (re == 1) {
                // pecorrendo o array
                for (int i = 0; i < array.length; i++) {
                    // verificando se  algum campo e maio que 180
                    if (array[i].getText().length() > 180) {
                        re = 2;
                        i = 1000000;
                    } else {
                        re = 1;
                    }
                }


            }

            if (re == 0) {
                JOptionPane.showMessageDialog(null, "Alguns campos obrigatorios estão vazios.\n"
                        + "Os campos obrigatórios são assinalados com *");

            }
            if (re == 2) {
                JOptionPane.showMessageDialog(null, "Alguns campos Ultrapassarão o limite de caracteres.\n"
                        + "O limite caracteres é de 200 por campo.");
                re = 0;
            }
        }
        return re;
    }

    public static int DatasVazias(javax.swing.JTextField array[]) {
        System.out.println("verifica campos vazios");
        int re = 0;
        for (int i = 0; i < array.length; i++) {


            if ("  /  /  ".equals(array[i].getText())) {
                re = 0;
                i = 1000000;

            } else {

                re = 1;
            }
        }

        if (re == 0) {
            JOptionPane.showMessageDialog(null, "Alguns campos de datas estão vazios.\n"
                    + "Os campos obrigatórios são assinalados com *");
        }

        return re;
    }
}
