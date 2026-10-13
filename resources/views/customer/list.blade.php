<input type="search" name="q"
    class="form-control"
    placeholder="Begin typing to search users" 
    data-hx-get="{{ route('customerSearch') }}" 
    data-hx-trigger="keyup changed delay:500ms, search" 
    data-hx-target=".hx-search-results"
    data-hx-include="[name='exclude_inactive_customers']"
    data-hx-indicator=".htmx-indicator">
    <span class="htmx-indicator">Searching...</span>     
<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="customers">
    <thead>
        <tr>
        <th>@lang("form.name")</th>
        <th>@lang("form.ID")</th>
        <th>@lang("form.primary_email")</th>
        <th>Website</th>
        </tr>
    </thead>
    <tbody class="hx-search-results">
    @include('customer/_list', ['customers' => $customers])
    </tbody>
</table>
