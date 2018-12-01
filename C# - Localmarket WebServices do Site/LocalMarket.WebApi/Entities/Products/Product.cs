namespace LocalMarket.WebApi.Entities.Products
{
    public class Product
    {
        public long ProductId { get; set; }
        public string Name { get; set; }
        public string CodeBar { get; set; }
        public string ImageUrl { get; set; }
        public ProductCategory ProductCategory { get; set; }
        public long ProductCategoryId { get; set; }
    }
}