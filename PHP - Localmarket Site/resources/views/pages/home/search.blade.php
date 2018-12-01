<?php

@extends('layout.default.default')

@section('content')
    <main>
        <div id="wrapper">
            <section class="info-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="info-bar-select">
                                <i class="fas fa-sort"></i>
                                <span class="info-bar-title">Ordernar por:</span>
                                <select class="m-select" name="ordem-select" id="ordem-select">
                                    <option value="destaque">Destaques</option>
                                    <option value="barato">Mais Baratos</option>
                                    <option value="caro">Mais Caros</option>
                                    <option value="novo">Mais Novos</option>
                                    <option value="antigo">Mais Antigos</option>
                                    <option value="visualizacao">Últimos Visualizados</option>
                                </select>
                                <span class="fa fa-caret-down"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="search-page">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/itubaina-retro.jpg"
                                                                                                   height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Itubaina Retrô</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"><a href="/product" target="_blank"><img src="./files/pringles.jpg" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Pringles Creme e Cebola</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/eskibon.png" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Esbkibon</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/gas.jpg" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Gás de Cozinha</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/itubaina-retro.jpg"
                                                                                                   height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Itubaina Retrô</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"><a href="/product" target="_blank"><img src="./files/pringles.jpg" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Pringles Creme e Cebola</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/eskibon.png" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Esbkibon</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/gas.jpg" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Gás de Cozinha</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/itubaina-retro.jpg"
                                                                                                   height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Itubaina Retrô</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"><a href="/product" target="_blank"><img src="./files/pringles.jpg" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Pringles Creme e Cebola</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/eskibon.png" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Esbkibon</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/gas.jpg" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Gás de Cozinha</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="pagination justify-content-center">
                            <ul>
                                <a href="#">
                                    <li>1</li>
                                </a>
                                <a href="#">
                                    <li>2</li>
                                </a>
                                <a class="is-active" href="#">
                                    <li>3</li>
                                </a>
                                <a href="#">
                                    <li>4</li>
                                </a>
                                <a href="#">
                                    <li>5</li>
                                </a>
                                <a href="#">
                                    <li>6</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><main>
        <div id="wrapper">
            <section class="info-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="info-bar-select">
                                <i class="fas fa-sort"></i>
                                <span class="info-bar-title">Ordernar por:</span>
                                <select class="m-select" name="ordem-select" id="ordem-select">
                                    <option value="destaque">Destaques</option>
                                    <option value="barato">Mais Baratos</option>
                                    <option value="caro">Mais Caros</option>
                                    <option value="novo">Mais Novos</option>
                                    <option value="antigo">Mais Antigos</option>
                                    <option value="visualizacao">Últimos Visualizados</option>
                                </select>
                                <span class="fa fa-caret-down"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="search-page">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/itubaina-retro.jpg"
                                                                                                   height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Itubaina Retrô</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"><a href="/product" target="_blank"><img src="./files/pringles.jpg" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Pringles Creme e Cebola</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/eskibon.png" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Esbkibon</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/gas.jpg" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Gás de Cozinha</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/itubaina-retro.jpg"
                                                                                                   height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Itubaina Retrô</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"><a href="/product" target="_blank"><img src="./files/pringles.jpg" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Pringles Creme e Cebola</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/eskibon.png" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Esbkibon</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/gas.jpg" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Gás de Cozinha</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/itubaina-retro.jpg"
                                                                                                   height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Itubaina Retrô</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"><a href="/product" target="_blank"><img src="./files/pringles.jpg" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Pringles Creme e Cebola</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/eskibon.png" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Esbkibon</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <div class="card card-product">
                                <div class="row">
                                    <div class="col-lg-4"> <a href="/product" target="_blank"><img src="./files/gas.jpg" height="200"></a>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-block">
                                            <div class="card-body"> <a href="/product" target="_blank">
                                                    <h3 class="card-title">Gás de Cozinha</h3>
                                                </a>
                                                <p class="card-text">Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="card-block">
                                            <div class="card-footer" style="text-align: -webkit-right;">
                                                <div class="price-tag "> <a>R$ 50,00</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="pagination justify-content-center">
                            <ul>
                                <a href="#">
                                    <li>1</li>
                                </a>
                                <a href="#">
                                    <li>2</li>
                                </a>
                                <a class="is-active" href="#">
                                    <li>3</li>
                                </a>
                                <a href="#">
                                    <li>4</li>
                                </a>
                                <a href="#">
                                    <li>5</li>
                                </a>
                                <a href="#">
                                    <li>6</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection