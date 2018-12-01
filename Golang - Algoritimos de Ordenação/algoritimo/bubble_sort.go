package algoritimo

func BubbleSort(vetor []int) {
	var i int
	troca := true
	for troca {
		troca = false
		for i = 0; i < len(vetor)-1; i++ {
			if vetor[i+1] < vetor[i] {
				vetor[i], vetor[i+1] = vetor[i+1], vetor[i]
				troca = true
			}
		}
	}
}
