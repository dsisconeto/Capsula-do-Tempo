using System.Collections.Generic;
using System.Linq;
using LocalMarket.WebApi.Entities.Products;
using Newtonsoft.Json;

namespace LocalMarket.WebApi.ValueObjects.GraphPrice
{
    public class GraphPrice
    {
        [JsonIgnore]
        private readonly Dictionary<long, Node> _markets = new Dictionary<long, Node>();

        public List<Node> Markets => _markets.Values.ToList();

        public void AddPrice(Price price)
        {
            if (_markets.ContainsKey(price.Market.Id) == false)
            {
                _markets.Add(price.Market.Id, new Node(price.Market));
            }

            _markets[price.Market.Id].AddPrice(price);
        }



     




    }
}