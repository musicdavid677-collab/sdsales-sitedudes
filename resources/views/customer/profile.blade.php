<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
@lang('form.customers')
</h2>
</x-slot>
<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="px-4 py-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
<style>
#account-notes, #billing-notes, #cancellation-notes{margin:0;list-style:none;padding:0;}
#account-notes li .comment, #billing-notes li .comment, #cancellation-notes li .comment{background-color:#f4f5f8;padding:1rem;border-radius:1rem;margin-top:1rem;}
li .comment span{word-break:break-all;display: block;white-space:pre-line;word-wrap:break-word;margin: 1em 0;}
.hx-placeholder{background-color: #f4f5f8;padding: 1rem;}
#customer_invoices_table, #monthly_fee_updates{width:100%; border-collapse: collapse;}
#customer_invoices_table #head, #customer_invoices_table #head td, #monthly_fee_updates #head, #monthly_fee_updates #head td{background: #414141!important; color:#ffffff; padding:10px}
#customer_invoices_table tr:nth-child(odd) , #monthly_fee_updates tr:nth-child(odd){
    background: #eeeeee;
}
#profile-table{width:100%;}
#profile-table tr:nth-child(odd){background-color: #f4f5f8}
#profile-table td{padding:10px;}
form{
    margin: 10px;
    border-bottom: solid 1px #CCCCCc;
    padding-bottom: 20px;
}
</style>
<script>
    document.body.addEventListener("htmx:responseError", function (event) {
        if (event.detail.xhr.status === 419) {
            // Session expired
            window.location.reload(); // or window.location.href = '/login';
        }
    });
    
function upAndRunning(id)
{
  if(confirm("Are you sure you want to send the Up and Running Email to this customer?"))
  {
  window.location.href="/customers/senduprunning/"+id;
}
return false;
}
function resendWelcomeEmail(id)
{
  if(confirm("Are you sure you want to resend welcome email to this customer?"))
  {
  window.location.href="/customers/resend-welcome-email/"+id;
}
return false;
}

function sendUpdateCCEmail(id)
{
if(confirm("Are you sure you want to send Update CC email to this customer?"))
  {
  window.location.href="/customers/send-cc-update-form/"+id;
}
return false;
}

function requestDomainCredentials(id)
{
  if(confirm("Are you sure you want to send the Request Domain Credentials Email to this customer?"))
  {
  window.location.href="/customers/requestdomaincredentials/"+id;
}
return false;
}
function confirmStats(event)
{
    if(confirm("Are you sure you want to add this customer to Site Dudes Stats?"))
  {
  return true;
}
else
{
  event.preventDefault();
  return false;
}
}

function generateLiveHelp(id)
{
  if(confirm("Are you sure you want to send the generate a live help number for this customer?"))
  {
  window.location.href="/customers/generateLiveHelp/"+id;
}
return false;
}

   function checkSession(e){

fetch('/user/status')
    .then(response => response.json())
    .then(data => {
        if (data.isLoggedIn) {
//console.log('logged in');
        } else {
          e.preventDefault();
        window.location.reload();
        //console.log('not logged in');
        }
    })
    .catch(error => console.error('Error fetching user status:', error));
 }

 function copy(id) {
  let copyText = document.getElementById(id);
  navigator.clipboard.writeText(copyText.innerText);
}
 function copyVal(id) {
  let copyText = document.getElementById(id);
  navigator.clipboard.writeText(copyText.val());
}
function backLocation()
{
  console.log(document.referrer);
  if(document.referrer=="https://sdintranet.sitedudes.com/customers")
    window.history.back();
  else
     window.location.href="https://sdintranet.sitedudes.com/customers";

}
</script>
<div class="main-content">
  @if (Session::has('message'))
    <div class="alert alert-success">
        <ul>
            <li>{{Session::get('message') }}</li>
        </ul>
    </div>
@endif
<div id="top"></div>
<div style="margin:15px 0px"><h5>Account Actions</h5>
<a href="/customers/invoice/{{$rec->id}}" class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none" target="_blank">Generate Invoice</a>
<a href="/customers/contract/{{$rec->id}}/view" class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none">Generate Contract</a>
<a href="#" class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none" onclick="return upAndRunning({{$rec->id}})">Send Up and Running Email</a>
<a href="#" class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none" onclick="return requestDomainCredentials({{$rec->id}})">Send Request Domain Credentials Email</a>
<a href="#" class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none" onclick="return resendWelcomeEmail('{{$rec->customer_id}}')">Resend Welcome Email</a> 
</div>
<a class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none" href="https://www.sitedudesstats.com/update.php?u={{$rec->email_address}}&e={{$rec->email_address}}&p={{$statspass}}&sitename={{$rec->company}}&siteurl={{$rec->url}}&designer={{$designer}}" target="_blank" onclick="return confirmStats(event)">ADD CLIENT TO SITE DUDES STATS</a>
<a class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none" href="https://www.sitedudesstats.com/update.php?u={{$rec->email_address}}&e={{$rec->email_address}}&p={{$statspass}}&sitename=SEO Client - {{$rec->company}}&siteurl={{$rec->url}}&designer={{$designer}}" target="_blank" onclick="return confirmStats(event)">ADD CLIENT TO SITE DUDES STATS ****SEO CLIENTS ONLY</a>  @if(check_perm('payments_edit'))<a href="#" class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none" onclick="return sendUpdateCCEmail('{{$rec->id}}')">Send Update CC Email</a> <a href="/customers/copyCCUpdateLink/{{$rec->id}}" class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none">Get Update CC Link</a>@endif

 <div class="px-2 py-2"></div>
 <div style="margin:15px 0px"><h5>Account Status</h5>
  <?= $rec->canceled==0 ? 'Active':'Cancelled';?>
  <?php foreach($productSolds as $prods)
  {
if($prods->product_id ==1060)
  print "<div style='color:#cc0000; font-weight:bold'>NO UPDATES, HOSTING ONLY</div>";
  }
  ?>
   <div class="px-2 py-2"></div>
   @if(count($monthlyinvoices)>0)
   @if(($monthlyinvoices[0]->status=="Declined" && ($monthlyinvoices[0]->updated_status=="Outstanding" || $monthlyinvoices[0]->updated_status=='Collections' || $monthlyinvoices[0]->updated_status==NULL)) || count($cleanup)>0)
<div class="alert-danger">PAYMENT OUTSTANDING</div>
   @endif
   @endif
    <div class="px-2 py-2"></div>
   <h5>@lang('form.profile') 

      <a style="font-size: 12px; vertical-align: top;" href="{{ route('edit_customer_page', $rec->id) }}?customer_id={{ $rec->customer_id }}"><i class="far fa-edit" aria-label="Edit">[EDIT]</i></a>

   </h5>

   <div class="table-responsive-sm">
   <table class="table" id="profile-table">
      <tbody>
          <tr>
            <td><strong>@lang('form.customer_number')</strong></td>
            <td><span id="customer_id">{{ $rec->customer_id }}  </span> <button onclick="copy('customer_id')" class="copybtn"></button></td>
         </tr>
         <tr>
            <td><strong>Sale Person/Sale Date</strong></td>
            <td>{{$rec->rep_first_name.' '.$rec->rep_last_name}} / {{$rec->signup_date}}</td>
         </tr>
         <!--   
         <tr>
            <td>@lang('form.name')</td>
            <td>{{ $rec->name }}</td>
         </tr>-->
         <tr>
            <td><strong>Customer Name</strong></td>
            <td>{{$rec->salutation.' '. $rec->first_name . ' ' . $rec->last_name}}</td>
         </tr>         
         <tr>
            <td><strong>Company Name</strong></td>
            <td><span id="company">{{$rec->company}} </span> <button onclick="copy('company')" class="copybtn"></button></td>
        </tr>
         <tr>
            <td><strong>@lang('form.phone')</strong></td>
            <td><span id="phone">{{$rec->area.' '.$rec->phone.' '.$rec->phone2}} ext: {{$rec->ext}} </span> <button onclick="copy('phone')" class="copybtn"></button></td>
         </tr>
         <tr>
            <td><strong>@lang('form.email')</strong></td>
            <td><span id="email">{{$rec->email_address}} </span> <button onclick="copy('email')" class="copybtn"></button></td>
         </tr>
          <tr>
            <td><strong>@lang('form.email') 2 </strong></td>
            <td><span id="email2">{{$rec->email_address2}}</span> @if($rec->email_address2!="")<button onclick="copy('email2')" class="copybtn"></button>@endif</td>
         </tr>
          <tr>
            <td><strong>Invoicing Email</strong></td>
            <td><span id="email3">{{$rec->invoicing_email}}</span> @if($rec->invoicing_email!="")<button onclick="copy('email3')" class="copybtn"></button>@endif</td>
         </tr>
          <tr>
            <td><strong>Invoicing Email 2</strong></td>
            <td><span id="email4">{{$rec->invoicing_email2}}</span> @if($rec->invoicing_email2!="")<button onclick="copy('email4')" class="copybtn"></button>@endif</td>
         </tr>
         <tr>
            <td><strong>SMS/Text Now #</strong></td>
            <td>@if($notes!==NULL){{$notes->sms_num_1.' '.$notes->sms_num_2.' '.$notes->sms_num_3}}@endif</td>
        </tr>
        <tr>
            <td><strong>Alt Phone #</strong></td>
            <td>@if($notes!==NULL){{$notes->alt_num_label}} {{$notes->alt_num1.' '.$notes->alt_num2.' '.$notes->alt_num3}}@endif</td>
        </tr>
         <tr>
            <td><strong>@lang('form.website')</strong></td>
            <td><span id="url"> <a target="_blank" href="{{ $rec->url }}">{{ $rec->url }}</a></span> <button onclick="copy('url')" class="copybtn"></button></td>
         </tr>
         <tr>
            <td><strong>Secondary Domain</strong></td>
            <td><span id="url2"> <a target="_blank" href="{{ $rec->url2 }}">{{ $rec->url2 }}</a></span>@if($rec->url2!="") <button onclick="copy('url2')" class="copybtn"></button>@endif</td>
         </tr>
         <tr>
            <td><strong>Dev. Website</strong></td>
            <td><a target="_blank" href="{{ $rec->dev_url }}">{{ $rec->dev_url }}</a></td>
         </tr>
         <tr>
            <td><strong>Live Help</strong></td>
            <td>{{ $rec->livehelp_id }}@if($rec->livehelp_id===NULL)<a href="#" class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none" onclick="return generateLiveHelp({{ $rec->id }})">Generate Livehelp Number</a> @endif</td>
         </tr>
         <!--
         <tr>
            <td>@lang('form.vat_number')</td>
            <td>{{ $rec->vat_number }}</td>
         </tr>
         
         <tr>
            <td>@lang('form.default_language')</td>
            <?php $language = $rec->language ;?>
            <td>{{ ($language) ? $language->name : '' }}</td>
         </tr>-->
         <tr>
            <td><strong>Address</strong></td>
            <td>
               <div>
                  <?php echo nl2br($rec->address)?>
                  <div>{{ $rec->city }} {{ $rec->state }}</div>
                  <?php $country = $rec->country; ?>
                  <div>{{ $rec->zip }} {{  ($country) ? $country->name : ''}}</div>
               </div>
            </td>
         </tr>
         <!--
         <tr>
            <td>@lang('form.shipping_address')</td>
            <td>
               <?php echo nl2br($rec->shipping_address)?>
               <div>{{ $rec->shipping_city }} {{ $rec->shipping_state }}</div>
               <?php $shipping_country = $rec->shipping_country; ?>
               <div>{{ $rec->shipping_zip_code }} {{  ($shipping_country) ? $shipping_country->name : ''}}</div>
            </td>
         </tr>
         -->
      </tbody>
   </table>


   <div data-hx-get="{{ url("client-notes/{$rec->customer_id}/sections/search-terms") }}" data-hx-trigger="load" class="hx-placeholder">Loading Search Terms...</div><br />
   
   <div data-hx-get="{{ url('product-sold/' . $rec->customer_id) }}" data-hx-trigger="load" class="hx-placeholder">Loading Products...</div><br />

   <div data-hx-get="{{ url("client-notes/{$rec->customer_id}/sections/domain-credentials") }}" data-hx-trigger="load" class="hx-placeholder">Loading Domain Credentials...</div><br />   

   <div data-hx-get="{{ url('customers/' . $rec->customer_id . '/sections/payment-info') }}" data-hx-trigger="load" class="hx-placeholder">Loading Payment Info...</div><br />
   <div data-hx-get="{{ url('client-notes/' . $rec->customer_id . '/sections/vertical') }}" data-hx-trigger="load" class="hx-placeholder">Loading Prospect Info...</div><br />
      <div><a href="#endofnotes">Jump to bottom</a></div>
      <div id="topofnotes"></div>
   <div class="card" x-data="{ tab: 'tab1' }">
  <div class="card-header">
    <!--<ul class="nav nav-tabs card-header-tabs" role="tablist">
      <li class="nav-item" role="presentation">
         <a class="nav-link active" id="client-tab" 
            data-toggle="tab" href="#client" 
            role="tab" aria-controls="client" aria-selected="true">Client Notes</a>
      </li>
      <li class="nav-item" role="presentation">
         <a class="nav-link" id="billing-tab" 
            data-toggle="tab" href="#billing" 
            role="tab" aria-controls="billing" aria-selected="false">Billing Notes</a>
      </li>
      <li class="nav-item" role="presentation">
         <a class="nav-link" id="cancellation-tab" 
            data-toggle="tab" href="#cancellation" 
            role="tab" aria-controls="cancellation" aria-selected="false">Cancellation Notes</a>
      </li>
    </ul>-->
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
    <li class="-mb-px mr-1">
      <a
         class="inline-block py-2 px-4 text-500 hover:text-orange-800 font-semibold"
         href="#" 
         :class="{ 'bg-white text-700 border-l border-t border-r': tab == 'tab3'}"
         @click.prevent="tab = 'tab3'"
         >Cancellation Notes</a
        >
    </li>
     <li class="-mb-px mr-1">
      <a
         class="inline-block py-2 px-4 text-500 hover:text-orange-800 font-semibold"
         href="#".
         :class="{ 'bg-white text-700 border-l border-t border-r': tab == 'tab4'}"
         @click.prevent="tab = 'tab4'"
         >Failed Payments</a>
    </li>
    <li class="-mb-px mr-1">
      <a
         class="inline-block py-2 px-4 text-500 hover:text-orange-800 font-semibold"
         href="#".
         :class="{ 'bg-white text-700 border-l border-t border-r': tab == 'tab5'}"
         @click.prevent="tab = 'tab5'"
         >Sent Invoices</a>
    </li>
    <li class="-mb-px mr-1">
      <a
         class="inline-block py-2 px-4 text-500 hover:text-orange-800 font-semibold"
         href="#".
         :class="{ 'bg-white text-700 border-l border-t border-r': tab == 'tab6'}"
         @click.prevent="tab = 'tab6'"
         >Monthly Fee Updates</a>
    </li>
  </ul>
  </div>
 
  <div class="card-body">    
      <div class="tab-content" id="notesContent">
         <div class="tab-pane fade show active" id="client" role="tabpanel" aria-labelledby="client-tab" x-show="tab == 'tab1'">
            <?php $adminPerson = Auth::user()->first_name . ' ' . Auth::user()->last_name ?>
            <form action="{{ url('client-comments/' . $rec->customer_id.'/create') }}" method="POST" autocomplete="false">
               @csrf()
               <input type="hidden" name="client_id" value="{{ $rec->customer_id }}">
               <input type="hidden" name="comment_type" value="Account">
               <input type="hidden" name="admin_person" value="{{ $adminPerson }}">
               <div class="form-group" class="">
                  <label for="addClientNotes" style="font-size:14px;font-weight:bold">Add New Client Note</label>
                  <textarea name="comment" class="form-control form-control-sm block w-full rounded-md my-2 py-1.5 text-gray-900" id="addClientNotes" rows="3"></textarea>               
               </div>
                <div class="form-group">
                   <label for="addClientNotes" style="font-size:14px;font-weight:bold">Note Tag</label>
       <select name="tag_id">
        <option value="">Select a Tag</option>
        @foreach($tags as $tag)
        @if($tag->type=="Client")
        <option value="{{$tag->id}}">{{$tag->tag}}</option>
        @endif
        @endforeach
    </select> Sticky <input type="checkbox" value="1" name="sticky" id="sticky"/>
    </div>
               <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-post="{{ url('client-comments/' . $rec->customer_id.'/create') }}"
                  data-hx-trigger="click"
                  data-hx-target="#account-notes"
                  data-hx-swap="afterbegin"
                   hx-on::after-request="(function(){document.getElementById('addClientNotes').value='';document.getElementById('sticky').value='';})()" hx-on::before-request="checkSession(event)">Add Note</button>
            </form>
            <br>            
            
            <!--search notes-->
            <label style="font-size:14px;font-weight:bold">Search Client Notes</label>
            <form action="{{ url('client-comments/' . $rec->customer_id) }}" method="POST" autocomplete="false">
            @csrf()
            <input type="text" name="comment_query" id="comment_query" class="block w-full rounded-md py-1.5 text-gray-900"/> <br/>Search Note Content: <input type="radio" name="query_type" value="comment" checked="checked"/> Search By Name: <input type="radio" name="query_type" value="admin_person"/><br/>

                                               <div class="grid grid-cols-2 gap-6 py-4">
   <div class="form-group">
      <label for="start_date">Start Date </label>
       <div x-data x-init="flatpickr($refs.dateInput,{altInput: true,altFormat: 'Y-m-d', dateFormat: 'Y-m-d'})">
      <input type="text" x-ref="dateInput" placeholder="YYYY-MM-DD"  name="start_date" value="" class="block w-full rounded-md py-1.5 text-gray-900" />

   </div>
   </div>
 <div class="form-group">
 <label for="end_date">End Date </label>
       <div x-data x-init="flatpickr($refs.dateInput,{altInput: true,altFormat: 'Y-m-d', dateFormat: 'Y-m-d'})">
      <input type="text" x-ref="dateInput" placeholder="YYYY-MM-DD"  name="end_date" value="" class="block w-full rounded-md py-1.5 text-gray-900" />
     
 </div>
</div>
</div>
       <select name="tag_id" id="tag_id">
        <option value="">Select a Tag</option>
        @foreach($tags as $tag)
        @if($tag->type=="Client")
        <option value="{{$tag->id}}">{{$tag->tag}}</option>
        @endif
        @endforeach
    </select>
            <input type="hidden" name="client_id" value="{{ $rec->customer_id }}">
               <input type="hidden" name="comment_type" value="Account">
               <input type="hidden" name="admin_person" value="{{ $adminPerson }}">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-post="{{ url('client-comments/' . $rec->customer_id) }}"
                  data-hx-trigger="click"
                  data-hx-target="#account-notes"
                  data-hx-swap="outerHTML"
                   hx-on::after-request="(function(){document.getElementById('addClientNotes').value='';})()">Search</button>
                   
                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-get="{{ url('client-comments/' . $rec->customer_id) }}?comment_type=Account"
                  data-hx-trigger="click"
                  data-hx-target="#account-notes"
                  data-hx-swap="outerHTML"
                  hx-on::after-request="(function(){document.getElementById('comment_query').value='';document.getElementById('tag_id').value='';})()">Reset</button>
            </form>
            <div data-hx-get="{{ url('client-comments/' . $rec->customer_id) }}?comment_type=Account"
               data-hx-trigger="load delay:1s"
               data-hx-swap="outerHTML">Loading Comments...
            </div>
         </div>

         <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab" x-show="tab == 'tab2'">
            <form action="{{ url('client-comments/' . $rec->customer_id.'/create') }}" method="POST" autocomplete="false">
               @csrf()
               <input type="hidden" name="client_id" value="{{ $rec->customer_id }}">
               <input type="hidden" name="comment_type" value="Billing">
               <input type="hidden" name="admin_person" value="{{ $adminPerson }}">
               <div class="form-group">
                  <label for="addBillingNotes" style="font-size:14px;font-weight:bold">Add Billing Note</label>
                  <textarea name="comment" class="form-control form-control-sm block w-full rounded-md my-2 py-1.5 text-gray-900" id="addBillingNotes" rows="3"></textarea>               
               </div>
               <div class="form-group">
                   <label for="addClientNotes" style="font-size:14px;font-weight:bold">Note Tag</label>
       <select name="tag_id">
        <option value="">Select a Tag</option>
        @foreach($tags as $tag)
        @if($tag->type=="Billing")
        <option value="{{$tag->id}}">{{$tag->tag}}</option>
        @endif
        @endforeach
    </select> Sticky <input type="checkbox" value="1" name="sticky" id="sticky-billing"/>
    </div>
               <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-post="{{ url('client-comments/' . $rec->customer_id.'/create') }}"
                  data-hx-trigger="click"
                  data-hx-target="#billing-notes"
                   hx-on::after-request="(function(){document.getElementById('addBillingNotes').value='';document.getElementById('sticky-billing').value='';})()"
                  data-hx-swap="afterbegin" hx-on::before-request="checkSession(event)">Add Note</button>
            </form>
            <br>     
            <!--search notes-->
            <label style="font-size:14px;font-weight:bold">Search Client Notes</label>
            <form action="{{ url('client-comments/' . $rec->customer_id) }}" method="POST" autocomplete="false">
            @csrf()
            <input type="text" name="comment_query" id="billing_comment_query" class="block w-full rounded-md py-1.5 text-gray-900"/> <br/>Search Note Content: <input type="radio" name="query_type" value="comment" checked="checked"/> Search By Name: <input type="radio" name="query_type" value="admin_person"/><br/>

            <input type="hidden" name="client_id" value="{{ $rec->customer_id }}">
               <input type="hidden" name="comment_type" value="Billing">
               <input type="hidden" name="admin_person" value="{{ $adminPerson }}">
                              <div class="grid grid-cols-2 gap-6 py-4">
   <div class="form-group">
      <label for="start_date">Start Date </label>
       <div x-data x-init="flatpickr($refs.dateInput,{altInput: true,altFormat: 'Y-m-d', dateFormat: 'Y-m-d'})">
      <input type="text" x-ref="dateInput" placeholder="YYYY-MM-DD"  name="start_date" value="" class="block w-full rounded-md py-1.5 text-gray-900" />

   </div>
   </div>
 <div class="form-group">
 <label for="end_date">End Date </label>
       <div x-data x-init="flatpickr($refs.dateInput,{altInput: true,altFormat: 'Y-m-d', dateFormat: 'Y-m-d'})">
      <input type="text" x-ref="dateInput" placeholder="YYYY-MM-DD"  name="end_date" value="" class="block w-full rounded-md py-1.5 text-gray-900" />
     
 </div>
</div>
</div>
            <select name="tag_id">
        <option value="">Select a Tag</option>
        @foreach($tags as $tag)
        @if($tag->type=="Billing")
        <option value="{{$tag->id}}">{{$tag->tag}}</option>
        @endif
        @endforeach
    </select><button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-post="{{ url('client-comments/' . $rec->customer_id) }}"
                  data-hx-trigger="click"
                  data-hx-target="#billing-notes"
                  data-hx-swap="outerHTML"
                   hx-on::after-request="(function(){document.getElementById('billing_comment_query').value='';})()">Search</button>
                   
                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-get="{{ url('client-comments/' . $rec->customer_id) }}?comment_type=Billing"
                  data-hx-trigger="click"
                  data-hx-target="#billing-notes"
                  data-hx-swap="outerHTML"
                  hx-on::after-request="(function(){document.getElementById('billing_comment_query').value='';})()">Reset</button>
            </form>       
            <div data-hx-get="{{ url('client-comments/' . $rec->customer_id) }}?comment_type=Billing"
               data-hx-trigger="load delay:1s"
               data-hx-swap="outerHTML">Loading Comments...
            </div>
         </div>

         <div class="tab-pane fade" id="cancellation" role="tabpanel" aria-labelledby="cancellation-tab" x-show="tab == 'tab3'">
            <form action="{{ url('client-comments/' . $rec->customer_id) }}" method="POST" autocomplete="false">
               @csrf()
               <input type="hidden" name="client_id" value="{{ $rec->customer_id }}">
               <input type="hidden" name="comment_type" value="Cancellation">
               <input type="hidden" name="admin_person" value="{{ $adminPerson }}">
               <div class="form-group">
                  <label for="addCancellationNotes" style="font-size:14px;font-weight:bold">Add Cancellation Note</label>
                  <textarea name="comment" class="form-control form-control-sm block w-full rounded-md my-2 py-1.5 text-gray-900" id="addCancellationNotes" rows="3"></textarea>       

               </div>
             <div class="form-group"> Sticky <input type="checkbox" value="1" name="sticky" id="sticky-cancel"/></div> <br/>
               <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-post="{{ url('client-comments/' . $rec->customer_id.'/create') }}"
                  data-hx-trigger="click"
                  data-hx-target="#cancellation-notes"
                  hx-on::after-request="(function(){document.getElementById('addCancellationNotes').value='';document.getElementById('sticky-cancel').value='';})()" 
                  data-hx-swap="afterbegin" hx-on::before-request="checkSession(event)">Add Note</button>
            </form>
           @if(check_perm('customers_delete'))
            <form method="POST" action="{{ route( 'cancel_customer', $rec->id) }}" onsubmit="return confirm('Do you really want to cancel this customer?');">
              @csrf()
               @method('patch')
               <label style="font-size:14px;font-weight:bold">Cancel Client</label><br />
               <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="canceled" id="canceled-yes" value="1" <?= $rec->canceled==1 ? 'checked':'';?>>
          <label class="form-check-label" for="canceled-yes">Yes</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="canceled" id="canceled-no" value="0" <?= $rec->canceled==0 ? 'checked':'';?>>
          <label class="form-check-label" for="canceled-no">No</label>
        </div>
         <div class="form-group">
                  <label for="canceldate">Cancellation Date <em>(i.e: mm/dd/yyyy)</em></label><br/>
                  <input type="date" name="cancel_date" class="form-control" id="cancellationDate" placeholder="12/23/2021" value="{{ isset($rec->cancel_date) ? $rec->cancel_date:'' }}">

               </div> 
               <div class="form-group">
                <label>Cancellation Reason</label><br/>
                  <textarea name="cancel_reason" style="width:100%">{{ isset($rec->cancel_reason) ? $rec->cancel_reason:'' }}</textarea>
               </div>

                <input type="submit" name="submit" value="Cancel Customer" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
            </form>
            @if($rec->canceled==1)
            <form method="POST" action="{{ route( 'reinstate_customer', $rec->id) }}" onsubmit="return confirm('Do you really want to reinstate this customer?');">
              @csrf()
              
                <input type="hidden" name="customer_id" value="{{$rec->customer_id}}">
                <input type="hidden" name="cancel_date" value="{{$rec->cancel_date}}">
                 <textarea name="cancel_reason" hidden="hidden">{{$rec->cancel_reason}}</textarea>
              <input type="submit" name="submit" value="Reinstate Customer" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
            </form>
            @endif
            @endif
            <br>      
               <!--search notes-->
            <label style="font-size:14px;font-weight:bold">Search Client Notes</label>
            <form action="{{ url('client-comments/' . $rec->customer_id) }}" method="POST" autocomplete="false">
            @csrf()
            <input type="text" name="comment_query" id="cancel_comment_query" class="block w-full rounded-md py-1.5 text-gray-900"/> <br/>Search Note Content: <input type="radio" name="query_type" value="comment" checked="checked"/> Search By Name: <input type="radio" name="query_type" value="admin_person"/><br/>
            <input type="hidden" name="client_id" value="{{ $rec->customer_id }}">
               <input type="hidden" name="comment_type" value="Cancellation">
               <input type="hidden" name="admin_person" value="{{ $adminPerson }}">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-post="{{ url('client-comments/' . $rec->customer_id) }}"
                  data-hx-trigger="click"
                  data-hx-target="#cancellation-notes"
                  data-hx-swap="outerHTML"
                   hx-on::after-request="(function(){document.getElementById('cancel_comment_query').value='';})()">Search</button>
                   
                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-get="{{ url('client-comments/' . $rec->customer_id) }}?comment_type=Cancellation"
                  data-hx-trigger="click"
                  data-hx-target="#cancellation-notes"
                  data-hx-swap="outerHTML"
                  hx-on::after-request="(function(){document.getElementById('cancel_comment_query').value='';})()">Reset</button>
            </form>   
            <div data-hx-get="{{ url('client-comments/' . $rec->customer_id) }}?comment_type=Cancellation"
               data-hx-trigger="load delay:1s"
               data-hx-swap="outerHTML">
            </div>
         </div>
         <div class="tab-pane fade px-5 py-5" id="cancellation" role="tabpanel" aria-labelledby="cancellation-tab" x-show="tab == 'tab4'">
          @if($rec->payment_type==2)
          <label>Add a failed RBC payment record</label>
          <form action="{{route('outstanding_pbc')}}" method="POST">
            @csrf()
              <input type="hidden" name="customer_id" value="{{$rec->customer_id}}"/>
               <div class="grid grid-cols-3 gap-6 py-4">
         <div class="form-group col-md-4">
                  <label for="customer_id">Month</label>
                          <select name="month" id="month" class="block w-full rounded-md py-1.5 text-gray-900" >
                                      <option value="01">Jan</option>
                                            <option value="02">Feb</option>
                                            <option value="03">Mar</option>
                                            <option value="04">Apr</option>
                                            <option value="05">May</option>
                                            <option value="06">Jun</option>
                                            <option value="07">Jul</option>
                                            <option value="08">Aug</option>
                                            <option value="09">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                            </select>

                                            </div>
                                         <div class="form-group col-md-4">
                  <label for="customer_id">Date</label>
                          <select name="day" id="day" class="block w-full rounded-md py-1.5 text-gray-900" >
                                            <option value="01">1st</option>
                                            <option value="15">15th</option>
                                            </select>

                                            </div></div>
              @if(check_perm('payments_edit')) <input type="submit" value="submit" class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none"/> @endif
          </form>
          @endif
           @if(count($cleanup)>0)
         <form action="{{route('updateOutstandingCleanup')}}" method="POST">
          {{ csrf_field()  }}
         <?php $ccount=0;?>
         <table>

  @foreach($cleanup as $crec)
  <tr><td><?php echo date("F", strtotime($crec->billing_date)); $ccount++; ?><td/><td> 
    <input type="hidden" name="customer_id_121[]" value="{{$rec->customer_id}}"/>
    <input type="hidden" value="{{$crec->id}}" name="payid_121[]" />
    <td/>
    <td><select name="clean_up_121[]" <?php if(!check_perm('payments_edit')) echo "disabled='disabled'"; ?> <?php if($crec->status==2 || $crec->status==3 || $crec->status==4) echo "disabled='disabled'";?>>
   <option value="">Select Option</option>
            <option value="1" <?php if($crec->status=="1") echo "selected='selected'";?> >Outstanding</option>
            <option value="2" <?php if($crec->status=="2") echo "selected='selected'";?>>Paid</option>
            <option value="3" <?php if($crec->status=="3") echo "selected='selected'";?>>Retry Ok</option>
            <option value="4" <?php if($crec->status=="4") echo "selected='selected'";?>>Called Retry Ok</option>
            <option value="5" <?php if($crec->status=="5") echo "selected='selected'";?>>Skipped-Free Month</option>
            <option value="6" <?php if($crec->status=="6") echo "selected='selected'";?>>Collections</option>
        </select><td/><td> <input type="hidden" name="billing_date_121[]" value="{{$crec->billing_date}}"/> {{$crec->billing_date}}</td></tr>
  @endforeach
</table>
  @if(check_perm('payments_edit')) <input type="submit" value="submit" class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none"/> @endif
  </form>
  @endif
<div style="clear:both;display: block;width: 100%"></div>
          @if(count($monthlyinvoices)>0)
         <form action="{{route('updateOutstanding')}}" method="POST">
          {{ csrf_field()  }}
         <?php $count=0;?>
         <table>

	@foreach($monthlyinvoices as $invoice)
	<tr><td><?php echo date("F", strtotime($invoice->billing_date)); $count++; ?><td/><td> <input type="hidden" name="customer_id[]" value="{{$rec->customer_id}}"/><input type="hidden" value="{{$invoice->id}}" name="payid[]" /><td/><td><select name="clean_up[]" <?php if(!check_perm('payments_edit')) echo "style='pointer-events: none;'"; ?> <?php if($invoice->updated_status=="Paid" || $invoice->updated_status=="Retry Ok" || $invoice->updated_status=="Called Retry Ok") echo "style='pointer-events: none;'";?>>
	 <option value="">Select Option</option>
				    <option value="Outstanding" <?php if($invoice->updated_status=="Outstanding" || $invoice->status=="Declined") echo "selected='selected'";?> >Outstanding</option>
				    <option value="Paid" <?php if($invoice->updated_status=="Paid") echo "selected='selected'";?>>Paid</option>
				    <option value="Retry Ok" <?php if($invoice->updated_status=="Retry Ok") echo "selected='selected'";?>>Retry Ok</option>
				    <option value="Called Retry Ok" <?php if($invoice->updated_status=="Called Retry Ok") echo "selected='selected'";?>>Called Retry Ok</option>
				    <option value="Skipped-Free Month" <?php if($invoice->updated_status=="Skipped-Free Month") echo "selected='selected'";?>>Skipped-Free Month</option>
				    <option value="Collections" <?php if($invoice->updated_status=="Collections") echo "selected='selected'";?>>Collections</option>
				</select><td/><td> <input type="hidden" name="billing_date[]" value="{{$invoice->billing_date}}"/> {{$invoice->billing_date}}</td></tr>
				
	@endforeach
	</table>
	@if(check_perm('payments_edit')) <input type="submit" value="submit" class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none"/> @endif
	</form>
  @endif
	</div>
<div class="tab-pane fade" id="sentInvoices" role="tabpanel" aria-labelledby="sentInvoices-tab" x-show="tab == 'tab5'">
@if(isset($customer_invoices))
<div class="py-4">
 <label style="font-size:14px;font-weight:bold">Search Sent Invoices</label>
            <form action="{{ url('customers/search-invoices/' . $rec->customer_id) }}" method="POST" autocomplete="false">
            @csrf()
            <div class="grid grid-cols-2 gap-6 py-4">
   <div class="form-group">
      <label for="start_date">Start Date </label>
       <div x-data x-init="flatpickr($refs.dateInput,{altInput: true,altFormat: 'Y-m-d', dateFormat: 'Y-m-d'})">
      <input type="text" x-ref="dateInput" placeholder="YYYY-MM-DD"  name="start_date" value="" class="block w-full rounded-md py-1.5 text-gray-900" />

   </div>
   </div>
 <div class="form-group">
 <label for="end_date">End Date </label>
       <div x-data x-init="flatpickr($refs.dateInput,{altInput: true,altFormat: 'Y-m-d', dateFormat: 'Y-m-d'})">
      <input type="text" x-ref="dateInput" placeholder="YYYY-MM-DD"  name="end_date" value="" class="block w-full rounded-md py-1.5 text-gray-900" />
     
 </div>
</div>
</div>

            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-post="{{ url('customers/search-invoices/' . $rec->customer_id) }}"
                  data-hx-trigger="click"
                  data-hx-target="#customer_invoices"
                  data-hx-swap="outerHTML"
                   hx-on::after-request="(function(){})()">Search</button>
                   
                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-get="{{ url('customers/search-invoices/' . $rec->customer_id) }}"
                  data-hx-trigger="click"
                  data-hx-target="#customer_invoices"
                  data-hx-swap="outerHTML"
                  hx-on::after-request="(function(){})()">Reset</button>
            </form>   
</div>
            <div id="customer_invoices">
<table id="customer_invoices_table"><tr id="head"><td>Billing Date</td><td>Total</td><td>Internal Notes</td><td>Rep</td><td>Timestamp</td><td>Action</td></tr>
@foreach($customer_invoices as $cinvoice)
<tr><td>{{$cinvoice->date}}</td><td>$ {{number_format($cinvoice->total,2)}}</td><td>{{$cinvoice->internal_notes}}</td><td>{{$cinvoice->rep}}</td><td>{{$cinvoice->timestamp}}</td><td><a href="{{ route('resend-invoice', $cinvoice->id) }}">View/Resend Invoice</a></td></tr>
@endforeach
</table>
</div>
@endif
</div>
<div class="tab-pane fade" id="monthlyFeeUpdates" role="tabpanel" aria-labelledby="monthlyFeeUpdates-tab" x-show="tab == 'tab6'">
@if(isset($monthly_fee_updates))
<table id="monthly_fee_updates"><tr id="head"><td>Old Monthly Fee</td><td>New Monthly Fee</td><td>Rep</td><td>Updated At</td></tr>
@foreach($monthly_fee_updates as $fee)
<tr><td>$ {{number_format($fee->old_monthly_fee,2)}}</td><td>$ {{number_format($fee->new_monthly_fee,2)}}</td><td>{{$fee->rep}}</td><td>{{$fee->updated_at}}</td></tr>
@endforeach
</table>
@endif
</div>
      </div>
  </div>
</div>   <!-- End of card -->
<div id="endofnotes" style="    position: fixed;
    right: 0%;
    bottom: 0;
  
    padding: 10px;"><div>
      <div style="margin-bottom:9px;text-align: right;"><a style="background:#1F2937; padding:5px; color:#ffffff; border-radius: 5px; " href="#top">Jump to top</a></div>
<div style="margin-bottom:7px;text-align: right;"><a style="background:#1F2937; padding:5px; color:#ffffff; border-radius: 5px; text-align: right;" href="#topofnotes">Jump to first note</a></div>
<div style="margin-bottom:5px;text-align: right;"><button style="background:#1F2937; padding:5px; color:#ffffff; border-radius: 5px; text-align: right;" onclick="backLocation()">Back to Search</button></div>
</div>
</div>
</div>
</div>
</div>
</x-app-layout>