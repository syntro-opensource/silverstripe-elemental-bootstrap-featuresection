<div class="container py-5">

        <div class="row mt-5 justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 mb-4 text-center">
                <% if ShowTitle %>
                    <h2 class="mb-4">$Title</h2>
                <% end_if %>
                <p>$Content</p>
            </div>
        </div>
    <div class="row my-5 align-items-center justify-content-center px-5">

        <div class="col-12 col-lg-4">
            <% loop Features %>
                <% if $Odd %>
                    <div class="py-4 d-flex">
                        <div class="icon mr-3 flex-grow-0 flex-shrink-0" style="width: 40px;">
                            <% if IsSvgIcon %>
                                <img src="$Icon.URL" alt="$Title" class="img-fluid">
                            <% else %>
                                <img src="$Icon.Fill(500,500).URL" alt="$Title" class="img-fluid">
                            <% end_if %>
                        </div>
                        <div class="content">
                            <% if ShowTitle %>
                                <h3 class="mt-2 mb-4">$Title</h3>
                            <% end_if %>
                            <p class="mb-4">$Content</p>
                            <% if CTALink %>
                                <% with CTALink %>
                                    <a {$IDAttr} class="text-$Up.Up.LinkColor" href="{$LinkURL}" {$TargetAttr}>
                                        <%t Syntro\SilverStripeElementalBootstrapFeatureSection\Model\Feature.CTA 'Read more...' %>
                                    </a>
                                <% end_with %>
                            <% end_if %>
                        </div>
                    </div>
                <% end_if %>
            <% end_loop %>
        </div>


        <div class="col-10 col-md-5 col-lg-4 col-xl-3">
            <img class="img-fluid" src="$Image.URL" alt="$Title">
        </div>


        <div class="col-12 col-lg-4">
            <% loop Features %>
                <% if $Even %>
                    <div class="py-4 d-flex">
                        <div class="icon mr-3 flex-grow-0 flex-shrink-0" style="width: 40px;">
                            <% if IsSvgIcon %>
                                <img src="$Icon.URL" alt="$Title" class="img-fluid">
                            <% else %>
                                <img src="$Icon.Fill(500,500).URL" alt="$Title" class="img-fluid">
                            <% end_if %>
                        </div>
                        <div class="content">
                            <% if ShowTitle %>
                                <h3 class="mt-2 mb-4">$Title</h3>
                            <% end_if %>
                            <p class="mb-4">$Content</p>
                            <% if CTALink %>
                                <% with CTALink %>
                                    <a {$IDAttr} class="text-$Up.Up.LinkColor" href="{$LinkURL}" {$TargetAttr}>
                                        <%t Syntro\SilverStripeElementalBootstrapFeatureSection\Model\Feature.CTA 'Read more...' %>
                                    </a>
                                <% end_with %>
                            <% end_if %>
                        </div>
                    </div>
                <% end_if %>
            <% end_loop %>
        </div>
    </div>
</div>
