<?php $urlUpdate = url('product-sold/' . $customer_id) ?>
<div class="hx-product-sold-edit">
<!--<form action="{{ $urlUpdate }}"
  method="POST"
  data-hx-put="{{ $urlUpdate }}"
  data-hx-target="this"
  data-hx-swap="outerHTML swap:1s">-->
  @csrf()
  <h5>Product Sold</h5>
  <div class="row">
	@foreach ($products as $product)
	<?php $product_status = in_array($product['product_id'], $productSold) ? 'checked' : '' ?>
    <div class="col-md-4">
      <div class="form-group form-check">
        <input type="checkbox"
          data-hx-post="{{ url('product-sold/' . $product['product_id'] . '?client_id=' . $customer_id . '&product_current_status=' . $product_status) }}"
          hx-trigger="click"
          hx-include="[name='_token']"
          name="product" 
          class="form-check-input"
          id="{{ $product->getProduct() }}" 
          value="{{ $product['product_id'] }}"
	      <?= $product_status ?>
        />
        <label class="form-check-label" for="{{ $product->getProduct() }}">{{ $product['product'] }}</label>
      </div>
    </div>
	@endforeach
	<div class="col-md-12" data-hx-get="{{ $urlUpdate }}" data-hx-target=".hx-product-sold-edit" data-hx-swap="outerHTML swap">
      <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700" hx-on::before-request="checkSession(event)">Cancel</button>
      <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700" hx-on::before-request="checkSession(event)">Submit</button>
    </div>
  </div>
<!--</form>-->
</div>
