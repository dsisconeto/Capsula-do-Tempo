@extends('layout.default.default')


@section('content')
    <main>
        <div id="wrapper">
            <section class="categories-menu">
                <div class="container">
                    <h2>Se preferir, escolha a categoria</h2>
                    <div class="row">
                        <div class="square-card">
                            <div class="square-body">
                                <img src="/assets/img/groceries.svg">
                                <p>Alimentos</p>
                            </div>
                        </div>

                        <div class="square-card">
                            <div class="square-body">
                                <img src="/assets/img/soda.svg">
                                <p>Bebidas</p>
                            </div>
                        </div>

                        <div class="square-card">
                            <div class="square-body">
                                <img src="/assets/img/cake.svg">
                                <p>Bolos</p>
                            </div>
                        </div>

                        <div class="square-card">
                            <div class="square-body">
                                <img src="/assets/img/groceries.svg">
                                    <p>Higiene Pessoal</p>
                            </div>
                        </div>

                        <div class="square-card">
                            <div class="square-body">
                                <img src="/assets/img/soda.svg">
                                <p>Eletrônicos</p>
                            </div>
                        </div>
                        <div class="square-card">
                            <div class="square-body">
                                <img src="/assets/img/soda.svg">
                                <p>Eletrodomésticos</p>
                            </div>
                        </div>
                        <div class="square-card">
                            <div class="square-body">
                                <img src="/assets/img/soda.svg">
                                <p>Móveis</p>
                            </div>
                        </div>

                        <div class="square-card">
                            <div class="square-body">
                                <img src="/assets/img/soda.svg">
                                <p>Limpeza</p>
                            </div>
                        </div>

                        <div class="square-card">
                            <div class="square-body">
                                <img src="/assets/img/soda.svg">
                                <p>Livros</p>
                            </div>
                        </div>
                        <div class="square-card card-more ">
                            <div class="square-body">
                                <i class="fas fa-plus-circle fa-2x"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="weekly-oferts">
                <div class="container">
                    <div class="section-title">
                        <h3>Ofertas da semana</h3>
                        <div class="section-topbar">
                            <div class="section-topbar-button">
                                <a class="section-topbar-button-icon"><i class="fas fa-ellipsis-h"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <a href="/">
                                <div class="card card-fixed card-oferts">
                                    <div class="card-img-cover">
                                        <img class="card-img-top" src="/assets/img/static/itubaina-retro.jpg" alt="Itubaina Retrô">
                                        <div class="favorite-item">
                                            <img src="/assets/img/star.svg">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Itubaina Retrô</h4>
                                        <div class="price-tag">
                                            <a class="old-price">R$ 3,45</a>
                                            <br>
                                            <a class="new-price">R$ 2,19</a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="/">
                                <div class="card card-fixed card-oferts">
                                    <div class="card-img-cover">
                                        <img class="card-img-top" src="/assets/img/static/pringles.jpg" alt="Pringles">
                                        <div class="favorite-item">
                                            <img src="/assets/img/star.svg">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Pringles Creme e Cebola</h4>
                                        <div class="price-tag">
                                            <a class="old-price">R$ 14,89</a>
                                            <br>
                                            <a class="new-price">R$ 8,89</a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="/">
                                <div class="card card-fixed card-oferts">
                                    <div class="card-img-cover">
                                        <img class="card-img-top" src="/assets/img/static/eskibon.png" alt="Eskibon">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Esbkibon</h4>
                                        <div class="price-tag">
                                            <a class="old-price">R$ 8,50</a>
                                            <br>
                                            <a class="new-price">R$ 5,00</a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="/">
                                <div class="card card-fixed card-oferts">
                                    <div class="card-img-cover">
                                        <img class="card-img-top" src="/assets/img/static/gas.jpg" alt="Eskibon">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Gás de Cozinha</h4>
                                        <div class="price-tag">
                                            <a class="old-price">R$ 81,50</a>
                                            <br>
                                            <a class="new-price">R$ 71,20</a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="home-how-it-works">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-title">
                                    <h2>Como <strong>funciona</strong></h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col">
                                                <h3>1</h3>
                                                <p>

                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at ultricies sapien. Fusce a
                                                    semper mi. In feugiat fermentum lectus at gravida. Phasellus id volutpat odio.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>2</h3>
                                        <p>
                                            Donec dapibus porta aliquam. Pellentesque nibh odio, varius id nisi vel, porttitor dapibus ex.
                                            Quisque vulputate tincidunt faucibus.
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>3</h3>
                                        <p>
                                            Cras in imperdiet nibh, commodo lobortis urna. Pellentesque dui lectus, cursus id placerat eget,
                                            suscipit vel dolor. Etiam venenatis sapien sit amet lorem pharetra scelerisque.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
