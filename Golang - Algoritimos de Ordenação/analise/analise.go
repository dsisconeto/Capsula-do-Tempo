package analise

import (
	"fmt"
	"github.com/dsisconeto/algoritimos-ordenacao/analise/teste"
	"github.com/dsisconeto/algoritimos-ordenacao/analise/vetor"
	"time"
)

type Algoritimo struct {
	nome        string
	funcao      vetor.FuncaoSort
	crescente   *teste.Testes
	aleatorio   *teste.Testes
	decrescente *teste.Testes
}
type Entradas struct {
	tamanhoEntradas []int
	aleatorias      [][]int
	crescentes      [][]int
	decrescentes    [][]int
}

func NovoAlgoritmo(nome string, funcao vetor.FuncaoSort) *Algoritimo {
	return &Algoritimo{nome: nome, funcao: funcao}
}

func NovaEntradas(tamahhoVetores ...int) *Entradas {
	en := &Entradas{}
	en.tamanhoEntradas = tamahhoVetores
	for _, entrada := range en.tamanhoEntradas {
		en.crescentes = append(en.crescentes, vetor.Gerar(vetor.Crescente, entrada))
		en.aleatorias = append(en.aleatorias, vetor.Gerar(vetor.Aleatorio, entrada))
		en.decrescentes = append(en.decrescentes, vetor.Gerar(vetor.Decrescente, entrada))
	}
	return en
}

func Analisar(en *Entradas, algoritmos []*Algoritimo) {
	switch len(algoritmos) {
	case 0:
		return
	case 1:
		algoritmos[0].analisarAlgoritmo(en)
		GerarGrafico(en, algoritmos[0])
	default:
		analisarMuitos(en, algoritmos)
		GerarGraficos(en, algoritmos)
	}
}

func analisarMuitos(en *Entradas, algoritmos []*Algoritimo) {
	for _, algo := range algoritmos {
		algo.analisarAlgoritmo(en)
	}
}

func (algo *Algoritimo) analisarAlgoritmo(en *Entradas) {
	fmt.Printf("------------------------- Iniando analise do algoritimo %s as %s -----------------\n\n", algo.nome, time.Now())
	algo.aleatorio = &teste.Testes{}
	algo.crescente = &teste.Testes{}
	algo.decrescente = &teste.Testes{}
	for i := 0; i < len(en.tamanhoEntradas); i++ {
		algo.aleatorio.ExecutarTeste(en.aleatorias[i], algo.funcao)
		algo.crescente.ExecutarTeste(en.crescentes[i], algo.funcao)
		algo.decrescente.ExecutarTeste(en.crescentes[i], algo.funcao)
	}
}
