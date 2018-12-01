package middleware

import (
    "github.com/gin-gonic/gin"
    "encoding/json"
    "github.com/dsisconeto/localmarket/utils"
    "net/http"
)

func ErrorMessage() gin.HandlerFunc {
    return func(c *gin.Context) {
        c.Next()
        if len(c.Errors.Errors()) == 0 {
            return
        }
        switch c.Errors.Last().Err.(type) {
        case utils.ErrorBadRequest:
            c.Status(http.StatusBadRequest)
        case utils.ErrorInternalServeError:
            c.Status(http.StatusInternalServerError)
        case utils.ErrorNotFound:
            c.Status(http.StatusNotFound)
        case utils.ErrorUnprocessableEntity:
            c.Status(http.StatusUnprocessableEntity)
        default:
            c.Status(http.StatusInternalServerError)
        }
        errors := map[string][]string{
            "errors": c.Errors.Errors(),
        }
        jsonErrors, _ := json.Marshal(errors)
        c.Writer.Header().Set("Content-Type", "application/json")
        c.Writer.Write(jsonErrors)
    }
}
