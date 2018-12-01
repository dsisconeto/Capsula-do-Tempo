using System.Collections.Generic;
using System.Linq;
using LocalMarket.WebApi.Entities.Products;
using Microsoft.EntityFrameworkCore;

namespace LocalMarket.WebApi.Repositories
{
    public class PriceRepository : AbstractRepository<Price>
    {
        protected PriceRepository(DatabaseContext context) : base(context)
        {

        }

        public List<Price> FindByProductAndCity(long productId, long cityId)
        {
            return _context.Prices
                           .Include(p => p.Market)
                           .Include(p => p.Market.Address)
                           .Where(p => p.ProductId.Equals(productId) && p.Market.Address.CityId.Equals(cityId)).ToList();
        }

        public List<Price> FindByProductsAndCity(List<long> productIds, long cityId)
        {
            return _context.Prices
                .Include(p => p.Market)
                .Include(p => p.Market.Address)
                .Where(p => productIds.Contains(p.Id))
                .Where(p => p.Market.Address.CityId.Equals(cityId))
                .ToList();
        }







    }
}