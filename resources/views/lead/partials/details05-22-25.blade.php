<?php
//lazy eh!?
function moneyFormat($amount) {
if(gettype($amount)!=="string"){
	$fmt = new NumberFormatter('en_CA', NumberFormatter::CURRENCY);
    $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
    $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
    return $fmt->format($amount);}
}
?>

<style>
 fieldset{border:1px solid #9e9e9e;padding:0.75rem;}
 legend{width:auto;font-size:1.2rem;}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
    margin: 0;
    }
    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
      }
</style>
<script>
  document.addEventListener('alpine:init', () => {
 // function splitUrl(){
  let url = document.getElementById("url").value;
  if(url!="")
  {
  let url_split=url.split("://");
  alert(url_split[0]);alert(url_split[1]);
  document.getElementById("http").value=url_split[0]+"://";
  document.getElementById("url").value=url_split[1];
  }
//}
});
function statusChange() {
  let lead_status = document.getElementById("lead_status_id").value;
  //document.getElementById("demo").innerHTML = "You selected: " + x;
  if(lead_status==2)
  {
  alert("This lead will be converted to a customer once you click submit.");
  }
}

function countryChange() {
  let country = document.getElementById("country_id").value;
  //document.getElementById("demo").innerHTML = "You selected: " + x;
  if(country==1)
  {
    document.getElementById("ordProvince").value="";
  document.getElementById("ordProvince_country_CA").disabled=false;
  document.getElementById("ordProvince_country_US").disabled=true;
  }
  else
  {
     document.getElementById("ordProvince").value="";
 document.getElementById("ordProvince_country_CA").disabled=true;
  document.getElementById("ordProvince_country_US").disabled=false;
  }
}
</script>
<div class="row">
   <div class="col-md-6">
   <div class="grid grid-cols-2 gap-4 py-4">
<div class="form-group col-md-4">
<label for="lead_status_id">@lang('form.status') <span class="required">*</span></label>
<select name="lead_status_id" id="lead_status_id" class="block w-full rounded-md py-1.5 text-gray-900" onchange="statusChange()">
@foreach($data['lead_status_id_list'] as $lead_status_key =>$lead_status_value)
@if(!isset($rec->id) && $lead_status_key==2)
 @else
 <option value="{{$lead_status_key}}" {{ old('lead_status_id', $rec) == $lead_status_key ? 'selected' : '' }}>{{$lead_status_value}} </option>
@endif
@endforeach
                  </select>
<div class="invalid-feedback">@php if($errors->has('lead_status_id')) { echo $errors->first('lead_status_id') ; } @endphp</div>
</div>

<div class="form-group col-md-4">
<label for="lead_source_id">@lang('form.source') <span class="required">*</span></label>
<select name="lead_source_id" id="lead_source_id" class="block w-full rounded-md py-1.5 text-gray-900">
@foreach($data['lead_source_id_list'] as $lead_source_key =>$lead_source_value)
<option value="{{$lead_source_key}}" {{ old('lead_source_id', $rec) == $lead_source_key ? 'selected' : '' }}>{{$lead_source_value}} </option>
@endforeach
</select>
<div class="invalid-feedback">@php if($errors->has('lead_source_id')) { echo $errors->first('lead_source_id') ; } @endphp</div>
</div>

   </div>
   <div class="grid grid-cols-3 gap-4 py-4">
      <div class="form-group">
		<div><label for="salutation">Salutation</label></div>
		<div class="form-check form-check-inline inline-block">
		  <input class="form-check-input" type="radio" name="salutation" value="Mr." <?= (old('salutation', $rec) === 'Mr.') ? 'checked' : '' ?>>
		  <label class="form-check-label" for="inlineRadio1">Mr.</label>
		</div>
		<div class="form-check form-check-inline inline-block">
		  <input class="form-check-input" type="radio" name="salutation" value="Sir" <?= (old('salutation', $rec) === 'Sir') ? 'checked' : '' ?>>
		  <label class="form-check-label" for="inlineRadio1">Sir</label>
		</div>
		<div class="form-check form-check-inline inline-block">
		  <input class="form-check-input" type="radio" name="salutation" value="Ms." <?= (old('salutation', $rec) === 'Ms.') ? 'checked' : '' ?>>
		  <label class="form-check-label" for="inlineRadio1">Ms.</label>
		</div>
		<div class="form-check form-check-inline inline-block">
		  <input class="form-check-input" type="radio" name="salutation" value="Miss" <?= (old('salutation', $rec) === 'Miss') ? 'checked' : '' ?>>
		  <label class="form-check-label" for="inlineRadio1">Miss</label>
		</div>
		<div class="form-check form-check-inline inline-block">
		  <input class="form-check-input" type="radio" name="salutation" value="Mrs." <?= (old('salutation', $rec) === 'Mrs.') ? 'checked' : '' ?>>
		  <label class="form-check-label" for="inlineRadio1">Mrs.</label>
		</div>
		<div class="form-check form-check-inline inline-block">
		  <input class="form-check-input" type="radio" name="salutation" value="Dr." <?= (old('salutation', $rec) === 'Dr.') ? 'checked' : '' ?>>
		  <label class="form-check-label" for="inlineRadio1">Dr.</label>
		</div>
		
      <div class="invalid-feedback">@php if($errors->has('salutation')) { echo $errors->first('salutation'); } @endphp</div>
      </div>
      <div class="form-group ">
         <label for="first_name">First Name <span class="required">*</span></label>
         <input type="text" class="form-control @php if($errors->has('first_name')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" name="first_name" value="{{ old('first_name', $rec) }}">
         <div class="invalid-feedback">@php if($errors->has('first_name')) { echo $errors->first('first_name'); } @endphp</div>
      </div>
      <div class="form-group ">
         <label for="last_name">Last Name <span class="required">*</span></label>
         <input type="text" class="form-control @php if($errors->has('last_name')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" name="last_name" value="{{ old('last_name', $rec) }}">
         <div class="invalid-feedback">@php if($errors->has('last_name')) { echo $errors->first('last_name'); } @endphp</div>
      </div>
      </div>
      <div class="form-group ">
         <label for="company">Company <span class="required">*</span></label>
         <input type="text" class="form-control @php if($errors->has('company')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" name="company" value="{{ old('company', $rec) }}">
         <div class="invalid-feedback">@php if($errors->has('company')) { echo $errors->first('company'); } @endphp</div>
      </div>
      <div class="row">
          <div class="col-md-12">
              @include('customer.partials.billing_and_shipping')
                 </div>
                 </div>
                 <div class="grid grid-cols-3 gap-6 py-4">
      <div class="form-group">
            <label for="email_address">Email <span class="required">*</span></label>
            <input type="email" class="form-control @php if($errors->has('email_address')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" id="email_address" name="email_address" value="{{ old('email_address', $rec) }}">
            <div class="invalid-feedback">@php if($errors->has('email_address')) { echo $errors->first('email_address') ; } @endphp</div>
         </div>
         <div class="form-group">
            <label for="url">@lang('form.website') <span class="required">*</span> (www.website.com)</label>
            <div class="grid grid-cols-2"><div><select name="http" id="http" class="form-control"><option value="https://">https://</option> <option value="http://">http://</option></select></div><div> <input type="text" class="form-control @php if($errors->has('url')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" id="url" name="url" value="{{ old('url', $rec) }}"></div></div>
            <div class="invalid-feedback">@php if($errors->has('url')) { echo $errors->first('url'); } @endphp</div>
         </div>
         <div class="form-group">
           <label for="dev_url">Dev URL (eg: http://website.sitedudes.com)</label>
<input type="text" class="form-control @php if($errors->has('dev_url')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" id="dev_url" name="dev_url" value="{{ old('dev_url', $rec) }}">
         </div>
         </div>
      <div class="grid grid-cols-3 gap-4 py-4" style="grid-template-columns: repeat(4,minmax(0,1fr));">
         <div class="form-group col-md-3">
            <label for="area">@lang('form.phone') <span class="required">*</span></label>
            <input type="number" pattern="[0-9]{3}" class="form-control @php if($errors->has('area')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" id="area" name="area" value="{{ old('area', $rec) }}">
            <div class="invalid-feedback">@php if($errors->has('area')) { echo $errors->first('area'); } @endphp</div>
         </div>
      	 <div class="form-group col-md-3">
            <label for="phone">&nbsp;</label>
            <input type="number" pattern="[0-9]{3}" class="form-control @php if($errors->has('phone')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" id="phone" name="phone" value="{{ old('phone', $rec) }}">
            <div class="invalid-feedback">@php if($errors->has('phone')) { echo $errors->first('phone') ; } @endphp</div>
         </div>
         <div class="form-group col-md-3">
            <label for="phone_2">&nbsp;</label>
            <input type="number" pattern="[0-9]{4}" class="form-control @php if($errors->has('phone2')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" id="phone2" name="phone2" value="{{ old('phone2', $rec) }}">
            <div class="invalid-feedback">@php if($errors->has('phone2')) { echo $errors->first('phone2') ; } @endphp</div>
         </div>
         <div class="form-group col-md-3">
            <label for="ext">Extenstion</label>
            <input type="number" pattern="[0-9]{3}" class="form-control block w-full rounded-md py-1.5 text-gray-900" maxlength="3" id="ext" name="ext" value="{{ old('ext', $rec) }}">
            <div class="invalid-feedback">@php if($errors->has('ext')) { echo $errors->first('ext') ; } @endphp</div>
         </div>
      </div>
      
      <div class="grid grid-cols-3 gap-4 py-4" style="grid-template-columns: repeat(3,minmax(0,1fr));">
         <div class="form-group col-md-4">
            <label for="sms">SMS/Text Now #</label>
            <input type="number" pattern="[0-9]{3}" maxlength="3" class="form-control block w-full rounded-md py-1.5 text-gray-900" id="sms_num_1" name="sms_num_1" value="{{ (isset($note)) ? old('sms_num_1', $note) : '' }}">
            <div class="invalid-feedback">@php if($errors->has('sms_num_1')) { echo $errors->first('sms_num_1'); } @endphp</div>
         </div>
      	 <div class="form-group col-md-4">
            <label for="sms_num_2">&nbsp;</label>
            <input type="number" pattern="[0-9]{3}" maxlength="3" class="form-control block w-full rounded-md py-1.5 text-gray-900" id="sms_num_2" name="sms_num_2" value="{{ (isset($note)) ? old('sms_num_2', $note) : '' }}">
            <div class="invalid-feedback">@php if($errors->has('sms_num_2')) { echo $errors->first('sms_num_2'); } @endphp</div>
         </div>
         <div class="form-group col-md-4">
            <label for="phone_2">&nbsp;</label>
            <input type="number" pattern="[0-9]{4}" maxlength="3" class="form-control block w-full rounded-md py-1.5 text-gray-900" id="sms_num_3" name="sms_num_3" value="{{ (isset($note)) ? old('sms_num_3', $note) : '' }}">
            <div class="invalid-feedback">@php if($errors->has('sms_num_3')) { echo $errors->first('sms_num_3'); } @endphp</div>
         </div>
      </div>
      
      <div class="grid grid-cols-3 gap-4 py-4" style="grid-template-columns: repeat(3,minmax(0,1fr));">
         <div class="form-group col-md-4">
            <label for="alt_num1">Alt Phone #</label>
            <input type="number" pattern="[0-9]{3}" maxlength="3" class="form-control block w-full rounded-md py-1.5 text-gray-900" id="alt_num1" name="alt_num1" value="{{ (isset($note)) ? old('alt_num1', $note) : '' }}">
            <div class="invalid-feedback">@php if($errors->has('alt_num1')) { echo $errors->first('alt_num1'); } @endphp</div>
         </div>
      	 <div class="form-group col-md-4">
            <label for="alt_num2">&nbsp;</label>
            <input type="number" pattern="[0-9]{3}" maxlength="3" class="form-control block w-full rounded-md py-1.5 text-gray-900" id="alt_num2" name="alt_num2" value="{{ (isset($note)) ? old('alt_num2', $note) : '' }}">
            <div class="invalid-feedback">@php if($errors->has('alt_num2')) { echo $errors->first('alt_num2'); } @endphp</div>
         </div>
         <div class="form-group col-md-4">
            <label for="alt_num3">&nbsp;</label>
            <input type="number" pattern="[0-9]{4}" maxlength="3" class="form-control block w-full rounded-md py-1.5 text-gray-900" id="alt_num3" name="alt_num3" value="{{ (isset($note)) ? old('alt_num3', $note) : '' }}">
            <div class="invalid-feedback">@php if($errors->has('alt_num3')) { echo $errors->first('alt_num3'); } @endphp</div>
         </div>
      </div>
      
      <div class="grid grid-cols-3 gap-4 py-4">
      <label for="product">Products</label>
@foreach ($products as $product)
<div class="col-md-4">
<div class="form-group form-check">
    <input type="checkbox" name="product[]" class="form-check-input"
     value="{{ $product->product_id }}"
    <?= in_array($product->product_id, $currentProduct) ? 'checked' : '' ?>
    />
    <label class="form-check-label" >{{ $product->product }}</label>
</div>
</div>
@endforeach
</div>

     <!-- <div class="form-row">
         <div class="form-group col-md-4">
            <label for="area">Fax</label>
            <input type="text" class="form-control" id="fax_area" name="fax_area" value="{{ old('fax_area', $rec) }}">
            <div class="invalid-feedback">@php if($errors->has('fax_area')) { echo $errors->first('fax_area'); } @endphp</div>
         </div>
      	 <div class="form-group col-md-4">
            <label for="phone">&nbsp;</label>
            <input type="text" class="form-control" id="fax_1" name="fax_1" value="{{ old('fax_1',$rec) }}">
            <div class="invalid-feedback">@php if($errors->has('fax_1')) { echo $errors->first('fax_1') ; } @endphp</div>
         </div>
         <div class="form-group col-md-4">
            <label for="phone_2">&nbsp;</label>
            <input type="text" class="form-control" id="fax_2" name="fax_2" value="{{ old('fax_2', $rec) }}">
            <div class="invalid-feedback">@php if($errors->has('fax_2')) { echo $errors->first('fax_2') ; } @endphp</div>
         </div>
      </div>      -->

   </div>
</div>
<br>
