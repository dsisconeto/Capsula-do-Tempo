package algoritimo

func GnomeSort(vetor []int) {
	if len(vetor) < 2 {
		return
	}
	var proximo, anterior int
	for i := 0; i < len(vetor)-1; i++ {
		if vetor[i] > vetor[i+1] {
			anterior = i
			proximo = i + 1
			for vetor[anterior] > vetor[proximo] {
				vetor[anterior], vetor[proximo] = vetor[proximo], vetor[anterior]
				if anterior > 0 {
					anterior--
				}
				if proximo > 0 {
					proximo--
				}
			}
		}
	}

}
