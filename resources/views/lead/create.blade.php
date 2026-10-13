<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
@lang('form.leads')
</h2>
</x-slot>
<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="px-4 py-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">

<script>
   function checkSession(){
fetch('/user/status')
    .then(response => response.json())
    .then(data => {
        if (data.isLoggedIn) {
//console.log('logged in');
        } else {
        window.location.reload();
        //console.log('not logged in');
        }
    })
    .catch(error => console.error('Error fetching user status:', error));
 }
   </script>
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
   <form method="post" action='{{ (isset($rec->id)) ? route( 'patch_lead', $rec->id) : route('post_lead') }}'>
   {{ csrf_field()  }}
   @if($rec)
   @method('patch')
   @endif
   @include('lead.partials.details')
   @include('lead.partials.billing_ch')
   @include('lead.partials.payment-info-form')
   <fieldset style="border: solid 1px #efefef!important; margin-bottom:10px">
         <legend>Sales Representative</legend>
         <div class="form-row grid grid-cols-2 gap-6 py-4">
            <div class="form-group col-md-6">
               <label for="rep_first_name">First Name <span class="required">*</span></label>
               <input type="text"
                  name="rep_first_name"
                  value="{{ old('rep_first_name',(isset($salesrep)) ? $salesrep['first_name']:$rec->rep_first_name, $rec) }}"
                  id="rep_first_name"
                  class="form-control @php if($errors->has('rep_first_name')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" readonly>
                  <div class="invalid-feedback">@php if($errors->has('rep_first_name')) { echo $errors->first('rep_first_name'); } @endphp</div>
            </div>
            <div class="form-group col-md-6">
               <label for="rep_last_name">Last Name <span class="required">*</span></label>
               <input type="text"
                  name="rep_last_name"
                  value="{{ old('rep_last_name', (isset($salesrep)) ? $salesrep['last_name']:$rec->rep_last_name, $rec) }}"
                  id="rep_last_name"
                  class="form-control @php if($errors->has('rep_last_name')) { echo 'is-invalid'; } @endphp block w-full rounded-md py-1.5 text-gray-900" readonly>
                  <div class="invalid-feedback">@php if($errors->has('rep_last_name')) { echo $errors->first('rep_last_name'); } @endphp</div>
            </div>
         </div>
      </fieldset>

   @if(isset($rec->lead_id))
  
   <input type="hidden" name="lead_id" value="{{ $rec->lead_id }}">
   <input type="hidden" name="social_links" value="{{ $rec->social_links }}">
   <input type="hidden" name="smart_summary" value="{{ $rec->smart_summary }}">
   <input type="hidden" name="photo" value="{{ $rec->photo }}">
   @endif
   @if(check_perm('leads_create') || check_perm('leads_edit'))
   <input type="submit" name="submit" value="Submit" id="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150"/>
   @endif
   </form>


@if(isset($rec->id))
 @if(auth()->user()->is_administrator)
   <form action="{{route('cancel_lead')}}" method="POST">
      @csrf()
      <input type="hidden" name="id" value="{{$rec->id}}">
       Are you sure you want to delete this lead? <input type="checkbox" name="comfirm_delete" value="comfirm_delete"> Yes
<input type="submit" name="submit" value=" Delete Lead" id="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150"/>
   </form>
   @endif
<?php $adminPerson = Auth::user()->first_name . ' ' . Auth::user()->last_name; ?>
 <div class="card" x-data="{ tab: 'tab1' }">
    <ul class="flex border-b mt-6">
    <li class="-mb-px mr-1">
      <a
         class="inline-block rounded-t py-2 px-4 font-semibold hover:text-orange-800"  href="#" 
         :class="{ 'bg-white text-700 border-l border-t border-r': tab == 'tab1'}"
         @click.prevent="tab = 'tab1'"
         >Client Notes</a>
    </li>
    <li class="-mb-px mr-1">
      <a
         class="inline-block py-2 px-4 text-500 hover:text-orange-800 font-semibold"
         href="#"
         :class="{ 'bg-white text-700 border-l border-t border-r': tab == 'tab2'}"
         @click.prevent="tab = 'tab2'"
         >Billing Notes</a
        >
    </li>
</li>
</ul>
<div class="card-body">    
      <div class="tab-content" id="notesContent">
         <div class="tab-pane fade show active" id="client" role="tabpanel" aria-labelledby="client-tab" x-show="tab == 'tab1'">
<form action="{{url('leads/lead-comments')}}" method="POST" autocomplete="false">
@csrf()
<input type="hidden" name="client_id" value="{{ $rec->id }}">
<input type="hidden" name="comment_type" value="Account">
<input type="hidden" name="admin_person" value="{{ $adminPerson }}">
<div class="form-group" class="">
<label for="addClientNotes" style="font-size:14px;font-weight:bold">Add New Lead Note</label>
<textarea name="comment" class="form-control form-control-sm block w-full rounded-md my-2 py-1.5 text-gray-900" id="addClientNotes" rows="3"></textarea>               
</div>
<button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
data-hx-post="{{ url('leads/lead-comments') }}"
data-hx-trigger="click"
data-hx-target="#Account-notes"
data-hx-swap="afterbegin" hx-on::before-request="checkSession()"
hx-on::after-request="(function(){document.getElementById('addClientNotes').value='';})()">Add Note</button>
</form>

<div data-hx-get="{{ url('leads/lead-comments/' . $rec->id.'/Account') }}"
data-hx-trigger="load delay:1s"
data-hx-swap="outerHTML">
</div>
</div>

<div class="tab-pane fade show active" id="client" role="tabpanel" aria-labelledby="client-tab" x-show="tab == 'tab2'">
<form action="{{url('leads/lead-comments')}}" method="POST" autocomplete="false">
@csrf()
<input type="hidden" name="client_id" value="{{ $rec->id }}">
<input type="hidden" name="comment_type" value="Billing">
<input type="hidden" name="admin_person" value="{{ $adminPerson }}">
<div class="form-group" class="">
<label for="addBillingNotes" style="font-size:14px;font-weight:bold">Add New Lead Billing Note</label>
<textarea name="comment" class="form-control form-control-sm block w-full rounded-md my-2 py-1.5 text-gray-900" id="addBillingNotes" rows="3"></textarea>               
</div>
<button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
data-hx-post="{{ url('leads/lead-comments') }}"
data-hx-trigger="click"
data-hx-target="#Billing-notes"
data-hx-swap="afterbegin"
hx-on::after-request="(function(){document.getElementById('addBillingNotes').value='';})()">Add Note</button>
</form>

<div data-hx-get="{{ url('leads/lead-comments/' . $rec->id.'/Billing') }}"
data-hx-trigger="load delay:1s"
data-hx-swap="outerHTML">
</div>
</div>

</div>
</div>
</div>
@endif
</div>

</div>
</div>
</div>
</x-app-layout>
