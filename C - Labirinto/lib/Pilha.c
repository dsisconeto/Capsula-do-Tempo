#include <stdio.h>
#include <stdlib.h>
#include "Pilha.h"

struct noPilha {
    RegPilha reg;
    struct noPilha *prox;
};
typedef struct noPilha NoPilha;

Pilha *criarPilha() {
    Pilha *pi = (Pilha *) malloc(sizeof(Pilha));
    if (pi != NULL)
        *pi = NULL;
    return pi;
}

void libera_Pilha(Pilha *pi) {
    if (pi != NULL) {
        NoPilha *no;
        while ((*pi) != NULL) {
            no = *pi;
            *pi = (*pi)->prox;
            free(no);
        }
        free(pi);
    }
}

int consulta_topo_Pilha(Pilha *pi, RegPilha *reg) {
    if (pi == NULL)
        return 0;
    if ((*pi) == NULL)
        return 0;
    *reg = (*pi)->reg;
    return 1;
}

int empilhar(Pilha *pi, RegPilha reg) {
    if (pi == NULL)
        return 0;
    NoPilha *no;
    no = (NoPilha *) malloc(sizeof(NoPilha));
    if (no == NULL)
        return 0;
    no->reg = reg;
    no->prox = (*pi);
    *pi = no;
    return 1;
}

int desempilhar(Pilha *pi, RegPilha *reg) {
    if (pi == NULL)
        return 0;
    if ((*pi) == NULL)
        return 0;
    NoPilha *no = *pi;
    *pi = no->prox;
    *reg = no->reg;
    free(no);
    return 1;
}

int tamanho_Pilha(Pilha *pi) {
    if (pi == NULL)
        return 0;
    int cont = 0;
    NoPilha *no = *pi;
    while (no != NULL) {
        cont++;
        no = no->prox;
    }
    return cont;
}

int Pilha_cheia(Pilha *pi) {
    return 0;
}

int Pilha_vazia(Pilha *pi) {
    if (pi == NULL)
        return 1;
    if (*pi == NULL)
        return 1;
    return 0;
}