
typedef struct registroFila {
    int cordenadas[2];
    int direcao;
    char caractere;
    union {
        int inteiro;
        char caractere;
        float real;
        char *liral;
    } valor;
} RegFila;

typedef struct fila Fila;

Fila *criarFila();

void libera_Fila(Fila *fi);

int consulta_Fila(Fila *fi, RegFila *reg);

int enfilerar(Fila *fi, RegFila reg);

int desenfilerar(Fila *fi, RegFila *reg);

int tamanhoFila(Fila *fi);

int filaVazia(Fila *fi);

int Fila_cheia(Fila *fi);

void imprime_Fila(Fila *fi);


