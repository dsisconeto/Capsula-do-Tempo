package classes;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;

public class revista extends conexao {

    private int id;
    private String nome;
    private String empresa;
    private String tipo;
    private int ciclo;
    private String tempoDoCiclo;
    private float porcetagem;
    int retona;
    PreparedStatement stmt;
    ResultSet res;

    public revista() throws SQLException {
    }

    public int criar(String nome, String empresa, String tipo, String ciclo, String tempoDoCiclo, String porcetagem) {

        try {
            
             consultar(nome, 3);
            System.out.print(this.getId());
             if (this.getId() == 0) {
               



                retona = 1;
                System.out.println("Criando uma Revista");

                stmt = (PreparedStatement) getConexao().prepareStatement("INSERT INTO app.revista"
                        + "(id,nome,empresa,tipo,ciclo,tempoDoCiclo,porcetagem)"
                        + "VALUES(?,?,?,?,?,?,?)");
                selecionaUltimo();
                stmt.setInt(1, (this.getId() + 1));
                stmt.setString(2, nome.toUpperCase());
                stmt.setString(3, empresa);
                stmt.setString(4, tipo);
                stmt.setInt(5, Integer.valueOf(ciclo));
                stmt.setString(6, tempoDoCiclo);
                stmt.setFloat(7, Float.valueOf(porcetagem));
                stmt.executeUpdate();
                retona = 1;
                
            } else {
                
                retona = 3;
            }
        } catch (SQLException ex) {
            retona = 0;
            Logger.getLogger(revista.class.getName()).log(Level.SEVERE, null, ex);
        }



        if (retona == 1) {
            System.out.println("Revista criada com sucesso");

        } else {
            System.out.println("não foi possivil cria uma Revista");

        }

        return retona;
    }
    
    public void cadastrarEmpresa(String nome){
        insertSQL("empresas (nome)VALUES("+nome+")");
    
    }

    public int editar(int id, String nome, String empresa, String tipo, String ciclo, String tempoDoCiclo, String porcetagem) {


        try {
            retona = 1;
            System.out.println("Editando uma Revista");

            stmt = (PreparedStatement) getConexao().prepareStatement("UPDATE app.revista SET"
                    + " nome = ?, empresa = ?,tipo = ?,ciclo = ?,tempoDoCiclo = ?, porcetagem = ? WHERE id = ?");
            selecionaUltimo();

            stmt.setString(1, nome.toUpperCase());
            stmt.setString(2, empresa);
            stmt.setString(3, tipo);
            stmt.setInt(4, Integer.valueOf(ciclo));
            stmt.setString(5, tempoDoCiclo);
            stmt.setFloat(6, Float.valueOf(porcetagem));
            stmt.setInt(7, id);
            stmt.executeUpdate();
            retona = 1;

        } catch (SQLException ex) {
            retona = 0;
            Logger.getLogger(revista.class.getName()).log(Level.SEVERE, null, ex);
        }

        if (retona == 1) {
            System.out.println("Revista criada com sucesso");

        } else {
            System.out.println("não foi possivil cria uma Revista");

        }

        return retona;
    }

    public int deletaRevista(int id) {

        String sql = "app.revista WHERE id = " + id;
        int re = this.deleteSQL(sql);

        return re;

    }

    public void selecionaPorId(int id) throws SQLException {
        String sql = "app.revista WHERE id = " + id;
        ResultSet res = selectSQL(sql);

        while (res.next()) {


            this.setNome(res.getString("nome"));
            this.setEmpresa(res.getString("empresa"));
            this.setTipo(res.getString("tipo"));
            this.setCiclo(res.getInt("ciclo"));
            this.setTempoDoCiclo(res.getString("tempoDoCiclo"));
            this.setPorcetagem(res.getFloat("porcetagem"));

        }

    }

    public ResultSet selecionaTodasRevista() throws SQLException {

        String sql = " app.revista ORDER BY nome ";
        ResultSet res = selectSQL(sql);
        return res;

    }

    public void selecionaUltimo() throws SQLException {
        int contado = 0;
        String sql = "app.revista ORDER BY id DESC";
        ResultSet res = selectSQL(sql);
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
            String sql = "app.revista WHERE nome LIKE '%" + nome + "%'";
            res = selectSQL(sql);
        } else {

            String sql = "app.revista WHERE nome = '" + nome + "'";
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

    public String getEmpresa() {
        return empresa;
    }

    public void setEmpresa(String empresa) {
        this.empresa = empresa;
    }

    public String getTipo() {
        return tipo;
    }

    public void setTipo(String tipo) {
        this.tipo = tipo;
    }

    public int getCiclo() {
        return ciclo;
    }

    public void setCiclo(int ciclo) {
        this.ciclo = ciclo;
    }

    public String getTempoDoCiclo() {
        return tempoDoCiclo;
    }

    public void setTempoDoCiclo(String tempoDoCiclo) {
        this.tempoDoCiclo = tempoDoCiclo;
    }

    public float getPorcetagem() {
        return porcetagem;
    }

    public void setPorcetagem(float porcetagem) {
        this.porcetagem = porcetagem;
    }
}
