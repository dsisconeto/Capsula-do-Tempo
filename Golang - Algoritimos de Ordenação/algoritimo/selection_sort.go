package algoritimo

func SelectionSort(vetor []int) {
	var i, j, min int
	for i = 0; i < len(vetor)-1; i++ {
		min = i
		for j = i + 1; j < len(vetor); j++ {
			if vetor[j] < vetor[min] {
				min = j
			}
		}
		if vetor[i] != vetor[min] {
			vetor[i], vetor[min] = vetor[min], vetor[i]
		}
	}

}
