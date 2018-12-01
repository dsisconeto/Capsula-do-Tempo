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

/**
 *
 * @author dsisconeto
 */
public class ProdutoController extends Controller {

    public ArrayList<Mensagem> cadastrar(String nome, String precoVenda,
            String precoCusto, String quantidade) {

        this.setMensagem("Nome invalido", false, 0);
        this.setMensagem("Preço de Venda Invalido", false, 1);
        this.setMensagem("Preço de Custo Invalido", false, 2);
        this.setMensagem("Produto cadastrado com sucesso", true, 3);
        this.setMensagem("Erro ao cadastrar produto", false, 4);
        this.setMensagem("Quntidade Invalida", false, 5);
        Produto produto = new Produto();
        produto.setNome(nome);
        precoCusto = precoCusto.replaceAll(",", ".");
        precoVenda = precoVenda.replaceAll(",", ".");

        if (produto.getNome().length() < 1) {

            this.setRetorno(0);
        }

        try {
            produto.setQuantidade(Integer.parseInt(quantidade));

            if (produto.getQuantidade() < 0) {

                this.setRetorno(5);
            }
        } catch (NumberFormatException e) {

            this.setRetorno(5);
        }

        try {
            produto.setPrecoVenda(Double.parseDouble(precoVenda));

            if (produto.getPrecoVenda() < 0) {
                this.setRetorno(1);

            }
        } catch (NumberFormatException e) {

            this.setRetorno(1);
        }

        try {

            produto.setPrecoCusto(Double.parseDouble(precoCusto));

            if (produto.getPrecoCusto() < 0) {
                this.setRetorno(2);
            }

        } catch (NumberFormatException e) {

            this.setRetorno(2);
        }

        if (this.noError()) {

            if (produto.cadastrar()) {

                this.setRetorno(3);

            } else {
                this.setRetorno(4);
            }

        }

        return this.getRetorno();
    }

    public ArrayList<Mensagem> editar(int id, String nome, String precoVenda,
            String precoCusto, String quantidade) {

        this.setMensagem("Nome invalido", false, 0);
        this.setMensagem("Preço de Venda Invalido", false, 1);
        this.setMensagem("Preço de Custo Invalido", false, 2);
        this.setMensagem("Produto Editado com sucesso", true, 3);
        this.setMensagem("Erro ao editar produto", false, 4);
        this.setMensagem("Quntidade Invalida", false, 5);

        Produto produto = new Produto();
        produto.setNome(nome);
        precoCusto = precoCusto.replaceAll(",", ".");
        precoVenda = precoVenda.replaceAll(",", ".");

        produto.setId(id);

        if (produto.getNome().length() < 1) {
            System.out.print("Nome invalido");
            this.setRetorno(0);
        }

        try {
            produto.setQuantidade(Integer.parseInt(quantidade));

            if (produto.getQuantidade() < 0) {
                System.out.print("Nome invalido");
                this.setRetorno(5);
            }
        } catch (NumberFormatException e) {
            System.out.print("Nome invalido");
            this.setRetorno(5);
        }

        try {
            produto.setPrecoVenda(Double.parseDouble(precoVenda));

            if (produto.getPrecoVenda() < 0) {
                System.out.print("Nome invalido");
                this.setRetorno(1);

            }
        } catch (NumberFormatException e) {
            System.out.print("Nome invalido");
            this.setRetorno(1);
        }

        try {

            produto.setPrecoCusto(Double.parseDouble(precoCusto));

            if (produto.getPrecoCusto() < 0) {
                this.setRetorno(2);
                System.out.print("Nome invalido");
            }

        } catch (NumberFormatException e) {
            System.out.print("Nome invalido");
            this.setRetorno(2);
        }

        if (this.noError()) {

            if (produto.editar()) {

                System.out.print("Nome invalido");
                this.setRetorno(3);

            } else {
                System.out.print("Erro ao editar");
                this.setRetorno(4);
            }

        } else {
            System.out.print("Erro ao editar");
        }

        return this.getRetorno();
    }

    public ArrayList<Mensagem> deletar(int id) {
        
        Produto produto = new Produto();
        produto.setId(id);
        this.setMensagem("Produto deletado com sucesso", true, 0);
        this.setMensagem("Erro ao deletar com sucesso", false, 1);

        if (produto.deletar()) {

            this.setRetorno(0);

        } else {
            
            this.setRetorno(1);
        }
        
        
        return this.getRetorno();

    }

}
