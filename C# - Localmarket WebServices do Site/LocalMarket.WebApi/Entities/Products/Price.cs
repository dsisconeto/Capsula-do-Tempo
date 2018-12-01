using System;
using LocalMarket.WebApi.Common.Enum;

namespace LocalMarket.WebApi.Entities.Products
{
    public class Price
    {
        public long Id { get; set; }
        public decimal Amount { get; set; }
        public int Quantity { get; set; }
        public DateTime ExpireAt { get; set; }
        public Market Market { get; set; }
        public long ProductId { get; set; }
        public long MarketId { get; set; }
        public Product Product { get; set; }
        public Status Status { get; set; }
    }
}