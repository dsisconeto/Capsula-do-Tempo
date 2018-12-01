#include <stdio.h>
#include "../lib/procurarPalavras.h"

// para rodar o programa use o comando partir do diret
// ./procurar_palavras matriz.txt palavras.txt

int main(int argc, char *argv[]) {

    Lista *resultados = procurarPalvra("matriz.txt", "palavras.txt");
    No *aux = *resultados;
    int i = 1;
    while (aux) {
        printf("\t");
        if (i < 10) {
            printf("0%d", i);
        } else{
            printf("%d", i);
        }
        printf(" - Palavra: %s, Direção %s,  Posição Linha:%d Colunha:%d, Tamanho da Palavra %d\n",
               convertePalavra(aux->registro.valor.resultado.palavra),
               identificarDirecao(aux->registro.valor.resultado.direcao),
               aux->registro.valor.resultado.c, aux->registro.valor.resultado.l,
               aux->registro.valor.resultado.tamanhoPalavra);
        aux = aux->nos[DIREITA];
        i++;
    }
    return 1;
}