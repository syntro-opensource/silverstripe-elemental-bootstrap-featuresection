<div class="row align-items-center justify-content-between text-center">
    <div class="{$ElementName}__image col-10 col-md-5 col-lg-4 col-xl-3">
        <img class="img-fluid" src="$Image.URL" alt="$Title">
    </div>
    <div class="col-12 col-md-6 col-lg-7 col-xl-8 py-4">
        <% if ShowTitle || Content %>
            <div class="{$ElementName}__contentholder col-12 col-md-10 col-lg-8 mb-5">
                <% if ShowTitle %>
                    <h2 class="{$ElementName}__title mb-3">$Title</h2>
                <% end_if %>
                <% if Content %>
                <p class="{$ElementName}__content">$Content</p>
                <% end_if %>
            </div>
        <% end_if %>
        <% loop Features %>
            <div class="{$Up.ElementName}__feature pt-4">
                <div class="media">
                    <div class="{$Up.ElementName}__feature-icon mr-3" style="width:3rem;">
                        <% if IsSvgIcon %>
                            <img src="$Icon.URL" alt="$Title" class="img-fluid">
                        <% else %>
                            <img src="$Icon.Fill(500,500).URL" alt="$Title" class="img-fluid">
                        <% end_if %>
                    </div>

                    <div class="{$Up.ElementName}__feature-body media-body">
                        <% if ShowTitle %>
                            <h3 class="{$Up.ElementName}__feature-title mt-2 mb-4">$Title</h3>
                        <% end_if %>
                    <p class="{$Up.ElementName}__feature-content mb-4">$Content</p>
                        <% if CTALink %>
                            <% with CTALink %>
                                <a {$IDAttr} class="{$Up.ElementName}__feature-link text-$Up.Up.LinkColor" href="{$LinkURL}" {$TargetAttr}>
                                    <%t Syntro\SilverStripeElementalBootstrapFeatureSection\Model\Feature.CTA 'Read more...' %>
                                </a>
                            <% end_with %>
                        <% end_if %>
                    </div>
                </div>
            </div>
        <% end_loop %>
    </div>
</div>
