package analise

import (
	"fmt"
	"github.com/dsisconeto/algoritimos-ordenacao/analise/teste"
	"log"
	"os"
	"text/template"
)

const templateGrafico string = `
ChartType = spline
Title = {{.Titulo}}
SubTitle = 
ValueSuffix = 
Height = 400
XAxisNumbers = {{range $i, $tamanhoEntrada := .TamanhoEntradas  }}{{$tamanhoEntrada}},{{end}}

# The y Axis text
YAxisText = Nanosegundos
# The data and the name of the lines
{{range $i, $algo := .Algos  }}
Data|{{$algo.Nome}} = {{range $j, $teste := $algo.Testes.TestesAtomicos }} {{$teste.Duracacao}},{{end}}
{{end}}`

type algoGrafico struct {
	Nome   string
	Testes *teste.Testes
}
type dadosGrafico struct {
	Titulo          string
	TamanhoEntradas []int
	Algos           []*algoGrafico
}

func GerarGraficos(en *Entradas, algoritmos []*Algoritimo) {
	tpl := criarTemplate()
	graficoAleatorio := criarArquivo("Aleatorio")
	graficoCrescente := criarArquivo("Crescente")
	graficoDecrescente := criarArquivo("Decrescente")

	defer func() {
		graficoAleatorio.Close()
		graficoCrescente.Close()
		graficoDecrescente.Close()
	}()

	var algGraAleatorio []*algoGrafico
	var algGraCrescente []*algoGrafico
	var algGraDecrescente []*algoGrafico

	for _, algo := range algoritmos {
		algGraAleatorio = append(algGraAleatorio, &algoGrafico{
			Nome:   algo.nome,
			Testes: algo.aleatorio,
		})
		algGraCrescente = append(algGraCrescente, &algoGrafico{
			Nome:   algo.nome,
			Testes: algo.crescente,
		})
		algGraDecrescente = append(algGraDecrescente, &algoGrafico{
			Nome:   algo.nome,
			Testes: algo.decrescente,
		})
	}

	tpl.Execute(graficoAleatorio, dadosGrafico{
		Titulo:          "Aleatorio",
		TamanhoEntradas: en.tamanhoEntradas,
		Algos:           algGraAleatorio,
	})

	tpl.Execute(graficoCrescente, dadosGrafico{
		Titulo:          "Crescente",
		TamanhoEntradas: en.tamanhoEntradas,
		Algos:           algGraCrescente,
	})

	tpl.Execute(graficoDecrescente, dadosGrafico{
		Titulo:          "Decrescente",
		TamanhoEntradas: en.tamanhoEntradas,
		Algos:           algGraDecrescente,
	})
}

func GerarGrafico(en *Entradas, algo *Algoritimo) {
	tpl := criarTemplate()
	grafico := criarArquivo(algo.nome)
	defer func() {
		grafico.Close()
	}()

	var algoGra []*algoGrafico
	algoGra = append(algoGra,
		&algoGrafico{
			Nome:   "Aleatorio",
			Testes: algo.aleatorio,
		},
		&algoGrafico{
			Nome:   "Crescente",
			Testes: algo.crescente,
		},
		&algoGrafico{
			Nome:   "Decrescente",
			Testes: algo.decrescente,
		},
	)

	tpl.Execute(grafico, dadosGrafico{
		Titulo:          algo.nome,
		TamanhoEntradas: en.tamanhoEntradas,
		Algos:           algoGra,
	})

}

func criarArquivo(nome string) *os.File {
	f, err := os.Create(fmt.Sprintf("./graficos/%s.chart", nome))
	if err != nil {
		log.Fatal(err)
	}
	return f
}

func criarTemplate() *template.Template {
	tpl, err := template.New("grafico").Parse(templateGrafico)
	if err != nil {
		log.Fatal(err)
	}
	return tpl
}
