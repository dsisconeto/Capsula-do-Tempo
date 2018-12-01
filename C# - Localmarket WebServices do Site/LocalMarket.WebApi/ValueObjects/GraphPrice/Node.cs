using System.Collections.Generic;
using LocalMarket.WebApi.Entities;
using LocalMarket.WebApi.Entities.Products;

namespace LocalMarket.WebApi.ValueObjects.GraphPrice
{
    public class Node
    {
        public Market Market { get; }
        public List<Price> Prices { get; } = new List<Price>();
        public Node(Market market)
        {
            Market = market;
        }

        public void AddPrice(Price price)
        {
            Prices.Add(price);
        }
    }
}