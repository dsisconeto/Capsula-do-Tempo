package maquina;

import model.Registradora;

import javax.swing.JFrame;
import javax.swing.UnsupportedLookAndFeelException;

import view.Comprar;
import view.JanalaMain;

/**
 *
 * @author dsisconeto
 */
public class Main {

    /**
     * @param args the command line arguments
     * @throws javax.swing.UnsupportedLookAndFeelException
     */
    public static void main(String[] args) throws UnsupportedLookAndFeelException {
        
        
        Registradora.aberta();
        JFrame janela = new JanalaMain();
        JanalaMain.trocarPanel(new Comprar());
        janela.setSize(600, 600);
        janela.setTitle("Maquina POG");
        janela.setVisible(true);

    }

}
