
<div class="py-5 container text-center">
    <div class="row mt-5 justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 mb-5">
            <% if ShowTitle %>
                <h2 class="mb-3">$Title</h2>
            <% end_if %>
            <% if Content %>
                <p>$Content</p>
            <% end_if %>
        </div>
    </div>
    <div class="row mb-5 justify-content-center text-left px-5">
        <% loop Features %>
            <div class="col-12 col-md-6 col-lg-4 px-4 d-flex">
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
                            <a {$IDAttr} class="text-$Up.Up.ComputedTextColor" href="{$LinkURL}" {$TargetAttr}>
                                <%t Syntro\SilverStripeElementalBootstrapFeatureSection\Model\Feature.CTA 'Read more...' %>
                            </a>
                        <% end_with %>
                    <% end_if %>
                </div>
            </div>
        <% end_loop %>
    </div>

</div>
