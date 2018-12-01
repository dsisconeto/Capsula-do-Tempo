package model;

import db.Model;
import db.Row;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;

public class Produto extends Model {

    private String nome;
    private double precoVenda;
    private double precoCusto;
    private int quantidade;

    public Produto() {
        this.setTable("APP.PRODUTO");

    }

    public boolean cadastrar() {

        this.setRows(new Row("nome", this.getNome()));
        this.setRows(new Row("quantidade", this.getQuantidade()));
        this.setRows(new Row("preco_custo", this.getPrecoCusto()));
        this.setRows(new Row("preco_venda", this.getPrecoVenda()));

        return this.registrar();
    }

    public boolean editar() {
        System.out.println("Editar Produto");

        this.setRows(new Row("nome", this.getNome()));
        this.setRows(new Row("quantidade", this.getQuantidade()));
        this.setRows(new Row("preco_custo", this.getPrecoCusto()));
        this.setRows(new Row("preco_venda", this.getPrecoVenda()));

        return this.atualizar();
    }

    public boolean retirar() {
        
        this.setRows(new Row("quantidade", (this.getQuantidade()-1)));
        
        return this.atualizar();
    }

    public ResultSet procurarEmEstoque() {

        this.setRows(new Row("quantidade", "0").setOperador(">"));

        return this.procurarPor();

    }

    public boolean deletar() {

        return this.delete();
    }

    public ResultSet procurarPorNome() {

        this.setRows(new Row("nome", "%" + this.getNome() + "%").setOperador("LIKE"));

        return this.procurarPor();
    }

    public void carregar() {

        ResultSet result = this.procurarUm();

        if (result != null) {

            try {
                while (result.next()) {

                    this.setNome(result.getString("nome"));
                    this.setPrecoCusto(result.getDouble("preco_custo"));
                    this.setPrecoVenda(result.getDouble("preco_venda"));
                    this.setQuantidade(result.getInt("quantidade"));
                }
            } catch (SQLException ex) {
                Logger.getLogger(Produto.class.getName()).log(Level.SEVERE, null, ex);
            }

        }

    }

    public int getQuantidade() {
        return quantidade;
    }

    public void setQuantidade(int quantidade) {
        this.quantidade = quantidade;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public double getPrecoVenda() {

        return precoVenda;
    }

    public void setPrecoVenda(double precoVenda) {
        this.precoVenda = precoVenda;
    }

    public double getPrecoCusto() {
        return precoCusto;
    }

    public void setPrecoCusto(double precoCusto) {
        this.precoCusto = precoCusto;
    }

}
