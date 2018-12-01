package entity

import (
    "github.com/globalsign/mgo/bson"
    "time"
    "github.com/go-ozzo/ozzo-validation"
)

type Category struct {
    ID        bson.ObjectId `json:"id,omitempty" bson:"_id,omitempty"`
    Name      string        `json:"name" bson:"name"`
    CreatedAt time.Time     `json:"created_at" bson:"created_at"`
    UpdatedAt time.Time     `json:"updated_at" bson:"updated_at"`
}

func (c *Category) Validate() error {
    return validation.ValidateStruct(c,
        validation.Field(&c.Name, validation.Required, validation.Length(2, 30)))
}
