package entity

import (
    "github.com/globalsign/mgo/bson"
    "time"
    "github.com/dsisconeto/localmarket/utils"
)

type ProductPrice struct {
    ID bson.ObjectId `json:"id" bson:"_id"`
    Product struct {
        ID bson.ObjectId `json:"id" bson:"id"`
    } `json:"product" bson:"product"`
    Market struct {
        ID   bson.ObjectId `json:"id" bson:"id"`
        Name string        `json:"name" bson:"name"`
    } `json:"market" bson:"market"`
    Price     *utils.Price   `json:"price" bson:"price"`
    Location  *utils.GeoJson `json:"location" bson:"location"`
    UpdatedAt time.Time      `json:"updated_at" bson:"updated_at"`
    CreatedAt time.Time      `json:"updated_at" bson:"updated_at"`
}

func NewProductPrice(product *Product, market *Market, price *utils.Price) *ProductPrice {
    pv := new(ProductPrice)
    pv.Product.ID = product.ID
    pv.Market.ID = market.ID
    pv.Market.Name = market.Name
    pv.Price = price
    pv.Location.Pointer(market.Address.Longitude, market.Address.Latitude)
    return pv
}
