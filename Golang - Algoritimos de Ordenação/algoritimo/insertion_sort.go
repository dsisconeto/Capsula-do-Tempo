package algoritimo

func InsertionSort(vetor []int) {
	var i, j, corrente int
	for i = 1; i < len(vetor); i++ {
		corrente = vetor[i]
		for j = i - 1; j >= 0 && corrente < vetor[j]; j-- {
			vetor[j+1] = vetor[j]
		}
		vetor[j+1] = corrente
	}

}
