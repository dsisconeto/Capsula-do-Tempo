package entity

import (
    "github.com/globalsign/mgo/bson"
    "time"
    "github.com/go-ozzo/ozzo-validation"
)

type Market struct {
    ID        bson.ObjectId  `json:"id" bson:"_id"`
    Name      string         `json:"name" bson:"name"`
    CNPJ      string         `json:"cnpj" bson:"cnpj"`
    Address   *MarketAddress `json:"address" bson:"address"`
    CreatedAt time.Time      `json:"created_at" bson:"created_at"`
    UpdatedAt  time.Time      `json:"updated_at" bson:"updated_at"`
}

func (m *Market) Validate() error {
    return validation.ValidateStruct(m,
        validation.Field(&m.Name, validation.Required, validation.Length(2, 250)),
        validation.Field(&m.CNPJ, validation.Required),
        validation.Field(m.Address.Validate()),
    )
}
