 <x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">

</h2>
</x-slot>
<div class="py-12">
<style>
  #tags tr:nth-child(odd) {
    background: #eeeeee;
}
#tags td{padding:10px}
</style>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="px-4 py-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
<div class="main-content">
   <h5>Note Tags</h5>
   <hr>
 <form action="{{ url('settings/tags/add') }}" method="POST" autocomplete="false">
               @csrf()
<div class="grid grid-cols-3 gap-6 py-1">
               <div class="form-group" class="">
                  <label for="tag" style="font-size:14px;font-weight:bold">Tag</label>
                  <input type="text" name="tag" id="tag"> <select name="type"><option value="Client">Client</option><option value="Billing">Billing</option></select><button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-post="{{ url('settings/tags/add') }}"
                  data-hx-trigger="click"
                  data-hx-target="#tags"
                  data-hx-swap="afterbegin"
                   hx-on::after-request="(function(){document.getElementById('tag').value='';})()">Add tag</button>
               </div>
<div class="form-group" class="">
               </div></div>
            </form>

            
               <table id="tags">
    @foreach ($tags as $tag)
        @include('settings/tag-one', [
            'tag' => $tag,
        ])
    @endforeach
</table>
      
      </div>
   </div>
</div>
</x-app-layout>