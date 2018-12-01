package database

import (
    "github.com/globalsign/mgo"
)

func CreateIndexes() {
    db := MongoDB()
    db.C(Categories).EnsureIndex(mgo.Index{
        Key:        []string{"name"},
        Unique:     true,
        DropDups:   true,
        Background: true,
        Sparse:     true,
    })
    db.C(Departments).EnsureIndex(mgo.Index{
        Key:        []string{"name"},
        Unique:     true,
        DropDups:   true,
        Background: true,
        Sparse:     true,
    })
    db.C(Products).EnsureIndex(mgo.Index{
        Key:        []string{"name"},
        Unique:     true,
        DropDups:   true,
        Background: true,
        Sparse:     true,
    })
    db.C(ProductPrices).EnsureIndex(mgo.Index{
        Key:        []string{"$2dsphere:location"},
        Unique:     false,
        DropDups:   false,
        Background: true,
        Sparse:     true,
    })
}
