#include "Lista.h"
#include "Pilha.h"

struct labirinto {
    int dimecao[2];
    int inicio[2];
    Lista *items;
};

typedef struct labirinto Labirinto;

Pilha *percorrerLabirinto(Labirinto *lab);

int agenteCaminho(NoLista *agente, int direcao, Pilha *caminho, Labirinto *lab);

Labirinto *carregarLabirinto(char *arquivo_matriz);

Labirinto *criarLabirinto();

void irParaCordenada(NoLista *agente007, int x, int y, Labirinto *lab);

void imprimrLabirinto(Labirinto *lab);

void marcaCaminho(Pilha *caminho, Labirinto *lab);

int mudarCaminho(Pilha *caminho, NoLista *agente007, Labirinto *lab);


void guardaCaminho(NoLista *agente007, int direcao, Pilha *pilha);