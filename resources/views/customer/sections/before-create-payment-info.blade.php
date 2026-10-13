<?php $urlCreateClientCredentials = url("customers/{$clientId}/sections/payment-info/create") ?>
<div class="hx-payment-info">
  <h5>No Payment Information Found
  <a href="{{ $urlCreateClientCredentials }}" 
  data-hx-get="{{ $urlCreateClientCredentials }}" 
  data-hx-swap="outerHTML" 
  data-hx-target=".hx-payment-info">[Create]</a>
  </h5>
</div>
