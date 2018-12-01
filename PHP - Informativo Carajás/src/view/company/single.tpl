{include "../header.tpl"}
<link rel="stylesheet" href="/css/page/company/company-single.css">
<link rel="stylesheet" href="/vendor/animate-css/css.css">
<link rel="stylesheet" href="/vendor/blueimp-gallery/css/blueimp-gallery.css">

<div class="company-cover ">
    <img src="/img/company_cover/lg/{$companyCover}" class="img-responsive"
         alt="Capa da empresa {$companyFantasyName} ">
    <h1 class="hidden">{$companyFantasyName} </h1>
</div>

<div class="container">


    <div class="row hidden-print">

        <div class="col-md-4 col-xs-6">
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={$metaUrl}"
               class="btn-shared btn-shared-facebook"><i class="fa fa-facebook"
                                                         aria-hidden="true"></i>
                Compartilhar
            </a>
        </div>

        <div class="col-md-4 col-xs-6">
            <a target="_blank" href="https://plus.google.com/share?url={$metaUrl}"
               class="btn-shared btn-shard-google-plus">

                <i class="fa fa-google-plus"
                   aria-hidden="true"></i>
                Compartilhar
            </a>
        </div>
        <div class="col-md-4 col-xs-6">
            <a target="_blank" href="https://twitter.com/intent/tweet?text={$metaUrl}"
               class="btn-shared btn-shared-twitter">
                <i class="fa fa-twitter" aria-hidden="true"></i> Compartilhar

            </a>
        </div>
        <div class="col-md-3 col-xs-6">
            {if $isMobile}
                <a href="whatsapp://send?text={$metaUrl}" class="btn-shared btn-shard-whats-app">

                    <i class="fa fa-whatsapp" aria-hidden="true">
                    </i> Compartilhar
                </a>
            {/if}
        </div>

    </div>


    <div class="row">

        <div class="col-md-8">

            <div class="row">
                <div class="col-md-12">
                    <div class="tag-section tag-section-company">
                        <i class="fa fa-map-marker" aria-hidden="true"></i> Endereço -
                        <small>{$companyAddress}</small>
                    </div>
                    {if $companyAddressEmbed}
                        <div class="google-maps margin-bottom-20">
                            <iframe src="https://www.google.com/maps/embed?pb={$companyAddressEmbed}"
                                    frameborder="0" style="border:0"
                                    allowfullscreen></iframe>
                        </div>
                    {/if}
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="tag-section tag-section-company">Sobre</div>
                    {$companyDescription}
                </div>
            </div>


            {if isset($companyGallery)}
                <div class="row">
                    <div class="col-md-12">
                        <div class="tag-section tag-section-company"><i class="fa fa-picture-o" aria-hidden="true"></i>
                            Imagens
                        </div>
                        <!--{$count = 0} -->
                        <div id="links">
                            {foreach from=$companyGallery item=keyGallery}
                                <a href="/img/company_gallery/lg/{$keyGallery.company_gallery_file}"
                                   title="{$count++} - Foto da Empresa {$companyFantasyName}" class="gallery-box">

                                    <img class="gallery-img"
                                         src="/img/company_gallery/xs/{$keyGallery.company_gallery_file}"
                                         alt="Foto da Empresa {$companyFantasyName}">

                                </a>
                            {/foreach}
                        </div>

                    </div>
                </div>
            {/if}
        </div>
        <div class="col-md-4">
            {if $companySocial}
                <div class="tag-section tag-section-company">
                    Redes Sociais:
                </div>
                <div class="row">
                    {foreach from=$companySocial item=keySocial}
                        <div class="col-md-3">
                            <a target="_blank" href="{$keySocial.company_social_network_link}"
                               class="btn-shared"
                               style="background:#{$keySocial.system_social_network_color}"><i
                                        class="{$keySocial.system_social_network_icon}"
                                        aria-hidden="true"></i>
                            </a>
                        </div>
                    {/foreach}
                </div>
            {/if}



            {if isset($companyPhone)}
                <div class="tag-section tag-section-company">
                    <i class="fa fa-phone-square" aria-hidden="true"></i>
                    FONE:
                </div>
                {foreach from=$companyPhone item=keyPhone}
                    <p> {$keyPhone.company_phone}</p>
                {/foreach}
            {/if}


            {if $companyEmail}
                <div class="tag-section tag-section-company "><i class="fa fa-envelope" aria-hidden="true"></i>
                    Email:
                </div>
                <form id="form_email" method="post" action="/form/company-email/enviar/">


                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" class="form-control" placeholder="Seu nome" name="my_name"
                               required="required" id="my_name">
                    </div>

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" placeholder="Seu Email" name="my_email"
                               required="required" id="my_email">
                    </div>


                    <div class="form-group">
                        <label>Assunto:</label>
                        <input type="text" class="form-control" placeholder="Assunto da Mensagem" name="subject"
                               required="required" id="subject">
                    </div>
                    <div class="form-group">
                        <label for="company_email_id">Falar com departamento:</label>
                        <select class="form-control" name="company_email_id" id="company_email_id">
                            {foreach from=$companyEmail item=keyEmail}
                                <option value="{$keyEmail.company_email_id}">{$keyEmail.company_email}</option>
                            {/foreach}
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email_msg">Mensagem:</label>
                        <textarea class="form-control" rows="5" name="email_msg" id="email_msg"
                                  required="required"></textarea>
                    </div>
                    <div class="form-group">

                        <button type="submit" class="btn btn-primary form-control">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            Enviar Email
                        </button>

                    </div>

                </form>
                <div class="row">
                    <div class="col-md-12">
                        {foreach from=$companyEmail item=keyEmail}
                            <p>
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                {$keyEmail.company_email}
                            </p>
                        {/foreach}
                    </div>
                </div>
            {/if}
        </div>
    </div>
</div>

<div id="blueimp-gallery" class="blueimp-gallery  {if !$isMobile}blueimp-gallery-controls{/if}">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>


<script src="/vendor/jqueryAjaxForm/jquery.form.min.js"></script>
<script src="/vendor/noty-master/js/noty/packaged/jquery.noty.packaged.min.js"></script>
<script src="/vendor/blueimp-gallery/js/blueimp-gallery.min.js"></script>
<script src="/js/page/company/company-single.js"></script>


{include "../footer.tpl"}