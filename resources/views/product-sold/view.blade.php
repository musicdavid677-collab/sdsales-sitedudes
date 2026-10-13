<?php $urlEdit = url('product-sold/' . $customer_id . '/edit') ?>
<div class="hx-product-sold">
<h5>Product Sold <a href="{{ $urlEdit }}" data-hx-get="{{ $urlEdit }}" data-hx-swap="outerHTML" data-hx-target=".hx-product-sold" hx-on::before-request="checkSession(event)">[Edit]</a></h5>
<?php 
$prod_array=array();
foreach ($productSoldModel as $p)
{
//$prod_array[]="<span class='badge badge-primary px-2 py-2 bg-gray-800 text-xs text-white rounded-md'>". $p['product']['product']." </span>";
	echo "<span class='badge badge-primary'>". $p['product']['product']." </span>";
}
//echo implode(',  ', $prod_array );
?>
</div>
