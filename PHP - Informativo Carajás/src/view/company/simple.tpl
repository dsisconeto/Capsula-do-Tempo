{include "../header.tpl"}
<link rel="stylesheet" href="/css/page/company/simple.css">

<div class="container">

    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="tag-section tag-section-company">Empresa</div>

                    <h1>{$companyFantasyName}</h1>
                    <p>{$companyAddress}</p>

                    {if isset($companyPhone)}
                        <h3><i class="fa fa-phone-square" aria-hidden="true"></i>
                            FONE:
                        </h3>
                        {foreach from=$companyPhone item=keyPhone}
                            <p>{$keyPhone.company_phone}</p>
                        {/foreach}

                    {/if}

                    {if $companyEmail}
                        <h3><i class="fa fa-envelope" aria-hidden="true"></i> Email:</h3>
                        {foreach from=$companyEmail item=keyEmail}
                            <p>
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                {$keyEmail.company_department_name}
                                : {$keyEmail.company_email}
                            </p>
                        {/foreach}

                    {/if}
                </div>
            </div>

        </div>

    </div>

</div>


{include "../footer.tpl"}