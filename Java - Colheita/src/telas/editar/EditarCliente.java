package telas.editar;

import telas.cadastrar.*;
import classes.function;
import java.awt.Image;
import java.awt.Toolkit;
import java.net.URL;
import classes.*;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import telas.TelaInicial;

public final class EditarCliente extends javax.swing.JFrame {

    private int id;
    cliente cl;
    ResultSet res;
    int re = 0;

    public EditarCliente(int id) {
        initComponents();
        this.setId(id);
        try {
            carregaCampos();
        } catch (SQLException ex) {
            Logger.getLogger(EditarCliente.class.getName()).log(Level.SEVERE, null, ex);
        }
        try {
            URL ukl = this.getClass().getResource("/telas/res/icone_logo.png");
            Image icone = Toolkit.getDefaultToolkit().getImage(ukl);
            this.setIconImage(icone);
        } catch (Exception e) {
        }
    }

    void carregaCampos() throws SQLException {
        cl = new cliente();
        // selecionando produto a se editado 
        cl.selecionaPorId(this.getId());
        // carregando valores no JTextFild
        nome.setText(cl.getNome());
        telefone.setText(cl.getTelefone());
        email.setText(cl.getEmail());
        endereco.setText(cl.getEndereco());
        clienteDesde.setText(cl.getClienteDesde());
        sexo.addItem(cl.getSexo());

    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jLabel7 = new javax.swing.JLabel();
        jButton1 = new javax.swing.JButton();
        jButton2 = new javax.swing.JButton();
        jButton3 = new javax.swing.JButton();
        jButton4 = new javax.swing.JButton();
        email = new javax.swing.JTextField();
        sexo = new javax.swing.JComboBox();
        clienteDesde = new javax.swing.JTextField();
        jLabel13 = new javax.swing.JLabel();
        jLabel14 = new javax.swing.JLabel();
        endereco = new javax.swing.JTextField();
        telefone = new javax.swing.JTextField();
        jLabel12 = new javax.swing.JLabel();
        jLabel11 = new javax.swing.JLabel();
        nome = new javax.swing.JTextField();
        jLabel9 = new javax.swing.JLabel();
        jLabel3 = new javax.swing.JLabel();
        bg = new javax.swing.JLabel();

        setDefaultCloseOperation(javax.swing.WindowConstants.DISPOSE_ON_CLOSE);
        setTitle("Colheita - Editar Cliente");
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

        jButton1.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/user_edit.png"))); // NOI18N
        jButton1.setText("Editar");
        jButton1.setToolTipText("Editar as infomações do cliente");
        jButton1.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jButton1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton1ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton1);
        jButton1.setBounds(710, 490, 150, 40);

        jButton2.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/user_search.png"))); // NOI18N
        jButton2.setText("Consultar");
        jButton2.setToolTipText("Consultar os Cliente já cadastrado");
        jButton2.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jButton2.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton2ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton2);
        jButton2.setBounds(390, 490, 150, 40);

        jButton3.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/delete.png"))); // NOI18N
        jButton3.setText("Cancelar");
        jButton3.setToolTipText("Cancelar e voltar para tela inicial");
        jButton3.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jButton3.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton3ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton3);
        jButton3.setBounds(230, 490, 150, 40);

        jButton4.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/user_add.png"))); // NOI18N
        jButton4.setText("Cadastrar");
        jButton4.setToolTipText("Cadastrar um novo cliente com essa infomações, isso vai gerar outro restro de cliente");
        jButton4.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jButton4.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton4ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton4);
        jButton4.setBounds(550, 490, 150, 40);

        email.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyReleased(java.awt.event.KeyEvent evt) {
                emailKeyReleased(evt);
            }
        });
        getContentPane().add(email);
        email.setBounds(480, 180, 380, 40);

        sexo.setModel(new javax.swing.DefaultComboBoxModel(new String[] { "F", "M" }));
        getContentPane().add(sexo);
        sexo.setBounds(660, 250, 110, 40);

        try{javax.swing.text.MaskFormatter maks = new javax.swing.text.MaskFormatter("##/##/##");
            clienteDesde  = new javax.swing.JFormattedTextField(maks);
        }catch(Exception e){}
        getContentPane().add(clienteDesde);
        clienteDesde.setBounds(530, 250, 120, 40);

        jLabel13.setText("Sexo:");
        getContentPane().add(jLabel13);
        jLabel13.setBounds(660, 230, 125, 17);

        jLabel14.setText("Cliente Desde*");
        getContentPane().add(jLabel14);
        jLabel14.setBounds(530, 230, 125, 17);

        endereco.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyReleased(java.awt.event.KeyEvent evt) {
                enderecoKeyReleased(evt);
            }
        });
        getContentPane().add(endereco);
        endereco.setBounds(80, 250, 430, 40);

        try{
            javax.swing.text.MaskFormatter mask = new javax.swing.text.MaskFormatter("(##)####-####");
            telefone = new javax.swing.JFormattedTextField(mask);
        }catch(Exception e){}
        getContentPane().add(telefone);
        telefone.setBounds(350, 180, 120, 40);

        jLabel12.setText("Telefone*");
        getContentPane().add(jLabel12);
        jLabel12.setBounds(350, 160, 125, 17);

        jLabel11.setText("Endereço:");
        getContentPane().add(jLabel11);
        jLabel11.setBounds(80, 230, 125, 17);

        nome.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                nomeActionPerformed(evt);
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
        nome.setBounds(80, 180, 250, 40);

        jLabel9.setText("Nome do Cliente*");
        getContentPane().add(jLabel9);
        jLabel9.setBounds(80, 160, 140, 17);

        jLabel3.setText("Email:");
        getContentPane().add(jLabel3);
        jLabel3.setBounds(480, 160, 125, 17);

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

        new telas.consultar.cosultarCliente().setVisible(true);
        this.dispose();
    }//GEN-LAST:event_jButton2ActionPerformed

    private void jButton1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton1ActionPerformed

        // validação de campos obrigatorios
        javax.swing.JTextField array[] = {nome};
        javax.swing.JTextField array2[] = {email, endereco};
        javax.swing.JTextField arrayData[] = {clienteDesde};
        if (function.ComposVazios(array, 3) == 1 && function.DatasVazias(arrayData) == 1 && function.ComposVazios(array2, 2) == 1) {

            //editando o  cliente
            re = cl.editar(this.getId(),
                    nome.getText(),
                    telefone.getText(),
                    email.getText(),
                    endereco.getText(),
                    clienteDesde.getText(),
                    (String) sexo.getModel().getSelectedItem());


            function.MsgdeCadastro("Editar Cliente", re);
            new telas.consultar.cosultarCliente().setVisible(true);
            this.dispose();

        }
    }//GEN-LAST:event_jButton1ActionPerformed

    private void jButton3ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton3ActionPerformed
        new TelaInicial().setVisible(true);
        this.dispose();
    }//GEN-LAST:event_jButton3ActionPerformed

    private void jButton4ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton4ActionPerformed
        int re;
        // validação de campos obrigatorios
        javax.swing.JTextField array[] = {nome};
        javax.swing.JTextField array2[] = {email, endereco};
        javax.swing.JTextField arrayData[] = {clienteDesde};
        if (function.ComposVazios(array, 3) == 1 && function.DatasVazias(arrayData) == 1 && function.ComposVazios(array2, 2) == 1) {

            // criando cliente
            re = cl.criar(
                    nome.getText(),
                    telefone.getText(),
                    email.getText(),
                    endereco.getText(),
                    clienteDesde.getText(),
                    (String) sexo.getModel().getSelectedItem());

            function.MsgdeCadastro("Cadastrar Cliente", re);
            new telas.consultar.cosultarCliente().setVisible(true);
            this.dispose();
        }
    }//GEN-LAST:event_jButton4ActionPerformed

    private void emailKeyReleased(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_emailKeyReleased
    }//GEN-LAST:event_emailKeyReleased

    private void enderecoKeyReleased(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_enderecoKeyReleased
    }//GEN-LAST:event_enderecoKeyReleased

    private void nomeActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_nomeActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_nomeActionPerformed

    private void nomeKeyPressed(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_nomeKeyPressed
    }//GEN-LAST:event_nomeKeyPressed

    private void nomeKeyReleased(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_nomeKeyReleased
        function.FormateJTextFieldParaM(nome, evt);
    }//GEN-LAST:event_nomeKeyReleased

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
                new EditarCliente(0).setVisible(true);

            }
        });
    }
    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JLabel bg;
    private javax.swing.JTextField clienteDesde;
    private javax.swing.JTextField email;
    private javax.swing.JTextField endereco;
    private javax.swing.JButton jButton1;
    private javax.swing.JButton jButton2;
    private javax.swing.JButton jButton3;
    private javax.swing.JButton jButton4;
    private javax.swing.JLabel jLabel11;
    private javax.swing.JLabel jLabel12;
    private javax.swing.JLabel jLabel13;
    private javax.swing.JLabel jLabel14;
    private javax.swing.JLabel jLabel3;
    private javax.swing.JLabel jLabel7;
    private javax.swing.JLabel jLabel9;
    private javax.swing.JTextField nome;
    private javax.swing.JComboBox sexo;
    private javax.swing.JTextField telefone;
    // End of variables declaration//GEN-END:variables
}
