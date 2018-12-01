{if !$selectRegion}
    <!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selecionar Cidade</title>
    <meta name="theme-color" content="‪#‎2780e3">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="icon" href="{asset("img/favicon.ico")}">
    <link rel="stylesheet" href="{asset("vendor/bootstrap/css/bootstrap.min.css")}">
    <link rel="stylesheet" href="{asset("vendor/font-awesome-4.6.2/css/font-awesome.min.css")}">
    <link rel="stylesheet" href="{asset("css/theme.css")}">

    {/if}
    <link href="{asset("vendor/select2/select2.min.css")}" rel="stylesheet">
    <link rel="stylesheet" href="{asset("css/page/select-geo-region.css")}">
    <link rel="stylesheet" href="{asset("/vendor/animate-css/css.css")}">


    {if !$selectRegion}
</head>

<body>
{/if}
<script>
    const HOST = "{host()}";
    var conti = "{$continue}";
</script>
{if $selectRegion}
    <h1 class="hidden">{$metaTitle}</h1>
{/if}
<div class="container select-region">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 box">
            {if !$selectRegion}
                <div class="logo">
                    <img src="{asset("/img/loading.gif")}" class="center-block img-responsive">
                </div>
            {/if}


            <form role="form" id="form_region" action="/form/cidade/escolher/" method="post">

                <div class="form-group">
                    <h2 class="text-center">Escolha sua cidade.</h2>
                    <select class="form-control" name="geo_region_id" id="geo_region_id" required="required">

                    </select>

                </div>

                <div class="form-group">

                    <button type="submit" class="btn btn-primary form-control">
                        <i class="fa fa-check" aria-hidden="true"></i> Continuar
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

{if !$selectRegion}
    <script src="{asset("vendor/jquery/jquery-2.2.2.min.js")}"></script>
    <script src="{asset("vendor/bootstrap/js/bootstrap.min.js")}"></script>
{/if}

{if !$isMobile}
    <script>
        var math = (($(window).height() - $(".box").height()) / 3) - 15;
        $(".box").css("margin-top", math);
    </script>
{/if}
<script src="{asset("vendor/noty/js/noty/packaged/jquery.noty.packaged.min.js")}"></script>
<script src="{asset("vendor/select2/select2.full.min.js")}"></script>
<script src="{asset("vendor/jqueryform/jquery.form.min.js")}"></script>
<script src="{asset("js/obj/Megaic.js")}"></script>

<script src="{asset("js/page/select-geo-region.js")}"></script>

{if !$selectRegion}
</body>
</html>

{/if}