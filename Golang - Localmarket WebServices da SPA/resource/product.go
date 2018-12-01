package resource

import (
    "net/http"
    "github.com/dsisconeto/localmarket/entity"
    "github.com/globalsign/mgo"
    "github.com/gin-gonic/gin"
    "github.com/dsisconeto/localmarket/repository"
    "github.com/dsisconeto/localmarket/utils"
)

func ProductStore(ctx *gin.Context) {
    p := new(entity.Product)
    if err := ctx.BindJSON(p); err != nil {
        ctx.Error(utils.NewErrorBadRequest())
        return
    }
    if err := p.Validate(); err != nil {
        ctx.Error(utils.NewErrorUnprocessableEntity(err.Error()))
        return
    }
    mongo := ctx.MustGet("mongo").(*mgo.Database)
    repo := repository.NewProduct(mongo)
    if errs := repo.ValidateToStore(p); len(errs) > 0 {
        for _, err := range errs {
            ctx.Error(utils.NewErrorUnprocessableEntity(err.Error()))
        }
        return
    }
    if err := repo.Store(p); err != nil {
        ctx.Error(utils.NewErrorInternalServeError())
        return
    }
    ctx.JSON(http.StatusCreated, p)
}

func ProductUpdate(ctx *gin.Context) {
    p := new(entity.Product)
    if err := utils.StringToObjectId(&p.ID, ctx.Param("id")); err != nil {
        ctx.Error(utils.NewErrorNotFound())
        return
    }
    if err := ctx.BindJSON(p); err != nil {
        ctx.Error(utils.NewErrorBadRequest())
        return
    }
    if err := p.Validate(); err != nil {
        ctx.Error(utils.NewErrorUnprocessableEntity(err.Error()))
        return
    }
    mongo := ctx.MustGet("mongo").(*mgo.Database)
    repo := repository.NewProduct(mongo)
    if errs := repo.ValidateToUpdate(p); len(errs) > 0 {
        for _, e := range errs {
            ctx.Error(utils.NewErrorUnprocessableEntity(e.Error()))
        }
        return
    }
    if err := repo.Update(p); err != nil {
        ctx.Error(utils.NewErrorInternalServeError())
        return
    }
    ctx.JSON(http.StatusNoContent, p)
}

func ProductShow(ctx *gin.Context) {
    mongo := ctx.MustGet("mongo").(*mgo.Database)
    repo := repository.NewProduct(mongo)
    p := new(entity.Product)
    if err := utils.StringToObjectId(&p.ID, ctx.Param("id")); err != nil {
        ctx.Error(utils.NewErrorNotFound())
        return
    }
    if err := repo.FindByID(p); err != nil {
        ctx.Error(utils.NewErrorInternalServeError())
        return
    }
    ctx.JSON(http.StatusOK, p)
}
