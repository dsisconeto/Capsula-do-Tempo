package entity

import (
    "github.com/globalsign/mgo/bson"
    "time"
    "github.com/go-ozzo/ozzo-validation"
)

type Department struct {
    ID        bson.ObjectId `json:"id,omitempty" bson:"_id,omitempty"`
    Name      string
    CreatedAt time.Time     `json:"created_at" bson:"created_at"`
    UpdatedAt time.Time     `json:"updated_at" bson:"updated_at"`
}

func (d *Department) Validate() error {
    return validation.ValidateStruct(d,
        validation.Field(&d.Name, validation.Required, validation.Length(5, 30)))
}
