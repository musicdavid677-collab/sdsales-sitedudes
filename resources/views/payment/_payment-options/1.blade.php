<label class="form-check-label">Credit Card Type</label><br />

<div class="form-group form-check-inline">
<input type="radio" name="type_of_card" value="Visa" <?= (old_set('type_of_card', NULL, $customer) === 'Visa') ? 'checked' : '' ?>>
<label class="form-check-label">Visa</label>
</div>
<div class="form-group form-check-inline">
<input type="radio" name="type_of_card" value="MasterCard" <?= (old_set('type_of_card', NULL, $customer) === 'MasterCard') ? 'checked' : '' ?>>
<label class="form-check-label">Master Card</label>
</div>
<div class="form-group form-check-inline">
<input type="radio" name="type_of_card" value="American_Express" <?= (old_set('type_of_card', NULL, $customer) === 'American_Express') ? 'checked' : '' ?>>
<label class="form-check-label">American Express</label>
</div>
<div class="form-group form-check-inline">
<input type="radio" name="type_of_card" value="Discover" <?= (old_set('type_of_card', NULL, $customer) === 'Discover') ? 'checked' : '' ?>>
<label class="form-check-label">Discover</label>
</div>
<div class="grid grid-cols-2 gap-6 py-4">
<div class="form-group">
    <label for="creditCard">Credit Card #</label>
    <input type="tel" maxlength="19" pattern="\d*"
    	name="credit_card"
        value="{{ isset($customer) ? $customer->credit_card : null }}" 
        id="creditCard" 
        class="cc-number block w-full rounded-md py-1.5 text-gray-900"> @if($customer->credit_card !="")<button onclick="copyCCVal(event,'creditCard')" class="copybtn"></button>@endif      
</div>

    <div class="form-group">
        <label for="expiry">Expiry Date</label>
        <input type="text" 
            name="expiry" 
            value="{{ isset($customer) ? $customer->cc_exp : null }}" 
            placeholder="MM/YY"
            id="expiry"
            class="block w-full rounded-md py-1.5 text-gray-900">
    </div>
	<!--
    <div class="col-md-6" style="display:none;visibility:hidden;">
        <div class="form-group">
            <label for="ccv">CCV</label>
            <input type="text"
                name="ccv" 
                value="{{ old_set('ccv', NULL, $customer) }}" 
                placeholder="123"
                id="ccv"                 
                class="form-control">
        </div>
    </div>
    -->

<div class="form-group">
    <label for="nameOnCard">Name On Card</label>
    <input type="text" 
        name="name_on_card" 
        value="{{ isset($customer) ? $customer->name_on_cc : null }}"
        id="nameOnCard"
        class="block w-full rounded-md py-1.5 text-gray-900"> @if($customer->name_on_cc !="")<button onclick="copyCCVal(event, 'nameOnCard');return false;" class="copybtn"></button>@endif
</div>
</div>
@include('customer.partials.billing_ch')
<div class="form-group" style="display:none;visibility:hidden;">
<label>Cardholder Phone #</label>
<input type="text" name="cardholder_phone" value="" class="block w-full rounded-md py-1.5 text-gray-900">
</div>

 <script>
     function copyCCVal(event,id) {
        event.preventDefault();
  let copyText = document.getElementById(id).value;
  navigator.clipboard.writeText(copyText);
return false;
}
         /*$(function(){
         $(".hx-payment-options .cc-number").formatCardNumber();
         $(".hx-payment-options #expiry").formatCardExpiry();
         $(".hx-payment-options .cc-cvc").formatCardCVC();
         });*/
         </script>
