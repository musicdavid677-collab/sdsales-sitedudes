 <x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">

</h2>
</x-slot>
<div class="py-12">
  <style>
    #verticals tr:nth-child(odd) {
    background: #eeeeee;
}
#verticals td{padding:10px}
</style>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="px-4 py-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
<div class="main-content">
   <h5>Verticals</h5>
   <hr>
 <form action="{{ url('settings/verticals/add') }}" method="POST" autocomplete="false">
               @csrf()
<div class="grid grid-cols-3 gap-6 py-1">
               <div class="form-group" class="">
                  <label for="vertical" style="font-size:14px;font-weight:bold">Vertical &nbsp;</label>
                  <input type="text" name="vertical" id="vertical">

               </div>
<div class="form-group" class="">
               <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-post="{{ url('settings/verticals/add') }}"
                  data-hx-trigger="click"
                  data-hx-target="#verticals"
                  data-hx-swap="afterbegin"
                   hx-on::after-request="(function(){document.getElementById('vertical').value='';})()">Add vertical</button></div></div>
            </form>

            
               <table id="verticals">
    @foreach ($verticals as $vertical)
        @include('settings/vertical-one', [
            'vertical' => $vertical,
        ])
    @endforeach
</table>
      
      </div>
   </div>
</div>
</x-app-layout>