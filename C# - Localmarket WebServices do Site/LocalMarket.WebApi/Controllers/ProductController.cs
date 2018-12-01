using System.Collections.Generic;
using LocalMarket.WebApi.Entities.Products;
using LocalMarket.WebApi.Repositories;
using Microsoft.AspNetCore.Mvc;

namespace LocalMarket.WebApi.Controllers
{
    [Route("products")]
    [ApiController]
    public class ProductController : ControllerBase
    {
        private readonly ProductRepository _productRepository;

        public ProductController(ProductRepository productRepository)
        {
            _productRepository = productRepository;
        }


        [HttpGet]
        public ActionResult<List<Product>> Index([FromQuery] string name)
        {
            if (!ModelState.IsValid) return BadRequest();

            return _productRepository.FindByName(name);
        }



        [HttpGet, Route("products/{id}")]
        public ActionResult<Product> Get(long id)
        {
            return _productRepository.FindById(id);
        }


    }
}