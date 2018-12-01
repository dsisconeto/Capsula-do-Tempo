package db;

import java.sql.*;

public class Conexao {

    private static Connection conexao = null;
    private static String dbURL = "jdbc:derby:/home/dsisconeto/DevStudy/maquina/Maquina/db";
    private static PreparedStatement prepare = null;

    private Conexao() {
    }

    public static Connection conectar() {

        if (conexao == null) {
            try {
                //Get a connection
                DriverManager.registerDriver(new org.apache.derby.jdbc.EmbeddedDriver());
                Conexao.conexao = DriverManager.getConnection(dbURL);
                System.out.println("Conexão com banco de dados feita");
                
            } catch (SQLException except) {

                System.out.print(except.getMessage());
            }
        }

        return conexao;
    }

    public static PreparedStatement prepare() {

        return Conexao.prepare;
    }

    public static void setPrepare(String sql) {

        try {

            Conexao.prepare = conectar().prepareStatement(sql);

        } catch (SQLException except) {

            System.out.println(except.getMessage());
        }
    }

    public static void shutdown() {

        try {

            if (Conexao.prepare != null) {
                prepare.close();
            }
            if (conexao != null) {
                DriverManager.getConnection(dbURL + ";shutdown=true");
                System.out.println("Conexao com banco de dados fechada");
                conexao.close();
            }
        } catch (SQLException except) {

            System.out.print(except.getMessage());
        }

    }

}
