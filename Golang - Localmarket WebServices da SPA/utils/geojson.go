package utils

//list the longitude first and then latitude
type GeoJson struct {
    Type        string    `json:"-" bson:"type"`
    Coordinates []float64 `json:"coordinates" bson:"coordinates"`
}

func (g *GeoJson) Pointer(longitude, latitude float64) {
    g.Type = "Point"
    //list the longitude first and then latitude
    g.Coordinates = append(g.Coordinates, longitude, latitude)
}
