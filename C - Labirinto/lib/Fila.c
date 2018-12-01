#include <stdio.h>
#include <stdlib.h>
#include "Fila.h"

struct noFila {
    RegFila reg;
    struct noFila *prox;
};
typedef struct noFila noFila;

struct fila {
    struct noFila *inicio;
    struct noFila *final;
    int qtd;
};

Fila *criarFila() {
    Fila *fi = (Fila *) malloc(sizeof(Fila));
    if (fi != NULL) {
        fi->final = NULL;
        fi->inicio = NULL;
        fi->qtd = 0;
    }
    return fi;
}

void libera_Fila(Fila *fi) {
    if (fi != NULL) {
        noFila *no;
        while (fi->inicio != NULL) {
            no = fi->inicio;
            fi->inicio = fi->inicio->prox;
            free(no);
        }
        free(fi);
    }
}

int consulta_Fila(Fila *fi, RegFila *reg) {
    if (fi == NULL)
        return 0;
    if (fi->inicio == NULL)//fila vazia
        return 0;
    *reg = fi->inicio->reg;
    return 1;
}

int enfilerar(Fila *fi, RegFila reg) {
    if (fi == NULL)
        return 0;
    noFila *no = (noFila *) malloc(sizeof(noFila));
    if (no == NULL)
        return 0;
    no->reg = reg;
    no->prox = NULL;
    if (fi->final == NULL)//fila vazia
        fi->inicio = no;
    else
        fi->final->prox = no;
    fi->final = no;
    fi->qtd++;
    return 1;
}

int desenfilerar(Fila *fi, RegFila *reg) {
    if (fi == NULL)
        return 0;
    if (fi->inicio == NULL)//fila vazia
        return 0;
    noFila *no = fi->inicio;
    fi->inicio = fi->inicio->prox;
    if (fi->inicio == NULL)//fila ficou vazia
        fi->final = NULL;
    *reg = no->reg;
    free(no);

    fi->qtd--;
    return 1;
}

int tamanhoFila(Fila *fi) {
    if (fi == NULL)
        return 0;
    return fi->qtd;
}

int filaVazia(Fila *fi) {
    if (fi == NULL)
        return 1;
    if (fi->inicio == NULL)
        return 1;
    return 0;
}