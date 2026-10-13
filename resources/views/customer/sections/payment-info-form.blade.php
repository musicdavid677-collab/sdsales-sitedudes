<?php
//lazy eh!?
function moneyFormat($amount) {
    if ($amount === null) {
        return null;
    }
	$fmt = new NumberFormatter('en_CA', NumberFormatter::CURRENCY);
    $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
    $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
    
    $amountWithNoComma = str_replace(',', '', $fmt->format($amount));
    return preg_replace('/\.\d+/i', '', $amountWithNoComma);
}

$billingDate = function($customer) use ($billing_date): ?string {
	return $customer->billing_date ?? $billing_date;
	/*
	if (isset($customer->billing_date) && $customer->billing_date === null) {
		return $billing_date ?? null;
	} 
	
	if (isset($customer->billing_date) && $customer->billing_date !== null) {
		return $customer->billing_date;
	}
	
	return null;*/
};
 		
$url = url('customers/' . $clientId . '/sections/payment-info');
//$url = url('payments/add_ccinfo/' . $clientId );

?>
<form action="{{ $url }}"
  method="POST" 
  data-hx-post="{{ $url }}"
  data-hx-target="this" 
  data-hx-swap="outerHTML swap">
  @csrf()
  <input type="hidden" name="id" value="{{ isset($customer) ? $customer->id : '' }}">
  <h5>Payment Information</h5>
  <div class="grid grid-cols-2 gap-6 py-4">
   <div class="form-group">
      <label for="currency">Currency</label>
      <select name="currency" id="currency" class="block w-full rounded-md py-1.5 text-gray-900">
         <option value="">Select</option>
         <option value="CDN" <?= (isset($customer) && $customer->currency === 'CDN' || old('currency') === 'CDN') ? 'selected' : '' ?>>CDN</option>
         <option value="USD" <?= (isset($customer) && $customer->currency === 'USD' || old('currency') === 'USD') ? 'selected' : '' ?>>USD</option> 
      </select>      
      <div class="invalid-feedback">@php if($errors->has('currency')) { echo $errors->first('currency'); } @endphp</div>   
   </div>
   <div class="form-group">   		
      <label for="setupFee">Setup Fee</label>
      <input type="text"
         name="setup_fee"
         value="{{ isset($customer) ? moneyFormat($customer->setup_fee) : moneyFormat(old('setup_fee')) }}"
         id="setupFee"
         class="block w-full rounded-md py-1.5 text-gray-900">
         <div class="invalid-feedback">@php if($errors->has('setup_fee')) { echo $errors->first('setup_fee'); } @endphp</div>   
   </div>
 </div>
 <div class="grid grid-cols-2 gap-6 py-4">
   <div class="form-group">
      <label for="recurringFee">Recurring Fee</label>
      <input type="text"
         name="recurring_fee"
         value="{{ isset($customer) ? moneyFormat($customer->recurring_fee) : moneyFormat(old('recurring_fee')) }}"
         id="recurringFee"
         class="block w-full rounded-md py-1.5 text-gray-900">
         <div class="invalid-feedback">@php if($errors->has('recurring_fee')) { echo $errors->first('recurring_fee'); } @endphp</div>   
   </div>
   <div class="form-group">
      <label for="totalFees">Total Fee</label>
      <input type="text"
         name="total_fees"
         value="{{ isset($customer) ? moneyFormat($customer->total_fees) : moneyFormat(old('total_fees')) }}"
         id="totalFees"
         class="block w-full rounded-md py-1.5 text-gray-900">
         <div class="invalid-feedback">@php if($errors->has('total_fees')) { echo $errors->first('total_fees'); } @endphp</div>   
   </div>
 </div>
     
    <label>Billing Cycle</label><br />
    <div class="form-check form-check-inline">
      <input type="radio" name="billing_cycle" 
        value="Monthly"
         class="form-check-input"
         {{ (isset($customer) && $customer->billing_cycle === 'Monthly' || old('billing_cycle') === 'Monthly') ? 'checked' : '' }}>
      <label class="form-check-label" for="monthly">Monthly</label>
     </div>
     
     <div class="form-check form-check-inline">
       <input type="radio" name="billing_cycle" 
         value="Quarterly"
         class="form-check-input"
         {{ (isset($customer) && $customer->billing_cycle === 'Quarterly' || old('billing_cycle') === 'Quarterly') ? 'checked' : '' }}>
        <label class="form-check-label" for="quarterly">Quarterly</label>
     </div>
     
    <div class="form-check form-check-inline">
      <input type="radio" name="billing_cycle" value="Semi Annual"
       class="form-check-input"
       {{ (isset($customer) && $customer->billing_cycle === 'Semi Annual' || old('billing_cycle') === 'Semi Annual') ? 'checked' : '' }}>
     <label class="form-check-label" for="semiAnnual">Semi Annual</label>
     </div>
     
     <div class="form-check form-check-inline">
     <input type="radio" name="billing_cycle" value="Annual"
     class="form-check-input"
     {{ (isset($customer) && $customer->billing_cycle === 'Annual' || old('billing_cycle') === 'Annual') ? 'checked' : '' }}>
     <label class="form-check-label" for="annual">Annual</label>
     </div>
     
     <div class="form-check form-check-inline">
     <input type="radio" name="billing_cycle" value="Other"
     class="form-check-input"
     {{ (isset($customer) && $customer->billing_cycle === 'Other' || old('billing_cycle') === 'Other') ? 'checked' : '' }}>
     <label class="form-check-label" for="other">Other</label>
     </div>
      <div class="invalid-feedback">@php if($errors->has('billing_cycle')) { echo $errors->first('billing_cycle'); } @endphp</div><br /><br />
   		
      <label for="billing_date">Day of the Month</label><br />
      <div class="form-check form-check-inline">
     <input type="radio" name="billing_date" value="1st"
     class="form-check-input"
     {{ ($billingDate($customer) === '1st' || old('billing_date') === '1st') ? 'checked' : '' }}>
     <label class="form-check-label" for="monthly">1st</label>
     </div>
     
     <div class="form-check form-check-inline">
     <input type="radio" name="billing_date" value="15th"
     class="form-check-input"
     {{ ($billingDate($customer) === '15th' || old('billing_date') === '15th') ? 'checked' : '' }}>
     <label class="form-check-label" for="15th">15th</label>
     </div>
     
     <div class="form-check form-check-inline">
     <input type="radio" name="billing_date" value="Annual"
     class="form-check-input"
     {{ ($billingDate($customer) === 'Annual' || old('billing_date') === 'Annual') ? 'checked' : '' }}>
     <label class="form-check-label" for="annual">Annual</label>
     </div>
     
     <div class="form-check form-check-inline">
     <input type="radio" name="billing_date" value="Other"
     class="form-check-input"
     {{ ($billingDate($customer) === 'Other' || old('billing_date') === 'Other') ? 'checked' : '' }}>
     <label class="form-check-label" for="other">Other</label>     
     </div>    
      <div class="invalid-feedback">@php if($errors->has('billing_date')) { echo $errors->first('billing_date'); } @endphp</div><br /><br />
 
   <div class="form-group">
      <label for="first_bill_date">First Billing Date <em>(yyyy-mm-dd h:i:s)</em></label>
      <input type="text" name="first_bill_date" value="{{ isset($customer) ? $customer->first_bill_date : old('first_bill_date') }}" class="block w-full rounded-md py-1.5 text-gray-900" />
      <div class="invalid-feedback">@php if($errors->has('first_bill_date')) { echo $errors->first('first_bill_date'); } @endphp</div>   
   </div>
 <div class="form-group">
 
 </div>
  <?php $ids = isset($customer) ? $customer->customer_id . '&id=' . $customer->id : '' ?>
   <div class="form-group">
      <label for="paymentType">Payment Type</label><br />
      <input type="radio" 
      	name="payment_type" 
      	value="1"
      	data-hx-get="{{ url('payment-options') }}?customer_id=<?= $ids ?>"
      	data-hx-target=".hx-payment-options"
      	data-hx-swap="innerHTML"
      	data-hx-trigger="<?= (isset($customer) && (int)$customer->payment_type === 1) ? 'load, click' : 'click' ?>"
      	{{ (isset($customer) && (int)$customer->payment_type === 1 || old('payment_type') === 1) ? 'checked' : '' }}> Credit Card
      	
      <input type="radio" 
      	name="payment_type" 
      	value="2"
      	data-hx-get="{{ url('payment-options') }}?customer_id=<?= $ids ?>"
      	data-hx-target=".hx-payment-options"
      	data-hx-swap="innerHTML"
      	data-hx-trigger="<?= (isset($customer) && (int)$customer->payment_type === 2) ? 'load, click' : 'click' ?>"
      	{{ (isset($customer) && (int)$customer->payment_type === 2 || old('payment_type') === 2) ? 'checked' : '' }}> Cheque
            
   </div>
    <div class="">
        <div class="hx-payment-options"></div>
    </div>
  <button class="orangebtn" data-hx-get="{{ $url }}" hx-on::before-request="checkSession(event)">Cancel</button>
  <button type="submit" class="orangebtn" hx-on::before-request="checkSession(event)">Submit</button>    
</form>    
<script>
$("#setupFee").change(function(){
$total=0;
$setupfee=0;
$recurringfee=0;
if($("#recurringFee").val()!="")
{
$setupfee=$("#setupFee").val();
$recurringfee=$("#recurringFee").val();
$total=parseFloat($setupfee)+parseFloat($recurringfee);
$("#totalFees").val($total);
}
      });
      $("#recurringFee").change(function(){
      $total=0;
      $setupfee=0;
      $recurringfee=0;
      if($("#setuFee").val()!="")
      {
      $setupfee=$("#setupFee").val();
      $recurringfee=$("#recurringFee").val();
      $total=parseFloat($setupfee)+parseFloat($recurringfee);
      $("#totalFees").val($total);
      }
            });
</script>