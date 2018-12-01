package utils

import (
    "github.com/globalsign/mgo/bson"
    "errors"
)

func StringToObjectId(id *bson.ObjectId, s string) error {
   if ok := bson.IsObjectIdHex(s); !ok {
       return errors.New("it's not object id")
   }
   *id = bson.ObjectIdHex(s)
   return nil
}
