/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controler;

import db.Controller;
import db.Mensagem;
import java.util.ArrayList;
import model.Produto;
import model.RegistroDeCompra;

/**
 *
 * @author dsisconeto
 */
public class Pagamento extends Controller {

    public ArrayList<Mensagem> cartao(String numero, String senha, Produto produto) {

        RegistroDeCompra registro = new RegistroDeCompra();

        this.setMensagem("Número do cartão invalido", false, 0);
        this.setMensagem("Senha do cartão invalida", false, 1);
        this.setMensagem("Pagamento Efetuado com sucesso\n valor da comprar: "
                + produto.getPrecoVenda() + "\n Produto:" + produto.getNome(), true, 2);
        this.setMensagem("Erro ao Efetuado com pagamento \nvalor da comprar: "
                + produto.getPrecoVenda() + "\n Produto:" + produto.getNome(), true, 3);

        if (numero.length() < 2) {
            this.setRetorno(0);
        }

        if (senha.length() < 2) {
            this.setRetorno(1);
        }

        if (this.noError()) {
            registro.setProduto(produto);
            registro.setFormaDePagamento(2);

            if (registro.cadastrar()) {

                this.setRetorno(2);
            } else {
                this.setRetorno(3);
            }
        }

        return this.getRetorno();
    }

    public ArrayList<Mensagem> dinheiro(String dinheiro, Produto produto) {

        RegistroDeCompra registro = new RegistroDeCompra();
        this.setMensagem("Valor invalido", false, 0);
        this.setMensagem("Seu dinheiro não dá para comprar\n produto:"
                + produto.getNome() + "\n valor do produto: R$ " + produto.getPrecoVenda()
                + "\n Seu dinheiro: R$ " + dinheiro, false, 1);
        double dinheirouDouble;
        dinheiro = dinheiro.replaceAll(",", ".");
        try {
            dinheirouDouble = Double.parseDouble(dinheiro);

            if (dinheirouDouble < produto.getPrecoVenda()) {
                this.setRetorno(1);
            }
            this.setMensagem("Pagamento Efetuado com sucesso\n valor da comprar: "
                    + produto.getPrecoVenda() + "\n Produto:" + produto.getNome()
                    + "\nSeu troco:" + (dinheirouDouble - produto.getPrecoVenda()), true, 2);

            this.setMensagem("Erro ao Efetuado com pagamento \nvalor da comprar: "
                    + produto.getPrecoVenda() + "\n Produto:" + produto.getNome(), true, 3);

        } catch (NumberFormatException e) {

            this.setRetorno(0);
        }

        if (this.noError()) {

            registro.setProduto(produto);
            registro.setFormaDePagamento(1);

            if (registro.cadastrar()) {
                this.setRetorno(2);
            } else {
                this.setRetorno(3);
            }
        }

        return this.getRetorno();
    }

}
