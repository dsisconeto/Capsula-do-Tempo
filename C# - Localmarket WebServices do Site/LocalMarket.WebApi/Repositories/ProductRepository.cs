using System;
using System.Collections.Generic;
using System.Linq;
using LocalMarket.WebApi.Entities.Products;

namespace LocalMarket.WebApi.Repositories
{
    public class ProductRepository : AbstractRepository<Product>
    {
        protected ProductRepository(DatabaseContext context) : base(context)
        {

        }


        public Product FindById(long id)
        {
            return _context.Products.FirstOrDefault(p => p.ProductId == id);
        }

        public List<Product> FindByName(string name)
        {
            return _context.Products.Where(p => p.Name.Contains(name)).ToList();
        }



    }
}