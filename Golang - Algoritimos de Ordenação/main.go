package main

import (
	"github.com/dsisconeto/algoritimos-ordenacao/algoritimo"
	"github.com/dsisconeto/algoritimos-ordenacao/analise"
	"github.com/dsisconeto/algoritimos-ordenacao/analise/gochart"
)

const mil = 1000
const doisMil = 2 * mil
const cincoMil = 5 * mil
const oitoMil = 8 * mil
const dezMil = 2 * cincoMil
const quinzeMil = 2 * cincoMil
const vinteMil = 2 * dezMil
const cinquentaMil = 5 * dezMil
const cemMil = 2 * cinquentaMil
const duzentosMil = 2 * cemMil
const trezentossMil = duzentosMil + cemMil
const quatrocentosMil = duzentosMil + duzentosMil
const quinehtosMil = 5 * cemMil

func main() {
	analisar()
	gochart.ChartServer()
}

func analisar() {
	entradas := analise.NovaEntradas(dezMil, quinzeMil, vinteMil, cinquentaMil, cemMil, duzentosMil, trezentossMil, quatrocentosMil, quinehtosMil)
	var algoritimos []*analise.Algoritimo
	algoritimos = append(algoritimos,
		// analise.NovoAlgoritmo("BubbleSort", func(vetor []int) { algoritimo.BubbleSort(vetor) }),
		//  analise.NovoAlgoritmo("CocktailSort", func(vetor []int) { algoritimo.CocktailSort(vetor) }),
		// analise.NovoAlgoritmo("CombSort", func(vetor []int) { algoritimo.CombSort(vetor) }),
		// analise.NovoAlgoritmo("GnomeSort", func(vetor []int) { algoritimo.GnomeSort(vetor) }),
		analise.NovoAlgoritmo("InsertionSort", func(vetor []int) { algoritimo.InsertionSort(vetor) }),
		//   analise.NovoAlgoritmo("ShellSort", func(vetor []int) { algoritimo.ShellSort(vetor) }),
	)
	analise.Analisar(entradas, algoritimos)
}
