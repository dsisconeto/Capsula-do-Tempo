#include <stdio.h>
#include <stdlib.h>

#define TAMANHO 3 // altera o tamanho do tabuleiro

void main(void) {

    int turnos; // controlar numero de turnos
    int jogador = 1; // a vez de qual jogador
    int tabuleiro[TAMANHO][TAMANHO]; // matriz que guarda os dados do tabuleiro
    int x, y; // usadas na estruturas de repedição
    int ganhou = 0; // numero do jogador que ganhou e local onde ganhou
    int imprimir(int jogador, int tabuleiro[TAMANHO][TAMANHO]);  // declarando função
    void capturarCodernadas(int jogador, int tabuleiro[TAMANHO][TAMANHO]);

    for (x = 0; x < TAMANHO; x++) {
        for (y = 0; y < TAMANHO; y++) {
            tabuleiro[x][y] = 0; // iniciando os valores do tabuleiro com zero
        }
    }
    printf("Bem vindo ao Jogo da velha\n Digite os Númeoros separados por um espaço EX: 1 1");
    imprimir(jogador, tabuleiro); // imprimi o tabuleiro pela primeira vez

    for (turnos = TAMANHO * TAMANHO; turnos >= 0; turnos--) { // controlar o fluxo do jogo até acabar os turnos

        capturarCodernadas(jogador, tabuleiro);// captura os dados teclado e passa para a matriz
        ganhou = imprimir(jogador, tabuleiro); // imprimi o tabuleiro e retorna se alguém ganhou

        if (ganhou != 0) {
            printf("\nJogador %d Ganhou!", ganhou);
            turnos = -1;
        }
        if (turnos == 0 && ganhou == 0) {
            // empate
            printf("Jogou deu Empate!");
            turnos = -1;
        }
        jogador = jogador == 1 ? 2 : 1; // trocar de jodador
    }
}

int imprimir(int jogador, int tabuleiro[TAMANHO][TAMANHO]) {
    // imprimir o tabuleiro com as marcações já feitas
    // e verifica se alguem já ganhou
    int pontos[4] = {0, 0, 0, 0}; // usada para verificar se alguém ganhou
    int x, y, p, h = (TAMANHO - 1); // usadas na estruturas de repedição
    int ganhou = 0;
    printf("  ");
    for (p = 0; p < TAMANHO; p++) { // linha
        printf("%d ", p + 1);
    }
    printf("\n");
    for (x = 0; x < TAMANHO; x++) { // linha
        printf("%d ", x + 1);
        pontos[0] = pontos[0] != TAMANHO ? 0 : pontos[0]; // quando muda linha zera a horizontal
        pontos[1] = pontos[1] != TAMANHO ? 0 : pontos[1];

        for (y = 0; y < TAMANHO; y++) { // coluna
            // imprimi o tabuleiro
            switch (tabuleiro[x][y]) {
                case 1: // jogador 1 = x
                    printf("X|");
                    break;
                case 2:
                    printf("O|"); // jogador = 2
                    break;
                default:
                    printf(" |"); // ainda não foi marcada
                    break;
            }

            // verificar na horizontal
            pontos[0] = (jogador == tabuleiro[x][y] && pontos[0] < TAMANHO) ? pontos[0] + 1 : pontos[0];
            // verificar na vertical
            pontos[1] = (jogador == tabuleiro[y][x] && pontos[1] < TAMANHO) ? pontos[1] + 1 : pontos[1];
        }
        // verificar na diagonal
        if (jogador == tabuleiro[x][x] && pontos[2] < TAMANHO) {
            (pontos[2]++);
        } else {
            pontos[2] = pontos[2] != TAMANHO ? 0 : pontos[2];
        }
        if (h >= 0) {
            if (jogador == tabuleiro[x][h] && pontos[3] < TAMANHO) {
                (pontos[3]++);
            } else {
                pontos[3] = pontos[3] != TAMANHO ? 0 : pontos[3];
            }
            h--;
        }
        printf("  \n");
    }
    // veriricar 1 se jogador atual ganhou
    for (x = 0; x < 4; x++) {
        if (pontos[x] == TAMANHO) {
            ganhou = jogador;
        }
    }
    return ganhou;
}

void capturarCodernadas(int jogador, int tabuleiro[TAMANHO][TAMANHO]) {
    // função que captura dados do teclado
    // para o tabuleiro
    int tempColuna, tempLinha; // guarda temporariamente a coluna e a lina
    int sucesso = 0; // flag usada para verificar se jogada foi efetuada com sucesso

    do { // repetir até o jogador efetuar uma jogada valida
        // pegando a coluna
        printf("Jogador %d, Digite a coluna e a linha: ", jogador);
        scanf("%d %d", &tempColuna, &tempLinha);

        tempLinha--; // decrementando 1 unidade da linha
        tempColuna--; // decrementando 1 unidade da coluna

        if ((tempLinha < 0 || tempLinha > (TAMANHO - 1)) || (tempColuna < 0 || tempColuna > (TAMANHO - 1))) {
            // validando se a coluna e linha são validados
            printf("Ops, local não existe!\n");
        } else {
            if (tabuleiro[tempLinha][tempColuna] == 0) {
                // como não está marcada, matriz recebera o valor do jogador
                tabuleiro[tempLinha][tempColuna] = jogador;
                sucesso = 1;
                printf("Jogada com sucesso!\n");
            } else {
                // verifica se já está marcado
                printf("Ops, local já está ocupado pelo outro jogador!\n");
            }
        }
    } while (sucesso == 0);
}