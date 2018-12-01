#include <stdio.h>
#include <ctype.h>

#define MAX 100

int main(void) {
    int teste[MAX][2]; // guarda o numero de associações feita por teste
    int numeroTeste = 0; // número de teste feitos
    int j, i, k, h, n; // flags usadas na estrutura de repedição e co
    int numero[MAX][10][5][2]; // 1 = teste, 2 = associação, 3 = coluna, 4 = os dois numeros da coluna
    int letra[MAX][10][6]; // indice 1 = teste, indice 2 = associação, letra usada convertida para numero
    int senha[MAX][6]; // 1 = teste, 2 = digitos da senha
    char tempLetras[6], letras[5] = {'a', 'b', 'c', 'd', 'e'}; // variaveis usada para receber as letras em char
    do { // loop usado para poder fazer até numero maximo de teste
        do { // lop usado para validar numero de associações
            printf("Digite o número de  associacões desejadas:\n");
            scanf("%d", &teste[numeroTeste][0]);
            if ((teste[numeroTeste][0] < 2 || teste[numeroTeste][0] > 10) && teste[numeroTeste][0] != 0) {
                printf("Ops, o numero deve ser maior que 1, menor que 11, ou zero para terminar\n");
            }
        } while ((teste[numeroTeste][0] < 2 || teste[numeroTeste][0] > 10) && teste[numeroTeste][0] != 0);

        if (teste[numeroTeste][0] != 0) {
            for (h = 0; h < 6; h++) { // iniciando todos os digitos da senha com -1
                senha[numeroTeste][h] = -1;
            }
            printf("Digite os teste de senha no formato\n 0 0 0 0 0 0 0 0 0 0  A A A A A A\n");
            for (i = 0; i < teste[numeroTeste][0]; i++) {
                printf("Digite a %d° associacao\n", (i + 1));

                for (j = 0; j < 5; j++) {
                    for (n = 0; n < 2; n++) {
                        scanf("%d", &numero[numeroTeste][i][j][n]);
                        getchar();
                    }
                }
                for (int l = 0; l < 6; l++) {
                    scanf("%c", &tempLetras[l]);
                    tolower(tempLetras[l]); // covertendo as letras para minusculas
                    for (k = 0; k < 5; k++) {
                        if (tempLetras[l] == letras[k]) { letra[numeroTeste][i][l] = k; }
                    }
                    getchar();
                }
            }
        }
        numeroTeste++; // numero do teste
    } while (teste[(numeroTeste - 1)][0] != 0); // termina a coleta de dados
    numeroTeste--;

    // inicio da definiçãp da senha
    for (i = 0; i < numeroTeste; i++) { // loop que roda numero de teste
        teste[i][1] = 1;
        for (k = 0; k < 6; k++) {// loop que verifica digito por digito
            int count[10] = {0, 0, 0, 0, 0, 0, 0, 0, 0, 0}; // array necessario para contar qual numero aparece mais
            h = 0;
            for (j = 0; j < teste[i][0]; j++) { // rodandos as associações
                for (n = 0; n < 2; n++) {
                    if ((count[numero[i][j][letra[i][j][k]][n]]++) > h) {
                        senha[i][k] = numero[i][j][letra[i][j][k]][n];
                        h = count[numero[i][j][letra[i][j][k]][n]];
                    }
                }
            }
        }
    }
    // validar senha, verificar se possivel definir a senha
    for (i = 0; i < numeroTeste; i++) {
        for (j = 0; j < 6; j++) {
            teste[i][1] = senha[i][j] == -1 ? 0 : teste[i][1];
        }
    }
    for (i = 0; i < numeroTeste; i++) {
        printf("Teste %d \n", (i + 1));
        if (teste[i][1] == 1) {
            for (j = 0; j < 6; j++) {
                printf("%d ", senha[i][j]);// imprimir a senha na tela
            }
            printf("\n");
        } else {
            printf("Dados insuficientes!\n");
        }
        printf("\n");
    }
    return 0;
}
