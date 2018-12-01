package utils

type (
    ErrorHTTP struct {
        message string
    }
    ErrorNotFound struct {
        ErrorHTTP
    }
    ErrorBadRequest struct {
        ErrorHTTP
    }
    ErrorInternalServeError struct {
        ErrorHTTP
    }
    ErrorUnprocessableEntity struct {
        ErrorHTTP
    }
)

func NewErrorNotFound() error {
    return ErrorNotFound{ErrorHTTP{message: "404 not found"}}
}

func NewErrorBadRequest() error {
    return ErrorBadRequest{ErrorHTTP{message: "400 bad request"}}

}

func NewErrorInternalServeError() error {
    return ErrorInternalServeError{ErrorHTTP{message: "500 internal serve error"}}
}

func NewErrorUnprocessableEntity(err string) error {
    return ErrorUnprocessableEntity{ErrorHTTP{message: err}}
}

func (e ErrorHTTP) Error() string {
    return e.message
}
