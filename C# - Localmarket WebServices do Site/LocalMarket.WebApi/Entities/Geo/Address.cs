namespace LocalMarket.WebApi.Entities.Geo
{
    public class Address
    {
        public long Id { get; set; }
        public string Description { get; set; }
        public long CityId { get; set; }
        public City City { get; set; }


    }
}