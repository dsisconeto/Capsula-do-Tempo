package route

import (
    "github.com/gin-gonic/gin"
    "github.com/dsisconeto/localmarket/resource"
)

func resources(r *gin.Engine) {

    productResource(r)
    productPriceResource(r)
    marketResource(r)
    departmentResource(r)
    categoryResources(r)

}

func departmentResource(r *gin.Engine) {
    r.POST("/resource/department", resource.DepartmentStore)
    r.PUT("/resource/department", resource.DepartmentUpdate)
}

func categoryResources(r *gin.Engine) {
    r.POST("/resource/category", resource.CategoryStore)
}

func productPriceResource(r *gin.Engine) {

}

func productResource(r *gin.Engine) {
    r.POST("/resource/product", resource.ProductStore)
    r.PUT("/resource/product/:id", resource.ProductUpdate)
    r.GET("/resource/product/:id", resource.ProductShow)
    r.POST("/resource/category", resource.CategoryStore)
}

func marketResource(r *gin.Engine) {
    r.POST("/resource/market", resource.MarketStore)
    r.PUT("/resource/market", resource.MarketUpdate)

}
