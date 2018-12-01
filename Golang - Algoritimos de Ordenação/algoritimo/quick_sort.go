package algoritimo

import (
	"math/rand"
	"sync"
)

func QuickSortConcorrente(vetor []int) []int {
	if len(vetor) <= 1 {
		return vetor
	}
	mediana := vetor[rand.Intn(len(vetor))]
	parteMenor := make([]int, 0, len(vetor))
	parteMaior := make([]int, 0, len(vetor))
	parteMeio := make([]int, 0, len(vetor))

	for i := 0; i < len(vetor); i++ {
		switch {
		case vetor[i] < mediana:
			parteMenor = append(parteMenor, vetor[i])
		case vetor[i] == mediana:
			parteMeio = append(parteMeio, vetor[i])
		case vetor[i] > mediana:
			parteMaior = append(parteMaior, vetor[i])
		}
	}
	var wg sync.WaitGroup
	wg.Add(2)
	go func() {
		defer func() {
			wg.Done()
		}()
		parteMenor = QuickSort(parteMenor)
	}()
	go func() {
		defer func() {
			wg.Done()
		}()
		parteMaior = QuickSort(parteMaior)
	}()
	wg.Wait()
	parteMenor = append(parteMenor, parteMeio...)
	parteMenor = append(parteMenor, parteMaior...)

	return parteMenor
}

func QuickSort(vetor []int) []int {
	if len(vetor) <= 1 {
		return vetor
	}
	mediana := vetor[rand.Intn(len(vetor))]
	parteMenor := make([]int, 0, len(vetor))
	parteMaior := make([]int, 0, len(vetor))
	parteMeio := make([]int, 0, len(vetor))

	for i := 0; i < len(vetor); i++ {
		switch {
		case vetor[i] < mediana:
			parteMenor = append(parteMenor, vetor[i])
		case vetor[i] == mediana:
			parteMeio = append(parteMeio, vetor[i])
		case vetor[i] > mediana:
			parteMaior = append(parteMaior, vetor[i])
		}
	}

	parteMenor = QuickSort(parteMenor)
	parteMaior = QuickSort(parteMaior)

	parteMenor = append(parteMenor, parteMeio...)
	parteMenor = append(parteMenor, parteMaior...)

	return parteMenor
}
