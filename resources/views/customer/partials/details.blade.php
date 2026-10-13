<?php
//lazy eh!?
function moneyFormat($amount) {
	$fmt = new NumberFormatter('en_CA', NumberFormatter::CURRENCY);
    $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
    $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
    return $fmt->format($amount);
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
fieldset{border:none!important;}
[type=radio]:checked {
    color: #f7971c;
}
    input:focus {
        outline: none!important; /* Removes the default blue outline in some browsers */
        appearance: none;
        outline-width: 0;
    }
</style>
<div class="row">
   <div class="col-md-6">
   <div class="grid grid-cols-3 gap-4 py-4" style="grid-template-columns: repeat(3,minmax(0,1fr));">
      <div class="form-group">
		<div><label for="salutation">Salutation</label></div>
		<div class="form-check form-check-inline inline-block">
		  <input class="form-check-input" type="radio" name="salutation" value="Mr." <?= (old('salutation', $rec) === 'Mr.') ? 'checked' : '' ?>>
		  <label class="form-check-label" for="inlineRadio1">Mr.</label>
		</div>
		<div class="form-check form-check-inline inline-block">
		  <input class="form-check-input" type="radio" name="salutation" value="Sir" <?= (old('salutation',  $rec) === 'Sir') ? 'checked' : '' ?>>
		  <label class="form-check-label" for="inlineRadio1">Sir</label>
		</div>
		<div class="form-check form-check-inline inline-block">
		  <input class="form-check-input" type="radio" name="salutation" value="Ms." <?= (old('salutation',$rec) === 'Ms.') ? 'checked' : '' ?>>
		  <label class="form-check-label" for="inlineRadio1">Ms.</label>
		</div>
		<div class="form-check form-check-inline inline-block">
		  <input class="form-check-input" type="radio" name="salutation" value="Miss" <?= (old('salutation', $rec) === 'Miss') ? 'checked' : '' ?>>
		  <label class="form-check-label" for="inlineRadio1">Miss</label>
		</div>
		<div class="form-check form-check-inline inline-block">
		  <input class="form-check-input" type="radio" name="salutation" value="Mrs." <?= (old('salutation',$rec) === 'Mrs.') ? 'checked' : '' ?>>
		  <label class="form-check-label" for="inlineRadio1">Mrs.</label>
		</div>
		<div class="form-check form-check-inline inline-block">
		  <input class="form-check-input" type="radio" name="salutation" value="Dr." <?= (old('salutation',  $rec) === 'Dr.') ? 'checked' : '' ?>>
		  <label class="form-check-label" for="inlineRadio1">Dr.</label>
		</div>
		
      <div class="invalid-feedback">@php if($errors->has('salutation')) { echo $errors->first('salutation'); } @endphp</div>
      </div>
      <div class="form-group ">
         <label for="first_name">First Name <span class="required">*</span></label>
         <input type="text" class="form-control @php if($errors->has('first_name')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" name="first_name" value="{{ old('first_name',$rec)}}">
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
                 <div class="grid grid-cols-2 gap-6 py-4">
      <div class="form-group">
            <label for="email_address">Email <span class="required">*</span></label>
            <input type="email" class="form-control @php if($errors->has('email_address')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" id="email_address" name="email_address" value="{{ old('email_address', $rec) }}">
            <div class="invalid-feedback">@php if($errors->has('email_address')) { echo $errors->first('email_address') ; } @endphp</div>
         </div>
         <div class="form-group">
            <label for="email_address2">Email 2</label>
            <input type="email" class="form-control  block w-full rounded-md py-1.5 text-gray-900" id="email_address2" name="email_address2" value="{{ old('email_address2', $rec) }}">
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
<div class="grid grid-cols-2 gap-6 py-4">
  <div class="form-group">
            <label for="url">@lang('form.website') <span class="required">*</span> <span>(Must include http:// or https://)</span></label>
            <input type="text" class="form-control @php if($errors->has('url')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" id="url" name="url" value="{{ old('url', $rec) }}">
            <div class="invalid-feedback">@php if($errors->has('url')) { echo $errors->first('url'); } @endphp</div>
         </div>
         <div class="form-group">
           <label for="dev_url">Dev URL (eg: http://website.sitedudes.com)</label>
<input type="text" class="form-control  block w-full rounded-md py-1.5 text-gray-900" id="dev_url" name="dev_url" value="{{ old('dev_url', $rec) }}">
         </div>


      </div>
<div class="grid grid-cols-2">
          <div class="form-group">
           <label for="url2">Secondary Domain</label>
<input type="text" class="form-control @php if($errors->has('url2')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" id="url2" name="url2" value="{{ old('url2', $rec) }}">
         </div>

         </div>




      <div class="grid grid-cols-3 gap-4 py-4" style="grid-template-columns: repeat(4,minmax(0,1fr));">
         <div class="form-group col-md-3">
            <label for="area">@lang('form.phone') <span class="required">*</span></label>
            <input type="number"  pattern="[0-9]{3}" maxlength="3" class="form-control @php if($errors->has('area')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" id="area" name="area" value="{{ old('area', $rec) }}">
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
      
           <div class="grid grid-cols-2 gap-4 py-2">
<div class="form-group col-md-4">
            <label for="alt_num_label">Alt Num Description</label>
            <input type="text"  class="form-control block w-full rounded-md py-1.5 text-gray-900" id="alt_num_label" name="alt_num_label" value="{{ (isset($note)) ? old('alt_num_label', $note) : '' }}">
            <div class="invalid-feedback">@php if($errors->has('alt_num_label')) { echo $errors->first('alt_num_label'); } @endphp</div>
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
      
     <!-- <div class="form-row">
         <div class="form-group col-md-4">
            <label for="area">Fax</label>
            <input type="text" class="form-control" id="fax_area" name="fax_area" value="{{ old('fax_area', $rec) }}">
            <div class="invalid-feedback">@php if($errors->has('fax_area')) { echo $errors->first('fax_area'); } @endphp</div>
         </div>
      	 <div class="form-group col-md-4">
            <label for="phone">&nbsp;</label>
            <input type="text" class="form-control" id="fax_1" name="fax_1" value="{{ old('fax_1', $rec) }}">
            <div class="invalid-feedback">@php if($errors->has('fax_1')) { echo $errors->first('fax_1') ; } @endphp</div>
         </div>
         <div class="form-group col-md-4">
            <label for="phone_2">&nbsp;</label>
            <input type="text" class="form-control" id="fax_2" name="fax_2" value="{{ old('fax_2', $rec) }}">
            <div class="invalid-feedback">@php if($errors->has('fax_2')) { echo $errors->first('fax_2') ; } @endphp</div>
         </div>
      </div>      -->
         
         <fieldset>
         <legend>Sales Representative</legend>
         <div class="form-row grid grid-cols-2 gap-6 py-4">
            <div class="form-group col-md-6">
               <label for="rep_first_name">First Name <span class="required">*</span></label>
               <input type="text"  
                  name="rep_first_name"
                  value="{{ old('rep_first_name',(isset($salesrep)) ? $salesrep['first_name']:$rec->rep_first_name, $rec) }}"
                  id="rep_first_name"
                  class="form-control @php if($errors->has('rep_first_name')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" readonly>
                  <div class="invalid-feedback">@php if($errors->has('rep_first_name')) { echo $errors->first('rep_first_name'); } @endphp</div>   
            </div>
            <div class="form-group col-md-6">
               <label for="rep_last_name">Last Name <span class="required">*</span></label>
               <input type="text"
                  name="rep_last_name"
                  value="{{ old('rep_last_name', (isset($salesrep)) ? $salesrep['last_name']:$rec->rep_last_name, $rec) }}"
                  id="rep_last_name"
                  class="form-control @php if($errors->has('rep_last_name')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" readonly>
                  <div class="invalid-feedback">@php if($errors->has('rep_last_name')) { echo $errors->first('rep_last_name'); } @endphp</div>
            </div>
         </div>
      </fieldset>
   </div>
</div>
<br>

