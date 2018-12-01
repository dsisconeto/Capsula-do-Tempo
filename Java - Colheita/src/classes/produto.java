package classes;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JOptionPane;

public class produto extends conexao {

    private int id;
    private String nome;
    private String codigo;
    private int idRevista;
    private int estoque;
    private float valor;
    private String tipoDeProduto;
    private String datadeCadastro;
    int retona;
    PreparedStatement stmt;
    revista revista;
    String sql;
    ResultSet res;

    public produto() throws SQLException {
        revista = new revista();
    }

    public int criar(String nome, String codigo, String Nomerevista, String estoque, String valor, String tipo) {
        try {
                
            consultar(nome, 3);
            if(this.getId() != 0){
            
            System.out.println("Criando uma Revista");

            stmt = (PreparedStatement) getConexao().prepareStatement("INSERT INTO produto"
                    + "(id,nome,codigo,idRevista,estoque,valor,dataDeCadastro,tipo)"
                    + "VALUES(?,?,?,?,?,?,?,?)");
            revista.consultar(Nomerevista, 2);
            selecionaUltimo();

            stmt.setInt(1, (this.getId() + 1));
            stmt.setString(2, nome.toUpperCase());
            stmt.setString(3, codigo);
            stmt.setInt(4, revista.getId());
            stmt.setInt(5, Integer.valueOf(estoque));
            stmt.setFloat(6, Float.valueOf(valor));
            stmt.setString(7, function.dataDoOS());
            stmt.setString(8, tipo);
            stmt.executeUpdate();
            retona = 1;
}else{
                JOptionPane.showMessageDialog(null, "Não é permitido Protudos ter nomes Iguais");}
        } catch (SQLException ex) {
            retona = 0;
            Logger.getLogger(produto.class.getName()).log(Level.SEVERE, null, ex);
        }

        if (retona == 1) {
            System.out.println("Revista criada com sucesso");

        } else {
            System.out.println("não foi possivil cria uma Revista");

        }

        return retona;
    }

    public int editar(int id, String nome, String codigo, String Nomerevista, String estoque, String valor, String tipo) {


        try {

            System.out.println("Criando uma Revista");

            stmt = (PreparedStatement) getConexao().prepareStatement(
                    "UPDATE produto SET "
                    + "nome = ?,codigo = ? ,idRevista = ?,estoque = ?,valor = ?,dataDeCadastro = ?,tipo = ? WHERE id = ?");
            revista.consultar(Nomerevista, 2);
            selecionaUltimo();
            stmt.setString(1, nome.toUpperCase());
            stmt.setString(2, codigo);
            stmt.setInt(3, revista.getId());
            stmt.setInt(4, Integer.valueOf(estoque));
            stmt.setFloat(5, Float.valueOf(valor));
            stmt.setString(6, function.dataDoOS());
            stmt.setString(7, tipo);
            stmt.setInt(8, id);
            stmt.executeUpdate();
            retona = 1;

        } catch (SQLException ex) {
            retona = 0;
            Logger.getLogger(produto.class.getName()).log(Level.SEVERE, null, ex);
        }

        if (retona == 1) {
            System.out.println("Revista criada com sucesso");

        } else {
            System.out.println("não foi possivil cria uma Revista");

        }

        return retona;
    }

    public int deletaProduto(int id) {

        sql = "produto WHERE id = " + id;
        int re = this.deleteSQL(sql);

        return re;

    }

    public int editarCliente(int id, String nome, String telefone, String email, String endereco, String clienteDesde, String sexo) {
        retona = 1;
        System.out.println("Editando um cliente");
        try {
            stmt = (PreparedStatement) getConexao().prepareStatement("UPDATE cliente SET"
                    + " nome = ? ,telefone = ?, email = ? , endereco = ?, clienteDesdes = ?, sexo = ? WHERE id = ?");

            stmt.setString(1, nome);
            stmt.setString(2, telefone);
            stmt.setString(3, email);
            stmt.setString(4, endereco);
            stmt.setString(5, clienteDesde);
            stmt.setString(6, sexo);
            stmt.executeUpdate();


        } catch (SQLException ex) {
            retona = 0;
            Logger.getLogger(produto.class.getName()).log(Level.SEVERE, null, ex);
        }

        return retona;
    }

    public void selecionaPotId(int id) throws SQLException {
        sql = "produto WHERE id = " + id;
        res = selectSQL(sql);

        while (res.next()) {


            this.setNome(res.getString("nome"));
            this.setCodigo(res.getString("codigo"));
            this.setIdRevista(res.getInt("idRevista"));
            this.setEstoque(res.getInt("estoque"));
            this.setValor(res.getFloat("valor"));
            this.setTipoDeProduto(res.getString("tipo"));
            this.setDatadeCadastro(res.getString("dataDeCadastro"));

        }

    }

    public ResultSet selecionaTodosProdutos() throws SQLException {

        sql = "app.produto ORDER BY nome";
        res = selectSQL(sql);
        return res;

    }

    public void selecionaPorCogigoERevista(String codigo, String nomeRevista) {

        if (nomeRevista != "OUTRA") {
            try {
                revista.consultar(nomeRevista, 3);
            } catch (SQLException ex) {
                Logger.getLogger(produto.class.getName()).log(Level.SEVERE, null, ex);
            }


            sql = "app.produto WHERE codigo = " + codigo + " AND idRevista = " + revista.getId();

            try {
                res = selectSQL(sql);

                while (res.next()) {
                    this.setId(res.getInt("id"));
                    this.setNome(res.getString("nome"));
                    this.setValor(res.getFloat("valor"));
                    this.setEstoque(res.getInt("estoque"));
                    this.setTipoDeProduto(res.getString("tipo"));
                }

            } catch (SQLException ex) {
                Logger.getLogger(produto.class.getName()).log(Level.SEVERE, null, ex);
            }
        }

    }

    public void selecionaUltimo() throws SQLException {
        int contado = 0;
         sql = "app.produto ORDER BY id DESC";
         res = selectSQL(sql);
        while (res.next()) {

            if (contado == 0) {
                this.setId(res.getInt("id"));
                this.setNome(res.getString("nome"));
                contado += 1;
            }
        }
    }

    public ResultSet consultar(String nome, int op) throws SQLException {
        // 1 para consultar like
        // 3 para consultar =
        int contato = 0;
        if (op == 1) {
            // fazendo sql de consulta
             sql = "app.produto WHERE nome LIKE '%" + nome + "%'";
            res = selectSQL(sql);
        } else {
           
      sql = "app.produto WHERE nome = '" + nome + "'";
            res = selectSQL(sql);
           
           while (res.next()) {
                
                if (contato == 0) {
                    this.setId(res.getInt("id"));
                    contato += 1;
                }
                
            }

        }
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

    public String getCodigo() {
        return codigo;
    }

    public void setCodigo(String codigo) {
        this.codigo = codigo;
    }

    public int getIdRevista() {
        return idRevista;
    }

    public void setIdRevista(int idRevista) {
        this.idRevista = idRevista;
    }

    public int getEstoque() {
        return estoque;
    }

    public void setEstoque(int estoque) {
        this.estoque = estoque;
    }

    public float getValor() {
        return valor;
    }

    public void setValor(float valor) {
        this.valor = valor;
    }

    public String getTipoDeProduto() {
        return tipoDeProduto;
    }

    public void setTipoDeProduto(String tipoDeProduto) {
        this.tipoDeProduto = tipoDeProduto;
    }

    public String getDatadeCadastro() {
        return datadeCadastro;
    }

    public void setDatadeCadastro(String datadeCadastro) {
        this.datadeCadastro = datadeCadastro;
    }

    public revista getRevista() {
        return revista;
    }

    public void setRevista(revista revista) {
        this.revista = revista;
    }
}
