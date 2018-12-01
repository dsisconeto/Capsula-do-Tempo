#include <stdio.h>
#include <stdlib.h>
#include "procurarPalavras.h"


Lista *procurarPalvra(char *matriz_arquivo, char *palavra_arquivo) {
    // carrega os dados
    Lista *listaDePalavras = carregarPalavras(palavra_arquivo);
    Lista *matriz = carregarMatriz(matriz_arquivo);
    Lista *listaDeResultados = criarLista();
    No *auxDirecoes;
    No *auxMatriz;
    No *auxPalavra;
    No *auxResultado;
    Registro reg;
    int colunaCount, linhaCount, auxColuna, colunas;
    int direcoes[8] = {
            BAIXO, CIMA,
            DIREITA, ESQUERDA,
            CIMA_ESQUERDA, BAIXO_DIREITA,
            CIMA_DIREITA, BAIXO_ESQUERDA
    };

    colunas = verificarColunas(matriz_arquivo);
    auxResultado = *listaDePalavras;

    // carregar Lista de resultados
    while (auxResultado) {
        reg.valor.resultado.tamanhoPalavra = tamanhoLista(auxResultado->registro.valor.lista);
        reg.valor.resultado.direcao = -1;
        reg.valor.resultado.l = -1;
        reg.valor.resultado.c = -1;
        reg.valor.resultado.pontos = 0;
        reg.valor.resultado.palavra = auxResultado->registro.valor.lista;
        inserirFinal(listaDeResultados, reg);
        auxResultado = auxResultado->nos[DIREITA];
    }

    auxResultado = *listaDeResultados;

    while (auxResultado) {
        colunaCount = 1, linhaCount = 1;
        auxMatriz = *matriz;
        // começa a percorre matriz de letras
        while (auxMatriz) {
            // percorre nas 8 direcões
            for (int d = 0; d <= 6; d++) {
                // passa letra para o auxilar para vericar ficar
                // em todas as direções
                auxDirecoes = auxMatriz;
                auxPalavra = *auxResultado->registro.valor.resultado.palavra;
                auxColuna = colunaCount;

                while (auxDirecoes != NULL) {

                    if (direcoes[d] == DIREITA) {
                        auxColuna++;
                    } else if (direcoes[d] == ESQUERDA) {
                        auxColuna--;
                    }
                    if (direcoes[d] == ESQUERDA && auxColuna < colunaCount) {
                        break;
                    }

                    // verifica se letra da matriz é igual letra da palavra
                    if (auxDirecoes->registro.valor.caractere == auxPalavra->registro.valor.caractere) {
                        // se for conta pontos, e passa para proxima letra da palavra
                        (auxResultado->registro.valor.resultado.pontos++);
                        auxPalavra = auxPalavra->nos[DIREITA];
                        if (auxResultado->registro.valor.resultado.l < 0 ||
                            auxResultado->registro.valor.resultado.c < 0) {
                            auxResultado->registro.valor.resultado.l = auxDirecoes->registro.cordenadas[1];
                            auxResultado->registro.valor.resultado.c = auxDirecoes->registro.cordenadas[0];
                        }
                    } else {
                        // se não zera os pontos
                        // voltar a palavra para o inicio
                        auxPalavra = *auxResultado->registro.valor.resultado.palavra;
                        auxResultado->registro.valor.resultado.pontos = 0;
                        auxResultado->registro.valor.resultado.l = -1;
                        auxResultado->registro.valor.resultado.c = -1;
                    }


                    if (auxResultado->registro.valor.resultado.pontos ==
                        auxResultado->registro.valor.resultado.tamanhoPalavra) {
                        // achou uma palabra
                        auxResultado->registro.valor.resultado.direcao = direcoes[d];
                        break;
                    }


                    // inverte a direcao
                    if (direcoes[d] == CIMA_ESQUERDA && auxDirecoes->nos[direcoes[d]] == NULL) {
                        (d++);
                    } else if (direcoes[d] == CIMA_DIREITA && auxDirecoes->nos[direcoes[d]] == NULL) {
                        (d++);
                    } else if (direcoes[d] == BAIXO && auxDirecoes->nos[direcoes[d]] == NULL) {

                        (d++);
                    } else if (direcoes[d] == DIREITA && auxColuna >= colunas) {
                        (d++);
                    }

                    auxDirecoes = auxDirecoes->nos[direcoes[d]];

                }

                if (auxResultado->registro.valor.resultado.pontos ==
                    auxResultado->registro.valor.resultado.tamanhoPalavra) {
                    break;
                }
            }


            if (auxResultado->registro.valor.resultado.pontos ==
                auxResultado->registro.valor.resultado.tamanhoPalavra) {
                break;
            }


            auxMatriz = auxMatriz->nos[DIREITA];
            if (colunaCount == colunas) {
                linhaCount++;
                colunaCount = 1;
            } else {
                colunaCount++;
            }
        }

        auxResultado = auxResultado->nos[DIREITA];
    }
    return listaDeResultados;
}


char *identificarDirecao(int direcao) {
    switch (direcao) {
        case CIMA:
            return "CIMA";
        case BAIXO:
            return "BAIXO";
        case ESQUERDA:
            return "ESQUERDA";
        case DIREITA:
            return "DIREITA";
        case CIMA_DIREITA:
            return "CIMA_DIREITA";
        case BAIXO_DIREITA:
            return "BAIXO_DIREITA";
        case BAIXO_ESQUERDA:
            return "BAIXO_ESQUERDA";
        case CIMA_ESQUERDA:
            return "CIMA_ESQUERDA";
        default:
            return "";
    }
}

Lista *carregarMatriz(char *matriz_arquivo) {

    Lista *matriz = criarLista();
    Registro regChar;
    FILE *arquivo;
    char c;
    int linha = 1;
    int coluna = 1;
    arquivo = fopen(matriz_arquivo, "r");

    if (arquivo == NULL) {
        puts("Arquivo da Matriz de Palavras não encontrado");
        return NULL;
    }

    regChar.tipo = CARACTERE;

    while ((c = (char) fgetc(arquivo)) != EOF) {

        if (c != '\n') { // quebra de linha
            regChar.valor.caractere = c;
            regChar.cordenadas[0] = linha;
            regChar.cordenadas[1] = coluna;
            inserirFinal(matriz, regChar);
            coluna++;
        } else {
            coluna = 1;
            linha++;
        }
    }
    fclose(arquivo);
    int colunas = verificarColunas(matriz_arquivo);

    ListaOitavamenteEncadeada(matriz, colunas);

    imprimirMatriz(matriz, colunas);

    return matriz;
}

char *convertePalavra(Lista *li) {
    No *no = (*li);
    int i = 0;
    int h = tamanhoLista(li);
    char *palavra = (char *) malloc((h * sizeof(char)));
    while (no) {
        palavra[i] = no->registro.valor.caractere;
        i++;
        no = no->nos[DIREITA];
    }
    palavra[i] = '\0';
    return palavra;
}

Lista *carregarPalavras(char *palavras) {

    Lista *palavra = criarLista();
    Lista *listaDePalavras = criarLista();
    char c;
    Registro regChar;
    Registro regLista;
    FILE *arquivo;

    arquivo = fopen(palavras, "r");
    if (arquivo == NULL) {
        puts("Arquivo de Palavras não encontrado");
        return NULL;
    }

    regLista.tipo = LISTA;
    regChar.tipo = CARACTERE;

    while ((c = (char) fgetc(arquivo)) != EOF) {
        if (c != '\n') {
            regChar.valor.caractere = c;
            inserirFinal(palavra, regChar);
        } else {
            regLista.valor.lista = palavra;
            inserirFinal(listaDePalavras, regLista);
            palavra = criarLista();
        }
    }

    regLista.valor.lista = palavra;
    inserirFinal(listaDePalavras, regLista);
    fclose(arquivo);

    return listaDePalavras;
}


int verificarColunas(char *matriz_arquivo) {

    FILE *arquivo;
    char c;
    int coluna = 0;
    arquivo = fopen(matriz_arquivo, "r");

    if (arquivo == NULL) {
        puts("Arquivo da Matriz de Palavras não encontrado");
        return -1;
    }


    while ((c = (char) fgetc(arquivo)) != EOF) {

        if (c != '\n') { // quebra de linha
            coluna++;
        } else {
            break;
        }

    }
    fclose(arquivo);


    return coluna;
}

void imprimirMatriz(Lista *li, int coluna) {

    No *aux = (*li);
    int c = 0;
    int tamanho = tamanhoLista(li);
    int i;
    printf("\n\t");
    for (i = 0; i < tamanho; i++) {
        printf("-----");
        if ((i + 1) >= coluna) {
            printf("-------");
            printf("\n");
            break;
        }
    }
    printf("\t|    ");
    for (i = 0; i < tamanho; i++) {
        if ((i + 1) < 10) {
            printf("| 0%d ", (i + 1));
        } else {
            printf("| %d ", (i + 1));
        }

        if ((i + 1) >= coluna) {
            printf(" |");
            printf("\n\t");
            break;
        }
    }

    for (i = 0; i < tamanho; i++) {

        printf("-----");
        if ((i + 1) >= coluna) {
            printf("-------");
            printf("\n\t");
            break;
        }
    }
    int comecoLinha = 1;
    int countLiha = 1;

    while (aux) {
        c++;
        if (comecoLinha) {

            if ((countLiha) < 10) {
                printf("| 0%d ", countLiha);
            } else {
                printf("| %d ", countLiha);
            }
            comecoLinha = 0;

        }

        printf("| %c  ", aux->registro.valor.caractere);


        if (c >= coluna) {
            c = 0;
            printf(" |");
            printf("\n\t");
            comecoLinha = 1;
            countLiha++;
            for (i = 0; i < tamanho; i++) {

                printf("-----");
                if ((i + 1) >= coluna) {
                    printf("-------");
                    printf("\n\t");
                    break;
                }
            }

        }

        aux = aux->nos[DIREITA];
    }
    printf("\n");

}
