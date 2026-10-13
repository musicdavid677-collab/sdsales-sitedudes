<div class="row">
   <div class="col-md-12">
      <div>
         <div class="form-group">
            <label for="address">@lang('form.billing_address')</label>
            <textarea id="address" name="ch_billing_address" placeholder="{{ __('form.street') }}" class="block w-full rounded-md py-1.5 text-gray-900" >{{ old_set('ch_billing_address', NULL, $customer) }}</textarea>
            <div class="invalid-feedback">@php if($errors->has('ch_billing_address')) { echo $errors->first('ch_billing_address') ; } @endphp</div>
         </div>
         <div class="grid grid-cols-2 gap-6 py-4">
            <div class="form-group col-md-6">
               <label for="address">@lang('form.city')</label>
               <input type="text" class="block w-full rounded-md py-1.5 text-gray-900" placeholder="{{ __('form.city') }}" name="ch_city" value="{{ old_set('ch_city', NULL, $customer) }}">
               <div class="invalid-feedback">@php if($errors->has('ch_city')) { echo $errors->first('ch_city') ; } @endphp</div>
            </div>
            <div class="form-group col-md-6">
               <label for="address">@lang('form.state')</label>
               <!--<input type="text" class="form-control form-control-sm " placeholder="{{ __('form.state') }}" name="state" value="{{ old_set('ch_state', NULL, $customer) }}">-->
               <select name="ch_billing_state" class="block w-full rounded-md py-1.5 text-gray-900" id="ordProvince" autocomplete="false"> 
               <option value="" disabled="">Region</option> 
               <option value="--" disabled="" style="display: none;">Outside U.S./Canada</option> 
               <optgroup id="ordProvince_country_CA" label="Canada"> 
               <option value="AB" {{ old_set('ch_state', NULL, $customer) == "AB" ? 'selected' : '' }}>Alberta</option> 
               <option value="BC" {{ old_set('ch_state', NULL, $customer) == "BC" ? 'selected' : '' }}>British Columbia</option> 
               <option value="MB" {{ old_set('ch_state', NULL, $customer) == "MB" ? 'selected' : '' }}>Manitoba</option> 
               <option value="NB" {{ old_set('ch_state', NULL, $customer) == "NB" ? 'selected' : '' }}>New Brunswick</option> 
               <option value="NL" {{ old_set('ch_state', NULL, $customer) == "NL" ? 'selected' : '' }}>Newfoundland and Labrador</option> 
               <option value="NT" {{ old_set('ch_state', NULL, $customer) == "NT" ? 'selected' : '' }}>Northwest Territories</option> 
               <option value="NS" {{ old_set('ch_state', NULL, $customer) == "NS" ? 'selected' : '' }}>Nova Scotia</option> 
               <option value="NU" {{ old_set('ch_state', NULL, $customer) == "NU" ? 'selected' : '' }}>Nunavut</option> 
               <option value="ON" {{ old_set('ch_state', NULL, $customer) == "ON" ? 'selected' : '' }}>Ontario</option> 
               <option value="PE" {{ old_set('ch_state', NULL, $customer) == "PE" ? 'selected' : '' }}>Prince Edward Island</option> 
               <option value="QC" {{ old_set('ch_state', NULL, $customer) == "QC" ? 'selected' : '' }}>Quebec</option> 
               <option value="SK" {{ old_set('ch_state', NULL, $customer) == "SK" ? 'selected' : '' }}>Saskatchewan</option> 
               <option value="YT" {{ old_set('ch_state', NULL, $customer) == "YT" ? 'selected' : '' }}>Yukon</option> 
               </optgroup> 
               <optgroup id="ordProvince_country_US" label="United States" disabled="" style=""> 
               <option value="AL" disabled="" {{ old_set('ch_state', NULL, $customer) == "AL" ? 'selected' : '' }}>Alabama</option> 
               <option value="AK" disabled="" {{ old_set('ch_state', NULL, $customer) == "AK" ? 'selected' : '' }}>Alaska</option> 
               <option value="AS" disabled="" {{ old_set('ch_state', NULL, $customer) == "AS" ? 'selected' : '' }}>American Samoa</option> 
               <option value="AZ" disabled="" {{ old_set('ch_state', NULL, $customer) == "AZ" ? 'selected' : '' }}>Arizona</option> 
               <option value="AR" disabled="" {{ old_set('ch_state', NULL, $customer) == "AR" ? 'selected' : '' }}>Arkansas</option> 
               <option value="AA" disabled="" {{ old_set('ch_state', NULL, $customer) == "AA" ? 'selected' : '' }}>Armed Forces Americas</option> 
               <option value="AE" disabled="" {{ old_set('ch_state', NULL, $customer) == "AE" ? 'selected' : '' }}>Armed Forces Europe</option> 
               <option value="AP" disabled="" {{ old_set('ch_state', NULL, $customer) == "AP" ? 'selected' : '' }}>Armed Forces Pacific</option> 
               <option value="CA" disabled="" {{ old_set('ch_state', NULL, $customer) == "CA" ? 'selected' : '' }}>California</option> 
               <option value="CO" disabled="" {{ old_set('ch_state', NULL, $customer) == "CO" ? 'selected' : '' }}>Colorado</option> 
               <option value="CT" disabled="" {{ old_set('ch_state', NULL, $customer) == "CT" ? 'selected' : '' }}>Connecticut</option>  
               <option value="MP" disabled="" {{ old_set('ch_state', NULL, $customer) == "NY" ? 'selected' : '' }}>Northern Marianas</option> 
               <option value="DE" disabled="" {{ old_set('ch_state', NULL, $customer) == "DE" ? 'selected' : '' }}>Delaware</option> 
               <option value="DC" disabled="" {{ old_set('ch_state', NULL, $customer) == "DC" ? 'selected' : '' }}>District of Columbia</option> 
               <option value="FL" disabled="" {{ old_set('ch_state', NULL, $customer) == "FL" ? 'selected' : '' }}>Florida</option> 
               <option value="GA" disabled="" {{ old_set('ch_state', NULL, $customer) == "GA" ? 'selected' : '' }}>Georgia</option> 
               <option value="GU" disabled="" {{ old_set('ch_state', NULL, $customer) == "GU" ? 'selected' : '' }}>Guam</option> 
               <option value="HI" disabled="" {{ old_set('ch_state', NULL, $customer) == "HI" ? 'selected' : '' }}>Hawaii</option> 
               <option value="ID" disabled="" {{ old_set('ch_state', NULL, $customer) == "ID" ? 'selected' : '' }}>Idaho</option> 
               <option value="IL" disabled="" {{ old_set('ch_state', NULL, $customer) == "IL" ? 'selected' : '' }}>Illinois</option> 
               <option value="IN" disabled="" {{ old_set('ch_state', NULL, $customer) == "IN" ? 'selected' : '' }}>Indiana</option> 
               <option value="IA" disabled="" {{ old_set('ch_state', NULL, $customer) == "IA" ? 'selected' : '' }}>Iowa</option> 
               <option value="KS" disabled="" {{ old_set('ch_state', NULL, $customer) == "KS" ? 'selected' : '' }}>Kansas</option> 
               <option value="KY" disabled="" {{ old_set('ch_state', NULL, $customer) == "KY" ? 'selected' : '' }}>Kentucky</option> 
               <option value="LA" disabled="" {{ old_set('ch_state', NULL, $customer) == "LA" ? 'selected' : '' }}>Louisiana</option> 
               <option value="ME" disabled="" {{ old_set('ch_state', NULL, $customer) == "ME" ? 'selected' : '' }}>Maine</option> 
               <option value="MD" disabled="" {{ old_set('ch_state', NULL, $customer) == "MD" ? 'selected' : '' }}>Maryland</option> 
               <option value="MA" disabled="" {{ old_set('ch_state', NULL, $customer) == "MA" ? 'selected' : '' }}>Massachusetts</option> 
               <option value="MI" disabled="" {{ old_set('ch_state', NULL, $customer) == "MI" ? 'selected' : '' }}>Michigan</option> 
               <option value="MN" disabled="" {{ old_set('ch_state', NULL, $customer) == "MN" ? 'selected' : '' }}>Minnesota</option> 
               <option value="MS" disabled="" {{ old_set('ch_state', NULL, $customer) == "MS" ? 'selected' : '' }}>Mississippi</option>
               <option value="MO" disabled="" {{ old_set('ch_state', NULL, $customer) == "MO" ? 'selected' : '' }}>Missouri</option>
               <option value="MT" disabled="" {{ old_set('ch_state', NULL, $customer) == "MT" ? 'selected' : '' }}>Montana</option>
               <option value="NE" disabled="" {{ old_set('ch_state', NULL, $customer) == "NE" ? 'selected' : '' }}>Nebraska</option>
               <option value="NV" disabled="" {{ old_set('ch_state', NULL, $customer) == "NV" ? 'selected' : '' }}>Nevada</option>
               <option value="NH" disabled="" {{ old_set('ch_state', NULL, $customer) == "NH" ? 'selected' : '' }}>New Hampshire</option>
               <option value="NJ" disabled="" {{ old_set('ch_state', NULL, $customer) == "NJ" ? 'selected' : '' }}>New Jersey</option>
               <option value="NM" disabled="" {{ old_set('ch_state', NULL, $customer) == "NM" ? 'selected' : '' }}>New Mexico</option>
               <option value="NY" disabled="" {{ old_set('ch_state', NULL, $customer) == "NY" ? 'selected' : '' }} >New York</option>
               <option value="NC" disabled="" {{ old_set('ch_state', NULL, $customer) == "NC" ? 'selected' : '' }}>North Carolina</option>
               <option value="ND" disabled="" {{ old_set('ch_state', NULL, $customer) == "ND" ? 'selected' : '' }}>North Dakota</option>
               <option value="MP" disabled="" {{ old_set('ch_state', NULL, $customer) == "MP" ? 'selected' : '' }}>Northern Marianas</option>
               <option value="OH" disabled="" {{ old_set('ch_state', NULL, $customer) == "OH" ? 'selected' : '' }}>Ohio</option>
               <option value="OK" disabled="" {{ old_set('ch_state', NULL, $customer) == "OK" ? 'selected' : '' }}>Oklahoma</option>
               <option value="OR" disabled="" {{ old_set('ch_state', NULL, $customer) == "OR" ? 'selected' : '' }}>Oregon</option>
               <option value="PW" disabled="" {{ old_set('ch_state', NULL, $customer) == "PW" ? 'selected' : '' }}>Palau</option>
               <option value="PA" disabled="" {{ old_set('ch_state', NULL, $customer) == "PA" ? 'selected' : '' }}>Pennsylvania</option>
               <option value="PR" disabled="" {{ old_set('ch_state', NULL, $customer) == "PR" ? 'selected' : '' }}>Puerto Rico</option>
               <option value="RI" disabled="" {{ old_set('ch_state', NULL, $customer) == "RI" ? 'selected' : '' }}>Rhode Island</option>
               <option value="SC" disabled="" {{ old_set('ch_state', NULL, $customer) == "SC" ? 'selected' : '' }}>South Carolina</option>
               <option value="SD" disabled="" {{ old_set('ch_state', NULL, $customer) == "SD" ? 'selected' : '' }}>South Dakota</option>
               <option value="TN" disabled="" {{ old_set('ch_state', NULL, $customer) == "TN" ? 'selected' : '' }}>Tennessee</option>
               <option value="TX" disabled="" {{ old_set('ch_state', NULL, $customer) == "TX" ? 'selected' : '' }}>Texas</option>
               <option value="UT" disabled="" {{ old_set('ch_state', NULL, $customer) == "UT" ? 'selected' : '' }}>Utah</option>
               <option value="VT" disabled="" {{ old_set('ch_state', NULL, $customer) == "VT" ? 'selected' : '' }}>Vermont</option>
               <option value="VI" disabled="" {{ old_set('ch_state', NULL, $customer) == "VI" ? 'selected' : '' }}>Virgin Islands</option>
               <option value="VA" disabled="" {{ old_set('ch_state', NULL, $customer) == "VA" ? 'selected' : '' }}>Virginia</option>
               <option value="WA" disabled="" {{ old_set('ch_state', NULL, $customer) == "WA" ? 'selected' : '' }}>Washington</option>
               <option value="WV" disabled="" {{ old_set('ch_state', NULL, $customer) == "WV" ? 'selected' : '' }}>West Virginia</option>
               <option value="WY" disabled="" {{ old_set('ch_state', NULL, $customer) == "WY" ? 'selected' : '' }} >Wyoming</option>
               </optgroup>
               </select> 
               
               <div class="invalid-feedback">@php if($errors->has('ch_billing_state')) { echo $errors->first('ch_billing_state') ; } @endphp</div>
            </div>
         </div>
         <div class="form-row">
        <label for="address">@lang('form.zip_code')</label>
         <div class="form-group col-md-6">
               <input type="text" class="form-control form-control-sm block w-full rounded-md py-1.5 text-gray-900" placeholder="{{ __('form.zip_code') }}" name="ch_zip" value="{{ old('ch_zip',$customer) }}">
               <div class="invalid-feedback">@php if($errors->has('ch_zip')) { echo $errors->first('ch_zip') ; } @endphp</div>
            </div>
         </div>
      </div>
   </div>
   
</div>