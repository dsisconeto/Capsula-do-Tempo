namespace LocalMarket.WebApi.Entities.Geo
{
    public class City
    {
        public long CityId { get; set; }
        public string Name { get; set; }
        public State State { get; set; }
        public long StateId { get; set; }
    }
}