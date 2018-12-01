package classes;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;

public class Venda extends conexao {
    
    private int id;
    private int Idrevista;
    private int idCliente;
    private int codicoProduto;
    private int idProduto;
    private float valorDoProduto;
    private int quantidadeProduto;
    private int tipoPagamento;
    private String dataDoPagamento;
    private String dataEntrga;
    private String dataDaVenda;
    int reto;
    private PreparedStatement stmt;
    private cliente cl;
    private revista revista;
    private ResultSet res;
    private produto pr;
     String sql;
 
    public Venda() {
        try {
            cl = new cliente();
            revista = new revista();
            pr = new produto();
        } catch (SQLException ex) {
            Logger.getLogger(Venda.class.getName()).log(Level.SEVERE, null, ex);
        }
        
    }
    
    public void criar(String nomeRevista,
            String nomeCliente, String codicoProduto, String valorDoProduto,
            String quantidadeProduto, String tipoPagamento, String dataDoPagamento,
            String dataEntrega, String datadaVenda) {
        try {
            // verificando se possui o cliente cadastrado
            cl.selecionaPorNome(nomeCliente);
            // pegando o id da revista
            revista.consultar(nomeRevista, 3);
            // selecionando o ultima venda 
            selecionaUltimo();
            /// pegando as inforções do produto

            stmt = (PreparedStatement) this.getConexao().prepareStatement(
                    "INSERT INTO app.venda (id,idRevista,idcliente,nomeCliente,codicoProduto,"
                    + "valorDoProduto,QuantidadeProduto,tipoPagamento,"
                    + "dataDoPagamento,dataEntrega,dataDaVenda)VALUES(?,?,?,?,?,?,?,?,?,?,?)");
            
            stmt.setInt(1, this.getId() + 1);
            stmt.setInt(2, revista.getId());
            stmt.setInt(3, cl.getId());
            if (cl.getNome() == null) {
                stmt.setString(4, nomeCliente);
            } else {
                stmt.setString(4, cl.getNome());
            }
            stmt.setInt(5, (Integer.valueOf(codicoProduto)));
            stmt.setFloat(6, Float.valueOf(valorDoProduto));
            stmt.setInt(7, Integer.valueOf(quantidadeProduto));
            stmt.setString(8, tipoPagamento);
            stmt.setString(9, dataDoPagamento);
            stmt.setString(10, dataEntrega);
            stmt.setString(11, dataDoPagamento);
            stmt.executeUpdate();
            
            
        } catch (SQLException ex) {
            reto = 0;
            Logger.getLogger(Venda.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        
    }
    
    public void selecionaUltimo() throws SQLException {
        int contado = 0;
         sql = "app.venda ORDER BY id DESC";
        res = selectSQL(sql);
        while (res.next()) {
            
            if (contado == 0) {
                this.setId(res.getInt("id"));
                contado += 1;
            }
        }
    }
    
   public ResultSet selecionarTudo(){
       
       sql = "app.venda";
        try {
            res =   selectSQL(sql);
        } catch (SQLException ex) {
            Logger.getLogger(Venda.class.getName()).log(Level.SEVERE, null, ex);
        }
       return res ;
}
    
    public int getId() {
        return id;
    }
    
    public void setId(int id) {
        this.id = id;
    }
    
    public int getIdrevista() {
        return Idrevista;
    }
    
    public void setIdrevista(int Idrevista) {
        this.Idrevista = Idrevista;
    }
    
    public int getIdCliente() {
        return idCliente;
    }
    
    public void setIdCliente(int idCliente) {
        this.idCliente = idCliente;
    }
    
    public int getCodicoProduto() {
        return codicoProduto;
    }
    
    public void setCodicoProduto(int codicoProduto) {
        this.codicoProduto = codicoProduto;
    }
    
    public int getIdProduto() {
        return idProduto;
    }
    
    public void setIdProduto(int idProduto) {
        this.idProduto = idProduto;
    }
    
    public float getValorDoProduto() {
        return valorDoProduto;
    }
    
    public void setValorDoProduto(float valorDoProduto) {
        this.valorDoProduto = valorDoProduto;
    }
    
    public int getQuantidadeProduto() {
        return quantidadeProduto;
    }
    
    public void setQuantidadeProduto(int quantidadeProduto) {
        this.quantidadeProduto = quantidadeProduto;
    }
    
    public int getTipoPagamento() {
        return tipoPagamento;
    }
    
    public void setTipoPagamento(int tipoPagamento) {
        this.tipoPagamento = tipoPagamento;
    }
    
    public String getDataDoPagamento() {
        return dataDoPagamento;
    }
    
    public void setDataDoPagamento(String dataDoPagamento) {
        this.dataDoPagamento = dataDoPagamento;
    }
    
    public String getDataEntrga() {
        return dataEntrga;
    }
    
    public void setDataEntrga(String dataEntrga) {
        this.dataEntrga = dataEntrga;
    }
    
    public PreparedStatement getStmt() {
        return stmt;
    }
    
    public void setStmt(PreparedStatement stmt) {
        this.stmt = stmt;
    }
    
    public cliente getCl() {
        return cl;
    }
    
    public void setCl(cliente cl) {
        this.cl = cl;
    }
    
    public revista getRevista() {
        return revista;
    }
    
    public void setRevista(revista revista) {
        this.revista = revista;
    }
}
