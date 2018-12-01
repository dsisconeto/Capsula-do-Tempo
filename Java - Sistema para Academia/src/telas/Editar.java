/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package telas;

import academia.config;
import classes.*;
import java.awt.Image;
import java.awt.Toolkit;
import java.net.URL;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JOptionPane;

/**
 *
 * @author dejair
 */
public class Editar extends javax.swing.JFrame {

    private cliente cliente;
    private exame exa;
    private matricula mt;
    private int idClinte;

    public Editar(int id) throws SQLException {
        setIdClinte(id);
        cliente = new cliente();
        exa = new exame();
        initComponents();
        setLocationRelativeTo(null);
        URL url = this.getClass().getResource("/telas/res/icon.png");
        Image iconeTitulo = Toolkit.getDefaultToolkit().getImage(url);
        this.setIconImage(iconeTitulo);
        carregarCampos();
        System.out.println("iniciando tela de Editar");
    }

    public Editar() {
    }

    public void carregarCampos() throws SQLException {
        // carregando dados do cliente
        cliente.selecionaPotId(this.getIdClinte());
        nometxt.setText(cliente.getNome());
        enderecoTxt.setText(cliente.getEndereco());
        dataNascimentoTxt.setText(cliente.getDataNascimento());
        sexoCombo.addItem(cliente.getSexo());
        sexoCombo.addItem("M");
        sexoCombo.addItem("F");
        CPFTxt.setText(cliente.getCpf());
        rgTxt.setText(cliente.getRg());
        emailTxt.setText(cliente.getEmail());
        telefoneTXT.setText(cliente.getTelefone());
        obs.setText(cliente.getObs());

        //carregando dados do exame
        exa.selecionaPeloCliente(this.getIdClinte());
        pesoTxt.setText(String.valueOf(exa.getPeso()));
        AlturaTxt.setText(String.valueOf(exa.getAltura()));
        imcTxt.setText(String.valueOf(exa.getImc()));
        gluteoTxt.setText(String.valueOf(exa.getGluteo()));
        bracoDireitoTxt.setText(String.valueOf(exa.getBracoDireito()));
        BracoEsquerdoTxt.setText(String.valueOf(exa.getBracoEsquerdo()));
        AnteBracoDireitoTxt.setText(String.valueOf(exa.getAnteBracoDireito()));
        AntebracoEsquerdoTxt.setText(String.valueOf(exa.getAnteBracoEsquerdo()));
        coxaDireitaTxt.setText(String.valueOf(exa.getCoxaDireita()));
        coxaEsquerdaTxt.setText(String.valueOf(exa.getCoxaEsqueda()));
        panturrilhaDireitaTxt.setText(String.valueOf(exa.getPanturrilhaDireita()));
        panturrilhaEsquerdaTxt.setText(String.valueOf(exa.getPanturrilhaEsquerda()));
    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jPanel1 = new javax.swing.JPanel();
        jLabel1 = new javax.swing.JLabel();
        jButton2 = new javax.swing.JButton();
        jButton4 = new javax.swing.JButton();
        jPanel2 = new javax.swing.JPanel();
        nome = new javax.swing.JLabel();
        nascimento = new javax.swing.JLabel();
        jLabel2 = new javax.swing.JLabel();
        jLabel3 = new javax.swing.JLabel();
        jLabel4 = new javax.swing.JLabel();
        jLabel5 = new javax.swing.JLabel();
        nometxt = new javax.swing.JTextField();
        dataNascimentoTxt = new javax.swing.JTextField();
        try{
            javax.swing.text.MaskFormatter dataMask  = new javax.swing.text.MaskFormatter("##/##/##");
            dataNascimentoTxt = new javax.swing.JFormattedTextField(dataMask);

        }catch(Exception e){}
        sexoCombo = new javax.swing.JComboBox();
        enderecoTxt = new javax.swing.JTextField();
        telefoneTXT = new javax.swing.JTextField();
        emailTxt = new javax.swing.JTextField();
        jLabel26 = new javax.swing.JLabel();
        CPFTxt = new javax.swing.JTextField();
        jLabel27 = new javax.swing.JLabel();
        rgTxt = new javax.swing.JTextField();
        jPanel3 = new javax.swing.JPanel();
        pesoTxt = new javax.swing.JTextField();
        jLabel7 = new javax.swing.JLabel();
        jLabel8 = new javax.swing.JLabel();
        jLabel9 = new javax.swing.JLabel();
        jLabel10 = new javax.swing.JLabel();
        jLabel11 = new javax.swing.JLabel();
        jLabel12 = new javax.swing.JLabel();
        jLabel13 = new javax.swing.JLabel();
        jLabel14 = new javax.swing.JLabel();
        jLabel15 = new javax.swing.JLabel();
        jLabel16 = new javax.swing.JLabel();
        jLabel17 = new javax.swing.JLabel();
        jLabel18 = new javax.swing.JLabel();
        jLabel20 = new javax.swing.JLabel();
        AlturaTxt = new javax.swing.JTextField();
        cinturaTxt = new javax.swing.JTextField();
        BracoEsquerdoTxt = new javax.swing.JTextField();
        bracoDireitoTxt = new javax.swing.JTextField();
        AntebracoEsquerdoTxt = new javax.swing.JTextField();
        coxaEsquerdaTxt = new javax.swing.JTextField();
        gluteoTxt = new javax.swing.JTextField();
        AnteBracoDireitoTxt = new javax.swing.JTextField();
        panturrilhaDireitaTxt = new javax.swing.JTextField();
        coxaDireitaTxt = new javax.swing.JTextField();
        panturrilhaEsquerdaTxt = new javax.swing.JTextField();
        imcTxt = new javax.swing.JTextField();
        jLabel19 = new javax.swing.JLabel();
        peitoTxt = new javax.swing.JTextField();
        jPanel4 = new javax.swing.JPanel();
        jLabel24 = new javax.swing.JLabel();
        jScrollPane1 = new javax.swing.JScrollPane();
        obs = new javax.swing.JTextPane();
        jLabel21 = new javax.swing.JLabel();
        jButton3 = new javax.swing.JButton();
        jButton1 = new javax.swing.JButton();

        setDefaultCloseOperation(javax.swing.WindowConstants.DISPOSE_ON_CLOSE);
        setTitle("MUSK - Editar");
        setFocusTraversalPolicyProvider(true);
        setResizable(false);
        addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyTyped(java.awt.event.KeyEvent evt) {
                formKeyTyped(evt);
            }
        });

        jPanel1.setBackground(new java.awt.Color(19, 153, 237));

        jLabel1.setFont(new java.awt.Font("Ubuntu", 0, 48)); // NOI18N
        jLabel1.setForeground(new java.awt.Color(244, 244, 244));
        jLabel1.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/48x48/user_add.png"))); // NOI18N
        jLabel1.setText("Editar");

        jButton2.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/48x48/computer.png"))); // NOI18N
        jButton2.setText("Inicio");
        jButton2.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton2ActionPerformed(evt);
            }
        });

        jButton4.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/48x48/computer_delete.png"))); // NOI18N
        jButton4.setText("Sair");
        jButton4.setFocusable(false);
        jButton4.setHorizontalTextPosition(javax.swing.SwingConstants.CENTER);
        jButton4.setVerticalTextPosition(javax.swing.SwingConstants.BOTTOM);
        jButton4.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton4ActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout jPanel1Layout = new javax.swing.GroupLayout(jPanel1);
        jPanel1.setLayout(jPanel1Layout);
        jPanel1Layout.setHorizontalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, jPanel1Layout.createSequentialGroup()
                .addContainerGap()
                .addComponent(jLabel1)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                .addComponent(jButton2)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(jButton4, javax.swing.GroupLayout.PREFERRED_SIZE, 81, javax.swing.GroupLayout.PREFERRED_SIZE))
        );
        jPanel1Layout.setVerticalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel1Layout.createSequentialGroup()
                .addContainerGap()
                .addComponent(jLabel1)
                .addContainerGap(26, Short.MAX_VALUE))
            .addComponent(jButton4, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
            .addComponent(jButton2, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
        );

        jPanel2.setBorder(javax.swing.BorderFactory.createTitledBorder(javax.swing.BorderFactory.createTitledBorder("Básico")));

        nome.setText("Nome*");

        nascimento.setText("Data de Nascimento*");

        jLabel2.setText("Endereço:");

        jLabel3.setText("Telefone:");

        jLabel4.setText("Email:");

        jLabel5.setText("Sexo:");

        nometxt.setVerifyInputWhenFocusTarget(false);
        nometxt.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                nometxtActionPerformed(evt);
            }
        });

        sexoCombo.setToolTipText("");

        try{
            javax.swing.text.MaskFormatter mask = new javax.swing.text.MaskFormatter("(##)####-####");
            telefoneTXT = new javax.swing.JFormattedTextField(mask);
        }catch(Exception e){}

        jLabel26.setText("CPF:");

        try{
            javax.swing.text.MaskFormatter Mask = new javax.swing.text.MaskFormatter("###########");
            CPFTxt = new javax.swing.JFormattedTextField(Mask);
        }catch(Exception e){}

        jLabel27.setText("RG:");

        rgTxt.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                rgTxtFocusLost(evt);
            }
        });

        javax.swing.GroupLayout jPanel2Layout = new javax.swing.GroupLayout(jPanel2);
        jPanel2.setLayout(jPanel2Layout);
        jPanel2Layout.setHorizontalGroup(
            jPanel2Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, jPanel2Layout.createSequentialGroup()
                .addContainerGap()
                .addGroup(jPanel2Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(jLabel2)
                    .addComponent(jLabel3)
                    .addComponent(nome, javax.swing.GroupLayout.Alignment.TRAILING))
                .addGroup(jPanel2Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(jPanel2Layout.createSequentialGroup()
                        .addGap(13, 13, 13)
                        .addComponent(telefoneTXT, javax.swing.GroupLayout.PREFERRED_SIZE, 116, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addGap(4, 4, 4)
                        .addComponent(jLabel4)
                        .addGap(18, 18, 18)
                        .addComponent(emailTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 360, javax.swing.GroupLayout.PREFERRED_SIZE))
                    .addGroup(jPanel2Layout.createSequentialGroup()
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addGroup(jPanel2Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                            .addComponent(enderecoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 366, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addComponent(nometxt, javax.swing.GroupLayout.Alignment.LEADING, javax.swing.GroupLayout.PREFERRED_SIZE, 366, javax.swing.GroupLayout.PREFERRED_SIZE))
                        .addGap(18, 18, 18)
                        .addGroup(jPanel2Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                            .addComponent(nascimento)
                            .addGroup(jPanel2Layout.createSequentialGroup()
                                .addComponent(jLabel26)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                .addComponent(CPFTxt)))))
                .addGroup(jPanel2Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(jPanel2Layout.createSequentialGroup()
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                        .addComponent(dataNascimentoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 116, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addComponent(jLabel5)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addComponent(sexoCombo, javax.swing.GroupLayout.PREFERRED_SIZE, 110, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addGap(427, 427, 427))
                    .addGroup(jPanel2Layout.createSequentialGroup()
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addComponent(jLabel27)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addComponent(rgTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 87, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addContainerGap(javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))))
        );
        jPanel2Layout.setVerticalGroup(
            jPanel2Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel2Layout.createSequentialGroup()
                .addContainerGap()
                .addGroup(jPanel2Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(nometxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addGroup(jPanel2Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                        .addComponent(dataNascimentoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addComponent(jLabel5)
                        .addComponent(sexoCombo, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addComponent(nome)
                        .addComponent(nascimento)))
                .addGap(13, 13, 13)
                .addGroup(jPanel2Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(enderecoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel2, javax.swing.GroupLayout.PREFERRED_SIZE, 34, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel26)
                    .addComponent(CPFTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel27)
                    .addComponent(rgTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                .addGroup(jPanel2Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jLabel3)
                    .addComponent(telefoneTXT, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(emailTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel4))
                .addContainerGap(javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
        );

        jPanel3.setBorder(javax.swing.BorderFactory.createTitledBorder("Exame Físico"));

        pesoTxt.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                pesoTxtActionPerformed(evt);
            }
        });
        pesoTxt.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                pesoTxtFocusLost(evt);
            }
        });
        pesoTxt.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyPressed(java.awt.event.KeyEvent evt) {
                pesoTxtKeyPressed(evt);
            }
            public void keyReleased(java.awt.event.KeyEvent evt) {
                pesoTxtKeyReleased(evt);
            }
        });

        jLabel7.setText("Peso:");

        jLabel8.setText("Altura:");

        jLabel9.setText("Peito:");

        jLabel10.setText("IMC:");

        jLabel11.setText("Cintura:");

        jLabel12.setText("Braço Direito:");

        jLabel13.setText("Braço Esquerdo:");

        jLabel14.setText("Ante Braço Direito:");

        jLabel15.setText("Ante Braço Esquerdo:");

        jLabel16.setText("Coxa Esquerda:");

        jLabel17.setText("Panturrilha Esqueda:");

        jLabel18.setText("Coxa Direita:");

        jLabel20.setText("Panturrilha Direita:");

        AlturaTxt.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                AlturaTxtActionPerformed(evt);
            }
        });
        AlturaTxt.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                AlturaTxtFocusLost(evt);
            }
        });
        AlturaTxt.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyPressed(java.awt.event.KeyEvent evt) {
                AlturaTxtKeyPressed(evt);
            }
            public void keyReleased(java.awt.event.KeyEvent evt) {
                AlturaTxtKeyReleased(evt);
            }
        });

        cinturaTxt.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                cinturaTxtFocusLost(evt);
            }
        });

        bracoDireitoTxt.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                bracoDireitoTxtFocusLost(evt);
            }
        });

        AntebracoEsquerdoTxt.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                AntebracoEsquerdoTxtFocusLost(evt);
            }
        });

        coxaEsquerdaTxt.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                coxaEsquerdaTxtFocusLost(evt);
            }
        });

        gluteoTxt.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                gluteoTxtFocusLost(evt);
            }
        });

        AnteBracoDireitoTxt.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                AnteBracoDireitoTxtFocusLost(evt);
            }
        });

        panturrilhaDireitaTxt.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                panturrilhaDireitaTxtFocusLost(evt);
            }
        });

        coxaDireitaTxt.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                coxaDireitaTxtActionPerformed(evt);
            }
        });
        coxaDireitaTxt.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                coxaDireitaTxtFocusLost(evt);
            }
        });

        panturrilhaEsquerdaTxt.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                panturrilhaEsquerdaTxtFocusLost(evt);
            }
        });

        imcTxt.setFocusable(false);
        imcTxt.setName(""); // NOI18N

        jLabel19.setText("Gluteo:");

        peitoTxt.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                peitoTxtActionPerformed(evt);
            }
        });
        peitoTxt.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusLost(java.awt.event.FocusEvent evt) {
                peitoTxtFocusLost(evt);
            }
        });

        javax.swing.GroupLayout jPanel3Layout = new javax.swing.GroupLayout(jPanel3);
        jPanel3.setLayout(jPanel3Layout);
        jPanel3Layout.setHorizontalGroup(
            jPanel3Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel3Layout.createSequentialGroup()
                .addGroup(jPanel3Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, jPanel3Layout.createSequentialGroup()
                        .addGap(37, 37, 37)
                        .addGroup(jPanel3Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                            .addGroup(jPanel3Layout.createSequentialGroup()
                                .addComponent(jLabel7)
                                .addGap(18, 18, 18))
                            .addGroup(jPanel3Layout.createSequentialGroup()
                                .addComponent(jLabel12)
                                .addGap(26, 26, 26)))
                        .addGroup(jPanel3Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addGroup(jPanel3Layout.createSequentialGroup()
                                .addComponent(pesoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 64, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                .addComponent(jLabel8)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                .addComponent(AlturaTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 63, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                .addComponent(jLabel10)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                .addComponent(imcTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 63, javax.swing.GroupLayout.PREFERRED_SIZE))
                            .addGroup(jPanel3Layout.createSequentialGroup()
                                .addGroup(jPanel3Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                                    .addComponent(panturrilhaDireitaTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 63, javax.swing.GroupLayout.PREFERRED_SIZE)
                                    .addComponent(bracoDireitoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 63, javax.swing.GroupLayout.PREFERRED_SIZE))
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                .addGroup(jPanel3Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(jLabel17)
                                    .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, jPanel3Layout.createSequentialGroup()
                                        .addComponent(jLabel13)
                                        .addGap(6, 6, 6)))
                                .addGroup(jPanel3Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(BracoEsquerdoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 63, javax.swing.GroupLayout.PREFERRED_SIZE)
                                    .addComponent(panturrilhaEsquerdaTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 63, javax.swing.GroupLayout.PREFERRED_SIZE)))))
                    .addGroup(jPanel3Layout.createSequentialGroup()
                        .addContainerGap()
                        .addComponent(jLabel20)
                        .addGap(87, 87, 87)))
                .addGroup(jPanel3Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                    .addGroup(jPanel3Layout.createSequentialGroup()
                        .addGroup(jPanel3Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                            .addComponent(jLabel18)
                            .addComponent(jLabel14))
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addGroup(jPanel3Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                            .addGroup(jPanel3Layout.createSequentialGroup()
                                .addComponent(coxaDireitaTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 63, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                                .addComponent(jLabel16))
                            .addGroup(jPanel3Layout.createSequentialGroup()
                                .addComponent(AnteBracoDireitoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 63, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                .addComponent(jLabel15))))
                    .addGroup(jPanel3Layout.createSequentialGroup()
                        .addGap(24, 24, 24)
                        .addComponent(jLabel9)
                        .addGap(18, 18, 18)
                        .addComponent(peitoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 63, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                        .addComponent(jLabel11)
                        .addGap(18, 18, 18)
                        .addComponent(cinturaTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 63, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addComponent(jLabel19)))
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addGroup(jPanel3Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(gluteoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 63, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(AntebracoEsquerdoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 63, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(coxaEsquerdaTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 63, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addContainerGap(62, Short.MAX_VALUE))
        );
        jPanel3Layout.setVerticalGroup(
            jPanel3Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel3Layout.createSequentialGroup()
                .addGroup(jPanel3Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(pesoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel7)
                    .addComponent(jLabel10)
                    .addComponent(jLabel9)
                    .addComponent(cinturaTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel11)
                    .addComponent(gluteoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel19)
                    .addComponent(peitoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(AlturaTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel8)
                    .addComponent(imcTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(18, 18, 18)
                .addGroup(jPanel3Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jLabel12)
                    .addComponent(bracoDireitoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel13)
                    .addComponent(BracoEsquerdoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel14)
                    .addComponent(AnteBracoDireitoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel15)
                    .addComponent(AntebracoEsquerdoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(20, 20, 20)
                .addGroup(jPanel3Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(panturrilhaDireitaTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(panturrilhaEsquerdaTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel20)
                    .addComponent(jLabel17)
                    .addComponent(jLabel18)
                    .addComponent(coxaDireitaTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel16)
                    .addComponent(coxaEsquerdaTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addContainerGap(javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
        );

        jPanel4.setBorder(javax.swing.BorderFactory.createTitledBorder("Final"));

        jScrollPane1.setViewportView(obs);

        jLabel21.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/imc.jpg"))); // NOI18N

        jButton3.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/24x24/delete.png"))); // NOI18N
        jButton3.setText("Cancelar");
        jButton3.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton3ActionPerformed(evt);
            }
        });

        jButton1.setIcon(new javax.swing.ImageIcon(getClass().getResource("/telas/res/24x24/user_edit.png"))); // NOI18N
        jButton1.setText("Editar");
        jButton1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton1ActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout jPanel4Layout = new javax.swing.GroupLayout(jPanel4);
        jPanel4.setLayout(jPanel4Layout);
        jPanel4Layout.setHorizontalGroup(
            jPanel4Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel4Layout.createSequentialGroup()
                .addGroup(jPanel4Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(jPanel4Layout.createSequentialGroup()
                        .addGap(302, 302, 302)
                        .addComponent(jLabel24))
                    .addGroup(jPanel4Layout.createSequentialGroup()
                        .addComponent(jLabel21, javax.swing.GroupLayout.PREFERRED_SIZE, 329, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                        .addGroup(jPanel4Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                            .addComponent(jScrollPane1, javax.swing.GroupLayout.Alignment.LEADING)
                            .addGroup(jPanel4Layout.createSequentialGroup()
                                .addGap(0, 426, Short.MAX_VALUE)
                                .addComponent(jButton3)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                                .addComponent(jButton1)))))
                .addContainerGap(44, Short.MAX_VALUE))
        );
        jPanel4Layout.setVerticalGroup(
            jPanel4Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel4Layout.createSequentialGroup()
                .addGroup(jPanel4Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(jPanel4Layout.createSequentialGroup()
                        .addComponent(jLabel21, javax.swing.GroupLayout.PREFERRED_SIZE, 238, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addGap(39, 39, 39)
                        .addComponent(jLabel24))
                    .addGroup(jPanel4Layout.createSequentialGroup()
                        .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 202, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addGap(21, 21, 21)
                        .addGroup(jPanel4Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                            .addComponent(jButton1)
                            .addComponent(jButton3))))
                .addContainerGap(16, Short.MAX_VALUE))
        );

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addComponent(jPanel1, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
            .addComponent(jPanel2, javax.swing.GroupLayout.Alignment.TRAILING, javax.swing.GroupLayout.PREFERRED_SIZE, 1016, Short.MAX_VALUE)
            .addComponent(jPanel3, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
            .addComponent(jPanel4, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addComponent(jPanel1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                .addComponent(jPanel2, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(jPanel3, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(jPanel4, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void jButton2ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton2ActionPerformed
        new TelaPrincipal().setVisible(true);
        this.dispose();
    }//GEN-LAST:event_jButton2ActionPerformed

    private void coxaDireitaTxtActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_coxaDireitaTxtActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_coxaDireitaTxtActionPerformed

    private void jButton4ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton4ActionPerformed
        System.exit(0);
    }//GEN-LAST:event_jButton4ActionPerformed

    private void jButton3ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton3ActionPerformed
        new TelaPrincipal().setVisible(true);
        this.dispose();

    }//GEN-LAST:event_jButton3ActionPerformed

    private void jButton1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton1ActionPerformed
        System.out.println("Click no btn Editar");

        int retona = 1;

        if (!"".equals(nometxt.getText()) && !"".equals(dataNascimentoTxt.getText())) {



          retona =  cliente.editarCliente(this.getIdClinte(),nometxt.getText(), CPFTxt.getText(), rgTxt.getText(), dataNascimentoTxt.getText(),
                    enderecoTxt.getText(), telefoneTXT.getText(), emailTxt.getText(),
                    (String) sexoCombo.getModel().getSelectedItem(), obs.getText());

                                config.converteCampos(pesoTxt);
                                config.converteCampos(AlturaTxt);
                                config.converteCampos(imcTxt);
                                config.converteCampos(cinturaTxt);
                                config.converteCampos(gluteoTxt);
                                config.converteCampos(bracoDireitoTxt);
                                config.converteCampos(BracoEsquerdoTxt);
                                config.converteCampos(AnteBracoDireitoTxt); 
                                config.converteCampos(AntebracoEsquerdoTxt);
                                config.converteCampos(coxaDireitaTxt);
                                config.converteCampos(coxaEsquerdaTxt);
                                config.converteCampos(panturrilhaDireitaTxt);
                                config.converteCampos(panturrilhaEsquerdaTxt);
           if(retona == 1){
            exa.Editar(this.getIdClinte(), pesoTxt.getText(), AlturaTxt.getText(), imcTxt.getText(),
                    cinturaTxt.getText(), gluteoTxt.getText(),
                    bracoDireitoTxt.getText(), BracoEsquerdoTxt.getText(),
                    AnteBracoDireitoTxt.getText(), AntebracoEsquerdoTxt.getText(),
                    coxaDireitaTxt.getText(), coxaEsquerdaTxt.getText(),
                    panturrilhaDireitaTxt.getText(), panturrilhaEsquerdaTxt.getText());


           }





            if (retona == 1) {
                JOptionPane.showMessageDialog(null, "Cliente Editado com sucesso!");
              try {
                  new Consultar().setVisible(true);
              } catch (SQLException ex) {
                  Logger.getLogger(Editar.class.getName()).log(Level.SEVERE, null, ex);
              }
                this.dispose();

            } else {
                JOptionPane.showMessageDialog(null, "Não foi possível Editar o cliente!\n"
                        + "Tente novamente mais tarde!\n"
                        + "Se o problema persistir contate o suporte While - Hard and System");
            }


        } else {
            System.out.println("Algum campos obrigatorios estão faltando");
            JOptionPane.showMessageDialog(null, "Algum campos obrigatorios estão faltando");
        }




    }//GEN-LAST:event_jButton1ActionPerformed

    private void AlturaTxtKeyPressed(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_AlturaTxtKeyPressed

        try {
            if (!"".equals(pesoTxt.getText()) && !"".equals(AlturaTxt.getText())) {

                imcTxt.setText(exa.imcSoma(pesoTxt.getText(), AlturaTxt.getText()));

                obs.setText(nometxt.getText() + " Você esta com " + exa.getImcMsg());


            }
        } catch (Exception e) {
        }
    }//GEN-LAST:event_AlturaTxtKeyPressed

    private void AlturaTxtActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_AlturaTxtActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_AlturaTxtActionPerformed

    private void formKeyTyped(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_formKeyTyped
    }//GEN-LAST:event_formKeyTyped

    private void pesoTxtKeyPressed(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_pesoTxtKeyPressed

        try {
            if (!"".equals(pesoTxt.getText()) && !"".equals(AlturaTxt.getText())) {

                imcTxt.setText(exa.imcSoma(pesoTxt.getText(), AlturaTxt.getText()));

                obs.setText(nometxt.getText() + " Você esta com " + exa.getImcMsg());

            }
        } catch (Exception e) {
        }
    }//GEN-LAST:event_pesoTxtKeyPressed

    private void pesoTxtActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_pesoTxtActionPerformed
    }//GEN-LAST:event_pesoTxtActionPerformed

    private void nometxtActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_nometxtActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_nometxtActionPerformed

    private void pesoTxtKeyReleased(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_pesoTxtKeyReleased
        pesoTxt.setText(pesoTxt.getText().replace(",", "."));



    }//GEN-LAST:event_pesoTxtKeyReleased

    private void pesoTxtFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_pesoTxtFocusLost
        config.converteCampos(pesoTxt);
    }//GEN-LAST:event_pesoTxtFocusLost

    private void AlturaTxtFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_AlturaTxtFocusLost
        config.converteCampos(AlturaTxt);
    }//GEN-LAST:event_AlturaTxtFocusLost

    private void peitoTxtActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_peitoTxtActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_peitoTxtActionPerformed

    private void peitoTxtFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_peitoTxtFocusLost
        config.converteCampos(peitoTxt);
    }//GEN-LAST:event_peitoTxtFocusLost

    private void cinturaTxtFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_cinturaTxtFocusLost
        config.converteCampos(cinturaTxt);
    }//GEN-LAST:event_cinturaTxtFocusLost

    private void gluteoTxtFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_gluteoTxtFocusLost
        config.converteCampos(gluteoTxt);
    }//GEN-LAST:event_gluteoTxtFocusLost

    private void bracoDireitoTxtFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_bracoDireitoTxtFocusLost
        config.converteCampos(bracoDireitoTxt);
    }//GEN-LAST:event_bracoDireitoTxtFocusLost

    private void AnteBracoDireitoTxtFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_AnteBracoDireitoTxtFocusLost
        config.converteCampos(AnteBracoDireitoTxt);
    }//GEN-LAST:event_AnteBracoDireitoTxtFocusLost

    private void AntebracoEsquerdoTxtFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_AntebracoEsquerdoTxtFocusLost
        config.converteCampos(AntebracoEsquerdoTxt);
    }//GEN-LAST:event_AntebracoEsquerdoTxtFocusLost

    private void panturrilhaDireitaTxtFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_panturrilhaDireitaTxtFocusLost
        config.converteCampos(panturrilhaDireitaTxt);
    }//GEN-LAST:event_panturrilhaDireitaTxtFocusLost

    private void panturrilhaEsquerdaTxtFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_panturrilhaEsquerdaTxtFocusLost
        config.converteCampos(panturrilhaEsquerdaTxt);
    }//GEN-LAST:event_panturrilhaEsquerdaTxtFocusLost

    private void coxaDireitaTxtFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_coxaDireitaTxtFocusLost
        config.converteCampos(coxaDireitaTxt);
    }//GEN-LAST:event_coxaDireitaTxtFocusLost

    private void coxaEsquerdaTxtFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_coxaEsquerdaTxtFocusLost
        config.converteCampos(coxaEsquerdaTxt);
    }//GEN-LAST:event_coxaEsquerdaTxtFocusLost

    private void AlturaTxtKeyReleased(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_AlturaTxtKeyReleased
        AlturaTxt.setText(AlturaTxt.getText().replace(",", "."));
    }//GEN-LAST:event_AlturaTxtKeyReleased

    private void rgTxtFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_rgTxtFocusLost
    }//GEN-LAST:event_rgTxtFocusLost

    public int getIdClinte() {
        return idClinte;
    }

    public void setIdClinte(int idClinte) {
        this.idClinte = idClinte;
    }

    //texto
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
        } catch (InstantiationException ex) {
        } catch (IllegalAccessException ex) {
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {

                new Editar().setVisible(true);



            }
        });
    }
    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JTextField AlturaTxt;
    private javax.swing.JTextField AnteBracoDireitoTxt;
    private javax.swing.JTextField AntebracoEsquerdoTxt;
    private javax.swing.JTextField BracoEsquerdoTxt;
    private javax.swing.JTextField CPFTxt;
    private javax.swing.JTextField bracoDireitoTxt;
    private javax.swing.JTextField cinturaTxt;
    private javax.swing.JTextField coxaDireitaTxt;
    private javax.swing.JTextField coxaEsquerdaTxt;
    private javax.swing.JTextField dataNascimentoTxt;
    private javax.swing.JTextField emailTxt;
    private javax.swing.JTextField enderecoTxt;
    private javax.swing.JTextField gluteoTxt;
    private javax.swing.JTextField imcTxt;
    private javax.swing.JButton jButton1;
    private javax.swing.JButton jButton2;
    private javax.swing.JButton jButton3;
    private javax.swing.JButton jButton4;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel10;
    private javax.swing.JLabel jLabel11;
    private javax.swing.JLabel jLabel12;
    private javax.swing.JLabel jLabel13;
    private javax.swing.JLabel jLabel14;
    private javax.swing.JLabel jLabel15;
    private javax.swing.JLabel jLabel16;
    private javax.swing.JLabel jLabel17;
    private javax.swing.JLabel jLabel18;
    private javax.swing.JLabel jLabel19;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JLabel jLabel20;
    private javax.swing.JLabel jLabel21;
    private javax.swing.JLabel jLabel24;
    private javax.swing.JLabel jLabel26;
    private javax.swing.JLabel jLabel27;
    private javax.swing.JLabel jLabel3;
    private javax.swing.JLabel jLabel4;
    private javax.swing.JLabel jLabel5;
    private javax.swing.JLabel jLabel7;
    private javax.swing.JLabel jLabel8;
    private javax.swing.JLabel jLabel9;
    private javax.swing.JPanel jPanel1;
    private javax.swing.JPanel jPanel2;
    private javax.swing.JPanel jPanel3;
    private javax.swing.JPanel jPanel4;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JLabel nascimento;
    private javax.swing.JLabel nome;
    private javax.swing.JTextField nometxt;
    private javax.swing.JTextPane obs;
    private javax.swing.JTextField panturrilhaDireitaTxt;
    private javax.swing.JTextField panturrilhaEsquerdaTxt;
    private javax.swing.JTextField peitoTxt;
    private javax.swing.JTextField pesoTxt;
    private javax.swing.JTextField rgTxt;
    private javax.swing.JComboBox sexoCombo;
    private javax.swing.JTextField telefoneTXT;
    // End of variables declaration//GEN-END:variables

    private String SubString(String string, int i, int i0) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

    private String subString(String string, int i, int i0) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

    private String substring(String string, int i, int i0) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }
}