<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel=stylesheet>
    <link href="/dist_admin/css/page/login.css" rel=stylesheet>
    <link href="/vendor/animate-css/css.css" rel="stylesheet">
    <script src="/vendor/jquery/jquery-2.2.2.min.js"></script>
    <script>
        {if $continue}
        var conti = "{$continue}";
        {else}
        var conti = "";
        {/if}
    </script>




</head>

<body>
<div id="box_login">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <img src="/img/logo.png" class="center-block">
        </div>

        <div class="panel-body">
            <form role="form" method="post" action="/form/login/" id="form_login">

                <div class="form-group">
                    <label for="login_user">Usuário:</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>

                        <input type="text" required class="form-control" name="login_user"
                               placeholder="Nome de Usuario">
                    </div>
                </div>

                <div class="form-group">
                    <label for="login_password">Senha:</label>

                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" class="form-control" required name="login_password"
                               placeholder="Senha de Usuario">
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit">
                        <span class="glyphicon glyphicon-log-in"></span> Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/vendor/jqueryAjaxForm/jquery.form.min.js"></script>
<script src="/vendor/noty/js/noty/packaged/jquery.noty.packaged.js"></script>

<script src="/js/obj/Megaic.js"></script>
<script src="/dist_admin/js/page/login.js"></script>
</body>
</html>
