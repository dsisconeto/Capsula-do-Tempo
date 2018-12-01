<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form role="form" class="search" method="get" action="/empresas/pesquisar/">

            <input type="text" class="form-control  margin-bottom-20"
                   placeholder="Pesquisar Empresas por nome ou segmento..."
                   style="width: 85%;border-radius: 20px 0 0 20px; float: left;"
                   value="{if isset($search)}{$search}{/if}"
                   name="arg"
                   autocomplete="off">

            <button class="btn btn-primary form-control margin-bottom-20"
                    style="width: 15%;    border-radius: 0 20px 20px 0px; float: left;">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </form>
    </div>
</div>

{if !$isMobile}
    <div class="row margin-bottom-20 hidden-xs hidden-sm">

        <div class="col-md-12">
            <a href="/empresas/pesquisar/?arg=Alimentação" class="segment-icon">
                <img src="/img/company-segment-01.png" class="img-responsive center-block">
                <p>Alimentação</p>
            </a>

            <a href="/empresas/pesquisar/?arg=Hospedagem" class="segment-icon">
                <img src="/img/company-segment-02.png" class="img-responsive center-block">
                <p>Hospedagem</p>
            </a>

            <a href="/empresas/pesquisar/?arg=Diversão" class="segment-icon">
                <img src="/img/company-segment-04.png" class="img-responsive center-block">
                <p>Diversão</p>
            </a>

            <a href="/empresas/pesquisar/?arg=Imobiliárias" class="segment-icon">
                <img src="/img/company-segment-05.png" class="img-responsive center-block">
                <p>Imobiliárias</p>
            </a>

            <a href="/empresas/pesquisar/?arg=Farmácias+e+Drograrias" class="segment-icon">
                <img src="/img/company-segment-06.png" class="img-responsive center-block">
                <p>Farmácias e <br> Drograrias</p>
            </a>

            <a href="/empresas/pesquisar/?arg=Supermercados" class="segment-icon">
                <img src="/img/company-segment-07.png" class="img-responsive center-block">
                <p>Supermercados</p>
            </a>


            <a href="/empresas/pesquisar/?arg=Roupas+e+Calçados" class="segment-icon">
                <img src="/img/company-segment-03.png" class="img-responsive center-block">
                <p>Roupas e <br> Calçados</p>
            </a>

        </div>
    </div>
{/if}