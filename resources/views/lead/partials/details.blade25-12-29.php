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
       input[type=text],input[type=email],input[type=number],select,textarea{ 
      background: #efefef;
    border: none;
    padding: 10px;
    margin: 5px 0;
}
</style>
<script>
  document.addEventListener('alpine:init', () => {
 // function splitUrl(){
  let url = document.getElementById("url").value;
  if(url!="" && url.search("http")!=-1)
  {
  let url_split=url.split("://");

  document.getElementById("http").value=url_split[0]+"://";
  document.getElementById("url").value=url_split[1];
  }
  if(document.getElementById("seoCheckbox"))
  {
    document.getElementById('termsOptions').style.display='none';
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

function showTerms(check)
{
if(check.checked){
  document.getElementById('termsOptions').style.display='block';
}
else
{
  document.getElementById('termsOptions').style.display='none';
}
}

function urlUpdate()
{
    let url = document.getElementById("url").value;
    let dev= document.getElementById("dev_url").value;
   
  if(url!="" && url.search("www")!=-1 && dev =="")
  {
  let url_split=url.split(".");
  document.getElementById("dev_url").value="http://"+url_split[1]+".sitedudes.com";
  }
  if(url!="" && url.search("www")==-1)
  {
  let url_split=url.split(".");
  document.getElementById("url").value="www."+url;
  if(dev =="")
  {
document.getElementById("dev_url").value="http://"+url_split[0]+".sitedudes.com";

  }
  
  }
}
</script>
<div class="row">
   <div class="col-md-6">
   <div class="grid grid-cols-3 gap-4 py-2">
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

<div class="form-group col-md-4">
<label for="lead_source_id">Vertical <span class="required">*</span></label>
<select name="vertical" id="vertical" class="block w-full rounded-md py-1.5 text-gray-900">
  <option value="">Select an option</option>
@foreach($verticals as $vertical)
<option value="{{$vertical->id}}" {{ old('vertical', $rec) == $vertical->id ? 'selected' : '' }}>{{$vertical->vertical}} </option>
@endforeach
</select>
<div class="invalid-feedback">@php if($errors->has('verical')) { echo $errors->first('vertical') ; } @endphp</div>
</div>

   </div>
   <div class="grid grid-cols-3 gap-4 py-2">
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
                 <div class="grid grid-cols-2 gap-6 py-2">
      <div class="form-group">
            <label for="email_address">Email <span class="required">*</span></label>
            <input type="email" class="form-control @php if($errors->has('email_address')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" id="email_address" name="email_address" value="{{ old('email_address', $rec) }}">
            <div class="invalid-feedback">@php if($errors->has('email_address')) { echo $errors->first('email_address') ; } @endphp</div>
         </div>
          <div class="form-group">
            <label for="email_address">Email 2</label>
            <input type="email" class="form-control @php if($errors->has('email_address2')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" id="email_address2" name="email_address2" value="{{ old('email_address2', $rec) }}">
            <div class="invalid-feedback">@php if($errors->has('email_address2')) { echo $errors->first('email_address2') ; } @endphp</div>
         </div>
         </div>
          <div class="grid grid-cols-2 gap-6 py-4">
      <div class="form-group">
            <label for="invoicing_email">Invoicing Email <span class="required">*</span></label>
            <input type="email" class="form-control @php if($errors->has('invoicing_email')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" id="invoicing_email" name="invoicing_email" value="{{ old('invoicing_email', $rec) }}">
            <div class="invalid-feedback">@php if($errors->has('invoicing_email')) { echo $errors->first('invoicing_email') ; } @endphp</div>
         </div>
         <div class="form-group">
            <label for="invoicing_email2">Invoicing Email 2</label>
            <input type="email" class="form-control @php if($errors->has('invoicing_email2')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" id="invoicing_email2" name="invoicing_email2" value="{{ old('invoicing_email2', $rec) }}">
            <div class="invalid-feedback">@php if($errors->has('invoicing_email2')) { echo $errors->first('invoicing_email2') ; } @endphp</div>
         </div>
         
         </div>
                 <div class="grid grid-cols-2 gap-6 py-2">
         <div class="form-group">
            <label for="url">@lang('form.website') <span class="required">*</span> (www.website.com)</label>
            <div class=""><select name="http" id="http" class="form-control"><option value="https://">https://</option> <option value="http://">http://</option> </select>&nbsp;&nbsp;<input onfocusout="urlUpdate()" type="text" class="form-control @php if($errors->has('url')) { echo 'is-invalid'; } @endphp rounded-md py-1.5 text-gray-900" id="url" name="url" value="{{ old('url', $rec) }}"></div>
            <div class="invalid-feedback">@php if($errors->has('url')) { echo $errors->first('url'); } @endphp</div>
         </div>
         <div class="form-group">
           <label for="dev_url">Dev URL (eg: http://website.sitedudes.com)</label>
<input type="text" class="form-control @php if($errors->has('dev_url')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" id="dev_url" name="dev_url" value="{{ old('dev_url', $rec) }}">
         </div>
         </div>
      <div class="grid grid-cols-3 gap-4 py-2" style="grid-template-columns: repeat(4,minmax(0,1fr));">
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
      
      <div class="grid grid-cols-3 gap-4 py-2" style="grid-template-columns: repeat(3,minmax(0,1fr));">
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
      
      <div class="grid grid-cols-3 gap-4 py-2" style="grid-template-columns: repeat(3,minmax(0,1fr));">
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
   
      <div class="grid grid-cols-3 gap-4 py-2">
      <label for="product">Products</label>
@foreach ($products as $product)
<div class="col-md-4">
<div class="form-group form-check">
    <input type="checkbox" name="product[]" class="form-check-input"
     value="{{ $product->product_id }}"
     @if((old('product')!==NULL))
    <?= in_array($product->product_id, old('product',$rec)) ? 'checked' : '' ?>
   @else
        <?= in_array($product->product_id, $currentProduct) ? 'checked' : '' ?>
         @endif
<?= ($product->product_id==1054) ? 'id="seoCheckbox" onchange="showTerms(this)"' : '' ?>
    />
    <label class="form-check-label" >{{ $product->product }}</label>
</div>
</div>
@endforeach
</div>
<p>&nbsp;</p>
<div class="grid gap-4 py-2" id="termsOptions" style="display:none">
<h5>Search Terms</h5>
 <div class="form-group py-2">
           
            <textarea id="terms" name="terms" class="form-control form-control-sm block w-full rounded-md border-1 py-1.5 text-gray-900" >{{ old('terms', $rec) }}</textarea>
            <div class="invalid-feedback">@php if($errors->has('terms')) { echo $errors->first('terms') ; } @endphp</div>
         </div>
</div>
<p>&nbsp;</p>
<h5>Domain Credentials</h5>
   <div class="grid grid-cols-3 gap-4 py-2">
   <div class="form-group ">
         <label for="login_location">Host </label>
         <input type="text" class="form-control @php if($errors->has('login_location')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" name="login_location" value="{{ old('login_location', $rec) }}">
         <div class="invalid-feedback">@php if($errors->has('login_location')) { echo $errors->first('login_location'); } @endphp</div>
      </div>
      <div class="form-group ">
         <label for="login_username">Username </label>
         <input type="text" class="form-control @php if($errors->has('login_username')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" name="login_username" value="{{ old('login_username', $rec) }}">
         <div class="invalid-feedback">@php if($errors->has('login_username')) { echo $errors->first('login_username'); } @endphp</div>
      </div>
      <div class="form-group ">
         <label for="login_password">Password </label>
         <input type="text" class="form-control @php if($errors->has('login_password')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" name="login_password" value="{{ old('login_password', $rec) }}">
         <div class="invalid-feedback">@php if($errors->has('login_password')) { echo $errors->first('login_password'); } @endphp</div>
      </div>
      </div>
        <div class="grid grid-cols-3 gap-4 py-2">
   <div class="form-group ">
         <label for="login_email">Email </label>
         <input type="text" class="form-control @php if($errors->has('login_email')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" name="login_email" value="{{ old('login_email', $rec) }}">
         <div class="invalid-feedback">@php if($errors->has('login_email')) { echo $errors->first('login_email'); } @endphp</div>
      </div>
      <div class="form-group py-2">
            <label for="other_domain">Other Domain</label>
            <textarea id="other_domain" name="other_domain" class="form-control form-control-sm block w-full rounded-md border-1 py-1.5 text-gray-900" >{{ old('other_domain', NULL, $rec) }}</textarea>
            <div class="invalid-feedback">@php if($errors->has('other_domain')) { echo $errors->first('other_domain') ; } @endphp</div>
         </div>
      <div class="form-group py-2">
            <label for="website_credentials">Website Credentials</label>
            <textarea id="website_credentials" name="website_credentials" class="form-control form-control-sm block w-full rounded-md border-1 py-1.5 text-gray-900" >{{ old('website_credentials', NULL, $rec) }}</textarea>
            <div class="invalid-feedback">@php if($errors->has('website_credentials')) { echo $errors->first('website_credentials') ; } @endphp</div>
         </div>
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
