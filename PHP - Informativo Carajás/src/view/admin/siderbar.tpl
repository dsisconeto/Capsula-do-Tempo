<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MENU PRINCIPAL</li>
            {if $loginNews || $loginNewspaper}
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                        <span>Notícias</span>
                    </a>

                    <ul class="treeview-menu">
                        {if $loginNews }
                            <li>
                                <a href="/admin/noticia/cadastrar/"><i class="fa fa-plus" aria-hidden="true"></i>
                                    Escrever Nova</a>
                            </li>
                            <li><a href="/admin/noticia/todas/"> <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                    Notícias</a>
                            </li>
                            {if $loginNewsCategory}
                                <li>
                                    <a href="/admin/noticia/tag/">
                                        <i class="fa fa-tags" aria-hidden="true"></i>Tags
                                    </a>
                                </li>
                            {/if}


                        {/if}

                        {if $loginNewspaper }
                            <li>
                                <a href="/admin/impresso/cadastrar/">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Cadastrar Jornal
                                </a>
                            </li>
                            <li>
                                <a href="/admin/impresso/todos/">
                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i> Todos os Jornais
                                </a>
                            </li>
                        {/if}
                    </ul>
                </li>
            {/if}

            {if $loginEvent}
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <span>Eventos</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/admin/evento/cadastrar/"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                Cadastrar Evento</a>
                        </li>

                        <li>
                            <a href="/admin/evento/todos/"><i class="fa fa-list" aria-hidden="true"></i>
                                Eventos</a>
                        </li>

                    </ul>
                </li>
            {/if}
            {if $loginCompany}
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-building" aria-hidden="true"></i>
                        <span>Empresas</span>
                    </a>

                    <ul class="treeview-menu">
                        <li>
                            <a href="/admin/empresa/cadastrar/">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Cadastrar
                            </a>
                        </li>

                        <li>
                            <a href="/admin/empresa/todas/">
                                <i class="fa fa-building" aria-hidden="true"></i>
                                Empresas
                            </a>
                        </li>
                        <li>
                            <a href="/admin/empresa/destaque/">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                Em Destaque
                            </a>
                        </li>

                    </ul>
                </li>
            {/if}




            {if $loginUserCompany}
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-building" aria-hidden="true"></i>
                        <span>Minha Empresa</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/admin/empresa/editar/{$loginUserCompanyId}/">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                Editar
                            </a>
                        </li>

                        <li>
                            <a href="/admin/empresa/adicionais/{$loginUserCompanyId}/">
                                Adicionais
                            </a>
                        </li>


                    </ul>
                </li>
            {/if}

            {if $loginAds}
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bullhorn" aria-hidden="true"></i>
                        <span>Anúncios</span>

                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/admin/anuncio/cadastrar/"><i class="fa fa-plus"></i> Novo Anúncio</a>
                        </li>

                        <li>
                            <a href="/admin/anuncio/todos/"> <i class="fa fa-bullhorn" aria-hidden="true"></i> Anúncios</a>
                        </li>
                    </ul>
                </li>
            {/if}

            {if $loginGeoRegion}
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-globe" aria-hidden="true"></i>
                        <span>Regiões</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/admin/regiao/todas/">
                                <i class="fa fa-globe" aria-hidden="true"></i>Regiões
                            </a>
                        </li>

                    </ul>
                </li>
            {/if}

            {if $loginUserRegister}
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span>Usuário</span>

                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/admin/usuario/cadastrar/">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Cadastrar
                            </a>
                        </li>

                        <li>
                            <a href="/admin/usuario/todos/">
                                <i class="fa fa-user" aria-hidden="true"></i>Usuários
                            </a>
                        </li>

                    </ul>
                </li>
            {/if}

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>