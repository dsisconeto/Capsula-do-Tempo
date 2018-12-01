#include <stdlib.h>
#include <stdio.h>
#include "Lista.h"


Lista *criarLista() {
    Lista *li = (Lista *) malloc(sizeof(Lista));
    if (li != NULL) {
        *li = NULL;
    }

    return li;
}

void liberarLista(Lista *li) {

    if ((li != NULL)) {
        if ((*li) != NULL) {
            No *no;
            no = *li;
            *li = (*li)->nos[DIREITA];
            free(no);
            liberarLista(li);
        }
    } else {
        free(li);
    }

}


int listaVazia(Lista *li) {

    if (li == NULL) return 1;
    if (*li == NULL) return 1;

    return 0;

}


int tamanhoLista(Lista *li) {
    if (li == NULL) return 0;
    No *no = (*li);
    int count = 0;
    while (no != NULL) {
        count++;
        no = no->nos[DIREITA];
    }
    return count;
}


int inserirInicio(Lista *li, Registro reg) {
    if (li == NULL)return 0;
    No *no = (No *) malloc(sizeof(No));
    if (no == NULL) return 0;
    no->registro = reg;
    no->nos[DIREITA] = (*li);
    if ((*li) != NULL) {
        (*li)->nos[ESQUERDA] = no;
    }
    *li = no;
    return 1;
}

int inserirFinal(Lista *li, Registro reg) {

    if (li == NULL) return 0;
    No *no = (No *) malloc(sizeof(No));
    if (no == NULL) return 0;

    no->nos[CIMA] = NULL;
    no->nos[BAIXO] = NULL;
    no->nos[CIMA_ESQUERDA] = NULL;
    no->nos[CIMA_DIREITA] = NULL;
    no->nos[BAIXO_ESQUERDA] = NULL;
    no->nos[BAIXO_DIREITA] = NULL;


    no->registro = reg;
    no->nos[DIREITA] = NULL;


    if ((*li) == NULL) {
        no->nos[ESQUERDA] = NULL;
        *li = no;
    } else {
        No *aux = (*li);
        while (aux->nos[DIREITA] != NULL) {
            aux = aux->nos[DIREITA];
        }
        aux->nos[DIREITA] = no;
        no->nos[ESQUERDA] = aux;
    }
    return 1;
}


int consultarPrimeiroElemento(Lista *li, Registro *reg) {
    if (listaVazia(li))return 0;
    (*reg) = (*li)->registro;
    return 1;
}








void imprimirLista(Lista *li) {

    if (!listaVazia(li)) {

        No *aux1;
        aux1 = (*li);
        while (aux1 != NULL) {

            printf("%c", aux1->registro.valor.caractere);
            aux1 = aux1->nos[DIREITA];

        }
        printf("\n");
    }

}


void ListaOitavamenteEncadeada(Lista *li, int coluna) {

    No *aux[3];
    aux[0] = (*li);

    while (aux[0]) {

        aux[1] = aux[0]->nos[DIREITA];
        aux[2] = aux[0]->nos[ESQUERDA];

        for (int i = 1; i <= coluna; i++) {

            if (i == coluna) {

                aux[0]->nos[BAIXO] = aux[1];// baixo

                if (aux[1]) {
                    aux[0]->nos[BAIXO_ESQUERDA] = aux[1]->nos[ESQUERDA];// baixo esquerda
                    aux[0]->nos[BAIXO_DIREITA] = aux[1]->nos[DIREITA];// baixo direita
                }

                aux[0]->nos[CIMA] = aux[2];

                if (aux[2]) {

                    aux[0]->nos[CIMA_ESQUERDA] = aux[2]->nos[ESQUERDA]; // cima esquerda
                    aux[0]->nos[CIMA_DIREITA] = aux[2]->nos[DIREITA]; // cima direita
                }

            }

            if (aux[2]) {
                aux[2] = aux[2]->nos[ESQUERDA];
            }

            if (aux[1]) {
                aux[1] = aux[1]->nos[DIREITA];
            }

        }

        aux[0] = aux[0]->nos[DIREITA];
    }
}



