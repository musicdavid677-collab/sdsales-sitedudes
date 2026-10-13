<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
@lang('form.tasks')
</h2>
</x-slot>
<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="px-4 py-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
<div class="main-content">
@section('title', (isset($rec->id)) ? __('form.edit_task'). " : " . $rec->title : __('form.new_task'))
<div>

   <form id="taskForm" method="post" action="{{ (isset($rec->id)) ? route( 'patch_task', $rec->id) : route('post_task') }}" enctype="multipart/form-data">
      {{ csrf_field()  }}
      @if(isset($rec->id))
      {{ method_field('PATCH') }}
      @endif
      <div class="row grid grid-cols-2 gap-4 py-4">
         <div class="col-md-8">
            @include('task.partials.form.left-column')
            <?php /*echo bottom_toolbar();*/ ?>
            @if(check_perm('tasks_create') || check_perm('tasks_edit'))
              <input type="submit" name="submit" id="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700.
   active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150"/>
 @endif

         </div>
         <div class="col-md-4">
            @include('task.partials.form.right-column')
         </div>
      </div>
   </form>
   @if(isset($files))
   <h3>Task Files</h3>
   <table>
    <tr>
        <th>Filename</th>
        <th></th>
    </tr>
    @forelse($files as $file)
        <tr>
            <td>
             <a href="{{ route('attachment_download_link', $file->id ) }}"  class="btn btn-danger btn-sm remove_attachment">    {{ $file->original_name }}</a> 
             
            </td>
            <td>
           
  <x-delete-button :action="route('attachment_delete_link', $file->id)" />
            </td>
        </tr>
          @empty
        <tr>
            <td>No uploads found</td>
        </tr>
    @endforelse
</table>
@endif
</div>

</div>

</div>
</div>
</div>
</x-app-layout>
