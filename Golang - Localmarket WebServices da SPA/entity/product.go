package entity

import (
    "time"
    "github.com/globalsign/mgo/bson"
    "github.com/go-ozzo/ozzo-validation"
    "regexp"
    "github.com/dsisconeto/localmarket/utils/regex"
)

type Product struct {
    ID         bson.ObjectId `json:"id" bson:"_id"`
    Name       string        `json:"name" bson:"name"`
    Categories []string      `json:"categories" bson:"categories"`
    Department string        `json:"department" bson:"department"`
    IMG        string        `json:"img" bson:"img"`
    Code       string        `json:"code" bson:"code"`
    CreatedAt  time.Time     `json:"created_at" bson:"created_at"`
    UpdatedAt  time.Time     `json:"updated_at" bson:"updated_at"`
}

func (p *Product) Validate() error {
    return validation.ValidateStruct(p,
        validation.Field(&p.Name, validation.Required, validation.Length(2, 100)),
        validation.Field(&p.Categories, validation.Required, validation.Length(1, 10)),
        validation.Field(&p.Department, validation.Required),
        validation.Field(&p.Code, validation.Required),
        validation.Field(&p.IMG, validation.Match(regexp.MustCompile(regex.FileName))),
    )
}
