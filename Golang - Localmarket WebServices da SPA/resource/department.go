package resource

import (
    "github.com/gin-gonic/gin"
    "github.com/globalsign/mgo"
    "github.com/dsisconeto/localmarket/repository"
    "github.com/dsisconeto/localmarket/entity"
    "github.com/dsisconeto/localmarket/utils"
    "net/http"
)

func DepartmentStore(ctx *gin.Context) {
    mongo := ctx.MustGet("mongo").(*mgo.Database)
    repo := repository.NewRepositoryDepartment(mongo)
    var deparment *entity.Department
    if err := ctx.Bind(deparment); err != nil {
        ctx.Error(utils.NewErrorBadRequest())
        return
    }
    if err := deparment.Validate(); err != nil {
        ctx.Error(utils.NewErrorUnprocessableEntity(err.Error()))
        return
    }
    if err := repo.ValidateToStore(deparment); err != nil {
        ctx.Error(utils.NewErrorUnprocessableEntity(err.Error()))
        return
    }
    if err := repo.Store(deparment); err != nil {
        ctx.Error(err)
    }
    ctx.JSON(http.StatusCreated, deparment)
}

func DepartmentUpdate(ctx *gin.Context) {
    mongo := ctx.MustGet("mongo").(*mgo.Database)
    repo := repository.NewRepositoryDepartment(mongo)
    var deparment *entity.Department

    if err := utils.StringToObjectId(&deparment.ID, ctx.Param("id")); err != nil {
        ctx.Error(utils.NewErrorNotFound())
        return
    }
    if err := ctx.Bind(deparment); err != nil {
        ctx.Error(utils.NewErrorBadRequest())
        return
    }
    if err := deparment.Validate(); err != nil {
        ctx.Error(utils.NewErrorUnprocessableEntity(err.Error()))
        return
    }
    if err := repo.ValidateToUpdate(deparment); err != nil {
        ctx.Error(utils.NewErrorUnprocessableEntity(err.Error()))
        return
    }
    if err := repo.Update(deparment); err != nil {
        ctx.Error(utils.NewErrorInternalServeError())
    }
    ctx.JSON(http.StatusCreated, deparment)
}
