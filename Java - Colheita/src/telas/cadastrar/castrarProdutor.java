/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package telas.cadastrar;

import classes.*;
import java.awt.Image;
import java.awt.Toolkit;
import java.net.URL;
import classes.*;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import telas.TelaInicial;

public final class castrarProdutor extends javax.swing.JFrame {

    ResultSet res;
    int reto = 0;
    produto pr;
    revista resvita;

    public castrarProdutor() throws SQLException {
        initComponents();

        pr = new produto();
        resvita = new revista();
        carregaCampos();
        try {
            URL url = this.getClass().getResource("/telas/res/icone_logo.png");
            Image icone = Toolkit.getDefaultToolkit().getImage(url);
            this.setIconImage(icone);
        } catch (Exception e) {
        }
    }

    void carregaCampos() throws SQLException {
        res = resvita.selecionaTodasRevista();

        while (res.next()) {
            revista.addItem(res.getString("nome"));
        }

    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        valorDoProduto = new javax.swing.JTextField();
        nome = new javax.swing.JTextField();
        jLabel7 = new javax.swing.JLabel();
        jLabel3 = new javax.swing.JLabel();
        jLabel8 = new javax.swing.JLabel();
        jLabel11 = new javax.swing.JLabel();
        jButton1 = new javax.swing.JButton();
        jButton2 = new javax.swing.JButton();
        jLabel12 = new javax.swing.JLabel();
        codigo = new javax.swing.JTextField();
        jLabel13 = new javax.swing.JLabel();
        estoque = new javax.swing.JTextField();
        jLabel14 = new javax.swing.JLabel();
        tipo = new javax.swing.JComboBox();
        revista = new javax.swing.JComboBox();
        jButton3 = new javax.swing.JButton();
        bg = new javax.swing.JLabel();

        setDefaultCloseOperation(javax.swing.WindowConstants.DISPOSE_ON_CLOSE);
        setTitle("Colheita - Cadastrar Produto");
        setFocusTraversalPolicyProvider(true);
        setLocationByPlatform(true);
        setResizable(false);
        getContentPane().setLayout(null);

        valorDoProduto.setToolTipText("Valor do Produto");
        valorDoProduto.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                valorDoProdutoFocusLost(evt);
            }
        });
        getContentPane().add(valorDoProduto);
        valorDoProduto.setBounds(450, 250, 70, 40);

        nome.addInputMethodListener(new java.awt.event.InputMethodListener() {
            public void inputMethodTextChanged(java.awt.event.InputMethodEvent evt) {
                nomeInputMethodTextChanged(evt);
            }
            public void caretPositionChanged(java.awt.event.InputMethodEvent evt) {
            }
        });
        nome.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyPressed(java.awt.event.KeyEvent evt) {
                nomeKeyPressed(evt);
            }
            public void keyReleased(java.awt.event.KeyEvent evt) {
                nomeKeyReleased(evt);
            }
        });
        getContentPane().add(nome);
        nome.setBounds(80, 180, 760, 40);

        jLabel7.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jLabel7.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                jLabel7MouseClicked(evt);
            }
        });
        getContentPane().add(jLabel7);
        jLabel7.setBounds(11, 10, 160, 110);

        jLabel3.setText("Revista:");
        getContentPane().add(jLabel3);
        jLabel3.setBounds(210, 230, 125, 18);

        jLabel8.setText("Nome do Produto:*");
        getContentPane().add(jLabel8);
        jLabel8.setBounds(80, 160, 134, 18);

        jLabel11.setText("Valor:*");
        getContentPane().add(jLabel11);
        jLabel11.setBounds(450, 230, 70, 18);

        jButton1.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/add.png"))); // NOI18N
        jButton1.setText("Cadastrar");
        jButton1.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jButton1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton1ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton1);
        jButton1.setBounds(710, 490, 150, 40);

        jButton2.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/search.png"))); // NOI18N
        jButton2.setText("Consultar");
        jButton2.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jButton2.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton2ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton2);
        jButton2.setBounds(390, 490, 150, 40);

        jLabel12.setText("Código:*");
        getContentPane().add(jLabel12);
        jLabel12.setBounds(80, 230, 125, 18);
        getContentPane().add(codigo);
        codigo.setBounds(80, 250, 120, 40);

        jLabel13.setText("Tipo:*");
        getContentPane().add(jLabel13);
        jLabel13.setBounds(670, 230, 125, 18);

        estoque.setToolTipText("Estoque");
        estoque.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                estoqueFocusLost(evt);
            }
        });
        getContentPane().add(estoque);
        estoque.setBounds(530, 250, 120, 40);

        jLabel14.setText("Estoque:*");
        getContentPane().add(jLabel14);
        jLabel14.setBounds(530, 230, 125, 18);

        tipo.setModel(new javax.swing.DefaultComboBoxModel(new String[] { "Item 1", "Item 2", "Item 3", "Item 4" }));
        getContentPane().add(tipo);
        tipo.setBounds(670, 250, 170, 40);

        revista.setModel(new javax.swing.DefaultComboBoxModel(new String[] { "OUTRA" }));
        getContentPane().add(revista);
        revista.setBounds(210, 250, 230, 40);

        jButton3.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/delete.png"))); // NOI18N
        jButton3.setText("Cancelar");
        jButton3.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jButton3.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton3ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton3);
        jButton3.setBounds(550, 490, 150, 40);

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

        new telas.consultar.cosultarProduto().setVisible(true);


        this.dispose();
    }//GEN-LAST:event_jButton2ActionPerformed

    private void valorDoProdutoFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_valorDoProdutoFocusLost
        function.converteCamposParaFloat(valorDoProduto);
    }//GEN-LAST:event_valorDoProdutoFocusLost

    private void jButton1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton1ActionPerformed
        // criando array com os campos de texto a se verificados se estão vazios
        javax.swing.JTextField array[] = {nome, codigo, valorDoProduto, valorDoProduto, estoque};

        int re = function.ComposVazios(array, 3);
        if (re == 1) {
            // String nome, String codigo, String Nomerevista, String estoque, String valor
            reto = pr.criar(
                    nome.getText(),
                    codigo.getText(),
                    (String) revista.getModel().getSelectedItem(),
                    estoque.getText(),
                    valorDoProduto.getText(),
                    (String) tipo.getModel().getSelectedItem());

            function.MsgdeCadastro("Cadastrar Produto", reto);
            if (reto == 1) {
                new TelaInicial().setVisible(true);
                this.dispose();
            }
        }
    }//GEN-LAST:event_jButton1ActionPerformed

    private void estoqueFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_estoqueFocusLost
        function.converteCamposParaInteger(estoque);
    }//GEN-LAST:event_estoqueFocusLost

    private void nomeInputMethodTextChanged(java.awt.event.InputMethodEvent evt) {//GEN-FIRST:event_nomeInputMethodTextChanged
    }//GEN-LAST:event_nomeInputMethodTextChanged

    private void nomeKeyPressed(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_nomeKeyPressed
    }//GEN-LAST:event_nomeKeyPressed

    private void nomeKeyReleased(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_nomeKeyReleased
        function.FormateJTextFieldParaM(nome, evt);
    }//GEN-LAST:event_nomeKeyReleased

    private void jButton3ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton3ActionPerformed
        new TelaInicial().setVisible(true);
        this.dispose();
    }//GEN-LAST:event_jButton3ActionPerformed

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
            java.util.logging.Logger.getLogger(castrarProdutor.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(castrarProdutor.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(castrarProdutor.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(castrarProdutor.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                try {
                    new castrarProdutor().setVisible(true);
                } catch (SQLException ex) {
                    Logger.getLogger(castrarProdutor.class.getName()).log(Level.SEVERE, null, ex);
                }
            }
        });
    }
    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JLabel bg;
    private javax.swing.JTextField codigo;
    private javax.swing.JTextField estoque;
    private javax.swing.JButton jButton1;
    private javax.swing.JButton jButton2;
    private javax.swing.JButton jButton3;
    private javax.swing.JLabel jLabel11;
    private javax.swing.JLabel jLabel12;
    private javax.swing.JLabel jLabel13;
    private javax.swing.JLabel jLabel14;
    private javax.swing.JLabel jLabel3;
    private javax.swing.JLabel jLabel7;
    private javax.swing.JLabel jLabel8;
    private javax.swing.JTextField nome;
    private javax.swing.JComboBox revista;
    private javax.swing.JComboBox tipo;
    private javax.swing.JTextField valorDoProduto;
    // End of variables declaration//GEN-END:variables
}
