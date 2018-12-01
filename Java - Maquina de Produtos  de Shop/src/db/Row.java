package db;

import java.sql.Date;

public class Row {

    private String literal;
    private int inteiro;
    private double real;
    private Date data;
    private String nameRow;
    private int tipo;
    private String codicao;
    private String operador;
    

    public String getOperador() {
        return operador;
    }

    public Row setOperador(String operador) {
        this.operador = operador;
        return this;
    }

    public String getCodicao() {
        return codicao;
    }

    public Row setCodicao(String codicao) {
        this.codicao = codicao;
        return this;
    }

    public int getTipo() {

        return tipo;
    }

    public String getNameRow() {
        return nameRow;
    }

    public Row(String nameCol, String literal) {
        this.nameRow = nameCol;
        this.literal = literal;
        this.tipo = 1;
    }

    public Row(String nameCol, int inteiro) {
        this.nameRow = nameCol;
        this.inteiro = inteiro;
        this.tipo = 2;
    }

    public Row(String nameCol, double real) {
        this.nameRow = nameCol;
        this.real = real;
        this.tipo = 3;

    }
    
    public Row(String nameCol, Date data) {
        this.nameRow = nameCol;
        this.data = data;
        this.tipo = 4;

    }

   

    public String getLiteral() {
        return literal;
    }

    public int getInteiro() {
        return inteiro;
    }

    public double getReal() {
        return real;
    }

    public Date getData() {
        return data;
    }
    
    

}
