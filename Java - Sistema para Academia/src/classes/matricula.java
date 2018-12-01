/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package classes;

import academia.config;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.text.SimpleDateFormat;
import telas.Pagamento1;
import telas.Pagamento2;

public class matricula extends cliente {

    private int id;
    private int idCliente;
    private String dataCadastro;
    private String dataDoVencimento;
    private String dataDoPagamento;
    private float valorDoPagamento;
    private int statusDaMatricula;
    private int statusDaPagamento;
    private int pagamento;
    ResultSet res;

    public matricula() throws SQLException {
    }

    public void criar(String dataCadastro, String dataDoVencimento,
            String dataDoPagamento, String valorDoPagamento, int pagamento) throws SQLException {
       
       
        ResultSet resCl = selecionaUltimo();
        while (resCl.next()) {
            this.setIdCliente(resCl.getInt("id"));
        }

        String sql = " matricula (`idCliente` ,`dataCadastro` ,`dataDoVencimento` ,`dataDoPagamento` ,`valorDoPagamento`,`statusDaMatricula`,`statusDaPagamento`,`pagamento`)"
                + "VALUES('" + this.getIdCliente() + "','" + dataCadastro + "','" + dataDoVencimento + "','" + dataDoPagamento + "','" + valorDoPagamento + "','1','1','"+pagamento+"')";


        insertSQL(sql);

    }

    public int deleta(int idCliente) {

        String sql = "matricula WHERE idCliente = " + idCliente;
        int retona = deleteSQL(sql);
        return retona;

    }

    public void selecionaPeloCliente(int idCliente) throws SQLException {
      
        String sql = "matricula WHERE idCliente = '" + idCliente + "'";
         res = selectSQL(sql);
        while (res.next()) {
            this.setDataCadastro(res.getString("dataCadastro"));
            this.setDataDoVencimento(res.getString("dataDoVencimento"));
            this.setDataDoPagamento(res.getString("dataDoPagamento"));
            this.setValorDoPagamento(res.getFloat("valorDoPagamento"));
            this.setStatusDaMatricula(res.getInt("statusDaMatricula"));
            this.setStatusDaPagamento(res.getInt("statusDaPagamento"));
            this.setPagamento(res.getInt("pagamento"));
           
        }

    }

    public int UpdateStatusDaMatricula(int status) {

        String sql = "matricula SET statusDaMatricula = " + status + "  WHERE idCliente = " + this.getIdCliente();
        int re = updateSQl(sql);
        return re;
    }
    
    public int UpdateStatusDataPagamento(int status) {

        String sql = "matricula SET statusDaPagamento = " + status + "  WHERE idCliente = " + this.getIdCliente();
        int re = updateSQl(sql);
        return re;
    }

    public String converteStatus(int status) {
        String r = null;
        switch (status) {
            case 2:
                r = "Vencimento";
                break;
            case 1:
                r = "Em dia";
               break;
        }
        return r;
    }
    
    public String convertePagagamento(int pagamento){
         String r = null;
        switch (pagamento) {
            case 1:
                r = "A Vista";
                break;
            case 2:
                r = "A Prazo";
               break;
        }
        return r;
    }

    public void VerificarDataMatricula() throws SQLException {
        ResultSet res = selecionaTodosClintes();
        while (res.next()) {
            this.setIdCliente(res.getInt("id"));

            this.selecionaPeloCliente(this.getIdCliente());


            if (this.getStatusDaMatricula() != 2) {

                
                String dateS = config.dataDoOS();
                String date = this.getDataDoVencimento();
                String dia = date.substring(0, 2);
                String diaS = dateS.substring(0, 2);
                String mes = date.substring(3, 5);
                String mesS = dateS.substring(3, 5);
                String ano = date.substring(6, 8);
                String anoS = dateS.substring(6, 8);

                int diaInt = Integer.valueOf(dia);
                int diaSInt = Integer.valueOf(diaS);
                int mesInt = Integer.valueOf(mes);
                int mesSInt = Integer.valueOf(mesS);
                int anoInt = Integer.valueOf(ano);
                int anoSInt = Integer.valueOf(anoS);
                if (anoInt <= anoSInt) {
                    System.out.println(dateS);
                    if (mesSInt >= mesInt) {

                        if (diaSInt >= diaInt) {

                            this.UpdateStatusDaMatricula(2);
                        }

                    }
                } else {
                    this.UpdateStatusDaMatricula(2);
                }

            }
        }
    }
    
    public void VerificarDataPagamento() throws SQLException {
        ResultSet res = selecionaTodosClintes();
        while (res.next()) {
            this.setIdCliente(res.getInt("id"));

            this.selecionaPeloCliente(this.getIdCliente());
            

            if (this.getStatusDaMatricula() != 2 && this.getPagamento() == 2) {

                
                String dateS = config.dataDoOS();
                String date = this.getDataDoVencimento();
                String dia = date.substring(0, 2);
                String diaS = dateS.substring(0, 2);
                String mes = date.substring(3, 5);
                String mesS = dateS.substring(3, 5);
                String ano = date.substring(6, 8);
                String anoS = dateS.substring(6, 8);

                int diaInt = Integer.valueOf(dia);
                int diaSInt = Integer.valueOf(diaS);
                int mesInt = Integer.valueOf(mes);
                int mesSInt = Integer.valueOf(mesS);
                int anoInt = Integer.valueOf(ano);
                int anoSInt = Integer.valueOf(anoS);
                if (anoInt <= anoSInt) {
                    System.out.println(dateS);
                    if (mesSInt >= mesInt) {

                        if (diaSInt >= diaInt) {

                            this.UpdateStatusDataPagamento(2);
                        }

                    }
                } else {
                    this.UpdateStatusDataPagamento(2);
                }

            }
        }
    }
    
    public void VereficarQualTipoDePagamento(int idCliente) throws SQLException{
    
     selecionaPeloCliente(idCliente);
     if(this.getPagamento() == 1){
     new Pagamento1(idCliente).setVisible(true);
     
     }else{
     new Pagamento2(idCliente).setVisible(true);
     
     }
        
        
    
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getIdCliente() {
        return idCliente;
    }

    public void setIdCliente(int idCliente) {
        this.idCliente = idCliente;
    }

    public String getDataCadastro() {
        return dataCadastro;
    }

    public void setDataCadastro(String dataCadastro) {
        this.dataCadastro = dataCadastro;
    }

    public String getDataDoVencimento() {
        return dataDoVencimento;
    }

    public void setDataDoVencimento(String dataDoVencimento) {
        this.dataDoVencimento = dataDoVencimento;
    }

    public String getDataDoPagamento() {
        return dataDoPagamento;
    }

    public void setDataDoPagamento(String dataDoPagamento) {
        this.dataDoPagamento = dataDoPagamento;
    }

    public float getValorDoPagamento() {
        return valorDoPagamento;
    }

    public void setValorDoPagamento(float valorDoPagamento) {
        this.valorDoPagamento = valorDoPagamento;
    }

    public int getStatusDaMatricula() {
        return statusDaMatricula;
    }

    public void setStatusDaMatricula(int statusDaMatricula) {
        this.statusDaMatricula = statusDaMatricula;
    }

    public int getStatusDaPagamento() {
        return statusDaPagamento;
    }

    public void setStatusDaPagamento(int statusDaPagamento) {
        this.statusDaPagamento = statusDaPagamento;
    }

    public int getPagamento() {
        return pagamento;
    }

    public void setPagamento(int pagamento) {
        this.pagamento = pagamento;
    }
    
    
}
