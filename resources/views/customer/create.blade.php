<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
@lang('form.customers')
</h2>
</x-slot>
<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="px-4 py-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
<div class="main-content">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   <form method="post" action='{{ (isset($rec->id)) ? route( 'patch_customer', $rec->id) : route('post_customer') }}'>
   {{ csrf_field()  }}
   @if($rec)
   @method('patch')
   @endif
   @include('customer.partials.details')
   @if(isset($rec->lead_id))
   <input type="hidden" name="lead_id" value="{{ $rec->lead_id }}">
   <input type="hidden" name="social_links" value="{{ $rec->social_links }}">
   <input type="hidden" name="smart_summary" value="{{ $rec->smart_summary }}">
   <input type="hidden" name="photo" value="{{ $rec->photo }}">
   @endif
   @if(check_perm('customers_create') || check_perm('customers_edit'))
   <input type="submit" name="submit" id="submit" class="orangebtn"/>
  @endif
   @if($rec)
   <a href="/customers/profile/{{$rec->id}}?customer_id={{$rec->customer_id}}" class="orangebtn">Back to Profile</a>
   @endif
   </form>
</div>

</div>
</div>
</div>
</x-app-layout>

