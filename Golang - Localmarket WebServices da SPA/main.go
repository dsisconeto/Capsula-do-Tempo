package main

import (
    "github.com/joho/godotenv"
    "log"
    "github.com/gin-gonic/gin"
    "os"
    "github.com/dsisconeto/localmarket/middleware"
    "github.com/dsisconeto/localmarket/database"
    "github.com/dsisconeto/localmarket/route"
)

func main() {
    err := godotenv.Load("./.env")
    if err != nil {
        log.Fatal(err)
    }
    mongo := database.StartMongoSession()
    defer mongo.Close()
    database.CreateIndexes()
    r := gin.Default()
    route.Router(r)
    r.Use(middleware.MiddlewareMongo())
    r.Use(middleware.ErrorMessage())
    r.Run(":" + os.Getenv("SERVER_PORT"))
}
