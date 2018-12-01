package repository

import (
    "github.com/globalsign/mgo"
    "github.com/dsisconeto/localmarket/entity"
    "github.com/globalsign/mgo/bson"
    "fmt"
    "time"
    "github.com/dsisconeto/localmarket/database"
)

type Category struct {
    Collection *mgo.Collection
}

func NewCategoryRepository(c *mgo.Database) *Category {
    repo := new(Category)
    repo.Collection = c.C(database.Categories)
    return repo
}

func (repo *Category) Store(c *entity.Category) error {
    c.ID = bson.NewObjectId()
    c.CreatedAt = time.Now()
    c.UpdatedAt = c.CreatedAt
    return repo.Collection.Insert(c)
}

func (repo *Category) Update(c *entity.Category) error {
    c.UpdatedAt = time.Now()
    err := repo.Collection.UpdateId(c.ID, c)
    if err != nil {
        return err
    }
    return nil
}

func (repo *Category) Show(c *entity.Category) error {
    return repo.Collection.FindId(c.ID, ).One(&c)
}

func (repo *Category) ValidateToUpdate(c *entity.Category) error {
    return repo.ValidateToStore(c)
}

func (repo *Category) ValidateToStore(c *entity.Category) error {
    return repo.validateName(c)
}

// verifica se categoria já existe no banco de dados
func (repo *Category) validateName(c *entity.Category) error {
    collection := repo.Collection
    query := collection.Find(bson.M{"name": c.Name}).Limit(1)
    count, err := query.Count()
    if count == 0 || err == nil {
        return nil
    }
    var c2 entity.Category
    query.One(&c2)
    if c2.ID != c.ID {
        return fmt.Errorf("category already exists")
    }
    return nil
}
