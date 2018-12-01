package database

import (
    "github.com/globalsign/mgo"
    "os"
    "time"
    "github.com/labstack/gommon/log"
)

var mongoSession *mgo.Session

func StartMongoSession() *mgo.Session {
    return GetMongoSession()
}

func GetMongoSession() (*mgo.Session) {
    if mongoSession != nil {
        return mongoSession
    }
    mongoDialInfo := &mgo.DialInfo{
        Addrs:    []string{os.Getenv("MONGO_DB_HOST")},
        Timeout:  60 * time.Second,
        Database: os.Getenv("MONGO_DB_NAME"),
    }
    session, err := mgo.DialWithInfo(mongoDialInfo)
    if err != nil {
        log.Fatal(err)
    }
    //// http://godoc.org/labix.org/v2/mgo#Session.SetMode
    session.SetMode(mgo.Monotonic, true)
    return session
}

func MongoDB() *mgo.Database {
    return GetMongoSession().Copy().DB("")
}
