<style>
div.form-check-inline{float:left; padding:5px};
</style>
<div class="grid grid-cols-4 gap-6 py-4">
   <div class="form-group">
      <label for="currency">Currency</label>
      <select name="currency" id="currency" class="block w-full rounded-md py-1.5 text-gray-900">
         <option value="">Select</option>
         <option value="CDN" <?= (old('currency', $rec) === 'CDN') ? 'selected' : '' ?>>CDN</option>
         <option value="USD" <?= ( old('currency', $rec) === 'USD') ? 'selected' : '' ?>>USD</option> 
      </select>      
      <div class="invalid-feedback">@php if($errors->has('currency')) { echo $errors->first('currency'); } @endphp</div>   
   </div>
   <div class="form-group">   		
      <label for="setupFee">Setup Fee</label>
      <input type="text"
         name="setup_fee"
         value="{{old('setup_fee', $rec)}}"
         id="setupFee"
         class="block w-full rounded-md py-1.5 text-gray-900" onchange="totalFee()">
         <div class="invalid-feedback">@php if($errors->has('setup_fee')) { echo $errors->first('setup_fee'); } @endphp</div>   
   </div>
   <div class="form-group">
      <label for="recurringFee">Recurring Fee</label>
      <input type="text"
         name="recurring_fee"
         value="{{old('recurring_fee',$rec)}}"
         id="recurringFee"
         class="block w-full rounded-md py-1.5 text-gray-900" onchange="totalFee()">
         <div class="invalid-feedback">@php if($errors->has('recurring_fee')) { echo $errors->first('recurring_fee'); } @endphp</div>   
   </div>
   <div class="form-group">
      <label for="totalFees">Total Fee</label>
      <input type="text"
         name="total_fees"
         value="{{old('total_fees',$rec)}}"
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
         {{ (old('billing_cycle',$rec) === 'Monthly') ? 'checked' : '' }}>
      <label class="form-check-label" for="monthly">Monthly</label>
     </div>
     
     <div class="form-check form-check-inline">
       <input type="radio" name="billing_cycle" 
         value="Quarterly"
         class="form-check-input"
         {{  (old('billing_cycle',$rec) === 'Quarterly') ? 'checked' : '' }}>
        <label class="form-check-label" for="quarterly">Quarterly</label>
     </div>
     
    <div class="form-check form-check-inline">
      <input type="radio" name="billing_cycle" value="Semi Annual"
       class="form-check-input"
       {{ ( old('billing_cycle',$rec) === 'Semi Annual') ? 'checked' : '' }}>
     <label class="form-check-label" for="semiAnnual">Semi Annual</label>
     </div>
     
     <div class="form-check form-check-inline">
     <input type="radio" name="billing_cycle" value="Annual"
     class="form-check-input"
     {{ (old('billing_cycle',$rec) === 'Annual') ? 'checked' : '' }}>
     <label class="form-check-label" for="annual">Annual</label>
     </div>
     
     <div class="form-check form-check-inline">
     <input type="radio" name="billing_cycle" value="Other"
     class="form-check-input"
     {{ ( old('billing_cycle',$rec) === 'Other') ? 'checked' : '' }}>
     <label class="form-check-label" for="other">Other</label>
     </div>
      <div class="invalid-feedback">@php if($errors->has('billing_cycle')) { echo $errors->first('billing_cycle'); } @endphp</div><br /><br />
   		 <div class="grid grid-cols-2 gap-6 py-4">
        <div class="form-group">
      <label for="billing_date">Day of the Month</label><br />
      <div class="form-check form-check-inline">
     <input type="radio" name="billing_date" value="1st"
     class="form-check-input"
     {{ (old('billing_date',$rec) === '1st') ? 'checked' : '' }}>
     <label class="form-check-label" for="monthly">1st</label>
     </div>
     
     <div class="form-check form-check-inline">
     <input type="radio" name="billing_date" value="15th"
     class="form-check-input"
     {{ (old('billing_date',$rec) === '15th') ? 'checked' : '' }}>
     <label class="form-check-label" for="15th">15th</label>
     </div>
     
     <div class="form-check form-check-inline">
     <input type="radio" name="billing_date" value="Annual"
     class="form-check-input"
     {{ (old('billing_date',$rec) === 'Annual') ? 'checked' : '' }}>
     <label class="form-check-label" for="annual">Annual</label>
     </div>
     
     <div class="form-check form-check-inline">
     <input type="radio" name="billing_date" value="Other"
     class="form-check-input"
     {{ (old('billing_date',$rec) === 'Other') ? 'checked' : '' }}>
     <label class="form-check-label" for="other">Other</label>     
     </div>    
      <div class="invalid-feedback">@php if($errors->has('billing_date')) { echo $errors->first('billing_date'); } @endphp</div><br /><br />
    </div>
  
       </div>
   <div class="grid grid-cols-2 gap-6 py-4">
   <div class="form-group"  @php if(auth()->user()!==null){ if(!auth()->user()->is_administrator){ echo 'style="display:none"';}} @endphp>
      <label for="first_bill_date">First Billing Date </label>
       <div x-data x-init="flatpickr($refs.dateInput,{altInput: true,altFormat: 'Y-m-d', dateFormat: 'Y-m-d', defaultDate: ['{{ old_set('first_bill_date', NULL,$rec)  }}']})">
      <input type="text" x-ref="dateInput" placeholder="YYYY-MM-DD"  name="first_bill_date" value="{{  old('first_bill_date',$rec) }}" class="block w-full rounded-md py-1.5 text-gray-900" />
      <div class="invalid-feedback">@php if($errors->has('first_bill_date')) { echo $errors->first('first_bill_date'); } @endphp</div>   
   </div>
   </div>
 <div class="form-group"  @php if(auth()->user()!==null){ if(!auth()->user()->is_administrator){ echo 'style="display:none"';}} @endphp>
 <label for="first_bill_date">Signup Date </label>
       <div x-data x-init="flatpickr($refs.dateInput,{altInput: true,altFormat: 'Y-m-d', dateFormat: 'Y-m-d', defaultDate: ['{{ old_set('signup_date', NULL,$rec)  }}']})">
      <input type="text" x-ref="dateInput" placeholder="YYYY-MM-DD"  name="signup_date" value="{{  old('signup_date',$rec) }}" class="block w-full rounded-md py-1.5 text-gray-900" />
      <div class="invalid-feedback">@php if($errors->has('signup_date')) { echo $errors->first('signup_date'); } @endphp</div>
 </div>
</div>
</div>
<div class="gap-6 py-4">
<label class="form-check-label">Payment Type</label><br />
<select name="payment_type" id="payment_type" class="block w-full rounded-md py-1.5 text-gray-900" onchange="paymentType()">
<option value="1" <?= (old('payment_type', $rec) === '1') ? 'selected' : '' ?>>Credit Card</option>
<option value="2" <?= (old('payment_type', $rec) === '2') ? 'selected' : '' ?>>Cheque</option>
</select>
</div>
<div id="ccinfo" style="display:block">
<label class="form-check-label">Credit Card Type</label><br />
<div style="clear:both">
<div class="form-group form-check-inline">
<input type="radio" name="type_of_card" value="Visa" <?= (old_set('type_of_card', NULL, $rec) === 'Visa') ? 'checked' : '' ?>>
<label class="form-check-label">Visa</label>
</div>
<div class="form-group form-check-inline">
<input type="radio" name="type_of_card" value="MasterCard" <?= (old_set('type_of_card', NULL, $rec) === 'MasterCard') ? 'checked' : '' ?>>
<label class="form-check-label">Master Card</label>
</div>
<div class="form-group form-check-inline">
<input type="radio" name="type_of_card" value="American_Express" <?= (old_set('type_of_card', NULL, $rec) === 'American_Express') ? 'checked' : '' ?>>
<label class="form-check-label">American Express</label>
</div>
<div class="form-group form-check-inline">
<input type="radio" name="type_of_card" value="Discover" <?= (old_set('type_of_card', NULL, $rec) === 'Discover') ? 'checked' : '' ?>>
<label class="form-check-label">Discover</label>
</div></div><br/><br/>
<div class="grid grid-cols-3 gap-6 py-4">
<div class="form-group">
    <label for="creditCard">Credit Card #</label>
    <input type="text" maxlength="19" pattern="\d*"
    name="credit_card" <?php if(!check_perm('payments_edit')) echo "disabled='disabled'"; ?>
        value="{{ old('credit_card',isset($ccinfo['cc']) ? $ccinfo['cc']:'' ) }}"
        id="creditCard"
        class="block w-full rounded-md py-1.5 text-gray-900 cc-number">
</div>

    <div class="form-group">
        <label for="expiry">Expiry Date</label>
        <input type="text" <?php if(!check_perm('payments_edit')) echo "disabled='disabled'"; ?>
            name="expiry"
            value="{{ old('expiry',isset($ccinfo['cc_exp']) ?$ccinfo['cc_exp']:'' ) }}"
            placeholder="MM/YY" x-mask="99/99" x-data
            id="expiry"
            class="block w-full rounded-md py-1.5 text-gray-900" onfocusout="checkExp()" >
    </div>
<div class="form-group">
    <label for="nameOnCard">Name On Card</label>
    <input type="text" <?php if(!check_perm('payments_edit')) echo "disabled='disabled'"; ?>
        name="name_on_card"
        value="{{ old('name_on_card',isset($ccinfo['name_on_cc']) ? $ccinfo['name_on_cc']: '') }}"
        id="nameOnCard"
        class="block w-full rounded-md py-1.5 text-gray-900">
</div>
</div>


</div>
<div id="chequeinfo" style="display:none">
<div class="grid grid-cols-3 gap-6 py-4">
<div class="form-group">
<label>Name on Cheque</label>
<input type="text" name="pbc_name_on_cheque"  class="block w-full rounded-md py-1.5 text-gray-900 cc-number">
</div>
<div class="form-group">
<label>Bank Routing Code</label>
<input type="text" name="pbc_routing_code" aria-label="Bank Routing Code" class="block w-full rounded-md py-1.5 text-gray-900 cc-number" onfocusout="formatRouting(this)">
</div><div class="form-group">
<label>Account Number</label>
<input type="text" name="pbc_bank_account_num"  aria-label="Account Number" class="block w-full rounded-md py-1.5 text-gray-900 cc-number">
</div>
</div>
</div>
<div class="form-group" style="display:none;visibility:hidden;">
<label>Cardholder Phone #</label>
<input type="text" name="cardholder_phone" value="" class="block w-full rounded-md py-1.5 text-gray-900">
</div>
   </div>
    <div class="">
        <div class="hx-payment-options"></div>
    </div>

<script>

function totalFee()
{
$total=0;
$setupfee=0;
$recurringfee=0;

$setupfee=document.getElementById("setupFee").value
$recurringfee=document.getElementById("recurringFee").value;
if($setupfee!="" && $recurringfee!="")
{
$total=parseFloat($setupfee)+parseFloat($recurringfee);
document.getElementById("totalFees").value=parseFloat($total);
}


}

function paymentType()
{
  if( document.getElementById('payment_type').value==1)
  {
     document.getElementById("chequeinfo").style.display="none";
     document.getElementById("ccinfo").style.display="block";
  }
  else
  {
     document.getElementById("chequeinfo").style.display="block";
     document.getElementById("ccinfo").style.display="none";
  }


}

function checkExp()
{
let exp=document.getElementById('expiry').value;
let expArr=exp.split('/');
let thisDate=new Date();

console.log(typeof(thisDate.getFullYear()));
if(Number("20"+expArr[1])<(Number(thisDate.getFullYear())))
{
  document.getElementById('expiry').value="";
  alert("Credit Card Expired");
}
else if(Number("20"+expArr[1])==(Number(thisDate.getFullYear())))
{
if((Number(thisDate.getMonth())+1) > Number(expArr[0]))
{
    document.getElementById('expiry').value="";
  alert("Credit Card Expired");
}

}

}
function formatRouting(routingCode)
{
  if(document.getElementById("currency").value=="CDN")
  {
let currency = document.getElementById("currency").value;
let code=routingCode.value;
code=code.replace(/\s+/g, '');
code=code.replace(/-+/g, '');
//code.substring(code.length - 3);
let newCode=code.substring(0, 5) + " " + code.substring(5);
routingCode.value=newCode;
}
}
/*$("#setupFee").change(function(){
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
            });*/
</script>