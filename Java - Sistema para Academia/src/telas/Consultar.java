/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package telas;

import classes.cliente;
import classes.exame;
import classes.matricula;

import java.awt.Image;
import java.awt.Toolkit;
import java.net.URL;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JOptionPane;
import javax.swing.table.DefaultTableModel;

/**
 * @author dejair
 */
public class Consultar extends javax.swing.JFrame {

    cliente cl;
    matricula mt;
    exame exa;

    /**
     * Creates new form Consultar
     */
    public Consultar() throws SQLException {
        initComponents();
        setLocationRelativeTo(null);
        cl = new cliente();
        mt = new matricula();
        exa = new exame();
        try {
            mt.VerificarDataMatricula();
            mt.VerificarDataPagamento();
        } catch (Exception e) {
            String message = e.getMessage();
            System.out.println(message);
        }
        URL url = this.getClass().getResource("/telas/res/icon.png");
        Image iconeTitulo = Toolkit.getDefaultToolkit().getImage(url);
        this.setIconImage(iconeTitulo);

    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jPanel1 = new javax.swing.JPanel();
        jLabel1 = new javax.swing.JLabel();
        jButton1 = new javax.swing.JButton();
        jButton6 = new javax.swing.JButton();
        jScrollPane1 = new javax.swing.JScrollPane();
        tabela = new javax.swing.JTable();
        btnEditar = new javax.swing.JButton();
        jButton3 = new javax.swing.JButton();
        jButton4 = new javax.swing.JButton();
        BtnPagamentoAtrasado = new javax.swing.JButton();
        nome = new javax.swing.JTextField();
        btnMatriculaVencida = new javax.swing.JButton();

        setDefaultCloseOperation(javax.swing.WindowConstants.DISPOSE_ON_CLOSE);
        setTitle("MUSK - Consultar");
        setAlwaysOnTop(true);
        setLocationByPlatform(true);
        setResizable(false);
        setType(java.awt.Window.Type.UTILITY);

        jPanel1.setBackground(new java.awt.Color(19, 153, 237));

        jLabel1.setFont(new java.awt.Font("Ubuntu", 0, 48)); // NOI18N
        jLabel1.setForeground(new java.awt.Color(246, 246, 246));
        jLabel1.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/48x48/user_search.png"))); // NOI18N
        jLabel1.setText("Consultar");

        jButton1.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/48x48/computer.png"))); // NOI18N
        jButton1.setText("Inicio");
        jButton1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton1ActionPerformed(evt);
            }
        });

        jButton6.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/48x48/computer_delete.png"))); // NOI18N
        jButton6.setText("Sair");
        jButton6.setFocusable(false);
        jButton6.setHorizontalTextPosition(javax.swing.SwingConstants.CENTER);
        jButton6.setVerticalTextPosition(javax.swing.SwingConstants.BOTTOM);
        jButton6.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton6ActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout jPanel1Layout = new javax.swing.GroupLayout(jPanel1);
        jPanel1.setLayout(jPanel1Layout);
        jPanel1Layout.setHorizontalGroup(
                jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                        .addGroup(jPanel1Layout.createSequentialGroup()
                                .addContainerGap()
                                .addComponent(jLabel1, javax.swing.GroupLayout.PREFERRED_SIZE, 393, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                                .addComponent(jButton1)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                .addComponent(jButton6, javax.swing.GroupLayout.PREFERRED_SIZE, 81, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addContainerGap())
        );
        jPanel1Layout.setVerticalGroup(
                jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                        .addGroup(jPanel1Layout.createSequentialGroup()
                                .addContainerGap()
                                .addComponent(jLabel1)
                                .addContainerGap(15, Short.MAX_VALUE))
                        .addComponent(jButton6, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                        .addComponent(jButton1, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
        );

        tabela.setFont(new java.awt.Font("Ubuntu", 0, 16)); // NOI18N
        tabela.setModel(new javax.swing.table.DefaultTableModel(
                new Object[][]{

                },
                new String[]{
                        "Id", "Nome", "Vencimento da Matricula", "Data do Pagamento", "Valor do Pagamento", "Status da matricula", "Status do Pagamento", "Pagamento"
                }
        ) {
            boolean[] canEdit = new boolean[]{
                    false, false, false, false, false, false, false, false
            };

            public boolean isCellEditable(int rowIndex, int columnIndex) {
                return canEdit[columnIndex];
            }
        });
        tabela.setColumnSelectionAllowed(true);
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
        tabela.getColumnModel().getSelectionModel().setSelectionMode(javax.swing.ListSelectionModel.SINGLE_SELECTION);

        btnEditar.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/24x24/user_edit.png"))); // NOI18N
        btnEditar.setText("Editar");
        btnEditar.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnEditarActionPerformed(evt);
            }
        });

        jButton3.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/24x24/user_unlock.png"))); // NOI18N
        jButton3.setText("Pagamento");
        jButton3.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton3ActionPerformed(evt);
            }
        });

        jButton4.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/24x24/user_delete.png"))); // NOI18N
        jButton4.setText("Deletar");
        jButton4.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton4ActionPerformed(evt);
            }
        });

        BtnPagamentoAtrasado.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/24x24/dollar_gold.png"))); // NOI18N
        BtnPagamentoAtrasado.setText("Pagamento Atrasado");
        BtnPagamentoAtrasado.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                BtnPagamentoAtrasadoActionPerformed(evt);
            }
        });

        nome.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                nomeActionPerformed(evt);
            }
        });
        nome.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyPressed(java.awt.event.KeyEvent evt) {
                nomeKeyPressed(evt);
            }
        });

        btnMatriculaVencida.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/24x24/user_lock.png"))); // NOI18N
        btnMatriculaVencida.setText("Matriculas Vencidas");
        btnMatriculaVencida.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnMatriculaVencidaActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
                layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                        .addComponent(jPanel1, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                        .addGroup(layout.createSequentialGroup()
                                .addContainerGap()
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                        .addGroup(layout.createSequentialGroup()
                                                .addComponent(jScrollPane1)
                                                .addContainerGap())
                                        .addGroup(layout.createSequentialGroup()
                                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                                        .addComponent(nome, javax.swing.GroupLayout.PREFERRED_SIZE, 526, javax.swing.GroupLayout.PREFERRED_SIZE)
                                                        .addGroup(layout.createSequentialGroup()
                                                                .addComponent(btnEditar)
                                                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                                                .addComponent(jButton4)
                                                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                                                .addComponent(jButton3)
                                                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                                                .addComponent(BtnPagamentoAtrasado)
                                                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                                                .addComponent(btnMatriculaVencida)))
                                                .addGap(0, 324, Short.MAX_VALUE))))
        );
        layout.setVerticalGroup(
                layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                        .addGroup(layout.createSequentialGroup()
                                .addComponent(jPanel1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                .addComponent(nome, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                                        .addComponent(btnEditar)
                                        .addComponent(jButton3, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                                        .addComponent(jButton4, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                                        .addComponent(BtnPagamentoAtrasado, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                                        .addComponent(btnMatriculaVencida))
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                                .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 437, javax.swing.GroupLayout.PREFERRED_SIZE))
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void btnEditarActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnEditarActionPerformed

        int id;
        Object te = null;
        DefaultTableModel tb;
        int retona = 1;
        try {
            Object r = tabela.getValueAt(tabela.getSelectedRow(), 1);
            tb = (DefaultTableModel) tabela.getModel();
            te = tabela.getValueAt(tabela.getSelectedRow(), 0);
        } catch (Exception e) {
        }

        try {

            id = (int) te;
            new Editar(id).setVisible(true);
            this.dispose();


        } catch (SQLException ex) {
            JOptionPane.showMessageDialog(rootPane, "Não é possivil editar");
        }

    }//GEN-LAST:event_btnEditarActionPerformed

    private void jButton3ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton3ActionPerformed
        try {
            int id;
            Object te = null;
            DefaultTableModel tb;
            int retona = 1;
            try {
                Object r = tabela.getValueAt(tabela.getSelectedRow(), 1);
                tb = (DefaultTableModel) tabela.getModel();
                te = tabela.getValueAt(tabela.getSelectedRow(), 0);


            } catch (Exception e) {
            }


            id = (int) te;
            mt.VereficarQualTipoDePagamento(id);
            this.dispose();
        } catch (SQLException ex) {
            Logger.getLogger(Consultar.class.getName()).log(Level.SEVERE, null, ex);
        }


    }//GEN-LAST:event_jButton3ActionPerformed

    private void jButton1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton1ActionPerformed
        new TelaPrincipal().setVisible(true);
        this.dispose();
    }//GEN-LAST:event_jButton1ActionPerformed

    private void jButton6ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton6ActionPerformed
        System.exit(0);
    }//GEN-LAST:event_jButton6ActionPerformed

    private void tabelaAncestorAdded(javax.swing.event.AncestorEvent evt) {//GEN-FIRST:event_tabelaAncestorAdded

        try {

            ResultSet res = cl.selecionaTodosClintes();
            DefaultTableModel tb = (DefaultTableModel) tabela.getModel();

            while (res.next()) {

                mt.selecionaPeloCliente(res.getInt("id"));
                tb.addRow(new Object[]{res.getInt("id"), res.getString("nome"),
                        mt.getDataDoVencimento(), mt.getDataDoPagamento(),
                        mt.getValorDoPagamento(), mt.converteStatus(mt.getStatusDaMatricula()),
                        mt.converteStatus(mt.getStatusDaPagamento()),
                        mt.convertePagagamento(mt.getPagamento())});

            }

        } catch (SQLException ex) {
            System.out.println("_FATAL_ERROR_Added");
        }

    }//GEN-LAST:event_tabelaAncestorAdded

    private void nomeKeyPressed(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_nomeKeyPressed
        tabela.removeAll();
        try {

            ResultSet res = cl.consultar(nome.getText());
            DefaultTableModel tb = (DefaultTableModel) tabela.getModel();

            tb.setNumRows(0);
            while (res.next()) {

                mt.selecionaPeloCliente(res.getInt("id"));
                tb.addRow(new Object[]{res.getInt("id"), res.getString("nome"),
                        mt.getDataDoVencimento(), mt.getDataDoPagamento(),
                        mt.getValorDoPagamento(), mt.converteStatus(mt.getStatusDaMatricula()),
                        mt.converteStatus(mt.getStatusDaPagamento()),
                        mt.convertePagagamento(mt.getPagamento())});

            }

        } catch (SQLException ex) {
            System.out.println("_FATAL_ERROR_nomeKeyPressed");
        }


    }//GEN-LAST:event_nomeKeyPressed

    private void nomeActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_nomeActionPerformed
        // TODO add your handling code here:

    }//GEN-LAST:event_nomeActionPerformed

    private void jButton4ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton4ActionPerformed
        try {
            int retona = 1;
            Object r = tabela.getValueAt(tabela.getSelectedRow(), 1);
            DefaultTableModel tb = (DefaultTableModel) tabela.getModel();
            int com = JOptionPane.showConfirmDialog(rootPane, "Realmente que deletar o Cliente " + r);
            if (com == 0) {

                Object te = tabela.getValueAt(tabela.getSelectedRow(), 0);

                retona = cl.deletaCliente((int) te);
                retona = exa.deleta((int) te);
                retona = mt.deleta((int) te);

                if (retona == 1) {
                    tb.removeRow(tabela.getSelectedRow());
                    JOptionPane.showMessageDialog(rootPane, r);


                } else {
                    JOptionPane.showMessageDialog(null, "Erro ao deletar contate o suporte!");
                }

            }
        } catch (Exception e) {
        }
    }//GEN-LAST:event_jButton4ActionPerformed

    private void BtnPagamentoAtrasadoActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_BtnPagamentoAtrasadoActionPerformed
        tabela.removeAll();
        try {

            ResultSet res = cl.consultar(nome.getText());
            DefaultTableModel tb = (DefaultTableModel) tabela.getModel();
            tb.setNumRows(0);
            while (res.next()) {

                mt.selecionaPeloCliente(res.getInt("id"));
                System.out.print(mt.getStatusDaPagamento());
                if (mt.getStatusDaPagamento() == 2) {
                    tb.addRow(new Object[]{res.getInt("id"), res.getString("nome"),
                            mt.getDataDoVencimento(), mt.getDataDoPagamento(),
                            mt.getValorDoPagamento(), mt.converteStatus(mt.getStatusDaMatricula()),
                            mt.converteStatus(mt.getStatusDaPagamento()),
                            mt.convertePagagamento(mt.getPagamento())});
                }
            }

        } catch (SQLException ex) {
            System.out.println("_FATAL_ERROR_nomeKeyPressed");
        }
    }//GEN-LAST:event_BtnPagamentoAtrasadoActionPerformed

    private void btnMatriculaVencidaActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnMatriculaVencidaActionPerformed
        tabela.removeAll();
        try {

            ResultSet res = cl.consultar(nome.getText());
            DefaultTableModel tb = (DefaultTableModel) tabela.getModel();
            tb.setNumRows(0);
            while (res.next()) {

                mt.selecionaPeloCliente(res.getInt("id"));
                System.out.print(mt.getStatusDaPagamento());
                if (mt.getStatusDaMatricula() == 2) {
                    tb.addRow(new Object[]{res.getInt("id"), res.getString("nome"),
                            mt.getDataDoVencimento(), mt.getDataDoPagamento(),
                            mt.getValorDoPagamento(), mt.converteStatus(mt.getStatusDaMatricula()),
                            mt.converteStatus(mt.getStatusDaPagamento()),
                            mt.convertePagagamento(mt.getPagamento())});
                }
            }

        } catch (SQLException ex) {
            System.out.println("_FATAL_ERROR_nomeKeyPressed");
        }
    }//GEN-LAST:event_btnMatriculaVencidaActionPerformed

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
            java.util.logging.Logger.getLogger(Consultar.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(Consultar.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(Consultar.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(Consultar.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                try {
                    new Consultar().setVisible(true);
                } catch (SQLException ex) {
                    Logger.getLogger(Consultar.class.getName()).log(Level.SEVERE, null, ex);
                }
            }
        });
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton BtnPagamentoAtrasado;
    private javax.swing.JButton btnEditar;
    private javax.swing.JButton btnMatriculaVencida;
    private javax.swing.JButton jButton1;
    private javax.swing.JButton jButton3;
    private javax.swing.JButton jButton4;
    private javax.swing.JButton jButton6;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JPanel jPanel1;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JTextField nome;
    private javax.swing.JTable tabela;
    // End of variables declaration//GEN-END:variables

    private void cliente() {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }
}
