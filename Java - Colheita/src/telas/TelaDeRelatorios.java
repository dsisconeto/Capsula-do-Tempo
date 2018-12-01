/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package telas;

import classes.Venda;
import classes.cliente;
import classes.revista;
import java.awt.Image;
import java.awt.Toolkit;
import java.net.URL;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.table.DefaultTableModel;

public class TelaDeRelatorios extends javax.swing.JFrame {

    Venda venda;
    ResultSet res;
    revista revista;
    cliente cl;

    public TelaDeRelatorios() {
        initComponents();


       
       
        try {     
            cl = new cliente();
            revista = new revista();
              
        } catch (SQLException ex) {
            Logger.getLogger(TelaDeRelatorios.class.getName()).log(Level.SEVERE, null, ex);
        }
         venda = new Venda();
           carregarTabelas();
   
        try {
            URL res = this.getClass().getResource("/telas/res/icone_logo.png");
            Image icone = Toolkit.getDefaultToolkit().getImage(res);
            this.setIconImage(icone);
        } catch (Exception e) {
        }
      
    }

    public void carregarTabelas() {
        /// pegando dados de todas vendas
        res = venda.selecionarTudo();

        // pegando model da tabela
        DefaultTableModel tb = (DefaultTableModel) tabela.getModel();
        // removendo todas linhas da tabela setando o 0
        tb.setRowCount(0);


        try {
            while (res.next()) {
             //   pegando o nome da revista
                revista.selecionaPorId(res.getInt("idrevista"));
                // pegando o nome do cliente 
                cl.selecionaPorId(res.getInt("idcliente"));
                tb.addRow(new Object[]{
                   res.getInt("id"),
                    revista.getNome(),
                   cl.getNome()
                        
                   
                });


            }



        } catch (SQLException ex) {
            Logger.getLogger(TelaDeRelatorios.class.getName()).log(Level.SEVERE, null, ex);
        }


    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jLabel7 = new javax.swing.JLabel();
        jButton1 = new javax.swing.JButton();
        jScrollPane1 = new javax.swing.JScrollPane();
        tabela = new javax.swing.JTable();
        jComboBox1 = new javax.swing.JComboBox();
        jLabel1 = new javax.swing.JLabel();
        jLabel9 = new javax.swing.JLabel();
        jComboBox5 = new javax.swing.JComboBox();
        jLabel10 = new javax.swing.JLabel();
        jComboBox2 = new javax.swing.JComboBox();
        jComboBox3 = new javax.swing.JComboBox();
        jLabel11 = new javax.swing.JLabel();
        jTextField1 = new javax.swing.JTextField();
        jTextField5 = new javax.swing.JTextField();
        bg = new javax.swing.JLabel();

        setDefaultCloseOperation(javax.swing.WindowConstants.DISPOSE_ON_CLOSE);
        setTitle("Colheita - Cadastrar Revista");
        setAlwaysOnTop(true);
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

        jButton1.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/btn/accept.png"))); // NOI18N
        jButton1.setText("OK");
        jButton1.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        getContentPane().add(jButton1);
        jButton1.setBounds(740, 180, 150, 40);

        tabela.setAutoCreateRowSorter(true);
        tabela.setModel(new javax.swing.table.DefaultTableModel(
            new Object [][] {

            },
            new String [] {
                "ID:", "REVISTA:", "CLIENTE:", "PRODUTO:", "VALOR DA VENDA:", "TIPO DE PAGAMENTO:"
            }
        ));
        tabela.setOpaque(false);
        tabela.setSelectionMode(javax.swing.ListSelectionModel.SINGLE_SELECTION);
        tabela.setUpdateSelectionOnSort(false);
        jScrollPane1.setViewportView(tabela);

        getContentPane().add(jScrollPane1);
        jScrollPane1.setBounds(0, 240, 1200, 360);

        jComboBox1.setModel(new javax.swing.DefaultComboBoxModel(new String[] { "Item 1", "Item 2", "Item 3", "Item 4" }));
        getContentPane().add(jComboBox1);
        jComboBox1.setBounds(380, 180, 140, 40);

        jLabel1.setText("Por Empresa:");
        getContentPane().add(jLabel1);
        jLabel1.setBounds(60, 160, 130, 14);

        jLabel9.setText("Por Cliente:");
        getContentPane().add(jLabel9);
        jLabel9.setBounds(380, 160, 90, 14);

        jComboBox5.setModel(new javax.swing.DefaultComboBoxModel(new String[] { "Item 1", "Item 2", "Item 3", "Item 4" }));
        getContentPane().add(jComboBox5);
        jComboBox5.setBounds(60, 180, 140, 40);

        jLabel10.setText("Por Revista:");
        getContentPane().add(jLabel10);
        jLabel10.setBounds(230, 160, 59, 14);

        jComboBox2.setModel(new javax.swing.DefaultComboBoxModel(new String[] { "Item 1", "Item 2", "Item 3", "Item 4" }));
        getContentPane().add(jComboBox2);
        jComboBox2.setBounds(230, 180, 140, 40);

        jComboBox3.setModel(new javax.swing.DefaultComboBoxModel(new String[] { "Item 1", "Item 2", "Item 3", "Item 4" }));
        getContentPane().add(jComboBox3);
        jComboBox3.setBounds(230, 180, 140, 40);

        jLabel11.setText("Por Intervalor de Datas:");
        getContentPane().add(jLabel11);
        jLabel11.setBounds(540, 160, 220, 14);

        try{javax.swing.text.MaskFormatter maks = new javax.swing.text.MaskFormatter("##/##/##");
            jTextField1  = new javax.swing.JFormattedTextField(maks);
        }catch(Exception e){}
        getContentPane().add(jTextField1);
        jTextField1.setBounds(530, 180, 90, 40);

        try{javax.swing.text.MaskFormatter maks = new javax.swing.text.MaskFormatter("##/##/##");
            jTextField5  = new javax.swing.JFormattedTextField(maks);
        }catch(Exception e){}
        getContentPane().add(jTextField5);
        jTextField5.setBounds(630, 180, 90, 40);

        bg.setDisplayedMnemonic('C');
        bg.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/bg_padrao_1.png"))); // NOI18N
        getContentPane().add(bg);
        bg.setBounds(0, 0, 1250, 600);

        setSize(new java.awt.Dimension(1212, 622));
        setLocationRelativeTo(null);
    }// </editor-fold>//GEN-END:initComponents

    private void jLabel7MouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_jLabel7MouseClicked
        new TelaInicial().setVisible(true);
        this.dispose();
    }//GEN-LAST:event_jLabel7MouseClicked

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
            java.util.logging.Logger.getLogger(TelaDeRelatorios.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(TelaDeRelatorios.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(TelaDeRelatorios.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(TelaDeRelatorios.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new TelaDeRelatorios().setVisible(true);
            }
        });
    }
    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JLabel bg;
    private javax.swing.JButton jButton1;
    private javax.swing.JComboBox jComboBox1;
    private javax.swing.JComboBox jComboBox2;
    private javax.swing.JComboBox jComboBox3;
    private javax.swing.JComboBox jComboBox5;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel10;
    private javax.swing.JLabel jLabel11;
    private javax.swing.JLabel jLabel7;
    private javax.swing.JLabel jLabel9;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JTextField jTextField1;
    private javax.swing.JTextField jTextField5;
    private javax.swing.JTable tabela;
    // End of variables declaration//GEN-END:variables
}
