/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package telas.editar;

import telas.cadastrar.*;
import classes.function;
import java.awt.Image;
import java.awt.Toolkit;
import java.net.URL;
import classes.revista;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import telas.TelaInicial;

public class EditarRevista extends javax.swing.JFrame {

    revista revista;
    private int id;

    public EditarRevista(int id) throws SQLException {
        initComponents();
        revista = new revista();
        this.setId(id);
        carregaCampos();
        try {
            URL res = this.getClass().getResource("/telas/res/icone_logo.png");
            Image icone = Toolkit.getDefaultToolkit().getImage(res);
            this.setIconImage(icone);
        } catch (Exception e) {
        }
    }

    public void carregaCampos() throws SQLException {
        // carregando os campos
        revista.selecionaPorId(this.getId());
        nome.setText(revista.getNome());
        porcentagem.setText(revista.getPorcetagem() + "");
        tipoDeRevistaCombo.addItem(revista.getTipo());
        ciclo.setText(revista.getCiclo() + "");
        tempoDoCiclo.setText(revista.getTempoDoCiclo());
        empresaCombo.addItem(revista.getEmpresa());

    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        tempoDoCiclo = new javax.swing.JTextField();
        nome = new javax.swing.JTextField();
        jLabel7 = new javax.swing.JLabel();
        jLabel3 = new javax.swing.JLabel();
        porcentagem = new javax.swing.JTextField();
        tipoDeRevistaCombo = new javax.swing.JComboBox();
        jLabel8 = new javax.swing.JLabel();
        jLabel10 = new javax.swing.JLabel();
        jLabel11 = new javax.swing.JLabel();
        empresaCombo = new javax.swing.JComboBox();
        jButton1 = new javax.swing.JButton();
        jButton2 = new javax.swing.JButton();
        jLabel12 = new javax.swing.JLabel();
        ciclo = new javax.swing.JTextField();
        jLabel13 = new javax.swing.JLabel();
        jButton3 = new javax.swing.JButton();
        jButton4 = new javax.swing.JButton();
        bg = new javax.swing.JLabel();

        setDefaultCloseOperation(javax.swing.WindowConstants.DISPOSE_ON_CLOSE);
        setTitle("Colheita - Editar Revista");
        setFocusTraversalPolicyProvider(true);
        setLocationByPlatform(true);
        setResizable(false);
        getContentPane().setLayout(null);

        tempoDoCiclo.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                tempoDoCicloFocusLost(evt);
            }
        });
        getContentPane().add(tempoDoCiclo);
        tempoDoCiclo.setBounds(200, 250, 130, 40);

        nome.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyPressed(java.awt.event.KeyEvent evt) {
                nomeKeyPressed(evt);
            }
            public void keyReleased(java.awt.event.KeyEvent evt) {
                nomeKeyReleased(evt);
            }
        });
        getContentPane().add(nome);
        nome.setBounds(80, 180, 250, 40);

        jLabel7.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jLabel7.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                jLabel7MouseClicked(evt);
            }
        });
        getContentPane().add(jLabel7);
        jLabel7.setBounds(11, 10, 160, 110);

        jLabel3.setText("Tipo de Revista:");
        getContentPane().add(jLabel3);
        jLabel3.setBounds(480, 160, 125, 17);

        porcentagem.setToolTipText("Porcentagem");
        porcentagem.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                porcentagemFocusLost(evt);
            }
        });
        getContentPane().add(porcentagem);
        porcentagem.setBounds(350, 180, 120, 40);

        tipoDeRevistaCombo.setModel(new javax.swing.DefaultComboBoxModel(new String[] { "OUTRO", "Item 2", "Item 3", "Item 4" }));
        getContentPane().add(tipoDeRevistaCombo);
        tipoDeRevistaCombo.setBounds(480, 180, 170, 40);

        jLabel8.setText("Nome da Revista:*");
        getContentPane().add(jLabel8);
        jLabel8.setBounds(80, 160, 133, 17);

        jLabel10.setText("Empresa da Revista:");
        getContentPane().add(jLabel10);
        jLabel10.setBounds(350, 230, 150, 17);

        jLabel11.setText("Dias do Ciclo:*");
        getContentPane().add(jLabel11);
        jLabel11.setBounds(200, 230, 130, 17);

        empresaCombo.setModel(new javax.swing.DefaultComboBoxModel(new String[] { "OUTRA", "Item 2", "Item 3", "Item 4" }));
        getContentPane().add(empresaCombo);
        empresaCombo.setBounds(350, 250, 180, 40);

        jButton1.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/notes_edit.png"))); // NOI18N
        jButton1.setText("Editar");
        jButton1.setToolTipText("Editar revista");
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
        jButton2.setToolTipText("Consultar Revista");
        jButton2.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jButton2.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton2ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton2);
        jButton2.setBounds(230, 490, 150, 40);

        jLabel12.setText("Porcentagem:*");
        getContentPane().add(jLabel12);
        jLabel12.setBounds(350, 160, 125, 17);
        getContentPane().add(ciclo);
        ciclo.setBounds(80, 250, 100, 40);

        jLabel13.setText("Ciclo:*");
        getContentPane().add(jLabel13);
        jLabel13.setBounds(80, 230, 80, 17);

        jButton3.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/notes_add.png"))); // NOI18N
        jButton3.setText("Cadastrar");
        jButton3.setToolTipText("Cadastrar um nova Revista isso vai gera um novo resistro");
        jButton3.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jButton3.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton3ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton3);
        jButton3.setBounds(550, 490, 150, 40);

        jButton4.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/delete.png"))); // NOI18N
        jButton4.setText("Cancelar");
        jButton4.setToolTipText("Cancelar e voltar para tela inicial");
        jButton4.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jButton4.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton4ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton4);
        jButton4.setBounds(390, 490, 150, 40);

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
        new telas.consultar.cosultarResvista().setVisible(true);
        this.dispose();
    }//GEN-LAST:event_jButton2ActionPerformed

    private void porcentagemFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_porcentagemFocusLost
        function.converteCamposParaFloat(porcentagem);
    }//GEN-LAST:event_porcentagemFocusLost

    private void jButton1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton1ActionPerformed

        javax.swing.JTextField array[] = {nome, porcentagem, tempoDoCiclo, ciclo};
        int res = 0;
        int re = function.ComposVazios(array, 3);
        if (re == 1) {

            res = revista.editar(
                    this.getId(),
                    nome.getText(),
                    (String) empresaCombo.getModel().getSelectedItem(),
                    (String) tipoDeRevistaCombo.getModel().getSelectedItem(),
                    ciclo.getText(), tempoDoCiclo.getText(), porcentagem.getText());



            function.MsgdeCadastro("Editar Revista", res);
            new telas.consultar.cosultarResvista().setVisible(true);
            this.dispose();

        }


    }//GEN-LAST:event_jButton1ActionPerformed

    private void nomeKeyPressed(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_nomeKeyPressed
        function.FormateJTextFieldParaM(nome, evt);
    }//GEN-LAST:event_nomeKeyPressed

    private void nomeKeyReleased(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_nomeKeyReleased
        function.FormateJTextFieldParaM(nome, evt);
    }//GEN-LAST:event_nomeKeyReleased

    private void tempoDoCicloFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_tempoDoCicloFocusLost
        function.converteCamposParaInteger(tempoDoCiclo);
    }//GEN-LAST:event_tempoDoCicloFocusLost

    private void jButton3ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton3ActionPerformed
        javax.swing.JTextField array[] = {nome, porcentagem, tempoDoCiclo, ciclo};
        int res = 0;
        int re = function.ComposVazios(array, 3);
        if (re == 1) {
            res = revista.criar(
                    nome.getText(),
                    (String) empresaCombo.getModel().getSelectedItem(),
                    (String) tipoDeRevistaCombo.getModel().getSelectedItem(),
                    ciclo.getText(), tempoDoCiclo.getText(), porcentagem.getText());
            function.MsgdeCadastro("Cadastrar Revista", res);
           
            if (res == 1) {
                 new telas.consultar.cosultarResvista().setVisible(true);
                this.dispose();
            }
        }


    }//GEN-LAST:event_jButton3ActionPerformed

    private void jButton4ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton4ActionPerformed
        new TelaInicial().setVisible(true);
        this.dispose();
    }//GEN-LAST:event_jButton4ActionPerformed

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

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
            java.util.logging.Logger.getLogger(cadastrarRevista.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(cadastrarRevista.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(cadastrarRevista.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(cadastrarRevista.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                try {
                    new cadastrarRevista().setVisible(true);
                } catch (SQLException ex) {
                    Logger.getLogger(cadastrarRevista.class.getName()).log(Level.SEVERE, null, ex);
                }
            }
        });
    }
    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JLabel bg;
    private javax.swing.JTextField ciclo;
    private javax.swing.JComboBox empresaCombo;
    private javax.swing.JButton jButton1;
    private javax.swing.JButton jButton2;
    private javax.swing.JButton jButton3;
    private javax.swing.JButton jButton4;
    private javax.swing.JLabel jLabel10;
    private javax.swing.JLabel jLabel11;
    private javax.swing.JLabel jLabel12;
    private javax.swing.JLabel jLabel13;
    private javax.swing.JLabel jLabel3;
    private javax.swing.JLabel jLabel7;
    private javax.swing.JLabel jLabel8;
    private javax.swing.JTextField nome;
    private javax.swing.JTextField porcentagem;
    private javax.swing.JTextField tempoDoCiclo;
    private javax.swing.JComboBox tipoDeRevistaCombo;
    // End of variables declaration//GEN-END:variables
}
