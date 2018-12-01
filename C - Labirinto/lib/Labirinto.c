#include "labinrinto.h"
#include <stdlib.h>
#include <stdio.h>


void irParaCordenada(NoLista *agente007, int x, int y, Labirinto * lab) {

    NoLista *aux = (*lab->items);

    while (aux) {
        if (x == aux->registro.cordenadas[0] && y == aux->registro.cordenadas[1]) {
            *agente007 = *aux;
            break;
        }
        aux = aux->nos[DIREITA];
    }
}


int agenteCaminho(NoLista *agente, int direcao, Pilha *caminho, Labirinto * lab) {


    while (agente->registro.valor.caractere != '#' &&
           agente->registro.valor.caractere != '@') {
        guardaCaminho(agente, direcao, caminho);
        agente = agente->nos[direcao];
    }

    if (agente->registro.valor.caractere == '@') {
        return 1;

    } else {

        return mudarCaminho(caminho, agente, lab);
    }
}


int mudarCaminho(Pilha *caminho, NoLista *agente007, Labirinto *lab) {

    RegPilha regPilha;
    RegFila regFila;
    consulta_topo_Pilha(caminho, &regPilha);
    desenfilerar(regPilha.fila, &regFila);


    irParaCordenada(agente007, regFila.cordenadas[0], regFila.cordenadas[1], lab);


    return agenteCaminho(agente007, regFila.direcao, caminho, lab);
}


void guardaCaminho(NoLista *agente007, int direcao, Pilha *pilha) {

    int d;
    int auxdirecoes[4] = {BAIXO, DIREITA, CIMA, ESQUERDA};
    RegPilha regPilha;
    RegFila regFila;
    regPilha.fila = criarFila();
    regPilha.cordenadas[0] = agente007->registro.cordenadas[0];
    regPilha.cordenadas[1] = agente007->registro.cordenadas[1];
    regPilha.direcao = direcao;
    regPilha.caractere = agente007->registro.valor.caractere;

    for (d = 0; d < 3; d++) {

        if (agente007->nos[auxdirecoes[d]]->registro.valor.caractere != '#') {

            if (agente007->nos[auxdirecoes[d]]->registro.valor.caractere != '@') {


                regFila.cordenadas[0] = agente007->nos[auxdirecoes[d]]->registro.cordenadas[0];
                regFila.cordenadas[1] = agente007->nos[auxdirecoes[d]]->registro.cordenadas[1];
                regFila.direcao = auxdirecoes[d];
                regFila.caractere = agente007->nos[auxdirecoes[d]]->registro.valor.caractere;

                enfilerar(regPilha.fila, regFila);
            } else {


                *agente007 = *agente007->nos[auxdirecoes[d]];
                break;
            }
        }

    }
    empilhar(pilha, regPilha);
}


Pilha *percorrerLabirinto(Labirinto *lab) {

    NoLista *agente007 = (*lab->items);
    Pilha *caminho = criarPilha();

    irParaCordenada(agente007, lab->inicio[0], lab->inicio[1], lab);
    agenteCaminho(agente007, DIREITA, caminho, lab);

    return caminho;
}


Labirinto *criarLabirinto() {
    Labirinto *lab = (Labirinto *) malloc(sizeof(Labirinto));
    return lab;
}


Labirinto *carregarLabirinto(char *arquivo_matriz) {

    FILE *arquivo = fopen(arquivo_matriz, "r");
    if (!arquivo) {
        printf("Erro ao abrir arquivo %s ", arquivo_matriz);
        return NULL;
    }
    char c;
    int x = 1, y = 1;
    Labirinto *labirinto = criarLabirinto();
    Lista *items = criarLista();
    RegLista registro;

    // pegar a dimecao, e retira o primeiro \n
    fscanf(arquivo, "%d,%d\n", &labirinto->dimecao[0], &labirinto->dimecao[1]);
    // ler o labirinto
    while ((c = (char) fgetc(arquivo)) != EOF) {

        if (x == (labirinto->dimecao[0]) && c == '\n') {
            // para quando cher noLista final do labirinto
            break;
        }
        if (c != '\n') {
            // pega o caractere e as cordenadas do mesmo
            registro.valor.caractere = c;
            registro.cordenadas[0] = x;
            registro.cordenadas[1] = y;
            // inseri noLista finla da lista de items do labirinto
            inserirFinal(items, registro);
            y++;
        } else {
            x++;
            y = 1;
        }
    }
    // pega ponto de inicio do labirinto
    fscanf(arquivo, "%d,%d", &labirinto->inicio[0], &labirinto->inicio[1]);
    // fecha o arquivo
    fclose(arquivo);

    ListaOitavamenteEncadeada(items, labirinto->dimecao[1]);
    // guarda a lista de items do labirinto
    labirinto->items = items;

    // retorna o labirinto
    return labirinto;
}

void marcaCaminho(Pilha *caminho, Labirinto *lab) {

    RegPilha regPilha;
    NoLista *aux;

    while (desempilhar(caminho, &regPilha)) {
        aux = (*lab->items);

        while (aux) {

            if (regPilha.cordenadas[0] == aux->registro.cordenadas[0]
                && regPilha.cordenadas[1] == aux->registro.cordenadas[1]) {
                aux->registro.valor.caractere = '*';
                break;
            }

            aux = aux->nos[DIREITA];
        }

    }
}

void imprimrLabirinto(Labirinto *lab) {

    int x = 1, y = 1;
    NoLista *aux = (*lab->items);
    RegPilha regPilha;


    while (aux) {

        if (x == 1) {
            if (y < 10) {
                printf("| 0%d |", y);
            } else {
                printf("| %d |", y);
            }
        }
        printf("%c", aux->registro.valor.caractere);

        if (x == lab->dimecao[1]) {
            printf("\n");
            x = 1;
            y++;
        } else {
            x++;
        }


        aux = aux->nos[DIREITA];
    }


}


