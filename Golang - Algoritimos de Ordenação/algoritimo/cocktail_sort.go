package algoritimo

func CocktailSort(vetor []int) {
    for i, aux := 0, 0; i < len(vetor)/2; i++ {
        esquerda := 0
        direita := len(vetor) - 1
        for esquerda <= direita {
            if vetor[esquerda] > vetor[esquerda+1] {
                aux = vetor[esquerda]
                vetor[esquerda] = vetor[esquerda+1]
                vetor[esquerda+1] = aux
            }
            esquerda++
            if vetor[direita-1] > vetor[direita] {
                aux = vetor[direita-1]
                vetor[direita-1] = vetor[direita]
                vetor[direita] = aux
            }
            direita--
        }
    }
}
