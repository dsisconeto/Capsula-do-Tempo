<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/vendor/font-awesome-4.6.2/css/font-awesome.min.css">
    <link rel="stylesheet" href="/vendor/animate-css/css.css">
    {block name="css"}{/block}
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist_admin/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/dist_admin/css/skins/_all-skins.min.css">


</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">

<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>IC</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>IC</b> Dashbord</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#" data-toggle="control-sidebar">{$systemUserName}</i></a>
                    </li>

                    <li>
                        <a href="/login/?logout">
                            <i class="fa fa-sign-out" aria-hidden="true"></i> Sair</a>
                    </li>


                </ul>
            </div>
        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MENU PRINCIPAL</li>
                {if $permissionNews || $permissionNewspaper}
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                            <span>Notícias</span>
                        </a>

                        <ul class="treeview-menu">
                            {if $permissionNews }
                                <li>
                                    <a href="/admin/noticia/cadastrar/"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Escrever Nova</a>
                                </li>
                                <li><a href="/admin/noticia/todas/"> <i class="fa fa-newspaper-o"
                                                                        aria-hidden="true"></i>
                                        Notícias</a>
                                </li>
                                <li><a href="/admin/noticia/painel/">
                                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                        Painel
                                    </a>
                                </li>
                                {if $permissionNewsCategory}
                                    <li>
                                        <a href="/admin/noticia/tag/">
                                            <i class="fa fa-tags" aria-hidden="true"></i>Tags
                                        </a>
                                    </li>
                                {/if}


                            {/if}

                            {if $permissionNewspaper }
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

                {if $permissionEvent}
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
                {if $permissionCompany}
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

                {if $permissionGeoRegion}
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

                {if $permissionUserRegister}
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

    {block name="content"}{/block}
    <!-- jQuery 2.1.4 -->
    <script src="/vendor/jquery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/vendor/jQueryUI/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="/js/obj/Site.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/vendor/noty-master/js/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="/vendor/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="/vendor/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist_admin/js/app.min.js"></script>

    <script>
        $.widget.bridge('uibutton', $.ui.button);
        Site.HOST_MAIN = "{$HOST_MAIN}";
        Site.HOST_IMG = "{$HOST_IMG}";
    </script>

    <script src="/js/obj/Megaic.js"></script>


    {block name="script"}{/block}
