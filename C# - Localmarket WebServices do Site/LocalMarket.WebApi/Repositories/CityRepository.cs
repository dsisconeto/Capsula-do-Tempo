using System.Linq;
using LocalMarket.WebApi.Entities;
using LocalMarket.WebApi.Entities.Geo;
using Microsoft.EntityFrameworkCore;

namespace LocalMarket.WebApi.Repositories
{
    public class CityRepository : AbstractRepository<City>
    {
        public CityRepository(DatabaseContext context) : base(context)
        {
        }
        
        public City FindByEqualName(string name)
        {
            return _context.Cities.Include(city => city.State).FirstOrDefault(city => city.Name == name);
        }

    }
}