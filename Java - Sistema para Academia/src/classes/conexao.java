/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package classes;

import java.sql.Connection;
import java.sql.Statement;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;

public class conexao {

    protected static Connection conexao;

    protected conexao() throws SQLException {


        DriverManager.registerDriver(new com.mysql.jdbc.Driver());
        if (conexao == null) {
            this.setConexao(conexao = DriverManager.getConnection("jdbc:mysql://localhost:3306/academia", "root", "51215121"));
        }
    }

    public ResultSet selectSQL(String sql) throws SQLException {

        Statement stmt = (Statement) conexao.createStatement();
        System.out.println("SELECT * FROM " + sql);
        ResultSet res = stmt.executeQuery("SELECT * FROM " + sql);
        return res;
    }

    public int insertSQL(String sql) {
        int retonar;

        try {
            Statement stmt = (Statement) conexao.createStatement();
            System.out.println("INSERT INTO " + sql);
            stmt.executeUpdate("INSERT INTO " + sql);


            retonar = 1;
        } catch (SQLException ex) {
            retonar = 0;
            System.out.println("_FATAl_ERROR_INSERT_");
        }
        return retonar;

    }

    public int deleteSQL(String sql) {

        int retonar;

        try {
            Statement stmt = (Statement) conexao.createStatement();
            System.out.println("DELETE FROM " + sql);
            stmt.executeUpdate("DELETE FROM  " + sql);


            retonar = 1;
        } catch (SQLException ex) {
            retonar = 0;
            System.out.println("_FATAl_ERROR_DELETE_");
        }
        return retonar;
    }

    public int updateSQl(String sql) {
        int retona;

        try {
            retona = 1;
            Statement stmt = (Statement) conexao.createStatement();
            System.out.println("UPDATE " + sql);
            stmt.executeUpdate("UPDATE " + sql);

        } catch (SQLException ex) {
            retona = 0;

        }

        return retona;
    }

    /*
     public void insert(String sql) throws SQLException {
     int retonar;
     Statement stmt = (Statement) conexao.createStatement();
     System.out.println("INSERT INTO ");
     stmt.executeUpdate("INSERT INTO  cliente (nome,cpf,rg,dataNascimento,endereco,telefone,email,sexo)VALUES('1111111111111','11111111111','111111111111111111111111','11/11/11','11111111111111111','(11)1111-1111','1111111111111111111111111111','M')");
     }
     */
    public Connection getConexao() {
        return conexao;
    }

    public void setConexao(Connection conexao) {
        this.conexao = conexao;
    }
}
