package route

import (
    "github.com/gin-gonic/gin"
)

func Router(r * gin.Engine) {
    resources(r)
}
