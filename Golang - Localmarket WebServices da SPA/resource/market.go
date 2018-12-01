package resource

import (
    "github.com/gin-gonic/gin"
    "github.com/globalsign/mgo"
    "github.com/dsisconeto/localmarket/repository"
    "github.com/dsisconeto/localmarket/entity"
    "github.com/dsisconeto/localmarket/utils"
    "net/http"
)

func MarketStore(ctx *gin.Context) {
    mongo := ctx.MustGet("mongo").(*mgo.Database)
    repo := repository.NewMarket(mongo)
    var market *entity.Market
    if err := ctx.Bind(&market); err != nil {
        ctx.Error(utils.NewErrorBadRequest())
        return
    }
    if err := market.Validate(); err != nil {
        ctx.Error(utils.NewErrorUnprocessableEntity(err.Error()))
        return
    }
    if err := repo.ValidateToStore(market); err != nil {
        ctx.Error(utils.NewErrorUnprocessableEntity(err.Error()))
        return
    }
    if err := repo.Store(market); err != nil {
        ctx.Error(utils.NewErrorInternalServeError())
    }
    ctx.JSON(http.StatusCreated, market)
}

func MarketUpdate(ctx *gin.Context) {
    mongo := ctx.MustGet("mongo").(*mgo.Database)
    repo := repository.NewMarket(mongo)
    var market *entity.Market
    if err := utils.StringToObjectId(&market.ID, ctx.Param("id")); err != nil {
        ctx.Error(utils.NewErrorNotFound())
        return
    }
    if err := ctx.Bind(&market); err != nil {
        ctx.Error(utils.NewErrorBadRequest())
        return
    }
    if err := market.Validate(); err != nil {
        ctx.Error(utils.NewErrorUnprocessableEntity(err.Error()))
        return
    }
    if err := repo.ValidateToUpdate(market); err != nil {
        ctx.Error(utils.NewErrorUnprocessableEntity(err.Error()))
        return
    }
    if err := repo.Update(market); err != nil {
        ctx.Error(utils.NewErrorInternalServeError())
    }
    ctx.JSON(http.StatusNoContent, market)
}
