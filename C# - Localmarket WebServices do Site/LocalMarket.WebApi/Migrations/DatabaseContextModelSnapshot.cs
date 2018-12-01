﻿// <auto-generated />
using System;
using LocalMarket.WebApi;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Infrastructure;
using Microsoft.EntityFrameworkCore.Metadata;
using Microsoft.EntityFrameworkCore.Storage.ValueConversion;

namespace LocalMarket.WebApi.Migrations
{
    [DbContext(typeof(DatabaseContext))]
    partial class DatabaseContextModelSnapshot : ModelSnapshot
    {
        protected override void BuildModel(ModelBuilder modelBuilder)
        {
#pragma warning disable 612, 618
            modelBuilder
                .HasAnnotation("ProductVersion", "2.1.3-rtm-32065")
                .HasAnnotation("Relational:MaxIdentifierLength", 128)
                .HasAnnotation("SqlServer:ValueGenerationStrategy", SqlServerValueGenerationStrategy.IdentityColumn);

            modelBuilder.Entity("LocalMarket.WebApi.Entities.Geo.Address", b =>
                {
                    b.Property<long>("Id")
                        .ValueGeneratedOnAdd()
                        .HasAnnotation("SqlServer:ValueGenerationStrategy", SqlServerValueGenerationStrategy.IdentityColumn);

                    b.Property<long>("CityId");

                    b.Property<string>("Description");

                    b.HasKey("Id");

                    b.HasIndex("CityId");

                    b.ToTable("Addresses");
                });

            modelBuilder.Entity("LocalMarket.WebApi.Entities.Geo.City", b =>
                {
                    b.Property<long>("CityId")
                        .ValueGeneratedOnAdd()
                        .HasAnnotation("SqlServer:ValueGenerationStrategy", SqlServerValueGenerationStrategy.IdentityColumn);

                    b.Property<string>("Name");

                    b.Property<long>("StateId");

                    b.HasKey("CityId");

                    b.HasIndex("StateId");

                    b.ToTable("Cities");

                    b.HasData(
                        new { CityId = 1L, Name = "Palmas - TO", StateId = 1L }
                    );
                });

            modelBuilder.Entity("LocalMarket.WebApi.Entities.Geo.State", b =>
                {
                    b.Property<long>("StateId")
                        .ValueGeneratedOnAdd()
                        .HasAnnotation("SqlServer:ValueGenerationStrategy", SqlServerValueGenerationStrategy.IdentityColumn);

                    b.Property<string>("Name");

                    b.HasKey("StateId");

                    b.ToTable("States");

                    b.HasData(
                        new { StateId = 1L, Name = "Tocantins" }
                    );
                });

            modelBuilder.Entity("LocalMarket.WebApi.Entities.Market", b =>
                {
                    b.Property<long>("Id")
                        .ValueGeneratedOnAdd()
                        .HasAnnotation("SqlServer:ValueGenerationStrategy", SqlServerValueGenerationStrategy.IdentityColumn);

                    b.Property<long>("AddressId");

                    b.Property<string>("Name");

                    b.HasKey("Id");

                    b.HasIndex("AddressId");

                    b.ToTable("Markets");
                });

            modelBuilder.Entity("LocalMarket.WebApi.Entities.Products.Price", b =>
                {
                    b.Property<long>("Id")
                        .ValueGeneratedOnAdd()
                        .HasAnnotation("SqlServer:ValueGenerationStrategy", SqlServerValueGenerationStrategy.IdentityColumn);

                    b.Property<decimal>("Amount")
                        .HasColumnType("decimal(18,2)");

                    b.Property<DateTime>("ExpireAt");

                    b.Property<long>("MarketId");

                    b.Property<long>("ProductId");

                    b.Property<int>("Quantity");

                    b.Property<int>("Status");

                    b.HasKey("Id");

                    b.HasIndex("MarketId");

                    b.HasIndex("ProductId");

                    b.ToTable("Prices");
                });

            modelBuilder.Entity("LocalMarket.WebApi.Entities.Products.Product", b =>
                {
                    b.Property<long>("ProductId")
                        .ValueGeneratedOnAdd()
                        .HasAnnotation("SqlServer:ValueGenerationStrategy", SqlServerValueGenerationStrategy.IdentityColumn);

                    b.Property<string>("CodeBar");

                    b.Property<string>("ImageUrl");

                    b.Property<string>("Name");

                    b.Property<long>("ProductCategoryId");

                    b.HasKey("ProductId");

                    b.HasIndex("ProductCategoryId");

                    b.ToTable("Products");

                    b.HasData(
                        new { ProductId = 1L, CodeBar = "7892509093569", ImageUrl = "https://images-americanas.b2w.io/produtos/01/00/item/132898/9/132898916SZ.jpg", Name = "Smart TV LED 49 Samsung", ProductCategoryId = 1L }
                    );
                });

            modelBuilder.Entity("LocalMarket.WebApi.Entities.Products.ProductCategory", b =>
                {
                    b.Property<long>("ProductCategoryId")
                        .ValueGeneratedOnAdd()
                        .HasAnnotation("SqlServer:ValueGenerationStrategy", SqlServerValueGenerationStrategy.IdentityColumn);

                    b.Property<string>("Name");

                    b.HasKey("ProductCategoryId");

                    b.ToTable("ProductCategories");

                    b.HasData(
                        new { ProductCategoryId = 1L, Name = "Tv's" }
                    );
                });

            modelBuilder.Entity("LocalMarket.WebApi.Entities.Geo.Address", b =>
                {
                    b.HasOne("LocalMarket.WebApi.Entities.Geo.City", "City")
                        .WithMany()
                        .HasForeignKey("CityId")
                        .OnDelete(DeleteBehavior.Cascade);
                });

            modelBuilder.Entity("LocalMarket.WebApi.Entities.Geo.City", b =>
                {
                    b.HasOne("LocalMarket.WebApi.Entities.Geo.State", "State")
                        .WithMany()
                        .HasForeignKey("StateId")
                        .OnDelete(DeleteBehavior.Cascade);
                });

            modelBuilder.Entity("LocalMarket.WebApi.Entities.Market", b =>
                {
                    b.HasOne("LocalMarket.WebApi.Entities.Geo.Address", "Address")
                        .WithMany()
                        .HasForeignKey("AddressId")
                        .OnDelete(DeleteBehavior.Cascade);
                });

            modelBuilder.Entity("LocalMarket.WebApi.Entities.Products.Price", b =>
                {
                    b.HasOne("LocalMarket.WebApi.Entities.Market", "Market")
                        .WithMany()
                        .HasForeignKey("MarketId")
                        .OnDelete(DeleteBehavior.Cascade);

                    b.HasOne("LocalMarket.WebApi.Entities.Products.Product", "Product")
                        .WithMany()
                        .HasForeignKey("ProductId")
                        .OnDelete(DeleteBehavior.Cascade);
                });

            modelBuilder.Entity("LocalMarket.WebApi.Entities.Products.Product", b =>
                {
                    b.HasOne("LocalMarket.WebApi.Entities.Products.ProductCategory", "ProductCategory")
                        .WithMany()
                        .HasForeignKey("ProductCategoryId")
                        .OnDelete(DeleteBehavior.Cascade);
                });
#pragma warning restore 612, 618
        }
    }
}
