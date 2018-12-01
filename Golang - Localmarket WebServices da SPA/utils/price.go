package utils

import "time"

type Price struct {
    Value     float64   `json:"value" bson:"value"`
    CreatedAt time.Time `json:"created_at" bson:"created_at"`
    ExpiryAt  time.Time `json:"expiry_at" bson:"expiry_at"`
    ExpiresIn time.Time `json:"expires_in" bson:"expires_in"`
}
