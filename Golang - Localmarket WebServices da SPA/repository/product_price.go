package repository

import (
    "github.com/globalsign/mgo"
    "time"
    "github.com/globalsign/mgo/bson"
    "github.com/dsisconeto/localmarket/entity"
    "github.com/dsisconeto/localmarket/database"
)

type ProductPrice struct {
    Collection *mgo.Collection
}

func NewProductPrice(c *mgo.Database) *ProductPrice {
    repo := new(ProductPrice)
    repo.Collection = c.C(database.ProductPrices)
    return repo
}

func (repo *ProductPrice) Store(price *entity.ProductPrice) error {
    price.CreatedAt = time.Now()
    price.ID = bson.NewObjectId()
    price.Price.CreatedAt = price.CreatedAt
    price.UpdatedAt = price.CreatedAt
    return repo.Collection.Insert(price)
}

// essa função deve guarda preço anterior
func (repo *ProductPrice) UpdatePrice(price *entity.ProductPrice) error {
    price.UpdatedAt = time.Now()
    price.Price.CreatedAt = time.Now()
    return repo.Collection.UpdateId(price.ID, bson.M{
        "$set": bson.M{"price": price.Price},
    })
}
