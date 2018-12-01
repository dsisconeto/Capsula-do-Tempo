package resource

import (
    "github.com/gin-gonic/gin"
    "github.com/dsisconeto/localmarket/utils"
    "time"
    "github.com/dsisconeto/localmarket/entity"
    "github.com/globalsign/mgo"
    "github.com/dsisconeto/localmarket/repository"
)

func PruductPriceStore(ctx *gin.Context) {
    data := struct {
        ProductID string
        MarketID  string
        Price     float64
        ExpiresIn time.Time
    }{}
    product := new(entity.Product)
    market := new(entity.Market)
    price := new(utils.Price)
    price.ExpiresIn = data.ExpiresIn
    if err := ctx.Bind(&data); err != nil {
        ctx.Error(utils.NewErrorBadRequest())
        return
    }
    if err := utils.StringToObjectId(&product.ID, data.ProductID); err != nil {
        ctx.Error(utils.NewErrorBadRequest())
        return
    }
    if err := utils.StringToObjectId(&market.ID, data.MarketID); err != nil {
        ctx.Error(utils.NewErrorBadRequest())
        return
    }
    mongo := ctx.MustGet("mongo").(*mgo.Database)
    repoPrice := repository.NewProductPrice(mongo)
    repoProduct := repository.NewProduct(mongo)
    repoMarket := repository.NewMarket(mongo)

    if err := repoProduct.FindByID(product); err != nil {
        ctx.Error(utils.NewErrorNotFound())
        return
    }
    if err := repoMarket.FindByID(market); err != nil {
        ctx.Error(utils.NewErrorNotFound())
        return
    }
    productPrice := entity.NewProductPrice(product, market, price)
    if err := repoPrice.Store(productPrice); err != nil {
        ctx.Error(utils.NewErrorInternalServeError())
        return
    }

}
