package colheita;

import classes.conexao;
import java.sql.PreparedStatement;
import java.sql.SQLException;

public class Colheita extends conexao {

    public Colheita()throws SQLException{
       
      }
  

    
    public static void main(String[] args) throws SQLException {
       new telas.TelaInicial().setVisible(true);
     new Colheita();
       
    }
}
