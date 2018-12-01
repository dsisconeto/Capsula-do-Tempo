package vetor

import (
	"math/rand"
	"time"
)

type OrdemVetor int

type FuncaoSort func(vetor []int)

const (
	Aleatorio OrdemVetor = iota
	Crescente
	Decrescente
)

func Gerar(ordem OrdemVetor, n int) []int {
	switch ordem {
	case Aleatorio:
		{
			return aleatorio(n)
		}
	case Crescente:
		{
			return crescente(n)
		}

	default:
		{
			return decrescente(n)
		}
	}

}

func crescente(n int) []int {
	var vetor []int
	for i := 1; i <= n; i++ {
		vetor = append(vetor, i)
	}
	return vetor
}

func decrescente(n int) []int {
	var vetor []int
	for i := n; i >= 1; i-- {
		vetor = append(vetor, i)
	}
	return vetor

}

func aleatorio(n int) []int {
	sourceRand := rand.NewSource(time.Now().Unix())
	r := rand.New(sourceRand)
	vetor := make([]int, 0)
	for i := 1; i <= n; i++ {
		vetor = append(vetor, r.Intn(n))
	}
	return vetor
}

func (t OrdemVetor) String() string {

	switch t {
	case Aleatorio:
		return "aleatorio"
	case Crescente:
		return "crescente"
	default:
		return "decrescente"
	}
}
