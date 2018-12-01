package repository

import (
    "github.com/globalsign/mgo"
    "github.com/dsisconeto/localmarket/entity"
    "github.com/globalsign/mgo/bson"
    "time"
    "github.com/pkg/errors"
    "github.com/dsisconeto/localmarket/database"
)

type Market struct {
    Collection *mgo.Collection
}

func NewMarket(db *mgo.Database) *Market {
    return &Market{Collection: db.C(database.Markets)}
}

func (repo *Market) Store(m *entity.Market) error {
    m.ID = bson.NewObjectId()
    m.CreatedAt = time.Now()
    m.UpdatedAt = m.CreatedAt
    return repo.Collection.Insert(m)
}

func (repo *Market) Update(m *entity.Market) error {
    m.UpdatedAt = time.Now()
    return repo.Collection.UpdateId(m.ID, m)
}
func (repo *Market) FindByID(m *entity.Market) error {
    return repo.Collection.FindId(m.ID).One(m)
}

func (repo *Market) ValidateToStore(m *entity.Market) error {
    return repo.validateCNPJ(m)
}

func (repo *Market) ValidateToUpdate(m *entity.Market) error {
    return repo.validateCNPJ(m)
}

func (repo *Market) validateCNPJ(m *entity.Market) error {
    query := repo.Collection.Find(bson.M{"cnpj": m.CNPJ})
    count, _ := query.Count()
    if count == 0 {
        return nil
    }
    var market2 *entity.Market
    query.One(&market2)
    if market2.ID == m.ID {
        return nil
    }
    return errors.New("cnpj already exists")
}
