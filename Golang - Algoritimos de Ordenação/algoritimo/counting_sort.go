package algoritimo

func CountingSort(vetor []int) {
	if len(vetor) == 0 {
		return
	}
	k := 0
	for _, v := range vetor {
		if v > k {
			k = v
		}
	}
	k += 1
	vetorCounts := make([]int, k)

	for i := 0; i < len(vetor); i++ {
		vetorCounts[vetor[i]] += 1
	}
	for i, j := 0, 0; i < k; i++ {
		for {
			if vetorCounts[i] > 0 {
				vetor[j] = i
				j += 1
				vetorCounts[i] -= 1
				continue
			}
			break
		}
	}
}
