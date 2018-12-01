<?php

@extends('layout.default.default')

@section('content')
    <main>
        <div id="wrapper">
            <section class="product-about">
                <div class="container">
                    <header>
                        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="vehicle-heading">
                                    <h1 class="vehicle-title">Itubaina Retrô</h1>
                                </div>
                            </div>
                            <div class="col-md-3 text-right">
                                <div class="price-tag">
                                    R$ 5,50 </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="b-detail__main-info-characteristics-one">
                                    <div class="b-detail__main-info-characteristics-one-top">
                                        <div>
                                            <a href="javascript:Veiculo.Favoritar('1532371151');">
                                                <i class="fas fa-star"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="b-detail__main-info-characteristics-one">
                                    <div class="b-detail__main-info-characteristics-one-top">
                                        <div>
                                            <a href="javascript: window.print();" title="Imprimir Anúncio">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="b-detail__main-info-characteristics-one">
                                    <div class="b-detail__main-info-characteristics-one-top">
                                        <div>
                                            <a id="compartilhar" href="javascript:void(0);">
                                                <i class="fas fa-share-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="b-detail__main-info-characteristics-one">
                                    <div class="b-detail__main-info-characteristics-one-top">
                                        <div>
                                            <a href="javascript:void(0);" title="Contratar Anunciante" class="env_proposta form_proposta">
                                                <i class="fas fa-envelope"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <div class="row">
                        <div class="col-xl-7 col-lg-7 col-md-6 col-lg-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="vehicle-gallery">
                                        <div class="lSSlideOuter ">
                                            <div class="lSSlideWrapper usingCss">
                                                <ul id="vehicleGallery" class="lightSlider lSSlide" style="width: 5080px; transform: translate3d(-635px, 0px, 0px); height: 21px; padding-bottom: 0%;">
                                                    <li data-thumb="/images/anuncio/20180814114332_corsa_bancos.png" data-src="/images/anuncio/20180814114332_corsa_bancos.png"
                                                        class="clone left" style="width: 635px; margin-right: 0px;">
                                                        <img style="width: 635px;" src="/images/anuncio/20180814114332_corsa_bancos.png">
                                                    </li>
                                                    <li data-thumb="/images/anuncio/20180814114321_corsa_lateral_2.png" data-src="/images/anuncio/20180814114321_corsa_lateral_2.png"
                                                        class="lslide active" style="width: 635px; margin-right: 0px;">
                                                        <img style="width: 635px;" src="/images/anuncio/20180814114321_corsa_lateral_2.png">
                                                    </li>
                                                    <li data-thumb="/images/anuncio/20180814114323_corsa_frente.png" data-src="/images/anuncio/20180814114323_corsa_frente.png"
                                                        class="lslide" style="width: 635px; margin-right: 0px;">
                                                        <img style="width: 635px;" src="/images/anuncio/20180814114323_corsa_frente.png">
                                                    </li>
                                                    <li data-thumb="/images/anuncio/20180814114326_corsa_tras.png" data-src="/images/anuncio/20180814114326_corsa_tras.png"
                                                        class="lslide" style="width: 635px; margin-right: 0px;">
                                                        <img style="width: 635px;" src="/images/anuncio/20180814114326_corsa_tras.png">
                                                    </li>
                                                    <li data-thumb="/images/anuncio/20180814114328_corsa_painel.png" data-src="/images/anuncio/20180814114328_corsa_painel.png"
                                                        class="lslide" style="width: 635px; margin-right: 0px;">
                                                        <img style="width: 635px;" src="/images/anuncio/20180814114328_corsa_painel.png">
                                                    </li>
                                                    <li data-thumb="/images/anuncio/20180814114330_corsa_km.png" data-src="/images/anuncio/20180814114330_corsa_km.png"
                                                        class="lslide" style="width: 635px; margin-right: 0px;">
                                                        <img style="width: 635px;" src="/images/anuncio/20180814114330_corsa_km.png">
                                                    </li>
                                                    <li data-thumb="/images/anuncio/20180814114332_corsa_bancos.png" data-src="/images/anuncio/20180814114332_corsa_bancos.png"
                                                        class="lslide" style="width: 635px; margin-right: 0px;">
                                                        <img style="width: 635px;" src="/images/anuncio/20180814114332_corsa_bancos.png">
                                                    </li>
                                                    <li data-thumb="/images/anuncio/20180814114321_corsa_lateral_2.png" data-src="/images/anuncio/20180814114321_corsa_lateral_2.png"
                                                        class="clone right" style="width: 635px; margin-right: 0px;">
                                                        <img style="width: 635px;" src="/images/anuncio/20180814114321_corsa_lateral_2.png">
                                                    </li>
                                                </ul>
                                                <div class="lSAction"><a class="lSPrev"></a><a class="lSNext"></a></div>
                                            </div>
                                            <ul class="lSPager lSGallery" style="margin-top: 5px; transition-duration: 400ms; width: 768.5px; transform: translate3d(0px, 0px, 0px);">
                                                <li style="width:100%;width:123px;margin-right:5px" class="active"><a href="#"><img src="/images/anuncio/20180814114321_corsa_lateral_2.png"></a></li>
                                                <li style="width:100%;width:123px;margin-right:5px"><a href="#"><img src="/images/anuncio/20180814114323_corsa_frente.png"></a></li>
                                                <li style="width:100%;width:123px;margin-right:5px"><a href="#"><img src="/images/anuncio/20180814114326_corsa_tras.png"></a></li>
                                                <li style="width:100%;width:123px;margin-right:5px"><a href="#"><img src="/images/anuncio/20180814114328_corsa_painel.png"></a></li>
                                                <li style="width:100%;width:123px;margin-right:5px"><a href="#"><img src="/images/anuncio/20180814114330_corsa_km.png"></a></li>
                                                <li style="width:100%;width:123px;margin-right:5px"><a href="#"><img src="/images/anuncio/20180814114332_corsa_bancos.png"></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="b-detail__main-info-characteristics wow zoomInUp">
                                        <div class="b-detail__main-info-characteristics-one">
                                            <div class="b-detail__main-info-characteristics-one-top">
                                                <div>
                                                    <span class="fa fa-car"></span>
                                                </div>
                                                <p>Único dono</p>
                                            </div>
                                            <div class="b-detail__main-info-characteristics-one-bottom">
                                                Estado
                                            </div>
                                        </div>
                                        <div class="b-detail__main-info-characteristics-one">
                                            <div class="b-detail__main-info-characteristics-one-top">
                                                <div>
                                                    <span class="fa fa-trophy"></span>
                                                </div>
                                                <p>126000</p>
                                            </div>
                                            <div class="b-detail__main-info-characteristics-one-bottom">
                                                Kilometragem
                                            </div>
                                        </div>
                                        <div class="b-detail__main-info-characteristics-one">
                                            <div class="b-detail__main-info-characteristics-one-top">
                                                <div>
                                                    <span class="fa fa-at"></span>
                                                </div>
                                                <p>Manual</p>
                                            </div>
                                            <div class="b-detail__main-info-characteristics-one-bottom">
                                                Transmissão
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="vehicle-card">
                                        <div class="vehicle-card-heading">
                                            <h5>Mais Informações</h5>
                                        </div>
                                        <div class="vehicle-card-body">
                                            <ul class="vehicle-card-list-1">
                                                <li>
                                                    <span>Marca</span>CHEVROLET
                                                </li>
                                                <li>
                                                    <span>Modelo</span>CORSA
                                                </li>
                                                <li>
                                                    <span>Ano</span>2010/2011
                                                </li>
                                                <li>
                                                    <span>Condição</span>Único dono
                                                </li>
                                                <li>
                                                    <span>Kilometragem</span>126000
                                                </li>
                                                <li>
                                                    <span>Cor</span>Preto
                                                </li>
                                                <li>
                                                    <span>Transmissão</span>Manual
                                                </li>
                                                <li>
                                                    <span>Motor</span>1.4 MPFI MAXX 8V FLEX 4P MANUAL
                                                </li>
                                                <li>
                                                    <span>Combustível</span>Gasolina e álcool
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="vehicle-card">
                                        <div class="vehicle-card-heading">
                                            <h5>Opcionais</h5>
                                        </div>
                                        <div class="vehicle-card-body">
                                            <ul class="vehicle-card-list-2">
                                                <li>126000 Km</li>
                                                <li>Alarme</li>
                                                <li>Ar Condicionado</li>
                                                <li>Direção Hidráulica</li>
                                            </ul>
                                            <ul class="vehicle-card-list-2">
                                                <li>Limpador Traseiro</li>
                                                <li>Trava Elétrica</li>
                                                <li>Vidro Elétrico</li>
                                                <li>Única Dona</li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="vehicle-card">
                                        <div class="vehicle-card-heading">
                                            <h5>Observações do vendedor</h5>
                                        </div>
                                        <div class="vehicle-card-body">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-6 col-lg-12">
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection