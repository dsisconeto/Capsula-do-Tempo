package repository

import (
    "github.com/dsisconeto/localmarket/entity"
    "github.com/globalsign/mgo/bson"
    "time"
    "github.com/globalsign/mgo"
    "errors"
    "github.com/dsisconeto/localmarket/database"
)

type Department struct {
    Collection *mgo.Collection
}

func NewRepositoryDepartment(db *mgo.Database) *Department {
    return &Department{db.C(database.Departments)}
}

func (repo *Department) Store(d *entity.Department) error {
    d.ID = bson.NewObjectId()
    d.CreatedAt = time.Now()
    d.UpdatedAt = time.Now()
    return repo.Collection.Insert(d)
}
func (repo *Department) Update(d *entity.Department) error {
    d.UpdatedAt = time.Now()
    return repo.Collection.UpdateId(d.ID, d)
}

func (repo *Department) ValidateToStore(d *entity.Department) error {
    return repo.validateName(d)
}
func (repo *Department) ValidateToUpdate(d *entity.Department) error {
    return repo.validateName(d)
}

func (repo *Department) validateName(d *entity.Department) error {
    query := repo.Collection.Find(bson.M{"name": d.Name})
    count, _ := query.Count()
    if count == 0 {
        return nil
    }
    var d2 *entity.Department
    query.One(&d2)
    if d2.ID == d.ID {
        return nil
    }
    return errors.New("department already exists")
}
