
<div class="row">
   <div class="col-md-12">
      <div>
         <div class="form-group py-4">
            <label for="address">@lang('form.company_address')</label>
            <textarea id="address" name="address" placeholder="{{ __('form.street') }}" class="form-control form-control-sm block w-full rounded-md border-0 py-1.5 text-gray-900" >{{ old('address', NULL, $rec) }}</textarea>
            <div class="invalid-feedback">@php if($errors->has('address')) { echo $errors->first('address') ; } @endphp</div>
         </div>
         <div class="form-row grid grid-cols-2 gap-6 py-4">
            <div class="form-group col-md-6">
               <input type="text" class="form-control form-control-sm block w-full rounded-md border-0 py-1.5 text-gray-900" placeholder="{{ __('form.city') }}" name="city" value="{{ old('city', NULL, $rec) }}">
               <div class="invalid-feedback">@php if($errors->has('city')) { echo $errors->first('city') ; } @endphp</div>
            </div>
             <div class="form-group col-md-6">
               <div class="select2-wrapper">
               <select name="country_id" class="form-control form-control-sm block w-full rounded-md border-0 py-1.5 text-gray-900" id="country_id" autocomplete="false">
                  <?php /*echo form_dropdown("country_id", $data['country_id_list'], old("country_id", NULL, $rec), "class='form-control form-control-sm  selectpicker '");*/ ?>
                  @foreach($data['country_id_list'] as $country_key =>$country_value){
                  print '<option id="{{$country_key}}" {{ old('country_id', NULL, $rec) == $country_key ? 'selected' : '' }} >{{$country_value}} </option>';
                  }
                  @endforeach
                  </select>
               </div>
               <div class="invalid-feedback">@php if($errors->has('country_id')) { echo $errors->first('country_id') ; } @endphp</div>
            </div>
           
         </div>
         <div class="form-row grid grid-cols-2 gap-6 py-4">
            <div class="form-group col-md-6">
               <input type="text" class="form-control form-control-sm block w-full rounded-md border-0 py-1.5 text-gray-900" placeholder="{{ __('form.zip_code') }}" name="zip" value="{{ old('zip', NULL, $rec) }}">
               <div class="invalid-feedback">@php if($errors->has('zip')) { echo $errors->first('zip') ; } @endphp</div>
            </div><!--country spot-->
            <div class="form-group col-md-6">
               <!--<input type="text" class="form-control form-control-sm block w-full rounded-md border-0 py-1.5 text-gray-900" placeholder="{{ __('form.state') }}" name="state" value="{{ old('state', NULL, $rec) }}">-->
               <select name="state" class="form-control form-control-sm block w-full rounded-md border-0 py-1.5 text-gray-900" id="ordProvince" autocomplete="false"> 
               <option value="" disabled="">Region</option> 
               <option value="--" disabled="" style="display: none;">Outside U.S./Canada</option> 
               <optgroup id="ordProvince_country_CA" label="Canada"> 
               <option value="AB" {{ old('state', NULL, $rec) == "AB" ? 'selected' : '' }}>Alberta</option> 
               <option value="BC" {{ old('state', NULL, $rec) == "BC" ? 'selected' : '' }}>British Columbia</option> 
               <option value="MB" {{ old('state', NULL, $rec) == "MB" ? 'selected' : '' }}>Manitoba</option> 
               <option value="NB" {{ old('state', NULL, $rec) == "NB" ? 'selected' : '' }}>New Brunswick</option> 
               <option value="NL" {{ old('state', NULL, $rec) == "NL" ? 'selected' : '' }}>Newfoundland and Labrador</option> 
               <option value="NT" {{ old('state', NULL, $rec) == "NT" ? 'selected' : '' }}>Northwest Territories</option> 
               <option value="NS" {{ old('state', NULL, $rec) == "NS" ? 'selected' : '' }}>Nova Scotia</option> 
               <option value="NU" {{ old('state', NULL, $rec) == "NU" ? 'selected' : '' }}>Nunavut</option> 
               <option value="ON" {{ old('state', NULL, $rec) == "ON" ? 'selected' : '' }}>Ontario</option> 
               <option value="PE" {{ old('state', NULL, $rec) == "PE" ? 'selected' : '' }}>Prince Edward Island</option> 
               <option value="QC" {{ old('state', NULL, $rec) == "QC" ? 'selected' : '' }}>Quebec</option> 
               <option value="SK" {{ old('state', NULL, $rec) == "SK" ? 'selected' : '' }}>Saskatchewan</option> 
               <option value="YT" {{ old('state', NULL, $rec) == "YT" ? 'selected' : '' }}>Yukon</option> 
               </optgroup> 
               <optgroup id="ordProvince_country_US" label="United States" disabled="" style=""> 
               <option value="AL" disabled="" {{ old('state', NULL, $rec) == "AL" ? 'selected' : '' }}>Alabama</option> 
               <option value="AK" disabled="" {{ old('state', NULL, $rec) == "AK" ? 'selected' : '' }}>Alaska</option> 
               <option value="AS" disabled="" {{ old('state', NULL, $rec) == "AS" ? 'selected' : '' }}>American Samoa</option> 
               <option value="AZ" disabled="" {{ old('state', NULL, $rec) == "AZ" ? 'selected' : '' }}>Arizona</option> 
               <option value="AR" disabled="" {{ old('state', NULL, $rec) == "AR" ? 'selected' : '' }}>Arkansas</option> 
               <option value="AA" disabled="" {{ old('state', NULL, $rec) == "AA" ? 'selected' : '' }}>Armed Forces Americas</option> 
               <option value="AE" disabled="" {{ old('state', NULL, $rec) == "AE" ? 'selected' : '' }}>Armed Forces Europe</option> 
               <option value="AP" disabled="" {{ old('state', NULL, $rec) == "AP" ? 'selected' : '' }}>Armed Forces Pacific</option> 
               <option value="CA" disabled="" {{ old('state', NULL, $rec) == "CA" ? 'selected' : '' }}>California</option> 
               <option value="CO" disabled="" {{ old('state', NULL, $rec) == "CO" ? 'selected' : '' }}>Colorado</option> 
               <option value="CT" disabled="" {{ old('state', NULL, $rec) == "CT" ? 'selected' : '' }}>Connecticut</option>  
               <option value="MP" disabled="" {{ old('state', NULL, $rec) == "NY" ? 'selected' : '' }}>Northern Marianas</option> 
               <option value="DE" disabled="" {{ old('state', NULL, $rec) == "DE" ? 'selected' : '' }}>Delaware</option> 
               <option value="DC" disabled="" {{ old('state', NULL, $rec) == "DC" ? 'selected' : '' }}>District of Columbia</option> 
               <option value="FL" disabled="" {{ old('state', NULL, $rec) == "FL" ? 'selected' : '' }}>Florida</option> 
               <option value="GA" disabled="" {{ old('state', NULL, $rec) == "GA" ? 'selected' : '' }}>Georgia</option> 
               <option value="GU" disabled="" {{ old('state', NULL, $rec) == "GU" ? 'selected' : '' }}>Guam</option> 
               <option value="HI" disabled="" {{ old('state', NULL, $rec) == "HI" ? 'selected' : '' }}>Hawaii</option> 
               <option value="ID" disabled="" {{ old('state', NULL, $rec) == "ID" ? 'selected' : '' }}>Idaho</option> 
               <option value="IL" disabled="" {{ old('state', NULL, $rec) == "IL" ? 'selected' : '' }}>Illinois</option> 
               <option value="IN" disabled="" {{ old('state', NULL, $rec) == "IN" ? 'selected' : '' }}>Indiana</option> 
               <option value="IA" disabled="" {{ old('state', NULL, $rec) == "IA" ? 'selected' : '' }}>Iowa</option> 
               <option value="KS" disabled="" {{ old('state', NULL, $rec) == "KS" ? 'selected' : '' }}>Kansas</option> 
               <option value="KY" disabled="" {{ old('state', NULL, $rec) == "KY" ? 'selected' : '' }}>Kentucky</option> 
               <option value="LA" disabled="" {{ old('state', NULL, $rec) == "LA" ? 'selected' : '' }}>Louisiana</option> 
               <option value="ME" disabled="" {{ old('state', NULL, $rec) == "ME" ? 'selected' : '' }}>Maine</option> 
               <option value="MD" disabled="" {{ old('state', NULL, $rec) == "MD" ? 'selected' : '' }}>Maryland</option> 
               <option value="MA" disabled="" {{ old('state', NULL, $rec) == "MA" ? 'selected' : '' }}>Massachusetts</option> 
               <option value="MI" disabled="" {{ old('state', NULL, $rec) == "MI" ? 'selected' : '' }}>Michigan</option> 
               <option value="MN" disabled="" {{ old('state', NULL, $rec) == "MN" ? 'selected' : '' }}>Minnesota</option> 
               <option value="MS" disabled="" {{ old('state', NULL, $rec) == "MS" ? 'selected' : '' }}>Mississippi</option>
               <option value="MO" disabled="" {{ old('state', NULL, $rec) == "MO" ? 'selected' : '' }}>Missouri</option>
               <option value="MT" disabled="" {{ old('state', NULL, $rec) == "MT" ? 'selected' : '' }}>Montana</option>
               <option value="NE" disabled="" {{ old('state', NULL, $rec) == "NE" ? 'selected' : '' }}>Nebraska</option>
               <option value="NV" disabled="" {{ old('state', NULL, $rec) == "NV" ? 'selected' : '' }}>Nevada</option>
               <option value="NH" disabled="" {{ old('state', NULL, $rec) == "NH" ? 'selected' : '' }}>New Hampshire</option>
               <option value="NJ" disabled="" {{ old('state', NULL, $rec) == "NJ" ? 'selected' : '' }}>New Jersey</option>
               <option value="NM" disabled="" {{ old('state', NULL, $rec) == "NM" ? 'selected' : '' }}>New Mexico</option>
               <option value="NY" disabled="" {{ old('state', NULL, $rec) == "NY" ? 'selected' : '' }} >New York</option>
               <option value="NC" disabled="" {{ old('state', NULL, $rec) == "NC" ? 'selected' : '' }}>North Carolina</option>
               <option value="ND" disabled="" {{ old('state', NULL, $rec) == "ND" ? 'selected' : '' }}>North Dakota</option>
               <option value="MP" disabled="" {{ old('state', NULL, $rec) == "MP" ? 'selected' : '' }}>Northern Marianas</option>
               <option value="OH" disabled="" {{ old('state', NULL, $rec) == "OH" ? 'selected' : '' }}>Ohio</option>
               <option value="OK" disabled="" {{ old('state', NULL, $rec) == "OK" ? 'selected' : '' }}>Oklahoma</option>
               <option value="OR" disabled="" {{ old('state', NULL, $rec) == "OR" ? 'selected' : '' }}>Oregon</option>
               <option value="PW" disabled="" {{ old('state', NULL, $rec) == "PW" ? 'selected' : '' }}>Palau</option>
               <option value="PA" disabled="" {{ old('state', NULL, $rec) == "PA" ? 'selected' : '' }}>Pennsylvania</option>
               <option value="PR" disabled="" {{ old('state', NULL, $rec) == "PR" ? 'selected' : '' }}>Puerto Rico</option>
               <option value="RI" disabled="" {{ old('state', NULL, $rec) == "RI" ? 'selected' : '' }}>Rhode Island</option>
               <option value="SC" disabled="" {{ old('state', NULL, $rec) == "SC" ? 'selected' : '' }}>South Carolina</option>
               <option value="SD" disabled="" {{ old('state', NULL, $rec) == "SD" ? 'selected' : '' }}>South Dakota</option>
               <option value="TN" disabled="" {{ old('state', NULL, $rec) == "TN" ? 'selected' : '' }}>Tennessee</option>
               <option value="TX" disabled="" {{ old('state', NULL, $rec) == "TX" ? 'selected' : '' }}>Texas</option>
               <option value="UT" disabled="" {{ old('state', NULL, $rec) == "UT" ? 'selected' : '' }}>Utah</option>
               <option value="VT" disabled="" {{ old('state', NULL, $rec) == "VT" ? 'selected' : '' }}>Vermont</option>
               <option value="VI" disabled="" {{ old('state', NULL, $rec) == "VI" ? 'selected' : '' }}>Virgin Islands</option>
               <option value="VA" disabled="" {{ old('state', NULL, $rec) == "VA" ? 'selected' : '' }}>Virginia</option>
               <option value="WA" disabled="" {{ old('state', NULL, $rec) == "WA" ? 'selected' : '' }}>Washington</option>
               <option value="WV" disabled="" {{ old('state', NULL, $rec) == "WV" ? 'selected' : '' }}>West Virginia</option>
               <option value="WY" disabled="" {{ old('state', NULL, $rec) == "WY" ? 'selected' : '' }} >Wyoming</option>
               </optgroup>
               </select> 
               
               <div class="invalid-feedback">@php if($errors->has('state')) { echo $errors->first('state') ; } @endphp</div>
            </div>

         </div>
      </div>
   </div>
   <div class="col-md-6" style="display:none;visibility:hidden;">
      <div style="padding: 10px;">
         <?php $disable = (old('shipping_is_same_as_billing', NULL, $rec) == 1)? TRUE: FALSE; ?>
         <div class="form-group">
            <div style="float: left; margin-bottom: 8px;"><label>@lang('form.compamy_address')</label></div>
            <div class="form-check" style="float: left; margin-left: 10px;">
               <input class="form-check-input" id="shipping_is_same_as_billing" type="checkbox" value="1" name="shipping_is_same_as_billing" {{ ($disable) ? 'checked' : '' }}>
               <label class="form-check-label" for="defaultCheck1">
               @lang('form.shipping_is_same_as_billing')
               </label>
            </div>
            <textarea id="shipping_address" name="shipping_address" placeholder="{{ __('form.street') }}" class="form-control form-control-sm block w-full rounded-md border-0 py-1.5 text-gray-900" {{ ($disable) ? 'disabled' : '' }}>{{ old('shipping_address', NULL, $rec) }}</textarea>
            <div class="invalid-feedback">@php if($errors->has('shipping_address')) { echo $errors->first('shipping_address') ; } @endphp</div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-6">
               <input type="text" class="form-control form-control-sm block w-full rounded-md border-0 py-1.5 text-gray-900" placeholder="{{ __('form.city') }}" name="shipping_city" value="{{ old('shipping_city', NULL, $rec) }}" {{ ($disable) ? 'disabled' : '' }}>
               <div class="invalid-feedback">@php if($errors->has('shipping_city')) { echo $errors->first('shipping_city') ; } @endphp</div>
            </div>
            <div class="form-group col-md-6">hinhinhinhin
               <input type="text" class="form-control form-control-sm block w-full rounded-md border-0 py-1.5 text-gray-900" placeholder="{{ __('form.state') }}" name="shipping_state" value="{{ old('shipping_state', NULL, $rec) }}" {{ ($disable) ? 'disabled' : '' }}>
               <div class="invalid-feedback">@php if($errors->has('shipping_state')) { echo $errors->first('shipping_state') ; } @endphp</div>
            </div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-6">
               <input type="text" class="form-control form-control-sm block w-full rounded-md border-0 py-1.5 text-gray-900" placeholder="{{ __('form.zip_code') }}" name="shipping_zip_code" value="{{ old('shipping_zip_code', NULL, $rec) }}" {{ ($disable) ? 'disabled' : '' }}>
               <div class="invalid-feedback">@php if($errors->has('shipping_zip_code')) { echo $errors->first('shipping_zip_code') ; } @endphp</div>
            </div>
            <div class="form-group col-md-6">
               <div class="select2-wrapper">
                  <?php $shipping_country_disable = ($disable) ? 'disabled' : '' ;?>
                  <select name="shipping_country_id" class="form-control form-control-sm block w-full rounded-md border-0 py-1.5 text-gray-900" id="shipping_country_id" autocomplete="false">
                  <?php /*echo form_dropdown("country_id", $data['country_id_list'], old("country_id", NULL, $rec), "class='form-control form-control-sm  selectpicker '");*/ ?>
                  @foreach($data['country_id_list'] as $country_key =>$country_value){
                  print '<option id="{{$country_key}}" {{ old('country_id', NULL, $rec) == $country_key ? 'selected' : '' }} >{{$country_value}} </option>';
                  }
                  @endforeach
                  </select>

                  <?php /*echo form_dropdown("shipping_country_id", $data['country_id_list'], old("shipping_country_id", NULL, $rec), "class='form-control form-control-sm  selectpicker'  {{ $shipping_country_disable }}")*/ ?>
               </div>
               <div class="invalid-feedback">@php if($errors->has('shipping_country_id')) { echo $errors->first('shipping_country_id') ; } @endphp</div>
            </div>
         </div>
      </div>
   </div>
</div>