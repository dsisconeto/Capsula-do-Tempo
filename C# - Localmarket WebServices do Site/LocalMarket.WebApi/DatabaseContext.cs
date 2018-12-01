using LocalMarket.WebApi.Entities;
using LocalMarket.WebApi.Entities.Geo;
using LocalMarket.WebApi.Entities.Products;
using Microsoft.EntityFrameworkCore;

namespace LocalMarket.WebApi
{
    public class DatabaseContext : DbContext
    {
        public DbSet<City> Cities { get; set; }
        public DbSet<State> States { get; set; }
        public DbSet<Product> Products { get; set; }
        public DbSet<Price> Prices { get; set; }
        public DbSet<ProductCategory> ProductCategories { get; set; }
        public DbSet<Address> Addresses { get; set; }
        public DbSet<Market> Markets { get; set; }

        public DatabaseContext(DbContextOptions options) : base(options)
        {
        }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.Entity<ProductCategory>().HasData(new ProductCategory() { ProductCategoryId = 1, Name = "Tv's" });

            modelBuilder.Entity<Product>().HasData(
                new Product()
                {

                    ProductId = 1,
                    Name = "Smart TV LED 49 Samsung",
                    ProductCategoryId = 1,
                    CodeBar = "7892509093569",
                    ImageUrl = "https://images-americanas.b2w.io/produtos/01/00/item/132898/9/132898916SZ.jpg",

                }
            );

            modelBuilder.Entity<Price>().Property(p => p.Amount).HasColumnType("decimal(18,2)");


            modelBuilder.Entity<State>().HasData(new State() { StateId = 1, Name = "Tocantins" });
            modelBuilder.Entity<City>().HasData(new City() { CityId = 1, Name = "Palmas - TO", StateId = 1 });

        }
    }
}