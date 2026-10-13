<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
User
</h2>
</x-slot>
<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="px-4 py-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
<div class="main-content">
@section('title', (isset($rec->id)) ? __('form.edit_user'). " : " . $rec->title : __('form.new_user'))
<div>

   <form id="userForm" method="post" action="{{ (isset($rec->id)) ? route( 'patch_user', $rec->id) : route('post_user') }}" enctype="multipart/form-data">
      {{ csrf_field()  }}
      @if(isset($rec->id))
      {{ method_field('PATCH') }}
      @endif
      <div class="row grid grid-cols-2 gap-4 py-4">
         <div class="col-md-8">
            @include('users.partials.form.left-column')
              <input type="submit" name="submit" id="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700.
   active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150"/>
   
</div>
         <div class="col-md-4">
            @include('users.partials.form.right-column')
         </div>
      </div>
   </form>

</div>

</div>

</div>
</div>
</div>
</x-app-layout>
