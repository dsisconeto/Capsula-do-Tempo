package db;

public class Mensagem {

    private String texto;
    private int codigo;
    private boolean status;

    public Mensagem(String texto, int codigo, boolean status) {
        this.texto = texto;
        this.codigo = codigo;
        this.status = status;
    }

    public String getTexto() {
        return texto;
    }

    public int getCodigo() {
        return codigo;
    }

    public boolean isStatus() {
        return status;
    }

    @Override
    public String toString() {
        return this.getTexto();
    }

}
