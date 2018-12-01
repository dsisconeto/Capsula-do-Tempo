using System.Collections.Generic;
using System.Linq;
using LocalMarket.WebApi.Entities.Products;
using LocalMarket.WebApi.Repositories;
using LocalMarket.WebApi.ValueObjects.GraphPrice;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore.Internal;

namespace LocalMarket.WebApi.Controllers
{
    [Route("product-prices")]
    [ApiController]
    public class PriceController : ControllerBase
    {
        private readonly PriceRepository _priceRepository;

        public PriceController(PriceRepository priceRepository)
        {
            _priceRepository = priceRepository;
        }

        [HttpGet]
        public ActionResult<List<Price>> Get(long productId, long cityId)
        {
            return _priceRepository.FindByProductAndCity(productId, productId);
        }


        [HttpGet]
        public ActionResult<GraphPrice> Get(List<long> products, long cityId)
        {
            var graphPrice = new GraphPrice();
            var prices = _priceRepository.FindByProductsAndCity(products, cityId);
            prices.ForEach(p =>
            {
                graphPrice.AddPrice(p);
            });
            return graphPrice;

        }
    }
}