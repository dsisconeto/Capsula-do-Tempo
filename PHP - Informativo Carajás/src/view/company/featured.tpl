<div class="row">
    <div class="col-md-12">
        <div class="tag-section tag-section-company">
            Empresas em Destaque
        </div>
    </div>
</div>

{if $companyTop}
    <div class="row">
        {foreach from=$companyTop item=$key}
            <div class="col-md-3 col-sm-6">
                <a href="/{$key.system_url_url}"
                   class="company-box">

                    <div class="company-box-img">
                        <img src="/img/company_logo/sm/{$key.company_logo}"
                             class="img-responsive center-block">
                    </div>

                    <div class="company-box-text">
                        <div class="company-box-title">
                            {$key.company_fantasy_name}
                        </div>
                        <p>
                            {$key.company_address}
                        </p>
                        <p>
                            {$key.company_phone}
                        </p>
                    </div>
                </a>
            </div>
        {/foreach}
    </div>
{/if}