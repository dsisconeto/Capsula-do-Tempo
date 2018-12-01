/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package classes;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author dejair
 */
public class cliente extends conexao {

    private int id;
    private String nome;
    private String dataNascimento;
    private String endereco;
    private String telefone;
    private String email;
    private String sexo;
    private String cpf;
    private String rg;
    private String obs;
    int retona;
    exame exa;
    matricula mt;
    PreparedStatement stmt;

    public cliente() throws SQLException {
    }

    public int criar(String nome, String cpf, String rg, String dataNascimento, String endereco, String telefone, String email, String sexo, String obs) {

        retona = 1;


        System.out.println("Criando um cliente");

        try {
            stmt = (PreparedStatement) getConexao().prepareStatement("INSERT INTO cliente "
                    + "(nome,cpf,rg,dataNascimento,endereco,telefone,email,sexo,obs)"
                    + "VALUES(?,?,?,?,?,?,?,?,?)");
            stmt.setString(1, nome);
            stmt.setString(2, cpf);
            stmt.setString(3, rg);
            stmt.setString(4, dataNascimento);
            stmt.setString(5, endereco);
            stmt.setString(6, telefone);
            stmt.setString(7, email);
            stmt.setString(8, sexo);
            stmt.setString(9, obs);

            stmt.executeUpdate();
        } catch (SQLException ex) {
            retona = 0;
        }





        if (retona == 1) {
            System.out.println("cliente criado com sucesso");

        } else {
            System.out.println("não foi possivil cria um cliente");
        }
        return retona;
    }

    public int deletaCliente(int id) {

        String sql = "cliente WHERE id = " + id;
        int re = this.deleteSQL(sql);

        return re;

    }

    public int editarCliente(int id, String nome, String cpf, String rg, String dataNascimento, String endereco, String telefone, String email, String sexo, String obs) {
        retona = 1;


        System.out.println("Editando um cliente");
        try {
        

            stmt = (PreparedStatement) getConexao().prepareStatement("UPDATE cliente SET"
                    + " nome = ? , cpf = ? , rg = ?, dataNascimento = ? , endereco = ? , telefone = ?, email = ?, sexo = ?, obs= ? WHERE id = ?");
       
            stmt.setString(1, nome);
            stmt.setString(2, cpf);
            stmt.setString(3, rg);
            stmt.setString(4, dataNascimento);
            stmt.setString(5, endereco);
            stmt.setString(6, telefone);
            stmt.setString(7, email);
            stmt.setString(8, sexo);
            stmt.setString(9, obs);
            stmt.setInt(10, id);

            stmt.executeUpdate();
      } catch (SQLException ex) {
          retona = 0;
            Logger.getLogger(cliente.class.getName()).log(Level.SEVERE, null, ex);
        }

        return retona;
    }

    public void selecionaPotId(int id) throws SQLException {
        String sql = "cliente WHERE id = " + id;
        ResultSet res = selectSQL(sql);

        while (res.next()) {
            this.setNome(res.getString("nome"));
            this.setDataNascimento(res.getString("dataNascimento"));
            this.setEmail(res.getString("email"));
            this.setTelefone(res.getString("telefone"));
            this.setEndereco(res.getString("endereco"));
            this.setSexo(res.getString("sexo"));
            this.setCpf(res.getString("cpf"));
            this.setRg(res.getString("rg"));
            this.setObs(res.getString("obs"));
        }

    }

    public ResultSet selecionaTodosClintes() throws SQLException {

        String sql = " cliente";
        ResultSet res = selectSQL(sql);
        return res;

    }

    public ResultSet selecionaUltimo() throws SQLException {

        String sql = "cliente ORDER BY id DESC LIMIT 1";
        ResultSet res = selectSQL(sql);
        return res;

    }

    public ResultSet consultar(String nome) throws SQLException {
        String sql = "cliente WHERE nome LIKE '%" + nome + "%'";

        ResultSet res = selectSQL(sql);
        return res;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getEndereco() {
        return endereco;
    }

    public void setEndereco(String endereco) {
        this.endereco = endereco;
    }

    public String getTelefone() {
        return telefone;
    }

    public void setTelefone(String telefone) {
        this.telefone = telefone;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getSexo() {
        return sexo;
    }

    public void setSexo(String sexo) {
        this.sexo = sexo;
    }

    public String getDataNascimento() {
        return dataNascimento;
    }

    public void setDataNascimento(String dataNascimento) {
        this.dataNascimento = dataNascimento;
    }

    public String getCpf() {
        return cpf;
    }

    public void setCpf(String cpf) {
        this.cpf = cpf;
    }

    public String getRg() {
        return rg;
    }

    public void setRg(String rg) {
        this.rg = rg;
    }

    public String getObs() {
        return obs;
    }

    public void setObs(String obs) {
        this.obs = obs;
    }
}
