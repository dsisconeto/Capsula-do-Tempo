package entity

import "github.com/go-ozzo/ozzo-validation"

type MarketAddress struct {
    Description string  `json:"description"`
    Latitude    float64 `json:"latitude"`
    Longitude   float64 `json:"longitude"`
    Estate      string  `json:"estate"`
    City        string  `json:"city"`
}

func (md *MarketAddress) Validate() error {
    return validation.ValidateStruct(md,
        validation.Field(&md.Description, validation.Required, validation.Length(5, 255)),
        validation.Field(&md.Latitude, validation.Required),
        validation.Field(&md.Longitude, validation.Required),
        validation.Field(&md.Estate, validation.Required),
        validation.Field(&md.City, validation.Required),
    )
}
