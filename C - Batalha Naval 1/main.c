#include <stdio.h>
#include <stdlib.h>
#include <string.h>

struct game {
    int play;
    int tabuleiro[2][2][10][10]; // são quatro tabuleiros
    int navios[2][5];
    int win;
    int point[2];
};

struct cordenadas {
    int colunas[2];
    int linhas[2];

};

struct tiro {
    int coluna;
    int linha;
};




int colunaEmLetras[2][10] = {
    {'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'},
    {'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'}
};

int preencherAutomatico(struct game *tabu) {
    int l, c, p, n, marcar;

    for (p = 0; p < 2; p++) {
        //(porta-aviões) id = 1
        for (c = 0; c < 5; c++) {
            tabu->tabuleiro[p][0][0][c] = 1;

        }

        for (c = 0; c < 4; c++) {
            tabu->tabuleiro[p][0][1][c] = 2;

        }

        for (c = 0; c < 3; c++) {

            tabu->tabuleiro[p][0][2][c] = 3;

        }

        for (c = 0; c < 3; c++) {

            tabu->tabuleiro[p][0][3][c] = 4;

        }

        for (c = 0; c < 2; c++) {

            tabu->tabuleiro[p][0][4][c] = 5;

        }

    }

}

int main(int argc, char** argv) {


    void startGame(struct game * tabu);
    void preencherTabuleiro(struct game * tabu);


    struct game jogo, *pointJogo;


    pointJogo = &jogo;

    startGame(pointJogo);



    return 0;
}

void startGame(struct game *tabu) {

    void preencherTabuleiro(struct game * tabu);
    void imprimirTabuleiro(struct game *tabu, int numeroTab);
    int jogando(struct game * tabu);
    // Um navio simples de cinco quadrados de comprimento (porta-aviões)
    // Um navio simples de quatro quadrados de comprimento (navio de guerra)
    // Dois navios de três quadrados de comprimento (o cruzador e o submarino)
    // Um navio simples de dois quadrados de comprimento (o destruidor)

    int l, c, p;
    tabu->win = -1;
    tabu->play = 0;
    tabu->point[0] = 17;
    tabu->point[1] = 17;
    // preenchendo tabuleiros dos dois jogadores;
    for (p = 0; p < 2; p++) {
        tabu->navios[p][0] = 5; //(porta-aviões) id = 1
        tabu->navios[p][1] = 4; // (navio de guerra) id = 2
        tabu->navios[p][2] = 3; // cruzador  id = 3
        tabu->navios[p][3] = 3; // submarino id = 4
        tabu->navios[p][4] = 2; // destruidor id = 5

        for (l = 0; l < 10; l++) {

            for (c = 0; c < 10; c++) {

                // zero é escondido
                tabu->tabuleiro[p][0][l][c] = 0;

                tabu->tabuleiro[p][1][l][c] = 0;
            }

        }
    }



    printf("Bem-vindo ao jogo batalha naval\n");

    for (p = 0; p < 2; p++) {
        tabu->play = p;
        preencherTabuleiro(tabu);

    }


    ///preencherAutomatico(tabu);

    tabu->play = 0;
    jogando(tabu);

}

void imprimirTabuleiro(struct game *tabu, int numeroTab) {

    int l, c, p, k;
    p = tabu->play;

    printf("\n\tTabuleiro do Jogador %i \n", (p + 1));

    printf("______________________________________________\n|   ");
    // imprimir as letras
    for (k = 0; k < 10; k++) {
        printf("| %c ", colunaEmLetras[1][k]);
    }
    printf("|\n");


    for (l = 0; l < 10; l++) {
        if ((l + 1) != 10) {
            printf("| %i ", l + 1);

        } else {
            printf("|%i ", l + 1);

        }


        for (c = 0; c < 10; c++) {

            if (numeroTab == 0) {

                printf("| %i ", tabu->tabuleiro[p][numeroTab][l][c]);

            } else {
                if (tabu->tabuleiro[p][numeroTab][l][c] == 0) {
                    // não marcado
                    printf("| - ");
                } else if (tabu->tabuleiro[p][numeroTab][l][c] == 1) {
                    // água
                    printf("| O ");
                } else {
                    // fogo
                    printf("| X ");
                }
            }

        }

        printf("|\n");
    }
    printf("______________________________________________\n");

}

void preencherTabuleiro(struct game *tabu) {

    struct cordenadas porta;
    struct cordenadas pegaCoordenadas();
    int validarCodernadas(struct game *tabu, struct cordenadas, int navio, int indenficador);
    int validarRes = 1, play;
    printf("Jogador %i é sua vez de preencher o seu tabuleiro", (tabu->play + 1));
    do {
        if (validarRes == 0) {
            printf("Coordenadas Invalidas! \n");
        }
        imprimirTabuleiro(tabu, 0);
        printf("1° Porta Aviões que tem 5 quadrados, o id do mesmo é o número 1\n");
        porta = pegaCoordenadas();
        validarRes = validarCodernadas(tabu, porta, 5, 1);
    } while (validarRes == 0);

    do {
        if (validarRes == 0) {
            printf("Coordenadas Invalidas! \n");
        }
        imprimirTabuleiro(tabu, 0);
        printf("2° navio de guerra que tem 4 quadrados, o id do mesmo é o número 2\n");
        porta = pegaCoordenadas();
        validarRes = validarCodernadas(tabu, porta, 4, 2);
    } while (validarRes == 0);

    do {
        if (validarRes == 0) {
            printf("Coordenadas Invalidas! \n");
        }
        imprimirTabuleiro(tabu, 0);
        printf("3° cruzador que tem 3 quadrados, o id do mesmo é o número 3\n");
        porta = pegaCoordenadas();
        validarRes = validarCodernadas(tabu, porta, 3, 3);
    } while (validarRes == 0);


    do {
        if (validarRes == 0) {
            printf("Coordenadas Invalidas! \n");
        }
        imprimirTabuleiro(tabu, 0);
        printf("4° submarino que tem 3 quadrados, o id do mesmo é o número 4\n");
        porta = pegaCoordenadas();
        validarRes = validarCodernadas(tabu, porta, 3, 4);
    } while (validarRes == 0);


    do {
        if (validarRes == 0) {
            printf("Coordenadas Invalidas! \n");
        }
        imprimirTabuleiro(tabu, 0);
        printf("5° destruidor que tem 2 quadrados, o id do mesmo é o número 5\n");
        porta = pegaCoordenadas();
        validarRes = validarCodernadas(tabu, porta, 2, 5);
    } while (validarRes == 0);


    system("clear");

    printf("Pronto!");


}

int validarCodernadas(struct game *tabu, struct cordenadas cordenadas, int navio, int indenficador) {

    int i, success = 0, count = 0;

    // se estiver na mesma coluna está na vertical 
    if (cordenadas.colunas[0] == cordenadas.colunas[1]) {
        // vertical

        for (i = cordenadas.linhas[0]; i <= cordenadas.linhas[1] && count < navio; i++) {

            if (tabu->tabuleiro[tabu->play][0][i][cordenadas.colunas[0]] == 0) {
                success++;
            }

        }
        count = 0;
        if (success == navio) {

            for (i = cordenadas.linhas[0]; i <= cordenadas.linhas[1] && count < navio; i++) {

                tabu->tabuleiro[tabu->play][0][i][cordenadas.colunas[0]] = indenficador;
            }

            return 1;

        } else {

            return 0;
        }

    } else {
        // horizontal
        for (i = cordenadas.colunas[0]; i <= cordenadas.colunas[1] && count < navio; i++) {


            if (tabu->tabuleiro[tabu->play][0][cordenadas.linhas[0]][i] == 0) {
                success++;
            }
            count++;
        }
        count = 0;
        if (success == navio) {

            for (i = cordenadas.colunas[0]; i <= cordenadas.colunas[1] && count < navio; i++) {

                tabu->tabuleiro[tabu->play][0][cordenadas.linhas[0]][i] = indenficador;
                count++;

            }



            return 1;
        } else {

            return 0;
        }
    }



    return 0;
}

struct cordenadas pegaCoordenadas() {

    int converte(char letra);
    struct cordenadas dados;
    char coluna[2];


    printf("Digite a Coluna da primeira cordenada:");
    scanf("%c", &coluna[0]);
    dados.colunas[0] = converte(coluna[0]);
    printf("\n");

    printf("Digite a Linha da primeira cordenada:  ");
    scanf("%i", &dados.linhas[0]);
    dados.linhas[0] -= 1;
    printf("\n");
    getchar();
    printf("Digite a Coluna da Segunda cordenada:  ");
    scanf("%c", &coluna[1]);
    dados.colunas[1] = converte(coluna[1]);
    printf("\n");

    printf("Digite a Linha da Segunda Coordenada:  ");
    scanf("%i", &dados.linhas[1]);
    dados.linhas[1] -= 1;
    printf("\n");
    getchar();
    return dados;
}

int converte(char letra) {

    // converte a letra para o número da matriz
    int i;

    for (i = 0; i < 10; i++) {
        if (colunaEmLetras[0][i] == letra || colunaEmLetras[1][i] == letra) {
            return i;
        }
    }
}

void inverteJogador(struct game *tabu) {

    if (tabu->play == 0) {
        tabu->play = 1;
    } else {
        tabu->play = 0;
    }


}

int validarTiro(struct game *tabu, struct tiro tiro) {
    int fogo;
    system("clear");
    printf("\n\n");
    if (tiro.coluna < 10 && tiro.coluna < 10) {

        inverteJogador(tabu);
        // verificar se não tem nada marcado no local
        if (tabu->tabuleiro[tabu->play][1][tiro.linha][tiro.coluna] == 0) {

            // verificar se algum navio no tabuleiro escondido
            if (tabu->tabuleiro[tabu->play][0][tiro.linha][tiro.coluna] != 0) {
                // tem navio
                // diminuir um ponto

                tabu->point[tabu->play] -= 1;
                // qual navio;
                switch (tabu->tabuleiro[tabu->play][0][tiro.linha][tiro.coluna]) {
                    case 1:
                        tabu->navios[tabu->play][0] -= 1;
                        fogo = tabu->navios[tabu->play][0];
                        break;

                    case 2:
                        tabu->navios[tabu->play][1] -= 1;
                        fogo = tabu->navios[tabu->play][1];
                        break;

                    case 3:
                        tabu->navios[tabu->play][2] -= 1;

                        fogo = tabu->navios[tabu->play][2];
                        break;

                    case 4:
                        tabu->navios[tabu->play][3] -= 1;
                        fogo = tabu->navios[tabu->play][3];
                        break;

                    case 5:
                        fogo = tabu->navios[tabu->play][4];
                        tabu->navios[tabu->play][4] -= 1;

                        break;
                }

                if (fogo <= 0) {
                    printf("AFUNDOU!\n");
                } else {
                    printf("************FOGO*****************!\n");
                }


                tabu->tabuleiro[tabu->play][1][tiro.linha][tiro.coluna] = 2;

                if (tabu->point[tabu->play] <= 0) {
                    // algum jogador venceu;
                    inverteJogador(tabu);
                    tabu->win = tabu->play;

                } else {
                    inverteJogador(tabu);
                }

                return 1;

            } else {
                // água
                printf("~~~~~~~~~~~~ÁGUA~~~~~~~~~~~~~~~~~!\n");
                tabu->tabuleiro[tabu->play][1][tiro.linha][tiro.coluna] = 1;
                inverteJogador(tabu);
                return 1;
            }



        } else {
            printf("<><><><><<><><><><><>Local já marcado<><><><><<><><><><><><><><><><><>\n");
            inverteJogador(tabu);
            return 0;
        }




    } else {

        printf("Coordenada do tiro invalida\n");
        return 0;
    }

}

struct tiro pegarTiro() {
    struct tiro dados;
    char colChar;
    printf("Coluna da Coordenada do tiro: ");
    scanf("%c", &colChar);
    printf("\n");
    dados.coluna = converte(colChar);

    printf("Linha da Coordenada do tiro: ");
    scanf("%i", &dados.linha);
    dados.linha -= 1;
    printf("\n");
    getchar();
    return dados;
}

int naviosAfundados(struct game *tabu) {

    int i, afundados = 0;
    inverteJogador(tabu);

    for (i = 0; i < 5; i++) {

        if (tabu->navios[tabu->play][i] == 0) {
            afundados++;
        }

    }
    inverteJogador(tabu);
    return afundados;

}

int jogando(struct game *tabu) {

    struct tiro bala;
    int validar, i;
    while (tabu->win == -1) {
        printf("Jogador %i é sua vez de jogar \n", (tabu->play + 1));
        printf("Você já afundou %i navios\n", naviosAfundados(tabu));

        for (i = 0; i < 3; i++) {
            validar = 1;
            inverteJogador(tabu); // inverte para imprimir o tabuleiro
            imprimirTabuleiro(tabu, 1);
            inverteJogador(tabu); // volta ao jogador
            printf("%i° tiro\n", (i + 1));

            do {
                bala = pegarTiro();
                validar = validarTiro(tabu, bala);

                if (validar == 0) {
                    printf("Jogue Novamente!\n");
                    inverteJogador(tabu); // inverte para imprimir o tabuleiro
                    imprimirTabuleiro(tabu, 1);
                    inverteJogador(tabu); // volta ao jogador
                    printf("%i° tiro\n", (i + 1));
                }
            } while (validar == 0);
        }

        inverteJogador(tabu);
    }
    system("clear");
    printf("!!!!!!!!!!!!!!!! Jogador %i você venceu !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!", tabu->play);
    inverteJogador(tabu);
    imprimirTabuleiro(tabu, 1);
    imprimirTabuleiro(tabu, 0);

    inverteJogador(tabu);
    imprimirTabuleiro(tabu, 1);
    imprimirTabuleiro(tabu, 0);
    inverteJogador(tabu);
    printf("!!!!!!!!!!!!!!!! Jogador %i você venceu !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!", tabu->play);



}
