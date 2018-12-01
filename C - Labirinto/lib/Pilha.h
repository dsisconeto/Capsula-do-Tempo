#include "Fila.h"

typedef struct registroPilha {
    int cordenadas[2];
    int direcao;
    char caractere;
    Fila *fila;
    union {
        int inteiro;
        char caractere;
        float real;
        char *liral;

    } valor;
} RegPilha;

typedef struct noPilha *Pilha;

Pilha *criarPilha();

void libera_Pilha(Pilha *pi);

int consulta_topo_Pilha(Pilha *pi, RegPilha *reg);

int empilhar(Pilha *pi, RegPilha reg);

int desempilhar(Pilha *pi, RegPilha *reg);

int tamanho_Pilha(Pilha *pi);

int Pilha_vazia(Pilha *pi);

int Pilha_cheia(Pilha *pi);

void imprime_Pilha(Pilha *pi);

