using LocalMarket.WebApi.Entities.Geo;

namespace LocalMarket.WebApi.Entities
{
    public class Market
    {
        public long Id { get; set; }
        public string Name { get; set; }
        public Address Address { get; set; }
        public long AddressId { get; set; }
    }
}