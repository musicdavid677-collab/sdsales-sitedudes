<div class="row">
@foreach ($products as $product)
<div class="col-md-4">
<div class="form-group form-check">
    <input type="checkbox" name="product[]" class="form-check-input" 
    id="{{ $product->getProduct() }}" value="{{ $product['product_id'] }}" 
    />
    <label class="form-check-label" for="{{ $product->getProduct() }}">{{ $product['product'] }}</label>
</div>
</div>
@endforeach
</div>
