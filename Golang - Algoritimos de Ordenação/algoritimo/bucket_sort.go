package algoritimo

const bucketSize = 50

func BucketSort(vetor []int) {
	var maiorValor int
	for _, valor := range vetor {
		if valor > maiorValor {
			maiorValor = valor
		}
	}

	numeroBaldes := int(maiorValor)/bucketSize + 1
	buckets := make([][]int, numeroBaldes)
	for _, valor := range vetor {
		idx := valor / bucketSize
		buckets[idx] = append(buckets[idx], valor)
	}
	i := 0
	for _, bucket := range buckets {
		if len(bucket) > 1 {
			InsertionSort(bucket)
		}
		for _, valor := range bucket {
			vetor[i] = valor
			i++
		}
	}
}
