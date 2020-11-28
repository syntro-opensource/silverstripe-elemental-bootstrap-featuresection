<% include Syntro\SilverStripeElementalBaseitems\ContentBlock %>

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
