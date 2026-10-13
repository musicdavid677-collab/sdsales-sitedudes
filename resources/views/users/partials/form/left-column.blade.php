<!-- Name -->
<div class="col-span-6 sm:col-span-4">
<x-label for="first_name" value="{{ __('First Name') }}" />
<x-input id="first_name" type="text" class="mt-1 block w-full" name="first_name" required autocomplete="first_name" value="{{ old('first_name', $rec) }}"/>
<div class="invalid-feedback">@php if($errors->has('first_name')) { echo $errors->first('first_name'); } @endphp</div>
</div>
<div class="col-span-6 sm:col-span-4">
<x-label for="last_name" value="{{ __('Last Name') }}" />
<x-input id="last_name" type="text" class="mt-1 block w-full" name="last_name" required autocomplete="last_name" value="{{ old('last_name', $rec) }}" />
<div class="invalid-feedback">@php if($errors->has('last_name')) { echo $errors->first('last_name'); } @endphp</div>
</div>

<!-- Email -->
<div class="col-span-6 sm:col-span-4">
<x-label for="email" value="{{ __('Email') }}" />
<x-input id="email" type="email" class="mt-1 block w-full" name="email" required autocomplete="username" value="{{ old('email', $rec) }}" />
<div class="invalid-feedback">@php if($errors->has('email')) { echo $errors->first('email'); } @endphp</div>
</div>


<div class="col-span-6 sm:col-span-4">
<x-label for="password" value="{{ __('Password') }}" />
<x-input id="password" type="password" class="mt-1 block w-full" name="password" autocomplete="password" />
<div class="invalid-feedback">@php if($errors->has('password')) { echo $errors->first('password'); } @endphp</div>
</div>

<div class="col-span-6 sm:col-span-4">
<x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
<x-input id="password_confirmation" type="password" class="mt-1 block w-full" name="password_confirmation" autocomplete="new-password" value="{{ old('password_confirmation', $rec) }}"/>
<div class="invalid-feedback">@php if($errors->has('password_confirmation')) { echo $errors->first('password_confirmation'); } @endphp</div>
</div>

<div class="form-group col-md-6">
<label>@lang('form.start_date') </label>
<div x-data x-init="flatpickr($refs.dateInput,{altInput: true,altFormat: 'Y-m-d', dateFormat: 'Y-m-d', defaultDate: ['{{ old_set('start_date', NULL,$rec)  }}']})">
<input type="text" x-ref="dateInput" placeholder="YYYY-MM-DD" class="form-control form-control-sm initially_empty_datepicker  @php if($errors->has('start_date')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gr
</div>
<div class="invalid-feedback">@php if($errors->has('start_date')) { echo $errors->first('start_date') ; } @endphp</div>
</div>

<div class="col-span-6 sm:col-span-4">
<x-label for="is_administrator" value="{{ __('Is Administrator') }}" />
<input type="checkbox" name="is_administrator" value="1" @php if(old('is_administrator', $rec)) echo "checked"; @endphp />
</div>

<div class="col-span-6 sm:col-span-4">
<x-label for="role" value="{{ __('Role') }}" />
<select id="role_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" name="role_id">
<option value=""></option>
<?php foreach($roles as $role):?>
<option value="@php echo $role->id; @endphp" @php if(old('role_id', $rec)==$role->id) echo "selected"; @endphp>@php echo $role->name; @endphp</option>
<?php endforeach;?>
</select>
<div class="invalid-feedback">@php if($errors->has('role')) { echo $errors->first('role'); } @endphp</div>
</div>

