<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Informativo Cidade | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    {if isset($select2)}
        <link rel="stylesheet" href="/vendor/select2/select2.min.css">
    {/if}

    <link rel="stylesheet" href="/vendor/font-awesome-4.6.2/css/font-awesome.min.css">
    <link rel="stylesheet" href="/vendor/animate-css/css.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/admin/css/skins/_all-skins.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->

    <!-- jQuery 2.1.4 -->
    <script src="/vendor/jquery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/vendor/jQueryUI/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
        const host = "/";
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/obj/Megaic.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">

<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="/admin/" class="logo">
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
                        <a href="#" data-toggle="control-sidebar">{$systemUserName}{if isset($loginUserCompanyName)} ({$loginUserCompanyName}){/if}</i></a>
                    </li>

                    <li>
                        <a href="/logout/">
                            <i class="fa fa-sign-out" aria-hidden="true"></i> Sair</a>
                    </li>


                </ul>
            </div>
        </nav>
    </header>

