<div class="row">
   <div class="col-md-12">
      <div>
      <h5>Billing and Payment Information</h5>
         <div class="form-group">
            <label for="address">@lang('form.billing_address')</label>
            <textarea id="ch_billing_address" name="ch_billing_address" placeholder="{{ __('form.street') }}" class="form-control form-control-sm block w-full rounded-md py-1.5 text-gray-900" >{{ old_set('ch_billing_address', NULL, $rec) }}</textarea>
            <div class="invalid-feedback">@php if($errors->has('ch_billing_address')) { echo $errors->first('ch_billing_address') ; } @endphp</div>
         </div>
         <div class="grid grid-cols-3 gap-6 py-4">
            <div class="form-group col-md-6">
               <input type="text" class="form-control  block w-full rounded-md py-1.5 text-gray-900" placeholder="{{ __('form.city') }}" name="ch_city" value="{{ old_set('ch_city', NULL, $rec) }}">
               <div class="invalid-feedback">@php if($errors->has('ch_city')) { echo $errors->first('ch_city') ; } @endphp</div>
            </div>
            <div class="form-group col-md-6">
               <select name="ch_state" class="form-control  block w-full rounded-md py-1.5 text-gray-900" id="ordProvince" autocomplete="false"> 
               <option value="" disabled="">Region</option> 
               <option value="--" disabled="" style="display: none;">Outside U.S./Canada</option> 
               <optgroup id="ordProvince_country_CA" label="Canada"> 
               <option value="AB" {{ old_set('ch_state', NULL, $rec) == "AB" ? 'selected' : '' }}>Alberta</option> 
               <option value="BC" {{ old_set('ch_state', NULL, $rec) == "BC" ? 'selected' : '' }}>British Columbia</option> 
               <option value="MB" {{ old_set('ch_state', NULL, $rec) == "MB" ? 'selected' : '' }}>Manitoba</option> 
               <option value="NB" {{ old_set('ch_state', NULL, $rec) == "NB" ? 'selected' : '' }}>New Brunswick</option> 
               <option value="NL" {{ old_set('ch_state', NULL, $rec) == "NL" ? 'selected' : '' }}>Newfoundland and Labrador</option> 
               <option value="NT" {{ old_set('ch_state', NULL, $rec) == "NT" ? 'selected' : '' }}>Northwest Territories</option> 
               <option value="NS" {{ old_set('ch_state', NULL, $rec) == "NS" ? 'selected' : '' }}>Nova Scotia</option> 
               <option value="NU" {{ old_set('ch_state', NULL, $rec) == "NU" ? 'selected' : '' }}>Nunavut</option> 
               <option value="ON" {{ old_set('ch_state', NULL, $rec) == "ON" ? 'selected' : '' }}>Ontario</option> 
               <option value="PE" {{ old_set('ch_state', NULL, $rec) == "PE" ? 'selected' : '' }}>Prince Edward Island</option> 
               <option value="QC" {{ old_set('ch_state', NULL, $rec) == "QC" ? 'selected' : '' }}>Quebec</option> 
               <option value="SK" {{ old_set('ch_state', NULL, $rec) == "SK" ? 'selected' : '' }}>Saskatchewan</option> 
               <option value="YT" {{ old_set('ch_state', NULL, $rec) == "YT" ? 'selected' : '' }}>Yukon</option> 
               </optgroup> 
               <optgroup id="ordProvince_country_US" label="United States" disabled="" style=""> 
               <option value="AL" disabled="" {{ old_set('ch_state', NULL, $rec) == "AL" ? 'selected' : '' }}>Alabama</option> 
               <option value="AK" disabled="" {{ old_set('ch_state', NULL, $rec) == "AK" ? 'selected' : '' }}>Alaska</option> 
               <option value="AS" disabled="" {{ old_set('ch_state', NULL, $rec) == "AS" ? 'selected' : '' }}>American Samoa</option> 
               <option value="AZ" disabled="" {{ old_set('ch_state', NULL, $rec) == "AZ" ? 'selected' : '' }}>Arizona</option> 
               <option value="AR" disabled="" {{ old_set('ch_state', NULL, $rec) == "AR" ? 'selected' : '' }}>Arkansas</option> 
               <option value="AA" disabled="" {{ old_set('ch_state', NULL, $rec) == "AA" ? 'selected' : '' }}>Armed Forces Americas</option> 
               <option value="AE" disabled="" {{ old_set('ch_state', NULL, $rec) == "AE" ? 'selected' : '' }}>Armed Forces Europe</option> 
               <option value="AP" disabled="" {{ old_set('ch_state', NULL, $rec) == "AP" ? 'selected' : '' }}>Armed Forces Pacific</option> 
               <option value="CA" disabled="" {{ old_set('ch_state', NULL, $rec) == "CA" ? 'selected' : '' }}>California</option> 
               <option value="CO" disabled="" {{ old_set('ch_state', NULL, $rec) == "CO" ? 'selected' : '' }}>Colorado</option> 
               <option value="CT" disabled="" {{ old_set('ch_state', NULL, $rec) == "CT" ? 'selected' : '' }}>Connecticut</option>  
               <option value="MP" disabled="" {{ old_set('ch_state', NULL, $rec) == "NY" ? 'selected' : '' }}>Northern Marianas</option> 
               <option value="DE" disabled="" {{ old_set('ch_state', NULL, $rec) == "DE" ? 'selected' : '' }}>Delaware</option> 
               <option value="DC" disabled="" {{ old_set('ch_state', NULL, $rec) == "DC" ? 'selected' : '' }}>District of Columbia</option> 
               <option value="FL" disabled="" {{ old_set('ch_state', NULL, $rec) == "FL" ? 'selected' : '' }}>Florida</option> 
               <option value="GA" disabled="" {{ old_set('ch_state', NULL, $rec) == "GA" ? 'selected' : '' }}>Georgia</option> 
               <option value="GU" disabled="" {{ old_set('ch_state', NULL, $rec) == "GU" ? 'selected' : '' }}>Guam</option> 
               <option value="HI" disabled="" {{ old_set('ch_state', NULL, $rec) == "HI" ? 'selected' : '' }}>Hawaii</option> 
               <option value="ID" disabled="" {{ old_set('ch_state', NULL, $rec) == "ID" ? 'selected' : '' }}>Idaho</option> 
               <option value="IL" disabled="" {{ old_set('ch_state', NULL, $rec) == "IL" ? 'selected' : '' }}>Illinois</option> 
               <option value="IN" disabled="" {{ old_set('ch_state', NULL, $rec) == "IN" ? 'selected' : '' }}>Indiana</option> 
               <option value="IA" disabled="" {{ old_set('ch_state', NULL, $rec) == "IA" ? 'selected' : '' }}>Iowa</option> 
               <option value="KS" disabled="" {{ old_set('ch_state', NULL, $rec) == "KS" ? 'selected' : '' }}>Kansas</option> 
               <option value="KY" disabled="" {{ old_set('ch_state', NULL, $rec) == "KY" ? 'selected' : '' }}>Kentucky</option> 
               <option value="LA" disabled="" {{ old_set('ch_state', NULL, $rec) == "LA" ? 'selected' : '' }}>Louisiana</option> 
               <option value="ME" disabled="" {{ old_set('ch_state', NULL, $rec) == "ME" ? 'selected' : '' }}>Maine</option> 
               <option value="MD" disabled="" {{ old_set('ch_state', NULL, $rec) == "MD" ? 'selected' : '' }}>Maryland</option> 
               <option value="MA" disabled="" {{ old_set('ch_state', NULL, $rec) == "MA" ? 'selected' : '' }}>Massachusetts</option> 
               <option value="MI" disabled="" {{ old_set('ch_state', NULL, $rec) == "MI" ? 'selected' : '' }}>Michigan</option> 
               <option value="MN" disabled="" {{ old_set('ch_state', NULL, $rec) == "MN" ? 'selected' : '' }}>Minnesota</option> 
               <option value="MS" disabled="" {{ old_set('ch_state', NULL, $rec) == "MS" ? 'selected' : '' }}>Mississippi</option>
               <option value="MO" disabled="" {{ old_set('ch_state', NULL, $rec) == "MO" ? 'selected' : '' }}>Missouri</option>
               <option value="MT" disabled="" {{ old_set('ch_state', NULL, $rec) == "MT" ? 'selected' : '' }}>Montana</option>
               <option value="NE" disabled="" {{ old_set('ch_state', NULL, $rec) == "NE" ? 'selected' : '' }}>Nebraska</option>
               <option value="NV" disabled="" {{ old_set('ch_state', NULL, $rec) == "NV" ? 'selected' : '' }}>Nevada</option>
               <option value="NH" disabled="" {{ old_set('ch_state', NULL, $rec) == "NH" ? 'selected' : '' }}>New Hampshire</option>
               <option value="NJ" disabled="" {{ old_set('ch_state', NULL, $rec) == "NJ" ? 'selected' : '' }}>New Jersey</option>
               <option value="NM" disabled="" {{ old_set('ch_state', NULL, $rec) == "NM" ? 'selected' : '' }}>New Mexico</option>
               <option value="NY" disabled="" {{ old_set('ch_state', NULL, $rec) == "NY" ? 'selected' : '' }} >New York</option>
               <option value="NC" disabled="" {{ old_set('ch_state', NULL, $rec) == "NC" ? 'selected' : '' }}>North Carolina</option>
               <option value="ND" disabled="" {{ old_set('ch_state', NULL, $rec) == "ND" ? 'selected' : '' }}>North Dakota</option>
               <option value="MP" disabled="" {{ old_set('ch_state', NULL, $rec) == "MP" ? 'selected' : '' }}>Northern Marianas</option>
               <option value="OH" disabled="" {{ old_set('ch_state', NULL, $rec) == "OH" ? 'selected' : '' }}>Ohio</option>
               <option value="OK" disabled="" {{ old_set('ch_state', NULL, $rec) == "OK" ? 'selected' : '' }}>Oklahoma</option>
               <option value="OR" disabled="" {{ old_set('ch_state', NULL, $rec) == "OR" ? 'selected' : '' }}>Oregon</option>
               <option value="PW" disabled="" {{ old_set('ch_state', NULL, $rec) == "PW" ? 'selected' : '' }}>Palau</option>
               <option value="PA" disabled="" {{ old_set('ch_state', NULL, $rec) == "PA" ? 'selected' : '' }}>Pennsylvania</option>
               <option value="PR" disabled="" {{ old_set('ch_state', NULL, $rec) == "PR" ? 'selected' : '' }}>Puerto Rico</option>
               <option value="RI" disabled="" {{ old_set('ch_state', NULL, $rec) == "RI" ? 'selected' : '' }}>Rhode Island</option>
               <option value="SC" disabled="" {{ old_set('ch_state', NULL, $rec) == "SC" ? 'selected' : '' }}>South Carolina</option>
               <option value="SD" disabled="" {{ old_set('ch_state', NULL, $rec) == "SD" ? 'selected' : '' }}>South Dakota</option>
               <option value="TN" disabled="" {{ old_set('ch_state', NULL, $rec) == "TN" ? 'selected' : '' }}>Tennessee</option>
               <option value="TX" disabled="" {{ old_set('ch_state', NULL, $rec) == "TX" ? 'selected' : '' }}>Texas</option>
               <option value="UT" disabled="" {{ old_set('ch_state', NULL, $rec) == "UT" ? 'selected' : '' }}>Utah</option>
               <option value="VT" disabled="" {{ old_set('ch_state', NULL, $rec) == "VT" ? 'selected' : '' }}>Vermont</option>
               <option value="VI" disabled="" {{ old_set('ch_state', NULL, $rec) == "VI" ? 'selected' : '' }}>Virgin Islands</option>
               <option value="VA" disabled="" {{ old_set('ch_state', NULL, $rec) == "VA" ? 'selected' : '' }}>Virginia</option>
               <option value="WA" disabled="" {{ old_set('ch_state', NULL, $rec) == "WA" ? 'selected' : '' }}>Washington</option>
               <option value="WV" disabled="" {{ old_set('ch_state', NULL, $rec) == "WV" ? 'selected' : '' }}>West Virginia</option>
               <option value="WY" disabled="" {{ old_set('ch_state', NULL, $rec) == "WY" ? 'selected' : '' }} >Wyoming</option>
               </optgroup>
               </select> 
               
               <div class="invalid-feedback">@php if($errors->has('ch_state')) { echo $errors->first('ch_billing_state') ; } @endphp</div>
            </div>
        
            <div class="form-group col-md-6">
               <input type="text" class="form-control  block w-full rounded-md py-1.5 text-gray-900" placeholder="{{ __('form.zip_code') }}" name="ch_zip" value="{{ old_set('ch_zip', NULL, $rec) }}">
               <div class="invalid-feedback">@php if($errors->has('ch_zip')) { echo $errors->first('ch_zip') ; } @endphp</div>
            
         </div>

      </div>
   </div>
   
</div>