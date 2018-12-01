package model;

import model.Caixa;



public class Registradora extends Caixa{

    private static Registradora registradora = null;

    private Registradora() {}

    public static Registradora aberta() {
        
        if (Registradora.registradora == null) {  
            Registradora.registradora  = new Registradora();
            
            Registradora.registradora.abrirCaixa();
            
        }

        return Registradora.registradora;
    }

}
