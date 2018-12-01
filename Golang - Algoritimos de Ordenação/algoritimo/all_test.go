package algoritimo

import (
	"github.com/dsisconeto/algoritimos-ordenacao/analise/vetor"
	"testing"
)

func testarOrdernacao(algoritimo string, t *testing.T, funcao func(vetor []int) []int) {
	var vetoresTeste [][]int
	vetoresTeste = append(vetoresTeste,
		vetor.Gerar(vetor.Decrescente, 50000),
		vetor.Gerar(vetor.Crescente, 50000),
		vetor.Gerar(vetor.Aleatorio, 50000))

	for _, vetorTeste := range vetoresTeste {
		vetorTeste = funcao(vetorTeste)
		for i, j := 0, 1; j < len(vetorTeste); i, j = i+1, j+1 {
			if vetorTeste[i] > vetorTeste[j] {

				t.Fatalf("%s: valor %d  é maior que %d,  logo o array não está ordenado, \n %v",
					algoritimo,
					vetorTeste[i],
					vetorTeste[j],
					vetorTeste)
			}
		}
	}
}

func TestSelectionSortAleatorio(t *testing.T) {
	testarOrdernacao("SelectionSort", t, func(vetor []int) []int {
		SelectionSort(vetor)
		return vetor
	})
}

func TestBubbleSortAleatorio(t *testing.T) {
	testarOrdernacao("BubbleSort", t, func(vetor []int) []int {
		BubbleSort(vetor)
		return vetor
	})
}

func TestInsertionSortAleatorio(t *testing.T) {
	testarOrdernacao("InsertionSort", t, func(vetor []int) []int {
		InsertionSort(vetor)
		return vetor
	})
}

func TestMergerSortAleatorio(t *testing.T) {
	testarOrdernacao("MergerSort", t, func(vetor []int) []int {
		return MergerSort(vetor)
	})
}

func TestHeapSort(t *testing.T) {
	testarOrdernacao("HeapSort", t, func(vetor []int) []int {
		HeapSort(vetor)
		return vetor
	})
}

func TestQuickSort(t *testing.T) {
	testarOrdernacao("QuickSort", t, func(vetor []int) []int {
		return QuickSort(vetor)
	})
}
func TestCocktailSort(t *testing.T) {
	testarOrdernacao("CocktailSort", t, func(vetor []int) []int {
		CocktailSort(vetor)
		return vetor
	})
}

func TestCombSort(t *testing.T) {
	testarOrdernacao("CombSort", t, func(vetor []int) []int {
		CombSort(vetor)
		return vetor
	})
}

func TestGnomeSort(t *testing.T) {
	testarOrdernacao("GnomeSort", t, func(vetor []int) []int {
		GnomeSort(vetor)
		return vetor
	})
}

func TestShellSort(t *testing.T) {
	testarOrdernacao("ShellSort", t, func(vetor []int) []int {
		ShellSort(vetor)
		return vetor
	})
}

func TestQuickSortConcorrente(t *testing.T) {
	testarOrdernacao("QuickSortConcorrente", t, func(vetor []int) []int {
		return QuickSortConcorrente(vetor)

	})
}

func TestBucketSort(t *testing.T) {
	testarOrdernacao("BucketSort", t, func(vetor []int) []int {
		BucketSort(vetor)
		return vetor
	})
}

func TestCountingSort(t *testing.T) {
	testarOrdernacao("CountingSort", t, func(vetor []int) []int {
		CountingSort(vetor)
		return vetor
	})
}
