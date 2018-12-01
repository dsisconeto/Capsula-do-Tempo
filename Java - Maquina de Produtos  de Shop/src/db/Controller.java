package db;

import java.util.ArrayList;
import javax.swing.JOptionPane;
import javax.swing.JPanel;

public class Controller {

    private final ArrayList<Mensagem> msg = new ArrayList<>();
    private final ArrayList<Mensagem> retorno = new ArrayList<>();

    public void setMensagem(String texto, boolean status, int codigo) {

        this.msg.add(codigo, new Mensagem(texto, codigo, status));

    }

    public void setRetorno(int codigo) {

        System.out.print(this.msg.get(codigo));
        this.retorno.add(this.msg.get(codigo));
    }

    public ArrayList<Mensagem> getRetorno() {

        return this.retorno;
    }

    public boolean noError() {

        return retorno.isEmpty();
    }

    public void show(JPanel jframe, ArrayList<Mensagem> retornos) {
  

        retornos.forEach(row -> {

            if (row.isStatus()) {
             
                JOptionPane.showMessageDialog(jframe, row.getTexto());

            } else {

                JOptionPane.showMessageDialog(jframe,
                        row.getTexto(),
                        "Errou, Errrou Feio, Errou rude",
                        JOptionPane.ERROR_MESSAGE);
            }

            System.out.println(row.getTexto());

        });
        
        


    }

}
