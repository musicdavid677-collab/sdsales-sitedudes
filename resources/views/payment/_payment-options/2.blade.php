<div class="form-group">
    <label for="chName">Name On Cheque</label>
    <input type="text" 
        name="pbc_name_on_cheque" 
        value="{{ old_set('pbc_name_on_cheque', NULL, $customer) }}" 
        id="chName" 
        class="block w-full rounded-md py-1.5 text-gray-900">
</div>
<div class="form-group" style="display:hidden;">
<label>Phone Number On Cheque</label>
<input type="text" name="" value="" id="" class="block w-full rounded-md py-1.5 text-gray-900">
</div>
<label>Address On Cheque</label>
<input type="text" name="pbc_address" value="{{ old_set('pbc_address', NULL, $customer) }}" id="" class="block w-full rounded-md py-1.5 text-gray-900">

<div class="row">
    <div class="col-md-5">
        <label>Cheque City</label>
        <input type="text" name="pbc_city" value="{{ old_set('pbc_city', NULL, $customer) }}" id="" class="block w-full rounded-md py-1.5 text-gray-900">
    </div>
    <div class="col-md-4">
<label for="chequeState">Cheque State</label>
<select name="pbc_state" id="chequeState" class="block w-full rounded-md py-1.5 text-gray-900">
<option value=""  >Region</option> 
               <option value="--"  disabled="" style="display: none;">Outside U.S./Canada</option> 
               <optgroup id="ordProvince_country_CA" label="Canada"> 
               <option value="AB" {{ old_set('pbc_state', NULL, $customer) == "AB" ? 'selected' : '' }}>Alberta</option> 
               <option value="BC" {{ old_set('pbc_state', NULL, $customer) == "BC" ? 'selected' : '' }}>British Columbia</option> 
               <option value="MB" {{ old_set('pbc_state', NULL, $customer) == "MB" ? 'selected' : '' }}>Manitoba</option> 
               <option value="NB" {{ old_set('pbc_state', NULL, $customer) == "NB" ? 'selected' : '' }}>New Brunswick</option> 
               <option value="NL" {{ old_set('pbc_state', NULL, $customer) == "NL" ? 'selected' : '' }}>Newfoundland and Labrador</option> 
               <option value="NT" {{ old_set('pbc_state', NULL, $customer) == "NT" ? 'selected' : '' }}>Northwest Territories</option> 
               <option value="NS" {{ old_set('pbc_state', NULL, $customer) == "NS" ? 'selected' : '' }}>Nova Scotia</option> 
               <option value="NU" {{ old_set('pbc_state', NULL, $customer) == "NU" ? 'selected' : '' }}>Nunavut</option> 
               <option value="ON" {{ old_set('pbc_state', NULL, $customer) == "ON" ? 'selected' : '' }}>Ontario</option> 
               <option value="PE" {{ old_set('pbc_state', NULL, $customer) == "PE" ? 'selected' : '' }}>Prince Edward Island</option> 
               <option value="QC" {{ old_set('pbc_state', NULL, $customer) == "QC" ? 'selected' : '' }}>Quebec</option> 
               <option value="SK" {{ old_set('pbc_state', NULL, $customer) == "SK" ? 'selected' : '' }}>Saskatchewan</option> 
               <option value="YT" {{ old_set('pbc_state', NULL, $customer) == "YT" ? 'selected' : '' }}>Yukon</option> 
               </optgroup> 
               <optgroup id="ordProvince_country_US" label="United States"   style=""> 
               <option value="AL"   {{ old_set('pbc_state', NULL, $customer) == "AL" ? 'selected' : '' }}>Alabama</option> 
               <option value="AK"   {{ old_set('pbc_state', NULL, $customer) == "AK" ? 'selected' : '' }}>Alaska</option> 
               <option value="AS"   {{ old_set('pbc_state', NULL, $customer) == "AS" ? 'selected' : '' }}>American Samoa</option> 
               <option value="AZ"   {{ old_set('pbc_state', NULL, $customer) == "AZ" ? 'selected' : '' }}>Arizona</option> 
               <option value="AR"   {{ old_set('pbc_state', NULL, $customer) == "AR" ? 'selected' : '' }}>Arkansas</option> 
               <option value="AA"   {{ old_set('pbc_state', NULL, $customer) == "AA" ? 'selected' : '' }}>Armed Forces Americas</option> 
               <option value="AE"   {{ old_set('pbc_state', NULL, $customer) == "AE" ? 'selected' : '' }}>Armed Forces Europe</option> 
               <option value="AP"   {{ old_set('pbc_state', NULL, $customer) == "AP" ? 'selected' : '' }}>Armed Forces Pacific</option> 
               <option value="CA"   {{ old_set('pbc_state', NULL, $customer) == "CA" ? 'selected' : '' }}>California</option> 
               <option value="CO"   {{ old_set('pbc_state', NULL, $customer) == "CO" ? 'selected' : '' }}>Colorado</option> 
               <option value="CT"   {{ old_set('pbc_state', NULL, $customer) == "CT" ? 'selected' : '' }}>Connecticut</option>  
               <option value="MP"   {{ old_set('pbc_state', NULL, $customer) == "NY" ? 'selected' : '' }}>Northern Marianas</option> 
               <option value="DE"   {{ old_set('pbc_state', NULL, $customer) == "DE" ? 'selected' : '' }}>Delaware</option> 
               <option value="DC"   {{ old_set('pbc_state', NULL, $customer) == "DC" ? 'selected' : '' }}>District of Columbia</option> 
               <option value="FL"   {{ old_set('pbc_state', NULL, $customer) == "FL" ? 'selected' : '' }}>Florida</option> 
               <option value="GA"   {{ old_set('pbc_state', NULL, $customer) == "GA" ? 'selected' : '' }}>Georgia</option> 
               <option value="GU"   {{ old_set('pbc_state', NULL, $customer) == "GU" ? 'selected' : '' }}>Guam</option> 
               <option value="HI"   {{ old_set('pbc_state', NULL, $customer) == "HI" ? 'selected' : '' }}>Hawaii</option> 
               <option value="ID"   {{ old_set('pbc_state', NULL, $customer) == "ID" ? 'selected' : '' }}>Idaho</option> 
               <option value="IL"   {{ old_set('pbc_state', NULL, $customer) == "IL" ? 'selected' : '' }}>Illinois</option> 
               <option value="IN"   {{ old_set('pbc_state', NULL, $customer) == "IN" ? 'selected' : '' }}>Indiana</option> 
               <option value="IA"   {{ old_set('pbc_state', NULL, $customer) == "IA" ? 'selected' : '' }}>Iowa</option> 
               <option value="KS"   {{ old_set('pbc_state', NULL, $customer) == "KS" ? 'selected' : '' }}>Kansas</option> 
               <option value="KY"   {{ old_set('pbc_state', NULL, $customer) == "KY" ? 'selected' : '' }}>Kentucky</option> 
               <option value="LA"   {{ old_set('pbc_state', NULL, $customer) == "LA" ? 'selected' : '' }}>Louisiana</option> 
               <option value="ME"   {{ old_set('pbc_state', NULL, $customer) == "ME" ? 'selected' : '' }}>Maine</option> 
               <option value="MD"   {{ old_set('pbc_state', NULL, $customer) == "MD" ? 'selected' : '' }}>Maryland</option> 
               <option value="MA"   {{ old_set('pbc_state', NULL, $customer) == "MA" ? 'selected' : '' }}>Massachusetts</option> 
               <option value="MI"   {{ old_set('pbc_state', NULL, $customer) == "MI" ? 'selected' : '' }}>Michigan</option> 
               <option value="MN"   {{ old_set('pbc_state', NULL, $customer) == "MN" ? 'selected' : '' }}>Minnesota</option> 
               <option value="MS"   {{ old_set('pbc_state', NULL, $customer) == "MS" ? 'selected' : '' }}>Mississippi</option>
               <option value="MO"   {{ old_set('pbc_state', NULL, $customer) == "MO" ? 'selected' : '' }}>Missouri</option>
               <option value="MT"   {{ old_set('pbc_state', NULL, $customer) == "MT" ? 'selected' : '' }}>Montana</option>
               <option value="NE"   {{ old_set('pbc_state', NULL, $customer) == "NE" ? 'selected' : '' }}>Nebraska</option>
               <option value="NV"   {{ old_set('pbc_state', NULL, $customer) == "NV" ? 'selected' : '' }}>Nevada</option>
               <option value="NH"   {{ old_set('pbc_state', NULL, $customer) == "NH" ? 'selected' : '' }}>New Hampshire</option>
               <option value="NJ"   {{ old_set('pbc_state', NULL, $customer) == "NJ" ? 'selected' : '' }}>New Jersey</option>
               <option value="NM"   {{ old_set('pbc_state', NULL, $customer) == "NM" ? 'selected' : '' }}>New Mexico</option>
               <option value="NY"   {{ old_set('pbc_state', NULL, $customer) == "NY" ? 'selected' : '' }} >New York</option>
               <option value="NC"   {{ old_set('pbc_state', NULL, $customer) == "NC" ? 'selected' : '' }}>North Carolina</option>
               <option value="ND"   {{ old_set('pbc_state', NULL, $customer) == "ND" ? 'selected' : '' }}>North Dakota</option>
               <option value="MP"   {{ old_set('pbc_state', NULL, $customer) == "MP" ? 'selected' : '' }}>Northern Marianas</option>
               <option value="OH"   {{ old_set('pbc_state', NULL, $customer) == "OH" ? 'selected' : '' }}>Ohio</option>
               <option value="OK"   {{ old_set('pbc_state', NULL, $customer) == "OK" ? 'selected' : '' }}>Oklahoma</option>
               <option value="OR"   {{ old_set('pbc_state', NULL, $customer) == "OR" ? 'selected' : '' }}>Oregon</option>
               <option value="PW"   {{ old_set('pbc_state', NULL, $customer) == "PW" ? 'selected' : '' }}>Palau</option>
               <option value="PA"   {{ old_set('pbc_state', NULL, $customer) == "PA" ? 'selected' : '' }}>Pennsylvania</option>
               <option value="PR"   {{ old_set('pbc_state', NULL, $customer) == "PR" ? 'selected' : '' }}>Puerto Rico</option>
               <option value="RI"   {{ old_set('pbc_state', NULL, $customer) == "RI" ? 'selected' : '' }}>Rhode Island</option>
               <option value="SC"   {{ old_set('pbc_state', NULL, $customer) == "SC" ? 'selected' : '' }}>South Carolina</option>
               <option value="SD"   {{ old_set('pbc_state', NULL, $customer) == "SD" ? 'selected' : '' }}>South Dakota</option>
               <option value="TN"   {{ old_set('pbc_state', NULL, $customer) == "TN" ? 'selected' : '' }}>Tennessee</option>
               <option value="TX"   {{ old_set('pbc_state', NULL, $customer) == "TX" ? 'selected' : '' }}>Texas</option>
               <option value="UT"   {{ old_set('pbc_state', NULL, $customer) == "UT" ? 'selected' : '' }}>Utah</option>
               <option value="VT"   {{ old_set('pbc_state', NULL, $customer) == "VT" ? 'selected' : '' }}>Vermont</option>
               <option value="VI"   {{ old_set('pbc_state', NULL, $customer) == "VI" ? 'selected' : '' }}>Virgin Islands</option>
               <option value="VA"   {{ old_set('pbc_state', NULL, $customer) == "VA" ? 'selected' : '' }}>Virginia</option>
               <option value="WA"   {{ old_set('pbc_state', NULL, $customer) == "WA" ? 'selected' : '' }}>Washington</option>
               <option value="WV"   {{ old_set('pbc_state', NULL, $customer) == "WV" ? 'selected' : '' }}>West Virginia</option>
               <option value="WY"   {{ old_set('pbc_state', NULL, $customer) == "WY" ? 'selected' : '' }} >Wyoming</option>
               </optgroup>
               </select> 
</div>
<div class="col-md-3">
<label>Cheque Zip</label>
<input type="text" name="pbc_zip" value="{{ old_set('pbc_zip', NULL, $customer) }}" id="" class="block w-full rounded-md py-1.5 text-gray-900">
</div>
</div><!--row-->

    <div class="form-group">
        <label>Cheque Number</label>
        <input type="text" 
            name="chq_num" 
            value="{{ old_set('chq_num', NULL, $customer) }}" 
            id="" 
            class="block w-full rounded-md py-1.5 text-gray-900">
    </div>

    <div class="form-group">
        <label>Signature Name</label>
        <input type="text" 
            name="pbc_signature_name" 
            value="{{ old_set('pbc_signature_name', NULL, $customer) }}" 
            id="" 
            class="block w-full rounded-md py-1.5 text-gray-900">
    </div>
<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Bank Routing Code &amp; Account Number</span>
  </div>
  <input type="text" name="pbc_routing_code" value="{{ old_set('pbc_routing_code', NULL, $customer) }}" aria-label="Bank Routing Code" class="form-control rounded-md py-1.5 text-gray-900">
  <input type="text" name="pbc_bank_account_num" value="{{ old_set('pbc_bank_account_num', NULL, $customer) }}" aria-label="Account Number" class="form-control rounded-md py-1.5 text-gray-900">
</div>
<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Send Invoices</span>
  </div>
<div class="form-check form-check-inline inline-block">
      <input class="form-check-input" type="radio" name="send_invoice" value="0"  {{ (isset($customer) && $customer->send_invoice === 0 || old('send_invoice') === 0) ? 'checked' : '' }}>
      <label class="form-check-label" for="inlineRadio1">Yes</label>
    </div>
    <div class="form-check form-check-inline inline-block">
      <input class="form-check-input" type="radio" name="send_invoice" value="1" {{ (isset($customer) && $customer->send_invoice === 1 || old('send_invoice') === 1) ? 'checked' : '' }}>
      <label class="form-check-label" for="inlineRadio1">No</label>
    </div></div>
<br />
