package repository

import (
    "github.com/globalsign/mgo"
    "github.com/dsisconeto/localmarket/entity"
    "github.com/globalsign/mgo/bson"
    "fmt"
    "time"
    "github.com/dsisconeto/localmarket/database"
)

type Product struct {
    Collection *mgo.Collection
}

func NewProduct(c *mgo.Database) *Product {
    repo := new(Product)
    repo.Collection = c.C(database.Products)
    return repo
}

func (repo *Product) Store(p *entity.Product) error {
    p.ID = bson.NewObjectId()
    p.CreatedAt = time.Now()
    p.UpdatedAt = p.CreatedAt
    return repo.Collection.Insert(p)
}

func (repo *Product) Update(p *entity.Product) error {
    p.UpdatedAt = time.Now()
    return repo.Collection.UpdateId(p.ID, p)
}

func (repo *Product) FindByID(p *entity.Product) error {
    return repo.Collection.FindId(p.ID, ).One(&p)
}

func (repo *Product) ValidateToUpdate(p *entity.Product) []error {
    return repo.ValidateToStore(p)
}

func (repo *Product) ValidateToStore(p *entity.Product) []error {
    errors := make([]error, 0)

    if err := repo.validateName(p); err != nil {
        errors = append(errors, err)
    }
    if err := repo.validateCode(p); err != nil {
        errors = append(errors, err)
    }

    if err := repo.validateCategories(p); err != nil {
        errors = append(errors, err)
    }

    if err := repo.validateDepartment(p); err != nil {
        errors = append(errors, err)
    }
    return errors
}

// verifica se não existe outro produto com mesmo nome ou código
func (repo *Product) validateName(p *entity.Product) error {
    query := repo.Collection.Find(bson.M{"name": p.Name}).Limit(1)
    count, _ := query.Count()
    if count == 0 {
        return nil
    }
    var p2 *entity.Product
    query.One(&p2)
    if p.ID == p2.ID {
        return nil
    }
    return fmt.Errorf("there is a product with this name")
}

func (repo *Product) validateCode(p *entity.Product) error {
    query := repo.Collection.Find(bson.M{"name": p.Name}).Limit(1)
    count, _ := query.Count()
    if count == 0 {
        return nil
    }
    var p2 *entity.Product
    query.One(&p2)
    if p.ID == p2.ID {
        return nil
    }
    return fmt.Errorf("there is a product with this code")
}

// verifica se existe uma deparmento de com esse nome
func (repo *Product) validateDepartment(p *entity.Product) error {
    collection := repo.Collection.Database.C("departments")
    count, err := collection.Find(bson.M{"name": p.Department}).Limit(1).Count()
    if err != nil || count == 0 {
        return fmt.Errorf("deparment %s does not exist", p.Department)
    }
    return nil
}

// verifica se todas as categorias existem no banco de dados
func (repo *Product) validateCategories(p *entity.Product) error {
    collection := repo.Collection.Database.C("categories")
    for _, category := range p.Categories {
        count, err := collection.Find(bson.M{"name": category}).Limit(1).Count()
        if err == nil && count != 0 {
            continue
        }
        return fmt.Errorf("category %s does not exist", category)
    }
    return nil
}
