<?php
//lazy eh!?
function moneyFormat($amount) {
    if ($amount === null) {
    	return null;
    }
	$fmt = new NumberFormatter('en_CA', NumberFormatter::CURRENCY);
    $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
    $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
    return $fmt->format($amount);
}

$url = url('customers/' . $clientId . '/sections/payment-info/edit');
?>
<div class="hx-payment-info">
  <h5>Payment Information @if(check_perm('payments_edit'))<a href="{{ $url }}" data-hx-get="{{ $url }}" data-hx-swap="outerHTML" data-hx-target=".hx-payment-info" hx-on::before-request="checkSession(event)">[Edit]</a>@endif</h5>
    Payment Type: <code>
    <?php if ((int)$customer->payment_type === 1): ?>
    Credit Card
    <?php elseif ((int)$customer->payment_type === 2): ?>
    Cheque
    <?php endif ?>
    </code><br />
    
    <span style="color:green; font-weight:bold">Recurring Fee: $<code>{{ moneyFormat($customer->recurring_fee) }}</code></span> <br/>
    Setup Fee: $<code>{{ moneyFormat($customer->setup_fee) }}</code> <br/>
    Total Fees: $<code>{{ moneyFormat($customer->total_fees) }}</code> <br/>
    Currency: <code>
    <?php if ($customer->currency === 'CDN'): ?>
    CDN
    <?php elseif ($customer->currency === 'USD'): ?>
    USD
    <?php endif ?>
    </code><br />
    Billing Cycle: <code>
    <?php if ($customer->billing_cycle === 'Monthly'): ?>
    Monthly
    <?php elseif ($customer->billing_cycle === 'Quarterly'): ?>
    Quarterly
    <?php elseif ($customer->billing_cycle === 'Semi Annual'): ?>
    Semi Annual
    <?php elseif ($customer->billing_cycle === 'Annual'): ?>
    Annual
    <?php elseif ($customer->billing_cycle === 'Other'): ?>
    Other			
    <?php endif ?>
    </code><br />
   Day of the month: <code>{{ $customer->billing_date ?? $billing_date }}</code><br />
   First Billing Date: <code>{{ ($customer->first_bill_date !== null) ? date_format(date_create($customer->first_bill_date), 'M. d, Y h:i:s A') : '' }}</code><br/><br/>
  
</div>
