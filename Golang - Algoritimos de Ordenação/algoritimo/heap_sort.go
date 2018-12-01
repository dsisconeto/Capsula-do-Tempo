package algoritimo

func HeapSort(vetor []int) {
    var i int
    for i = (len(vetor) - 1) / 2; i >= 0; i-- {
        criarHep(vetor, i, len(vetor)-1)
    }
    for i = len(vetor) - 1; i >= 1; i-- {
        vetor[0], vetor[i] = vetor[i], vetor[0]
        criarHep(vetor, 0, i-1)
    }
}

func criarHep(vetor []int, indicePai int, final int) {
    valorPai := vetor[indicePai]
    indiceFilho := indicePai*2 + 1
    for indiceFilho <= final {
        if indiceFilho < final && vetor[indiceFilho] < vetor[indiceFilho+1] {
            indiceFilho += 1
        }
        if valorPai < vetor[indiceFilho] {
            vetor[indicePai] = vetor[indiceFilho]
            indicePai = indiceFilho
            indiceFilho = 2*indicePai + 1
        } else {
            indiceFilho = final + 1
        }
    }
    vetor[indicePai] = valorPai
}
