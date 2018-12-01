#include "../lib/labinrinto.h"

int main() {


    Labirinto *lab = carregarLabirinto("maze.txt");
    imprimrLabirinto(lab);

    Pilha *caminho = percorrerLabirinto(lab);
    lab = carregarLabirinto("maze.txt");
    marcaCaminho(caminho, lab);
    imprimrLabirinto(lab);

    return 1;

}