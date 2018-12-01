/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import db.Model;
import db.Row;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author dsisconeto
 */
public class RegistroDeCompra extends Model {

    private Produto produto = new Produto();
    private Caixa caixa = new Caixa();
    private int formaDePagamento; // 1 = dinheiro 2 = cartão
   
    public RegistroDeCompra() {

        this.setTable("registro_compra");
    }

    public boolean cadastrar() {

        Registradora registradora = Registradora.aberta();
        this.setRows(new Row("caixa_id", registradora.getId()));
        this.setRows(new Row("produto_id", produto.getId()));
        this.setRows(new Row("valor_custo", produto.getPrecoCusto()));
        this.setRows(new Row("valor_venda", produto.getPrecoVenda()));
        this.setRows(new Row("forma_pagamento", this.getFormaDePagamento()));

        if (this.registrar()) {
            produto.retirar();
            return true;
        } else {
            return false;
        }

    }

    public ArrayList<RegistroDeCompra> todosRegistros() {

        ArrayList<RegistroDeCompra> registos = new ArrayList<>();
        RegistroDeCompra registro;
        ResultSet resutadoRegistros = this.procurarTodos();

        try {
            while (resutadoRegistros.next()) {
                registro = new RegistroDeCompra();
                
                registro.setId(resutadoRegistros.getInt("id"));
                registro.getCaixa().setId(resutadoRegistros.getInt("caixa_id"));
                registro.setFormaDePagamento(resutadoRegistros.getInt("forma_pagamento"));
                registro.getProduto().setPrecoCusto(resutadoRegistros.getDouble("valor_custo"));
                registro.getProduto().setPrecoVenda(resutadoRegistros.getDouble("valor_venda"));
                
                registos.add(registro);
            }

        } catch (SQLException ex) {
            Logger.getLogger(RegistroDeCompra.class.getName()).log(Level.SEVERE, null, ex);
        }

        return registos;

    }

    public Caixa getCaixa() {
        return caixa;
    }

    public void setCaixa(Caixa caixa) {
        this.caixa = caixa;
    }
    
    
    
    

    public Produto getProduto() {
        return produto;
    }

    public void setProduto(Produto produto) {
        this.produto = produto;
    }

    public int getFormaDePagamento() {
        return formaDePagamento;
    }

    public void setFormaDePagamento(int formaDePagamento) {
        this.formaDePagamento = formaDePagamento;
    }

}
