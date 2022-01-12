<% if HasSearched %>
<div class="typography">
    <% if $Results %>
    <% loop $Results.GroupedBy(Section) %>
    <h2 class="searchResults__title">$Section</h2>
    <ul class="searchResults">
        <% loop $Children %>
        <li class="searchResults__item">
            <div class="searchResults__date">$Date.Format('dd/MM/y')</div>
            <a class="searchResults__link" href="$URL" target="_blank">$Title</a>
        </li>
        <% end_loop %>
    </ul>
    <% end_loop %>
    <% else %>
    <p>Sorry, your search did not return any results.</p>
    <% end_if %>
</div>
<% end_if %>