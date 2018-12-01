package algoritimo

func CombSort(vetor []int) {
	var i, intervalo int
	trocado := true
	for trocado {
		trocado = false
		intervalo = int(float64(intervalo) / 1.247330950103979)
		if intervalo == 9 || intervalo == 10 {
			intervalo = 11
		}
		if intervalo < 1 {
			intervalo = 1
		}
		for i = 0; (intervalo + i) < len(vetor); i++ {
			if vetor[i] > vetor[i+intervalo] {
				trocado = true
				vetor[i], vetor[intervalo+i] = vetor[intervalo+i], vetor[i]
			}
		}

	}
}
