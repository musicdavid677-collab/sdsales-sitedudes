<div class="row">
   <div class="col-md-12">
      <div>
         <div class="form-group">
            <label for="address">@lang('form.company_address')</label>
            <textarea id="address" name="address" placeholder="{{ __('form.street') }}" class="form-control form-control-sm " >{{ old('address', NULL, $rec) }}</textarea>
            <div class="invalid-feedback">@php if($errors->has('address')) { echo $errors->first('address') ; } @endphp</div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-6">
               <input type="text" class="form-control form-control-sm " placeholder="{{ __('form.city') }}" name="city" value="{{ old('city', NULL, $rec) }}">
               <div class="invalid-feedback">@php if($errors->has('city')) { echo $errors->first('city') ; } @endphp</div>
            </div>
           
               
             
            </div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-6">
               <input type="text" class="form-control form-control-sm " placeholder="{{ __('form.zip_code') }}" name="zip" value="{{ old('zip', NULL, $rec) }}">
               <div class="invalid-feedback">@php if($errors->has('zip')) { echo $errors->first('zip') ; } @endphp</div>
            </div>

         </div>
      </div>
   </div>


<?php exit();?>