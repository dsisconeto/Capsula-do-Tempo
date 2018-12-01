#include "Lista.h"


char *identificarDirecao(int direcao);

void imprimirMatriz(Lista *li, int coluna);


Lista *carregarMatriz(char *matriz_arquivo);

Lista *carregarPalavras(char *palavras);

int verificarColunas(char *matriz_arquivo);


Lista *procurarPalvra(char *matriz_arquivo, char *palavra_arquivo);

char *convertePalavra(Lista *li);