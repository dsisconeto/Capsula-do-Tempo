/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package telas;

import classes.Venda;
import classes.autoComplete;
import classes.cliente;
import classes.function;
import classes.produto;
import classes.revista;
import java.awt.Color;
import java.awt.Image;
import java.awt.Toolkit;
import java.net.URL;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;



public class VendaDeProdutos extends javax.swing.JFrame {

    ResultSet res;
    revista revista;
    cliente cl;
    produto pr;
    Venda venda;

    public VendaDeProdutos() {
        initComponents();
        try {
            cl = new cliente();
            revista = new revista();
            pr = new produto();
            venda = new Venda();
            carregaCampos();
        } catch (SQLException ex) {
            Logger.getLogger(VendaDeProdutos.class.getName()).log(Level.SEVERE, null, ex);
        }

        try {
            dataDaVenda.setText(function.dataDoOS());

            URL res = this.getClass().getResource("/telas/res/icone_logo.png");
            Image icone = Toolkit.getDefaultToolkit().getImage(res);
            this.setIconImage(icone);
        } catch (Exception e) {
        }
    }

    void carregaCampos() throws SQLException {

        
        res = revista.selecionaTodasRevista();
        while (res.next()) {
            revistaCombo.addItem(res.getString("nome"));

        }


    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jLabel7 = new javax.swing.JLabel();
        jLabel8 = new javax.swing.JLabel();
        jLabel11 = new javax.swing.JLabel();
        jButton1 = new javax.swing.JButton();
        jButton2 = new javax.swing.JButton();
        jLabel12 = new javax.swing.JLabel();
        nomeProduto = new javax.swing.JTextField();
        jLabel13 = new javax.swing.JLabel();
        valorDoProduto = new javax.swing.JTextField();
        jLabel14 = new javax.swing.JLabel();
        jLabel15 = new javax.swing.JLabel();
        jLabel16 = new javax.swing.JLabel();
        jLabel17 = new javax.swing.JLabel();
        jLabel21 = new javax.swing.JLabel();
        codigoDoProduto = new javax.swing.JTextField();
        receberProduto = new javax.swing.JTextField();
        dataDoPagamento = new javax.swing.JTextField();
        unidade = new javax.swing.JSpinner();
        revistaCombo = new javax.swing.JComboBox();
        pagamentoComboBOX = new javax.swing.JComboBox();
        dataDaVenda = new javax.swing.JTextField();
        jLabel18 = new javax.swing.JLabel();
        nomeCliente = new javax.swing.JComboBox();
        bg = new javax.swing.JLabel();

        setDefaultCloseOperation(javax.swing.WindowConstants.DISPOSE_ON_CLOSE);
        setTitle("Colheita - Cadastrar Revista");
        setFocusTraversalPolicyProvider(true);
        setLocationByPlatform(true);
        setResizable(false);
        getContentPane().setLayout(null);

        jLabel7.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jLabel7.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                jLabel7MouseClicked(evt);
            }
        });
        getContentPane().add(jLabel7);
        jLabel7.setBounds(11, 10, 160, 110);

        jLabel8.setText("Nome do Cliente:");
        getContentPane().add(jLabel8);
        jLabel8.setBounds(80, 160, 140, 18);

        jLabel11.setText("Data do Pagamento:");
        getContentPane().add(jLabel11);
        jLabel11.setBounds(530, 370, 150, 18);

        jButton1.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/accept.png"))); // NOI18N
        jButton1.setText("OK");
        jButton1.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jButton1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton1ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton1);
        jButton1.setBounds(710, 490, 150, 40);

        jButton2.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/delete.png"))); // NOI18N
        jButton2.setText("Cancelar");
        jButton2.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jButton2.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton2ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton2);
        jButton2.setBounds(550, 490, 150, 40);

        jLabel12.setText("Nome do Produto:");
        getContentPane().add(jLabel12);
        jLabel12.setBounds(80, 300, 150, 18);

        nomeProduto.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusGained(java.awt.event.FocusEvent evt) {
                nomeProdutoFocusGained(evt);
            }
        });
        getContentPane().add(nomeProduto);
        nomeProduto.setBounds(80, 320, 770, 40);

        jLabel13.setText("Valor do Produto:");
        getContentPane().add(jLabel13);
        jLabel13.setBounds(80, 370, 140, 18);

        valorDoProduto.setToolTipText("Valor do Produto");
        valorDoProduto.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                valorDoProdutoFocusLost(evt);
            }
        });
        getContentPane().add(valorDoProduto);
        valorDoProduto.setBounds(80, 390, 140, 40);

        jLabel14.setText("Unidades:");
        getContentPane().add(jLabel14);
        jLabel14.setBounds(240, 370, 80, 18);

        jLabel15.setText("Revista:");
        getContentPane().add(jLabel15);
        jLabel15.setBounds(80, 230, 140, 18);

        jLabel16.setText("Receber Produto:");
        getContentPane().add(jLabel16);
        jLabel16.setBounds(570, 450, 140, 18);

        jLabel17.setText("Pagamento:");
        getContentPane().add(jLabel17);
        jLabel17.setBounds(370, 370, 140, 18);

        jLabel21.setText("Código do Produto:");
        getContentPane().add(jLabel21);
        jLabel21.setBounds(350, 230, 140, 18);

        codigoDoProduto.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                codigoDoProdutoFocusLost(evt);
            }
        });
        getContentPane().add(codigoDoProduto);
        codigoDoProduto.setBounds(350, 250, 150, 40);

        try{javax.swing.text.MaskFormatter maks = new javax.swing.text.MaskFormatter("##/##/##");
            receberProduto  = new javax.swing.JFormattedTextField(maks);
        }catch(Exception e){}
        receberProduto.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                receberProdutoActionPerformed(evt);
            }
        });
        getContentPane().add(receberProduto);
        receberProduto.setBounds(710, 440, 140, 40);

        try{javax.swing.text.MaskFormatter maks = new javax.swing.text.MaskFormatter("##/##/##");
            dataDoPagamento  = new javax.swing.JFormattedTextField(maks);
        }catch(Exception e){}
        dataDoPagamento.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusGained(java.awt.event.FocusEvent evt) {
                dataDoPagamentoFocusGained(evt);
            }
        });
        getContentPane().add(dataDoPagamento);
        dataDoPagamento.setBounds(530, 390, 150, 40);

        unidade.setModel(new javax.swing.SpinnerNumberModel(Integer.valueOf(0), Integer.valueOf(0), null, Integer.valueOf(1)));
        getContentPane().add(unidade);
        unidade.setBounds(240, 390, 110, 40);

        revistaCombo.setModel(new javax.swing.DefaultComboBoxModel(new String[] { "OUTRA" }));
        getContentPane().add(revistaCombo);
        revistaCombo.setBounds(80, 250, 260, 40);

        pagamentoComboBOX.setModel(new javax.swing.DefaultComboBoxModel(new String[] { "A Vista", "A Receber" }));
        pagamentoComboBOX.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                pagamentoComboBOXActionPerformed(evt);
            }
        });
        getContentPane().add(pagamentoComboBOX);
        pagamentoComboBOX.setBounds(370, 390, 140, 40);

        try{javax.swing.text.MaskFormatter maks = new javax.swing.text.MaskFormatter("##/##/##");
            dataDaVenda = new javax.swing.JFormattedTextField(maks);
        }catch(Exception e){}
        dataDaVenda.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                dataDaVendaActionPerformed(evt);
            }
        });
        getContentPane().add(dataDaVenda);
        dataDaVenda.setBounds(710, 390, 140, 40);

        jLabel18.setText("Data da venda:");
        getContentPane().add(jLabel18);
        jLabel18.setBounds(710, 370, 140, 18);

        nomeCliente.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusGained(java.awt.event.FocusEvent evt) {
                nomeClienteFocusGained(evt);
            }
        });
        nomeCliente.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyReleased(java.awt.event.KeyEvent evt) {
                nomeClienteKeyReleased(evt);
            }
        });
        getContentPane().add(nomeCliente);
        nomeCliente.setBounds(80, 190, 770, 40);

        bg.setDisplayedMnemonic('C');
        bg.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/bg_padrao.png"))); // NOI18N
        getContentPane().add(bg);
        bg.setBounds(0, 0, 940, 600);

        setSize(new java.awt.Dimension(936, 622));
        setLocationRelativeTo(null);
    }// </editor-fold>//GEN-END:initComponents

    private void jLabel7MouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_jLabel7MouseClicked
        new TelaInicial().setVisible(true);
        this.dispose();
    }//GEN-LAST:event_jLabel7MouseClicked

    private void jButton2ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton2ActionPerformed
        new TelaInicial().setVisible(true);
        this.dispose();
    }//GEN-LAST:event_jButton2ActionPerformed

    private void receberProdutoActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_receberProdutoActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_receberProdutoActionPerformed

    private void dataDaVendaActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_dataDaVendaActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_dataDaVendaActionPerformed

    private void valorDoProdutoFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_valorDoProdutoFocusLost
        function.converteCamposParaFloat(valorDoProduto);
    }//GEN-LAST:event_valorDoProdutoFocusLost

    private void pagamentoComboBOXActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_pagamentoComboBOXActionPerformed
        String pg;
        pg = (String) pagamentoComboBOX.getModel().getSelectedItem();

        if ("A Vista".equals(pg)) {
            dataDoPagamento.setText(function.dataDoOS());
            dataDoPagamento.disable();
        } else {
            dataDoPagamento.setText(function.dataDoProMes());
            dataDoPagamento.enable();

        }
    }//GEN-LAST:event_pagamentoComboBOXActionPerformed

    private void dataDoPagamentoFocusGained(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_dataDoPagamentoFocusGained
    }//GEN-LAST:event_dataDoPagamentoFocusGained

    private void codigoDoProdutoFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_codigoDoProdutoFocusLost
        int r = function.converteCamposParaInteger(codigoDoProduto);
        if (r >= 0) {


            pr.selecionaPorCogigoERevista(codigoDoProduto.getText(), (String) revistaCombo.getModel().getSelectedItem());
            System.out.println(pr.getId());
            if (pr.getId() != 0) {
                nomeProduto.setText(pr.getNome());
                nomeProduto.disable();
                valorDoProduto.setText(pr.getValor() + "");
            } else {
                nomeProduto.enable();
                nomeProduto.setText("");
            }
        }
    }//GEN-LAST:event_codigoDoProdutoFocusLost

    private void nomeProdutoFocusGained(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_nomeProdutoFocusGained
        int r = function.converteCamposParaInteger(codigoDoProduto);
        if (r >= 0) {


            pr.selecionaPorCogigoERevista(codigoDoProduto.getText(), (String) revistaCombo.getModel().getSelectedItem());
            System.out.println(pr.getId());
            if (pr.getId() != 0) {
                nomeProduto.setText(pr.getNome());
                nomeProduto.disable();
                nomeProduto.setForeground(Color.red);
                valorDoProduto.setText(pr.getValor() + "");
            } else {
                nomeProduto.enable();
                nomeProduto.setText("");
            }
        }
    }//GEN-LAST:event_nomeProdutoFocusGained

    private void nomeClienteFocusGained(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_nomeClienteFocusGained
       autoComplete  comple = new autoComplete();
      comple.setAutoComplete(nomeCliente,  comple.getColumnToVector("SELECT nome FROM cliente "));
    }//GEN-LAST:event_nomeClienteFocusGained

    private void nomeClienteKeyReleased(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_nomeClienteKeyReleased
     
    }//GEN-LAST:event_nomeClienteKeyReleased

    private void jButton1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton1ActionPerformed
        venda.criar(
                (String)revistaCombo.getModel().getSelectedItem(), 
                (String)nomeCliente.getModel().getSelectedItem(), 
                 codigoDoProduto.getText(),
                 valorDoProduto.getText(),
                 unidade.getValue()+"",
                 (String)pagamentoComboBOX.getModel().getSelectedItem(),
                 dataDoPagamento.getText(),
                 receberProduto.getText(),
                 dataDaVenda.getText()
                 );
    }//GEN-LAST:event_jButton1ActionPerformed

    /**
     * @param args the command line arguments
     */
    public static void main(String args[]) {
        /* Set the Nimbus look and feel */
        //<editor-fold defaultstate="collapsed" desc=" Look and feel setting code (optional) ">
        /* If Nimbus (introduced in Java SE 6) is not available, stay with the default look and feel.
         * For details see http://download.oracle.com/javase/tutorial/uiswing/lookandfeel/plaf.html 
         */
        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (ClassNotFoundException ex) {
            java.util.logging.Logger.getLogger(VendaDeProdutos.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(VendaDeProdutos.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(VendaDeProdutos.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(VendaDeProdutos.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new VendaDeProdutos().setVisible(true);
            }
        });
    }
    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JLabel bg;
    private javax.swing.JTextField codigoDoProduto;
    private javax.swing.JTextField dataDaVenda;
    private javax.swing.JTextField dataDoPagamento;
    private javax.swing.JButton jButton1;
    private javax.swing.JButton jButton2;
    private javax.swing.JLabel jLabel11;
    private javax.swing.JLabel jLabel12;
    private javax.swing.JLabel jLabel13;
    private javax.swing.JLabel jLabel14;
    private javax.swing.JLabel jLabel15;
    private javax.swing.JLabel jLabel16;
    private javax.swing.JLabel jLabel17;
    private javax.swing.JLabel jLabel18;
    private javax.swing.JLabel jLabel21;
    private javax.swing.JLabel jLabel7;
    private javax.swing.JLabel jLabel8;
    private javax.swing.JComboBox nomeCliente;
    private javax.swing.JTextField nomeProduto;
    private javax.swing.JComboBox pagamentoComboBOX;
    private javax.swing.JTextField receberProduto;
    private javax.swing.JComboBox revistaCombo;
    private javax.swing.JSpinner unidade;
    private javax.swing.JTextField valorDoProduto;
    // End of variables declaration//GEN-END:variables
}
