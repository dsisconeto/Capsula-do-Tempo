package algoritimo

import "sync"

func MergerSortConcorrente(vetor []int) []int {
	if len(vetor) < 2 {
		return vetor
	}
	meio := int(len(vetor) / 2)
	var wg sync.WaitGroup
	wg.Add(2)
	var v1, v2 []int

	go func() {
		defer func() {
			wg.Done()
		}()
		v1 = MergerSort(vetor[:meio])
	}()
	go func() {
		defer func() {
			wg.Done()
		}()
		v2 = MergerSort(vetor[meio:])
	}()
	wg.Wait()
	return merge(v1, v2)
}

func MergerSort(vetor []int) []int {
	if len(vetor) < 2 {
		return vetor
	}
	meio := int(len(vetor) / 2)
	var v1, v2 []int

	v1 = MergerSort(vetor[:meio])
	v2 = MergerSort(vetor[meio:])

	return merge(v1, v2)
}

func merge(v1, v2 []int) []int {
	v3 := make([]int, len(v1)+len(v2))
	var i, j int
	for i, j = 0, 0; i < len(v1) && j < len(v2); {
		if v1[i] <= v2[j] {
			v3[i+j] = v1[i]
			i++
		} else {
			v3[i+j] = v2[j]
			j++
		}
	}
	for i < len(v1) {
		v3[i+j] = v1[i]
		i++
	}
	for j < len(v2) {
		v3[i+j] = v2[j]
		j++
	}
	return v3
}
