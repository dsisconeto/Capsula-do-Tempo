<script src="/js/obj/Site.js"></script>
<script>
    Site.HOST_MAIN = "{$HOST_MAIN}";
</script>
<link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/vendor/font-awesome-4.6.2/css/font-awesome.min.css"">

<form id="form_news_content_img" role="form" method="post" action="/form/admin/noticia/imagem/conteudo/upload/" enctype="multipart/form-data">

    <div class="" style="width: 100%; height: 60px; position: fixed;  background: #fff; z-index: 1000;">
        <div class="row">
            <div class="col-md-4 col-md-offset-3">

                <input type="file" class="form-control" name="news_content_img_file"
                       id="news_content_img_file" required="required">

                <div class="progress " id="news_content_img_progress_box">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                         aria-valuemax="100" style="width: 0%;" id="news_content_img_progress">
                        <span class="sr-only" id="bar_news_content_img_bar">0% Complete</span>
                    </div>
                </div>

            </div>

            <div class="col-md-2">
                <button type="submit" class="form-control btn btn-primary"><i
                            class="fa fa-cloud-upload"
                            aria-hidden="true"></i>
                    Upload Imagem
                </button>

            </div>
        </div>
    </div>
</form>
<div style="width: 100%;height: 60px;"></div>
<div class="container-fluid">
    <div class="row" id="row_content_img">

    </div>
</div>

<script src="/vendor/jquery/jQuery-2.1.4.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/vendor/jqueryAjaxForm/jquery.form.min.js"></script>
<script src="/dist_admin/js/page/news/imgContentUpload.js"></script>