/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package telas.consultar;

import classes.function;
import java.awt.Image;
import java.awt.Toolkit;
import java.net.URL;
import java.sql.ResultSet;
import java.sql.SQLException;
import javax.swing.table.DefaultTableModel;
import classes.revista;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JOptionPane;
import telas.TelaInicial;

public class cosultarResvista extends javax.swing.JFrame {

    revista revista;
    int retona;
    ResultSet res;
   

    public cosultarResvista() {
        initComponents();
        try {
            carrega();
        } catch (SQLException ex) {
            Logger.getLogger(cosultarResvista.class.getName()).log(Level.SEVERE, null, ex);
        }
        try {
            URL res = this.getClass().getResource("/telas/res/icone_logo.png");
            Image icone = Toolkit.getDefaultToolkit().getImage(res);
            this.setIconImage(icone);
        } catch (Exception e) {
        }
    }

    public void carrega() throws SQLException {

        revista = new revista();
        carregaTB(null, 1);
    }
    
    
    public void carregaTB(String consulta, int op) throws SQLException{
            String resvistaNome;
        // removendo todos os contudo da tabela
        tabela.removeAll();
        // operação a ser realizada
        switch (op) {
            case 1:
                // carregando todos os clientes
                res = revista.selecionaTodasRevista();
                break;
            // consultando um cliente por nome ou id   
            case 2:
                res = revista.consultar(consulta, 1);

                break;

        }
        // pegando model da tabela
        DefaultTableModel tb = (DefaultTableModel) tabela.getModel();
        // removendo todas linhas da tabela setando o 0
        tb.setRowCount(0);

        // loop de repetição pegando infomações do banco dados 
        while (res.next()) {

            // adicionando infomações do banco de dados nas linhas da tabela
            tb.addRow(
                    new Object[]{
         res.getInt("id"),
                    res.getString("nome"),
                    res.getString("empresa"),
                    res.getString("tipo"),
                    res.getString("ciclo"),
                    res.getString("tempoDoCiclo"),
                    res.getString("porcetagem")
            });
        }

    
  
    
    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jLabel7 = new javax.swing.JLabel();
        jScrollPane1 = new javax.swing.JScrollPane();
        tabela = new javax.swing.JTable();
        jLabel10 = new javax.swing.JLabel();
        nomedaRevista = new javax.swing.JTextField();
        jButton1 = new javax.swing.JButton();
        jButton2 = new javax.swing.JButton();
        jButton3 = new javax.swing.JButton();
        bg = new javax.swing.JLabel();

        setDefaultCloseOperation(javax.swing.WindowConstants.DISPOSE_ON_CLOSE);
        setTitle("Colheita - Consultar Revista");
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

        tabela.setAutoCreateRowSorter(true);
        tabela.setModel(new javax.swing.table.DefaultTableModel(
            new Object [][] {

            },
            new String [] {
                "ID:", "NOME:", "EMPRESA:", "TIPO DE REVISTA:", "CICLO:", "TEMPO DO CICLO:", "PORCETAGEM"
            }
        ) {
            boolean[] canEdit = new boolean [] {
                false, false, false, false, false, false, false
            };

            public boolean isCellEditable(int rowIndex, int columnIndex) {
                return canEdit [columnIndex];
            }
        });
        tabela.setOpaque(false);
        tabela.setSelectionMode(javax.swing.ListSelectionModel.SINGLE_SELECTION);
        tabela.setUpdateSelectionOnSort(false);
        tabela.addAncestorListener(new javax.swing.event.AncestorListener() {
            public void ancestorRemoved(javax.swing.event.AncestorEvent evt) {
            }
            public void ancestorAdded(javax.swing.event.AncestorEvent evt) {
                tabelaAncestorAdded(evt);
            }
            public void ancestorMoved(javax.swing.event.AncestorEvent evt) {
            }
        });
        jScrollPane1.setViewportView(tabela);

        getContentPane().add(jScrollPane1);
        jScrollPane1.setBounds(50, 250, 840, 310);

        jLabel10.setText("Nome da Revista:");
        getContentPane().add(jLabel10);
        jLabel10.setBounds(50, 140, 140, 17);

        nomedaRevista.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyPressed(java.awt.event.KeyEvent evt) {
                nomedaRevistaKeyPressed(evt);
            }
            public void keyReleased(java.awt.event.KeyEvent evt) {
                nomedaRevistaKeyReleased(evt);
            }
        });
        getContentPane().add(nomedaRevista);
        nomedaRevista.setBounds(50, 160, 300, 40);

        jButton1.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/notes_add.png"))); // NOI18N
        jButton1.setText("Cadastrar");
        getContentPane().add(jButton1);
        jButton1.setBounds(590, 140, 140, 40);

        jButton2.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/notes_edit.png"))); // NOI18N
        jButton2.setText("Editar");
        jButton2.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton2ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton2);
        jButton2.setBounds(730, 180, 140, 40);

        jButton3.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/notes_delete.png"))); // NOI18N
        jButton3.setText("Deletar");
        jButton3.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton3ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton3);
        jButton3.setBounds(730, 140, 140, 40);

        bg.setDisplayedMnemonic('C');
        bg.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/bg_padrao_1.png"))); // NOI18N
        getContentPane().add(bg);
        bg.setBounds(0, 0, 940, 600);

        setSize(new java.awt.Dimension(936, 622));
        setLocationRelativeTo(null);
    }// </editor-fold>//GEN-END:initComponents

    private void jLabel7MouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_jLabel7MouseClicked
        new TelaInicial().setVisible(true);
        this.dispose();
    }//GEN-LAST:event_jLabel7MouseClicked

    private void tabelaAncestorAdded(javax.swing.event.AncestorEvent evt) {//GEN-FIRST:event_tabelaAncestorAdded

    }//GEN-LAST:event_tabelaAncestorAdded

    private void nomedaRevistaKeyPressed(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_nomedaRevistaKeyPressed
      
    }//GEN-LAST:event_nomedaRevistaKeyPressed

    private void nomedaRevistaKeyReleased(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_nomedaRevistaKeyReleased
        function.FormateJTextFieldParaM(nomedaRevista, evt);
        try {
            carregaTB(nomedaRevista.getText(),2);
        } catch (SQLException ex) {
            Logger.getLogger(cosultarResvista.class.getName()).log(Level.SEVERE, null, ex);
        }
    }//GEN-LAST:event_nomedaRevistaKeyReleased

    private void jButton3ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton3ActionPerformed
        try {
            // pegando o nome da tabela que index e 1
            Object r = tabela.getValueAt(tabela.getSelectedRow(), 1);
            //pegando o id da tabela que index e 0
            Object id = tabela.getValueAt(tabela.getSelectedRow(), 0);
            //pegando model da tabela    
            DefaultTableModel tb = (DefaultTableModel) tabela.getModel();

            // verifica se relmente deseja deleta
            int com = JOptionPane.showConfirmDialog(rootPane, "Realmente que deletar a Revista " + r);
            if (com == 0) {
                // executando a operação de deleta
                retona = revista.deletaRevista((int) id);
                // verificando se foi concluido com sucesso
                if (retona == 1) {
                    // removendo linha da tabela
                    tb.removeRow(tabela.getSelectedRow());

                    function.MsgdeCadastro("A operação de deletar foi", 1);


                } else {
                    function.MsgdeCadastro("A operação de deletar", 0);
                }

            }
        } catch (Exception e) {
        }
    }//GEN-LAST:event_jButton3ActionPerformed

    private void jButton2ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton2ActionPerformed
        Object id = 0;


        try {
            try {
                //pegando o id da tabela que index e 0
                id = tabela.getValueAt(tabela.getSelectedRow(), 0);

                // executando a tela de editar
                new telas.editar.EditarRevista((int) id).setVisible(true);
            } catch (SQLException ex) {
                Logger.getLogger(cosultarProduto.class.getName()).log(Level.SEVERE, null, ex);
            }
            this.dispose();
        } catch (Exception e) {
        }


    }//GEN-LAST:event_jButton2ActionPerformed
 
  
    
   
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
            java.util.logging.Logger.getLogger(cosultarResvista.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(cosultarResvista.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(cosultarResvista.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(cosultarResvista.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {

                new cosultarResvista().setVisible(true);

            }
        });
    }
    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JLabel bg;
    private javax.swing.JButton jButton1;
    private javax.swing.JButton jButton2;
    private javax.swing.JButton jButton3;
    private javax.swing.JLabel jLabel10;
    private javax.swing.JLabel jLabel7;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JTextField nomedaRevista;
    private javax.swing.JTable tabela;
    // End of variables declaration//GEN-END:variables
}
