
<div class="row">
   <div class="col-md-12">
      <div>
         <div class="form-group py-4">
            <label for="address">@lang('form.company_address')</label>
            <textarea id="address" name="address" placeholder="{{ __('form.street') }}" class="form-control form-control-sm block w-full rounded-md py-1.5 text-gray-900" >{{ old('address', $rec) }}</textarea>
            <div class="invalid-feedback">@php if($errors->has('address')) { echo $errors->first('address') ; } @endphp</div>
         </div>
         <div class="form-row grid grid-cols-2 gap-6 py-4">
            <div class="form-group col-md-6">
               <input type="text" class="form-control form-control-sm block w-full rounded-md py-1.5 text-gray-900" placeholder="{{ __('form.city') }}" name="city" value="{{ old('city', $rec) }}">
               <div class="invalid-feedback">@php if($errors->has('city')) { echo $errors->first('city') ; } @endphp</div>
            </div>


             <div class="form-group col-md-6">
               <div class="select2-wrapper">
               <select name="country_id" class="form-control form-control-sm block w-full rounded-md py-1.5 text-gray-900" id="country_id" autocomplete="false" onchange="countryChange()">
                  <?php /*echo form_dropdown("country_id", $data['country_id_list'], old("country_id", $rec), "class='form-control form-control-sm  selectpicker '");*/ ?>
                  @foreach($data['country_id_list'] as $country_key =>$country_value)
                  <option value="{{$country_key}}"  {{ old('country_id', $rec) == $country_key ? 'selected' : '' }} >{{$country_value}} </option>
                  @endforeach
                  </select>
               </div>
               <div class="invalid-feedback">@php if($errors->has('country_id')) { echo $errors->first('country_id') ; } @endphp</div>
            </div>
         </div>
         <div class="form-row grid grid-cols-2 gap-6 py-4">
            <div class="form-group col-md-6">
               <input type="text" class="form-control form-control-sm block w-full rounded-md py-1.5 text-gray-900" placeholder="{{ __('form.zip_code') }}" name="zip" value="{{ old('zip',$rec) }}">
               <div class="invalid-feedback">@php if($errors->has('zip')) { echo $errors->first('zip') ; } @endphp</div>
            </div><!-- country spot-->
                       <div class="form-group col-md-6">
               <!--<input type="text" class="form-control form-control-sm block w-full rounded-md py-1.5 text-gray-900" placeholder="{{ __('form.state') }}" name="state" value="{{ old('state', $rec) }}">-->
               <select name="state" class="form-control form-control-sm block w-full rounded-md py-1.5 text-gray-900" id="ordProvince" autocomplete="false"> 
               <option value="" disabled="">Region</option> 
               <option value="--" disabled="" style="display: none;">Outside U.S./Canada</option> 
               <optgroup id="ordProvince_country_CA" label="Canada"> 
               <option value="AB" {{ old('state', $rec) == "AB" ? 'selected' : '' }}>Alberta</option> 
               <option value="BC" {{ old('state', $rec) == "BC" ? 'selected' : '' }}>British Columbia</option> 
               <option value="MB" {{ old('state', $rec) == "MB" ? 'selected' : '' }}>Manitoba</option> 
               <option value="NB" {{ old('state', $rec) == "NB" ? 'selected' : '' }}>New Brunswick</option> 
               <option value="NL" {{ old('state', $rec) == "NL" ? 'selected' : '' }}>Newfoundland and Labrador</option> 
               <option value="NT" {{ old('state', $rec) == "NT" ? 'selected' : '' }}>Northwest Territories</option> 
               <option value="NS" {{ old('state', $rec) == "NS" ? 'selected' : '' }}>Nova Scotia</option> 
               <option value="NU" {{ old('state', $rec) == "NU" ? 'selected' : '' }}>Nunavut</option> 
               <option value="ON" {{ old('state', $rec) == "ON" ? 'selected' : '' }}>Ontario</option> 
               <option value="PE" {{ old('state', $rec) == "PE" ? 'selected' : '' }}>Prince Edward Island</option> 
               <option value="QC" {{ old('state', $rec) == "QC" ? 'selected' : '' }}>Quebec</option> 
               <option value="SK" {{ old('state', $rec) == "SK" ? 'selected' : '' }}>Saskatchewan</option> 
               <option value="YT" {{ old('state', $rec) == "YT" ? 'selected' : '' }}>Yukon</option> 
               </optgroup> 
               <optgroup id="ordProvince_country_US" label="United States" style=""> 
               <option value="AL"  {{ old('state', $rec) == "AL" ? 'selected' : '' }}>Alabama</option> 
               <option value="AK"  {{ old('state', $rec) == "AK" ? 'selected' : '' }}>Alaska</option> 
               <option value="AS"  {{ old('state', $rec) == "AS" ? 'selected' : '' }}>American Samoa</option> 
               <option value="AZ"  {{ old('state', $rec) == "AZ" ? 'selected' : '' }}>Arizona</option> 
               <option value="AR"  {{ old('state', $rec) == "AR" ? 'selected' : '' }}>Arkansas</option> 
               <option value="AA"  {{ old('state', $rec) == "AA" ? 'selected' : '' }}>Armed Forces Americas</option> 
               <option value="AE"  {{ old('state', $rec) == "AE" ? 'selected' : '' }}>Armed Forces Europe</option> 
               <option value="AP"  {{ old('state', $rec) == "AP" ? 'selected' : '' }}>Armed Forces Pacific</option> 
               <option value="CA"  {{ old('state', $rec) == "CA" ? 'selected' : '' }}>California</option> 
               <option value="CO"  {{ old('state', $rec) == "CO" ? 'selected' : '' }}>Colorado</option> 
               <option value="CT"  {{ old('state', $rec) == "CT" ? 'selected' : '' }}>Connecticut</option>  
               <option value="MP"  {{ old('state', $rec) == "NY" ? 'selected' : '' }}>Northern Marianas</option> 
               <option value="DE"  {{ old('state', $rec) == "DE" ? 'selected' : '' }}>Delaware</option> 
               <option value="DC"  {{ old('state', $rec) == "DC" ? 'selected' : '' }}>District of Columbia</option> 
               <option value="FL"  {{ old('state', $rec) == "FL" ? 'selected' : '' }}>Florida</option> 
               <option value="GA"  {{ old('state', $rec) == "GA" ? 'selected' : '' }}>Georgia</option> 
               <option value="GU"  {{ old('state', $rec) == "GU" ? 'selected' : '' }}>Guam</option> 
               <option value="HI"  {{ old('state', $rec) == "HI" ? 'selected' : '' }}>Hawaii</option> 
               <option value="ID"  {{ old('state', $rec) == "ID" ? 'selected' : '' }}>Idaho</option> 
               <option value="IL"  {{ old('state', $rec) == "IL" ? 'selected' : '' }}>Illinois</option> 
               <option value="IN"  {{ old('state', $rec) == "IN" ? 'selected' : '' }}>Indiana</option> 
               <option value="IA"  {{ old('state', $rec) == "IA" ? 'selected' : '' }}>Iowa</option> 
               <option value="KS"  {{ old('state', $rec) == "KS" ? 'selected' : '' }}>Kansas</option> 
               <option value="KY"  {{ old('state', $rec) == "KY" ? 'selected' : '' }}>Kentucky</option> 
               <option value="LA"  {{ old('state', $rec) == "LA" ? 'selected' : '' }}>Louisiana</option> 
               <option value="ME"  {{ old('state', $rec) == "ME" ? 'selected' : '' }}>Maine</option> 
               <option value="MD"  {{ old('state', $rec) == "MD" ? 'selected' : '' }}>Maryland</option> 
               <option value="MA"  {{ old('state', $rec) == "MA" ? 'selected' : '' }}>Massachusetts</option> 
               <option value="MI"  {{ old('state', $rec) == "MI" ? 'selected' : '' }}>Michigan</option> 
               <option value="MN"  {{ old('state', $rec) == "MN" ? 'selected' : '' }}>Minnesota</option> 
               <option value="MS"  {{ old('state', $rec) == "MS" ? 'selected' : '' }}>Mississippi</option>
               <option value="MO"  {{ old('state', $rec) == "MO" ? 'selected' : '' }}>Missouri</option>
               <option value="MT"  {{ old('state', $rec) == "MT" ? 'selected' : '' }}>Montana</option>
               <option value="NE"  {{ old('state', $rec) == "NE" ? 'selected' : '' }}>Nebraska</option>
               <option value="NV"  {{ old('state', $rec) == "NV" ? 'selected' : '' }}>Nevada</option>
               <option value="NH"  {{ old('state', $rec) == "NH" ? 'selected' : '' }}>New Hampshire</option>
               <option value="NJ"  {{ old('state', $rec) == "NJ" ? 'selected' : '' }}>New Jersey</option>
               <option value="NM"  {{ old('state', $rec) == "NM" ? 'selected' : '' }}>New Mexico</option>
               <option value="NY"  {{ old('state', $rec) == "NY" ? 'selected' : '' }} >New York</option>
               <option value="NC"  {{ old('state', $rec) == "NC" ? 'selected' : '' }}>North Carolina</option>
               <option value="ND"  {{ old('state', $rec) == "ND" ? 'selected' : '' }}>North Dakota</option>
               <option value="MP"  {{ old('state', $rec) == "MP" ? 'selected' : '' }}>Northern Marianas</option>
               <option value="OH"  {{ old('state', $rec) == "OH" ? 'selected' : '' }}>Ohio</option>
               <option value="OK"  {{ old('state', $rec) == "OK" ? 'selected' : '' }}>Oklahoma</option>
               <option value="OR"  {{ old('state', $rec) == "OR" ? 'selected' : '' }}>Oregon</option>
               <option value="PW"  {{ old('state', $rec) == "PW" ? 'selected' : '' }}>Palau</option>
               <option value="PA"  {{ old('state', $rec) == "PA" ? 'selected' : '' }}>Pennsylvania</option>
               <option value="PR"  {{ old('state', $rec) == "PR" ? 'selected' : '' }}>Puerto Rico</option>
               <option value="RI"  {{ old('state', $rec) == "RI" ? 'selected' : '' }}>Rhode Island</option>
               <option value="SC"  {{ old('state', $rec) == "SC" ? 'selected' : '' }}>South Carolina</option>
               <option value="SD"  {{ old('state', $rec) == "SD" ? 'selected' : '' }}>South Dakota</option>
               <option value="TN"  {{ old('state', $rec) == "TN" ? 'selected' : '' }}>Tennessee</option>
               <option value="TX"  {{ old('state', $rec) == "TX" ? 'selected' : '' }}>Texas</option>
               <option value="UT"  {{ old('state', $rec) == "UT" ? 'selected' : '' }}>Utah</option>
               <option value="VT"  {{ old('state', $rec) == "VT" ? 'selected' : '' }}>Vermont</option>
               <option value="VI"  {{ old('state', $rec) == "VI" ? 'selected' : '' }}>Virgin Islands</option>
               <option value="VA"  {{ old('state', $rec) == "VA" ? 'selected' : '' }}>Virginia</option>
               <option value="WA"  {{ old('state', $rec) == "WA" ? 'selected' : '' }}>Washington</option>
               <option value="WV"  {{ old('state', $rec) == "WV" ? 'selected' : '' }}>West Virginia</option>
               <option value="WY"  {{ old('state', $rec) == "WY" ? 'selected' : '' }} >Wyoming</option>
               </optgroup>
               </select> 
               
               <div class="invalid-feedback">@php if($errors->has('state')) { echo $errors->first('state') ; } @endphp</div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6" style="display:none;visibility:hidden;">
      <div style="padding: 10px;">
         <?php $disable = (old('shipping_is_same_as_billing', $rec) == 1)? TRUE: FALSE; ?>
         <div class="form-group">
            <div style="float: left; margin-bottom: 8px;"><label>@lang('form.compamy_address')</label></div>
            <div class="form-check" style="float: left; margin-left: 10px;">
               <input class="form-check-input" id="shipping_is_same_as_billing" type="checkbox" value="1" name="shipping_is_same_as_billing" {{ ($disable) ? 'checked' : '' }}>
               <label class="form-check-label" for="defaultCheck1">
               @lang('form.shipping_is_same_as_billing')
               </label>
            </div>
            <textarea id="shipping_address" name="shipping_address" placeholder="{{ __('form.street') }}" class="form-control form-control-sm block w-full rounded-md py-1.5 text-gray-900" {{ ($disable) ? 'disabled' : '' }}>{{ old('shipping_address', $rec) }}</textarea>
            <div class="invalid-feedback">@php if($errors->has('shipping_address')) { echo $errors->first('shipping_address') ; } @endphp</div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-6">
               <input type="text" class="form-control form-control-sm block w-full rounded-md py-1.5 text-gray-900" placeholder="{{ __('form.city') }}" name="shipping_city" value="{{ old('shipping_city', $rec) }}" {{ ($disable) ? 'disabled' : '' }}>
               <div class="invalid-feedback">@php if($errors->has('shipping_city')) { echo $errors->first('shipping_city') ; } @endphp</div>
            </div>
            <div class="form-group col-md-6">hinhinhinhin
               <input type="text" class="form-control form-control-sm block w-full rounded-md py-1.5 text-gray-900" placeholder="{{ __('form.state') }}" name="shipping_state" value="{{ old('shipping_state', $rec) }}" {{ ($disable) ? 'disabled' : '' }}>
               <div class="invalid-feedback">@php if($errors->has('shipping_state')) { echo $errors->first('shipping_state') ; } @endphp</div>
            </div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-6">
               <input type="text" class="form-control form-control-sm block w-full rounded-md py-1.5 text-gray-900" placeholder="{{ __('form.zip_code') }}" name="shipping_zip_code" value="{{ old('shipping_zip_code', $rec) }}" {{ ($disable) ? 'disabled' : '' }}>
               <div class="invalid-feedback">@php if($errors->has('shipping_zip_code')) { echo $errors->first('shipping_zip_code') ; } @endphp</div>
            </div>
            <div class="form-group col-md-6">
               <div class="select2-wrapper">
                  <?php $shipping_country_disable = ($disable) ? 'disabled' : '' ;?>
                  <select name="shipping_country_id" class="form-control form-control-sm block w-full rounded-md py-1.5 text-gray-900" id="shipping_country_id" autocomplete="false">
                  <?php /*echo form_dropdown("country_id", $data['country_id_list'], old("country_id", $rec), "class='form-control form-control-sm  selectpicker '");*/ ?>
                  @foreach($data['country_id_list'] as $country_key =>$country_value){
                  print '<option value="{{$country_key}}" {{ old('country_id', $rec) == $country_key ? 'selected' : '' }} >{{$country_value}} </option>';
                  }
                  @endforeach
                  </select>

                  <?php /*echo form_dropdown("shipping_country_id", $data['country_id_list'], old("shipping_country_id",$rec), "class='form-control form-control-sm  selectpicker'  {{ $shipping_country_disable }}")*/ ?>
               </div>
               <div class="invalid-feedback">@php if($errors->has('shipping_country_id')) { echo $errors->first('shipping_country_id') ; } @endphp</div>
            </div>
         </div>
      </div>
   </div>
</div>