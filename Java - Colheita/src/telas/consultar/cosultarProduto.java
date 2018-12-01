package telas.consultar;

import classes.function;
import java.awt.Image;
import java.awt.Toolkit;
import java.net.URL;
import java.sql.ResultSet;
import java.sql.SQLException;
import javax.swing.table.DefaultTableModel;
import classes.produto;
import classes.revista;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JOptionPane;
import telas.TelaInicial;
import telas.cadastrar.castrarProdutor;

public class cosultarProduto extends javax.swing.JFrame {

    produto pr;
    revista revista;
    ResultSet res;
    int retona = 1;

    public cosultarProduto() {
        initComponents();
        try {
            carregar();
        } catch (SQLException ex) {
            Logger.getLogger(cosultarProduto.class.getName()).log(Level.SEVERE, null, ex);
        }
        try {
            URL res = this.getClass().getResource("/telas/res/icone_logo.png");
            Image icone = Toolkit.getDefaultToolkit().getImage(res);
            this.setIconImage(icone);
        } catch (Exception e) {
        }
    }

    public void carregar() throws SQLException {
        revista = new revista();
        pr = new produto();
    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jLabel7 = new javax.swing.JLabel();
        jScrollPane1 = new javax.swing.JScrollPane();
        tabela = new javax.swing.JTable();
        jLabel10 = new javax.swing.JLabel();
        nome = new javax.swing.JTextField();
        jButton1 = new javax.swing.JButton();
        jButton2 = new javax.swing.JButton();
        jButton3 = new javax.swing.JButton();
        bg = new javax.swing.JLabel();

        setDefaultCloseOperation(javax.swing.WindowConstants.DISPOSE_ON_CLOSE);
        setTitle("Colheita - Cosultar Produto");
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
                "ID:", "NOME:", "CÓDIGO:", "RESVISTA:", "ESTOQUE", "VALOR:", "TIPO:", "DATA DE CADATRATO:"
            }
        ) {
            boolean[] canEdit = new boolean [] {
                false, false, false, false, false, false, false, false
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

        jLabel10.setText("Nome do Produtor:");
        getContentPane().add(jLabel10);
        jLabel10.setBounds(50, 140, 140, 17);

        nome.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyPressed(java.awt.event.KeyEvent evt) {
                nomeKeyPressed(evt);
            }
            public void keyReleased(java.awt.event.KeyEvent evt) {
                nomeKeyReleased(evt);
            }
        });
        getContentPane().add(nome);
        nome.setBounds(50, 160, 320, 40);

        jButton1.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/add.png"))); // NOI18N
        jButton1.setText("Cadastrar");
        jButton1.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jButton1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton1ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton1);
        jButton1.setBounds(610, 140, 140, 40);

        jButton2.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/edit.png"))); // NOI18N
        jButton2.setText("Editar");
        jButton2.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jButton2.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton2ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton2);
        jButton2.setBounds(750, 140, 140, 40);

        jButton3.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/delete.png"))); // NOI18N
        jButton3.setText("Deletar");
        jButton3.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jButton3.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton3ActionPerformed(evt);
            }
        });
        getContentPane().add(jButton3);
        jButton3.setBounds(750, 180, 140, 40);

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
        try {
            carregarTebela(null, 1);
        } catch (SQLException ex) {
            Logger.getLogger(cosultarProduto.class.getName()).log(Level.SEVERE, null, ex);
        }
    }//GEN-LAST:event_tabelaAncestorAdded

    private void nomeKeyPressed(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_nomeKeyPressed
    }//GEN-LAST:event_nomeKeyPressed

    private void nomeKeyReleased(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_nomeKeyReleased
        function.FormateJTextFieldParaM(nome, evt);
        try {
            carregarTebela(nome.getText(), 2);
        } catch (SQLException ex) {
            Logger.getLogger(cosultarProduto.class.getName()).log(Level.SEVERE, null, ex);
        }

    }//GEN-LAST:event_nomeKeyReleased

    private void jButton3ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton3ActionPerformed
        try {
            // pegando o nome da tabela que index e 1
            Object r = tabela.getValueAt(tabela.getSelectedRow(), 1);
            //pegando o id da tabela que index e 0
            Object id = tabela.getValueAt(tabela.getSelectedRow(), 0);
            //pegando model da tabela    
            DefaultTableModel tb = (DefaultTableModel) tabela.getModel();

            // verifica se relmente deseja deleta
            int com = JOptionPane.showConfirmDialog(rootPane, "Realmente que deletar o Produto " + r);
            if (com == 0) {
                // executando a operação de deleta
                retona = pr.deletaProduto((int) id);
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
                new telas.editar.EditarProdutor((int) id).setVisible(true);
            } catch (SQLException ex) {
                Logger.getLogger(cosultarProduto.class.getName()).log(Level.SEVERE, null, ex);
            }
            this.dispose();
        } catch (Exception e) {
        }

    }//GEN-LAST:event_jButton2ActionPerformed

    private void jButton1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton1ActionPerformed
        try {
            new castrarProdutor().setVisible(true);
        } catch (SQLException ex) {
            Logger.getLogger(cosultarProduto.class.getName()).log(Level.SEVERE, null, ex);
        }
        this.dispose();
    }//GEN-LAST:event_jButton1ActionPerformed

    public void carregarTebela(String consultar, int op) throws SQLException {
        String resvistaNome;
        // removendo todos os contudo da tabela
        tabela.removeAll();
        // operação a ser realizada
        switch (op) {
            case 1:
                // carregando todos os clientes
                res = pr.selecionaTodosProdutos();
                break;
            // consultando um cliente por nome ou id   
            case 2:
                res = pr.consultar(consultar,1);

                break;

        }
        // pegando model da tabela
        DefaultTableModel tb = (DefaultTableModel) tabela.getModel();
        // removendo todas linhas da tabela setando o 0
        tb.setRowCount(0);

        // loop de repetição pegando infomações do banco dados 
        while (res.next()) {

            // pegando o nome da revista
            if (res.getInt("idRevista") == 0) {
                resvistaNome = "OUTRA";

            } else {
                revista.selecionaPorId(res.getInt("idRevista"));
                resvistaNome = revista.getNome();
            }

            // adicionando infomações do banco de dados nas linhas da tabela
            tb.addRow(
                    new Object[]{
                res.getInt("id"),
                res.getString("nome"),
                res.getString("codigo"),
                resvistaNome,
                res.getString("estoque"),
                res.getString("valor"),
                res.getString("tipo"),
                res.getString("dataDeCadastro")
            });
        }
    }

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
            java.util.logging.Logger.getLogger(cosultarProduto.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(cosultarProduto.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(cosultarProduto.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(cosultarProduto.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
    
                    new cosultarProduto().setVisible(true);

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
    private javax.swing.JTextField nome;
    private javax.swing.JTable tabela;
    // End of variables declaration//GEN-END:variables
}
