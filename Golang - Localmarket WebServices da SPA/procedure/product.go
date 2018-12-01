package procedure

import (
    "fmt"
    "github.com/gin-gonic/gin"
)

type Product struct{}

func (Product) ImageUpload(ctx *gin.Context) {

    fmt.Print("não implementado :)")
}
