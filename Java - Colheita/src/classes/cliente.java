package classes;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;

public class cliente extends conexao {

    private int id;
    private String nome;
    private String telefone;
    private String email;
    private String endereco;
    private String clienteDesde;
    private String sexo;
    int retona;
    PreparedStatement stmt;
    ResultSet res;
    String sql;

    public cliente() throws SQLException {
    }

    public int criar(String nome, String telefone, String email, String endereco, String clienteDesde, String sexo) {
        try {
            retona = 1;
            System.out.println("Criando um cliente");

            stmt = (PreparedStatement) getConexao().prepareStatement("INSERT INTO app.cliente "
                    + "(id,nome,telefone,email,endereco,clienteDesde,sexo)"
                    + "VALUES(?,?,?,?,?,?,?)");
            selecionaUltimo();
            stmt.setInt(1, (this.getId() + 1));
            stmt.setString(2, nome.toUpperCase());
            stmt.setString(3, telefone);
            stmt.setString(4, email);
            stmt.setString(5, endereco);
            stmt.setString(6, clienteDesde);
            stmt.setString(7, sexo);
            stmt.executeUpdate();
            retona = 1;

        } catch (SQLException ex) {
            retona = 0;
            Logger.getLogger(cliente.class.getName()).log(Level.SEVERE, null, ex);
        }

        if (retona == 1) {
            System.out.println("cliente criado com sucesso");

        } else {
            System.out.println("não foi possivil cria um cliente");

        }

        return retona;
    }

    public int editar(int id, String nome, String telefone, String email, String endereco, String clienteDesde, String sexo) {
        try {
            System.out.println("Criando um cliente");
            stmt = (PreparedStatement) getConexao().prepareStatement("UPDATE  cliente SET "
                    + " nome = ?, telefone = ?, email = ?,endereco = ?, clienteDesde = ?,sexo = ? WHERE id = ?");
            selecionaUltimo();

            stmt.setString(1, nome.toUpperCase());
            stmt.setString(2, telefone);
            stmt.setString(3, email);
            stmt.setString(4, endereco);
            stmt.setString(5, clienteDesde);
            stmt.setString(6, sexo);
            stmt.setInt(7, id);
            stmt.executeUpdate();
            retona = 1;

        } catch (SQLException ex) {
            retona = 0;
            Logger.getLogger(cliente.class.getName()).log(Level.SEVERE, null, ex);
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

    public void selecionaPorId(int id) throws SQLException {
        String sql = "cliente WHERE id = " + id;
        res = selectSQL(sql);

        while (res.next()) {
            this.setNome(res.getString("nome"));
            this.setTelefone(res.getString("telefone"));
            this.setEmail(res.getString("email"));
            this.setEndereco(res.getString("endereco"));
            this.setClienteDesde(res.getString("clienteDesde"));
            this.setSexo(res.getString("sexo"));
        }

    }

    public int selecionaPorNome(String nome) {
        sql = "app.cliente";

        try {
            res = selectSQL(sql);


            while (res.next()) {
                this.setId(res.getInt("id"));
                this.setNome(res.getString("nome"));

            }
            retona = 1;
        } catch (SQLException ex) {
            Logger.getLogger(cliente.class.getName()).log(Level.SEVERE, null, ex);
            retona = 0;
        }
        if (this.getId() == 0) {
            retona = 0;
        }

        return retona;
    }

    public ResultSet selecionaTodosClintes() throws SQLException {

        sql = "app.cliente";
        res = selectSQL(sql);
        return res;

    }

    public void selecionaUltimo() throws SQLException {
        int contado = 0;
        String sql = "cliente ORDER BY id DESC";
        res = selectSQL(sql);
        while (res.next()) {

            if (contado == 0) {
                this.setId(res.getInt("id"));
                this.setNome(res.getString("nome"));
                contado += 1;
            }
        }
    }

    public ResultSet consultar(String termo) throws SQLException {

        if (function.converterStringInt(termo) == 1) {
            sql = "cliente WHERE  id  = " + termo;
        } else {
            sql = "cliente WHERE nome LIKE '%" + termo + "%'";

        }
        res = selectSQL(sql);
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

    public String getClienteDesde() {
        return clienteDesde;
    }

    public void setClienteDesde(String clienteDesde) {
        this.clienteDesde = clienteDesde;
    }
}
