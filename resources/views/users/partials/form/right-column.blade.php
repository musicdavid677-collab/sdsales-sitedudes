

<div class="col-span-6 sm:col-span-4">
<x-label for="birth_date" value="{{ __('Date of Birth') }}" />
<div x-data x-init="flatpickr($refs.dateInput,{altInput: true,altFormat: 'Y-m-d', dateFormat: 'Y-m-d',defaultDate: ['{{ old('birth_date', $rec) }}']})" >
<input type="text" x-ref="dateInput" placeholder="YYYY-MM-DD" name="birth_date" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" value="{{ old('birth_date', $rec) }}">
</div>
<div class="invalid-feedback">@php if($errors->has('birth_date')) { echo $errors->first('birth_date'); } @endphp</div>
</div>

<div class="col-span-6 sm:col-span-4">
<x-label for="gender" value="{{ __('Gender') }}" />
<select id="gender" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" name="gender" required>
<option value=""></option>
<option value="F" @php if(old('gender', $rec)=="F") echo "selected"; @endphp>Female</option>
<option value="M" @php if(old('gender', $rec)=="M") echo "selected"; @endphp>Male</option>
</select>
<div class="invalid-feedback">@php if($errors->has('gender')) { echo $errors->first('gender'); } @endphp</div>
</div>

<div class="col-span-6 sm:col-span-4">
<x-label for="job_title" value="{{ __('Job Title') }}" />
<x-input id="job_title" type="text" class="mt-1 block w-full" name="job_title" required autocomplete="job_title" value="{{ old('job_title', $rec) }}" />
<div class="invalid-feedback">@php if($errors->has('job_title')) { echo $errors->first('job_title'); } @endphp</div>
</div>

<div class="col-span-6 sm:col-span-4">
<x-label for="phone" value="{{ __('Phone') }}" />
<x-input id="phone" type="text" x-mask="(999)-(999)-(9999)" placeholder="(999)-(999)-(9999)" class="mt-1 block w-full" name="phone" autocomplete="phone" value="{{ old('phone', $rec) }}"/>
<div class="invalid-feedback">@php if($errors->has('phone')) { echo $errors->first('phone'); } @endphp</div>
</div>

<div class="col-span-6 sm:col-span-4">
<x-label for="address" value="{{ __('Address') }}" />
<textarea id="address" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" name="address" >{{ old('address', $rec) }}</textarea>
<div class="invalid-feedback">@php if($errors->has('address')) { echo $errors->first('address'); } @endphp</div>
</div>