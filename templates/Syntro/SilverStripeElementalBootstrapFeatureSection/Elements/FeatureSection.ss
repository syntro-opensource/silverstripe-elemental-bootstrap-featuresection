<div class="row justify-content-center text-center">
    <% if ShowTitle || Content %>
        <div class="{$ElementName}__contentholder col-12 col-md-10 col-lg-8 mb-5">
            <% if ShowTitle %>
                <h2 class="{$ElementName}__title mb-4">$Title</h2>
            <% end_if %>
            <% if Content %>
            <p class="{$ElementName}__content">$Content</p>
            <% end_if %>
        </div>
    <% end_if %>
</div>
<div class="{$ElementName}__featureholder row mb-5 justify-content-center px-5">
    <% loop Features %>
        <div class="{$Up.ElementName}__feature col-12 col-md-6 col-lg-4 px-4 d-flex flex-column align-items-center">
            <% if IsSvgIcon %>
                <img src="$Icon.URL" alt="$Title" class="{$Up.ElementName}__feature-icon w-25 img-fluid mb-3 px-2">
            <% else %>
                <img src="$Icon.Fill(500,500).URL" alt="$Title" class="{$Up.ElementName}__feature-icon w-25 img-fluid mb-3 px-2">
            <% end_if %>
            <% if ShowTitle %>
                <h3 class="{$Up.ElementName}__feature-title">$Title</h3>
            <% end_if %>
        <p class="{$Up.ElementName}__feature-content">$Content</p>
            <% if CTALink %>
                <% with CTALink %>
                    <a {$IDAttr} class="{$Up.ElementName}__feature-link text-$Up.Up.LinkColor" href="{$LinkURL}" {$TargetAttr}>
                        <%t Syntro\SilverStripeElementalBootstrapFeatureSection\Model\Feature.CTA 'Read more...' %>
                    </a>
                <% end_with %>
            <% end_if %>
        </div>

    <% end_loop %>
</div>
