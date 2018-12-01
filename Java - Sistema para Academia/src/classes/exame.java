/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package classes;

import java.sql.ResultSet;
import java.sql.SQLException;

public class exame extends cliente {

    private int id;
    private int idCliente;
    private float peso;
    private float altura;
    private float imc;
    private String imcMsg;
    private float cintura;
    private float gluteo;
    private float bracoDireito;
    private float bracoEsquerdo;
    private float anteBracoDireito;
    private float anteBracoEsquerdo;
    private float coxaDireita;
    private float coxaEsqueda;
    private float panturrilhaDireita;
    private float panturrilhaEsquerda;
     cliente cl;
      ResultSet res;
      String sql ;

    public exame() throws SQLException {
          cl = new cliente();
    }

    public void criar(String peso, String altura, String imc, String cintura,
            String gluteo, String bracoDireito, String bracoEsquerdo,
            String anteBracoDireito, String anteBracoEsquerdo, String coxaDireita,
            String coxaEsqueda, String panturrilhaDireita, String panturrilhaEsquerda) throws SQLException {
       
       
         res = cl.selecionaUltimo();
        while (res.next()) {
            idCliente = res.getInt("id");
        }
        sql = "exame (idCliente,peso,altura,imc,cintura,"
                + "gluteo,bracoDireito,bracoEsquerdo,anteBracoDireito,anteBracoEsquerdo,"
                + "coxaDireita,coxaEsqueda,panturrilhaDireita,panturrilhaEsquerda)"
                + "VALUES('" + idCliente + "','" + peso + "','" + altura + "','" + imc + "',"
                + "'" + cintura + "','" + gluteo + "',"
                + "'" + bracoDireito + "','" + bracoEsquerdo + "','" + anteBracoDireito + "',"
                + "'" + anteBracoEsquerdo + "','" + coxaDireita + "','" + coxaEsqueda + "',"
                + "'" + panturrilhaDireita + "','" + panturrilhaEsquerda + "')";
        insertSQL(sql);
    }

    public int deleta(int idCliente) {

         sql = "exame WHERE idCliente = " + idCliente;
        int retona = deleteSQL(sql);
        return retona;

    }
    public void Editar(int idCliente,String peso, String altura, String imc, String cintura,
            String gluteo, String bracoDireito, String bracoEsquerdo,
            String anteBracoDireito, String anteBracoEsquerdo, String coxaDireita,
            String coxaEsqueda, String panturrilhaDireita, String panturrilhaEsquerda){
    
    
    sql = "exame SET "
            + "peso ='" + peso + "',"
            + "altura = '" + altura + "',"
            + "imc = '" + imc + "',"
            + "cintura = '" + cintura + "',"
            + "gluteo = '" + gluteo + "',"
            + "bracoDireito = '" + bracoDireito + "',"
            + "bracoEsquerdo = '" + bracoEsquerdo + "',"
            + "anteBracoDireito ='" + anteBracoDireito + "',"
            + "anteBracoEsquerdo = '" + anteBracoEsquerdo + "',"
            + "coxaDireita = '" + coxaDireita + "',"
            + "coxaEsqueda = '" + coxaEsqueda + "',"
            + "panturrilhaDireita = '" + panturrilhaDireita + "',"
            + "panturrilhaEsquerda = '" + panturrilhaEsquerda + "'"
            +" WHERE idCliente = "+idCliente;
    
    updateSQl(sql);
    
    
  }
    
    

    public String imcSoma(String peso, String altura) {

        float imc = Float.valueOf(peso) / (Float.valueOf(altura) * Float.valueOf(altura));
        String imcString = imc + "";
        imc = Float.valueOf(imcString.substring(0, 3));


        if (imc < 16) {
            this.setImcMsg("Baixo do Peso Severo");
        }
        if (imc > 16 && imc <= 16.9) {
            this.setImcMsg("Baixo do Peso Moderado");
        }
        if (imc >= 17 && imc <= 18.49) {
            this.setImcMsg("Baixo do Peso Leve");
        }
        if (imc >= 18.5 && imc <= 24.9) {
            this.setImcMsg("Peso Ideal");
        }
        if (imc == 25) {
            this.setImcMsg("Sobrepeso");
        }
        if (imc > 25 && imc <= 29.9) {
            this.setImcMsg("Pré-Obesidade");
        }
        if (imc > 30 && imc <= 34.9) {
            this.setImcMsg("Obesidade moderada");
        }
        if (imc > 35 && imc < 39.9) {
            this.setImcMsg("Obesidade Alta");
        }
        if (imc > 40) {
            this.setImcMsg("Obesidade Alta");
        }


        System.out.println("IMC = " + imc + " Você esta com " + this.getImcMsg());
        return imc + "";
    }

    public void selecionaPeloCliente(int IdCliente) throws SQLException {
        sql = "exame WHERE idCliente = " + IdCliente;
         res = this.selectSQL(sql);
       
        while(res.next()){
            
            
            this.setPeso(res.getFloat("peso"));
            this.setAltura(res.getFloat("altura"));
            this.setImc(res.getFloat("imc"));
            this.setGluteo(res.getFloat("gluteo"));
            this.setBracoDireito(res.getFloat("bracoDireito"));
            this.setBracoEsquerdo(res.getFloat("bracoEsquerdo"));
            this.setAnteBracoDireito(res.getFloat("anteBracoDireito"));
            this.setAnteBracoEsquerdo(res.getFloat("anteBracoEsquerdo"));
            this.setCoxaDireita(res.getFloat("coxaDireita"));
            this.setCoxaEsqueda(res.getFloat("coxaEsqueda"));
            this.setPanturrilhaDireita(res.getFloat("panturrilhaDireita"));
            this.setPanturrilhaEsquerda(res.getFloat("panturrilhaEsquerda"));
        
        
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

    public void setIdCliente(int id_cliente) {
        this.idCliente = id_cliente;
    }

    public float getPeso() {
        return peso;
    }

    public void setPeso(float peso) {
        this.peso = peso;
    }

    public float getAltura() {
        return altura;
    }

    public void setAltura(float altura) {
        this.altura = altura;
    }

    public float getImc() {
        return imc;
    }

    public void setImc(float imc) {
        this.imc = imc;
    }

    public String getImcMsg() {
        return imcMsg;
    }

    public void setImcMsg(String imcMsg) {
        this.imcMsg = imcMsg;
    }

    public float getCintura() {
        return cintura;
    }

    public void setCintura(float cintura) {
        this.cintura = cintura;
    }

    public float getGluteo() {
        return gluteo;
    }

    public void setGluteo(float gluteo) {
        this.gluteo = gluteo;
    }

    public float getBracoDireito() {
        return bracoDireito;
    }

    public void setBracoDireito(float bracoDireito) {
        this.bracoDireito = bracoDireito;
    }

    public float getBracoEsquerdo() {
        return bracoEsquerdo;
    }

    public void setBracoEsquerdo(float bracoEsquerdo) {
        this.bracoEsquerdo = bracoEsquerdo;
    }

    public float getAnteBracoDireito() {
        return anteBracoDireito;
    }

    public void setAnteBracoDireito(float anteBracoDireito) {
        this.anteBracoDireito = anteBracoDireito;
    }

    public float getAnteBracoEsquerdo() {
        return anteBracoEsquerdo;
    }

    public void setAnteBracoEsquerdo(float anteBracoEsquerdo) {
        this.anteBracoEsquerdo = anteBracoEsquerdo;
    }

    public float getCoxaDireita() {
        return coxaDireita;
    }

    public void setCoxaDireita(float coxaDireita) {
        this.coxaDireita = coxaDireita;
    }

    public float getCoxaEsqueda() {
        return coxaEsqueda;
    }

    public void setCoxaEsqueda(float coxaEsqueda) {
        this.coxaEsqueda = coxaEsqueda;
    }

    public float getPanturrilhaDireita() {
        return panturrilhaDireita;
    }

    public void setPanturrilhaDireita(float panturrilhaDireita) {
        this.panturrilhaDireita = panturrilhaDireita;
    }

    public float getPanturrilhaEsquerda() {
        return panturrilhaEsquerda;
    }

    public void setPanturrilhaEsquerda(float panturrilhaEsquerda) {
        this.panturrilhaEsquerda = panturrilhaEsquerda;
    }
    
}
