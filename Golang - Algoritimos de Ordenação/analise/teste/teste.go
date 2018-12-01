package teste

import (
	"fmt"
	"github.com/dsisconeto/algoritimos-ordenacao/analise/vetor"
	"log"
	"time"
)

type Testes struct {
	TestesAtomicos []*Teste
}

type Teste struct {
	TamanhoVetor int
	Duracacao    int64
}

func (Testes) execucao(vetor []int, funcao vetor.FuncaoSort) int64 {
	fmt.Printf("------ Entrada %d, %s\n", len(vetor), time.Now().Format(time.StampNano))
	inicio := time.Now()
	funcao(vetor)
	fim := time.Now()
	verifcarOrdenacao(vetor)
	return fim.Sub(inicio).Nanoseconds()
}

func verifcarOrdenacao(vetor []int) {
	for i, j := 0, 1; j < len(vetor); i, j = i+1, j+1 {
		if vetor[i] > vetor[j] {
			log.Fatalf("valor %d  é maior que %d,  logo o array não está ordenado, \n %v",
				vetor[i],
				vetor[j],
				vetor)
		}
	}
}

func (t *Testes) ExecutarTeste(vetor []int, funcao vetor.FuncaoSort) {
	duracao := t.execucao(vetor, funcao)
	t.TestesAtomicos = append(t.TestesAtomicos, &Teste{TamanhoVetor: len(vetor), Duracacao: duracao})
}
