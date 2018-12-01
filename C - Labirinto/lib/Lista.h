#define CARACTERE 1
#define REAL 2
#define INTEIRO 3
#define LITERAL 4
#define RESULTADO
#define LISTA 5
#define BAIXO 0
#define CIMA 1
#define DIREITA 2
#define ESQUERDA 3
#define CIMA_ESQUERDA 4
#define BAIXO_DIREITA 5
#define CIMA_DIREITA 6
#define BAIXO_ESQUERDA 7


typedef struct noLista *Lista;
typedef struct noLista NoLista;

typedef struct registroLista {
    int cordenadas[2];
    int tipo;
    union {
        int inteiro;
        char caractere;
        float real;
        char *liral;
        Lista *lista;
    } valor;
} RegLista;

struct noLista {
    NoLista *nos[8];
    RegLista registro;
};

Lista *criarLista();

void liberarLista(Lista *li);

int tamanhoLista(Lista *li);

int listaVazia(Lista *li);

int inserirInicio(Lista *li, RegLista reg);

int inserirFinal(Lista *li, RegLista reg);

int inserirOrdenado(Lista *li, RegLista reg);

int removerInicio(Lista *li);

int removerFinal(Lista *li);

int removerLista(Lista *li, int matricula);


void ListaOitavamenteEncadeada(Lista *li, int coluna);

char * definirDirecao(int direcao);

void andarPara(NoLista *no, int direcao);

void imprimirListaDeLista(Lista *li);
