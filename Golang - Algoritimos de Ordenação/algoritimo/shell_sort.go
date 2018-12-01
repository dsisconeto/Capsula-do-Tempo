package algoritimo

func ShellSort(vetor []int)  {
    for metadade := int(len(vetor)/2); metadade > 0; metadade /= 2 {
        for i := metadade; i < len(vetor); i++ {
            for j := i; j >= metadade && vetor[j-metadade] > vetor[j]; j -= metadade {
                vetor[j], vetor[j-metadade] = vetor[j-metadade], vetor[j]
            }
        }
    }
}
