<tr data-hx-target="this" hx-swap="outerHTML">
      <td><strong>{{ $product->product }} </strong></td>
      <td><button class="btn btn-sm"
      arial-label="Edit product"
      data-hx-get="{{ url("settings/product/edit/{$product->product_id}") }}">Edit</button></td>
</tr>
