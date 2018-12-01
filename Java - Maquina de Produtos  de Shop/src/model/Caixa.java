package model;

import db.Model;
import db.Row;
import java.sql.Date;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.logging.Level;
import java.util.logging.Logger;

public class Caixa extends Model {

    private double valorEmDinheiro = 0;
    private double valorEmCredito = 0;
    private double valorTotal = 0;
    private double valorLucro = 0;

    private Date data;
    private final Date dataAtual = new Date(new java.util.Date().getTime());

    public Caixa() {

        this.setTable("caixa");

    }

    public void calcularCaixa() {

        RegistroDeCompra registro = new RegistroDeCompra();
        ResultSet caixas = this.procurarTodos();
        ArrayList<RegistroDeCompra> registros = registro.todosRegistros();
        double valor;
        Caixa caixa2;
        if (caixas != null && registros != null) {

            try {

                while (caixas.next()) {
                    caixa2 = new Caixa();
                    caixa2.setId(caixas.getInt("id"));

                    for (RegistroDeCompra row : registros) {

                        if (row.getCaixa().getId() == caixa2.getId()) {

                            valor = row.getProduto().getPrecoVenda();

                            if (row.getFormaDePagamento() == 1) {

                                caixa2.setValorEmDinheiro((caixa2.getValorEmDinheiro() + valor));

                            } else {

                                caixa2.setValorEmCredito((caixa2.getValorEmCredito() + valor));

                            }

                            valor =row.getProduto().getPrecoVenda() - row.getProduto().getPrecoCusto();

                            caixa2.setValorLucro(caixa2.getValorLucro() + valor);

                        }

                    }

                    caixa2.setValorTotal(caixa2.getValorEmCredito() + caixa2.getValorEmDinheiro());
                    caixa2.atualizarCaixar();

                }

            } catch (SQLException ex) {
                Logger.getLogger(Caixa.class.getName()).log(Level.SEVERE, null, ex);
            }

        }
    }

    private boolean atualizarCaixar() {

        this.setRows(new Row("valor_total", this.getValorTotal()));
        this.setRows(new Row("valor_lucro", this.getValorLucro()));
        this.setRows(new Row("valor_dinheiro", this.getValorEmDinheiro()));
        this.setRows(new Row("valor_credito", this.getValorEmCredito()));

        return this.atualizar();
    }

    protected void abrirCaixa() {

        if (!this.carregarCaixa()) {

            System.out.print("Abrir Caixar");
            this.setRows(new Row("data", this.dataAtual));
            this.registrar();
            this.carregarCaixa();

        } else {
            System.out.print("O caixa já está aberto");
        }
    }

    protected boolean carregarCaixa() {

        this.setRows(new Row("data", this.dataAtual).setOperador("="));

        ResultSet result = this.procurarPor();

        if (result != null) {
            try {
                result.next();
                this.setId(result.getInt("id"));
                this.setData(result.getDate("data"));
                this.setValorEmCredito(result.getDouble("valor_credito"));
                this.setValorEmDinheiro(result.getDouble("valor_dinheiro"));
                return true;
            } catch (SQLException ex) {

                Logger.getLogger(Caixa.class.getName()).log(Level.SEVERE, null, ex);
                return false;
            }

        } else {

            return false;
        }

    }

    public double getValorEmDinheiro() {
        return valorEmDinheiro;
    }

    public void setValorEmDinheiro(double valorEmDinheiro) {
        this.valorEmDinheiro = valorEmDinheiro;
    }

    public double getValorEmCredito() {
        return valorEmCredito;
    }

    public void setValorEmCredito(double valorEmCredito) {
        this.valorEmCredito = valorEmCredito;
    }

    public Date getData() {
        return data;
    }

    public void setData(Date data) {
        this.data = data;
    }

    public Date getDataAtual() {
        return dataAtual;
    }

    public double getValorTotal() {
        return valorTotal;
    }

    public void setValorTotal(double valorTotal) {
        this.valorTotal = valorTotal;
    }

    public double getValorLucro() {
        return valorLucro;
    }

    public void setValorLucro(double valorLucro) {
        this.valorLucro = valorLucro;
    }

}
