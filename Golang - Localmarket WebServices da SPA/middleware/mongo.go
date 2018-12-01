package middleware

import (
    "github.com/gin-gonic/gin"
    "github.com/dsisconeto/localmarket/database"
)

func MiddlewareMongo() gin.HandlerFunc {
    return func(c *gin.Context) {
        mongo := database.MongoDB()
        defer mongo.Session.Close()
        c.Set("mongo", mongo)
        c.Next()

    }
}
