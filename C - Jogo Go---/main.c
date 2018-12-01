#include <stdlib.h>
#include <stdio.h>

int main()
    {
    // declaração de variaveis
    int boardSize, amountOfPed, play, turn, success,  x, y, math, col, line, i, j, k,pointBlack,pointWhite,black,white;
    // iniciando a configuração o jogo
    // definindo o tamanho do tabuleiro
    do {
        printf("Qual é o Tamanho do Tabuleiro?\n");
        scanf("%i", &boardSize);
   
        if (!(boardSize >= 10 && boardSize <= 500)) {

            printf("O tabuleiro precisa ser maior que 10 e menor que 500 \n");
        }
        
    } while (!(boardSize >= 10 && boardSize <= 500));
    // definindo a quantidade de pedras do jogo
    do {
        printf("Com quantas pedras você quer jogar?\n");
        scanf("%i", &amountOfPed);

        if (!(amountOfPed >= 1 && boardSize <= 250)) {

            printf("As Pedras devem ser menor ou igual a 500\n");
        }

        math = ((boardSize * boardSize) / 2);

        if (!(amountOfPed <= math)) {
            printf(" As pedras tem que ser menor que  %d \n", math);

        }

    } while (!(amountOfPed >= 1 && boardSize <= 250));

    // iniciando o jogo

    int board[boardSize][boardSize];   // criando a matriz que representa o tabuleiro

    turn = amountOfPed * 2; // definindo a quantidade de turnos
    play = 1;	// varivel que defini o jogador
    // imprimindo o tabuleiro pela primeira vez
    printf("<><><><><><><><><><><><><><><><><><><><><><><><><><><><><>\n");
    for (x = 0; x < boardSize; x++) {

        for (y = 0; y < boardSize; y++) {
            board[x][y] = 0;
            printf(" %d |", board[x][y]);
        }

        printf("\n");

    }
    printf("<><><><><><><><><><><><><><><><><><><><><><><><><><><><><>\n");
    //  o jogo acaba quando a quantidade de turnos chegar a zero
    while (turn > 0) { // loop que mantem o fluxo de turnos

        printf("Jogador %d° é o seu turno \n", play);
        printf("Qual Coluna deseja colocar a pedra\n");
        scanf("%i", &col);
        printf("Qual linha deseja colocar a pedra \n");
        scanf("%i", &line);
        // convertendo as cordenas do usuario para as da matriz
        col -= 1;
        line -= 1;

        if ((0 > col || col > boardSize) || (0 > line || line > boardSize)) {

            printf("Desculpa, Local Invalido \n");
            success = 0;
        } else {

    do {
            if (board[line][col]) {
                printf("Desculpa, Local já está ocupado\n");
                success = 0;

            } else {

                board[line][col] = play == 1 ? 1 : 2;
                success = 1;
            }

        }

        if (success) {
           
            play = play == 1 ? 2 : 1;
           
            turn -= 1;

           for (x = 0; x < boardSize; x++) {


                for (y = 0; y < boardSize; y++) {

                    printf(" %d |", board[x][y]);

                }
               printf("\n");

            }

        printf("<><><><><><><><><><><><><><><><><><><><><><><><><><><><><>\n");
        }
	}


	for(i = 0; i < boardSize; ++i){

        for(j = 0; j < boardSize; ++j)
        {
            white=0;
            black=0;
            for(k = 1; k <= boardSize; k++)
                {
                if(k + i > boardSize || k + j > boardSize)
                    break;
                for(x = i; x < i + k; ++x)
                    {
                        for(y = j; y < j + k; ++y)
                        {
                            if(board[x][y]==1)
                                black=1;
                            if(board[x][y]==2)
                                white=1;
                    }
                }
                if(black==1)
                    break;
                if(white==1)
                    pointWhite++;
            }
        }
    }
    for(i = 0; i < boardSize; ++i)
        {
        for(j = 0; j < boardSize; ++j)
        {
            white=0;
            black=0;
            for(k = 1; k <= boardSize; k++)
                {
                if(k + i > boardSize || k + j > boardSize)
                    break;
                for(x = i; x < i + k; ++x)
                    {
                        for(y = j; y < j + k; ++y)
                        {
                            if(board[x][y]==1)
                                black=1;
                            if(board[x][y]==2)
                                white=1;
                    }
                }
                if(white==1)
                    break;
                if(black==1)
                    pointBlack++;
            }
        }
    }

     printf("Player one points %d\n",pointBlack);
        printf("Player Tow points  %d\n",pointWhite);
        if (pointWhite<pointBlack)
            printf("Player One Win :)");
        if (pointWhite=pointBlack)
            printf("Draw");
        else
            printf("Player Two Win :)");

        return 0;
    }
