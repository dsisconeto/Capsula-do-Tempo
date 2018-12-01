package resource

import (
    "github.com/gin-gonic/gin"
    "github.com/globalsign/mgo"
    "github.com/dsisconeto/localmarket/repository"
    "github.com/dsisconeto/localmarket/entity"
    "net/http"
    "github.com/dsisconeto/localmarket/utils"
)

func CategoryStore(ctx *gin.Context) {
    mongo := ctx.MustGet("mongo").(*mgo.Database)
    repo := repository.NewCategoryRepository(mongo)
    category := new(entity.Category)
    if err := ctx.Bind(&category); err != nil {
        ctx.Error(utils.NewErrorBadRequest())
        return
    }
    if err := category.Validate(); err != nil {
        ctx.Error(utils.NewErrorUnprocessableEntity(err.Error()))
        return
    }
    if err := repo.ValidateToStore(category); err != nil {
        ctx.Error(utils.NewErrorUnprocessableEntity(err.Error()))
        return
    }
    if err := repo.Store(category); err != nil {
        ctx.Error(utils.NewErrorInternalServeError())
        return
    }
    ctx.JSON(http.StatusOK, category)
}
