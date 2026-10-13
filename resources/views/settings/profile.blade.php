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
#customer_invoices{width:100%; border-collapse: collapse;}
#customer_invoices #head, #customer_invoices #head td{background: #414141!important; color:#ffffff; padding:10px}
#customer_invoices tr:nth-child(odd) {
    background: #eeeeee;
}
</style>
<script>
function upAndRunning(id)
{
  if(confirm("Are you sure you want to send the Up and Running Email to this customer?"))
  {
  window.location.href="/customers/senduprunning/"+id;
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
</script>
<div class="main-content">
<div style="margin:15px 0px"><h5>Account Actions</h5>
<a href="/customers/invoice/{{$rec->id}}" class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none">Generate Invoice</a>
<a href="/customers/contract/{{$rec->id}}/view" class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none">Generate Contract</a>
<a href="#" class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none" onclick="return upAndRunning({{$rec->id}})">Send Up and Running Email</a>
<a href="#" class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none" onclick="return requestDomainCredentials({{$rec->id}})">Send Request Domain Credentials Email</a></div>
<a class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none" href="https://www.sitedudesstats.com/update.php?u={{$rec->email_address}}&amp;e={{$rec->email_address}}&amp;p={{$statspass}}&amp;sitename={{$rec->company}}&amp;siteurl={{$rec->url}}&amp;designer={{$designer}}" target="_blank">ADD CLIENT TO SITE DUDES STATS</a>
<a class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none" href="https://www.sitedudesstats.com/update.php?u={{$rec->email_address}}&amp;e={{$rec->email_address}}&amp;p={{$statspass}}&amp;sitename=SEO Client - {{$rec->company}}&amp;siteurl={{$rec->url}}&amp;designer={{$designer}}" target="_blank">ADD CLIENT TO SITE DUDES STATS ****SEO CLIENTS ONLY</a>
 <div class="px-2 py-2"></div>
 <div style="margin:15px 0px"><h5>Account Status</h5>
  <?= $rec->canceled==0 ? 'Active':'Cancelled';?>
   <div class="px-2 py-2"></div>
   <h5>@lang('form.profile') 

      <a style="font-size: 12px; vertical-align: top;" href="{{ route('edit_customer_page', $rec->id) }}?customer_id={{ $rec->customer_id }}"><i class="far fa-edit" aria-label="Edit">[EDIT]</i></a>

   </h5>

   <div class="table-responsive-sm">
   <table class="table table-sm">
      <tbody>
          <tr>
            <td>@lang('form.customer_number')</td>
            <td>{{ $rec->customer_id }}</td>
         </tr>
         <tr>
            <td>Sale Person/Sale Date</td>
            <td>{{$rec->rep_first_name.' '.$rec->rep_last_name}} / {{$rec->signup_date}}</td>
         </tr>
         <!--   
         <tr>
            <td>@lang('form.name')</td>
            <td>{{ $rec->name }}</td>
         </tr>-->
         <tr>
            <td>Customer Name</td>
            <td>{{$rec->salutation.' '. $rec->first_name . ' ' . $rec->last_name}}</td>
         </tr>         
         <tr>
            <td>Company Name</td>
            <td>{{$rec->company}} </td>
        </tr>
         <tr>
            <td>@lang('form.phone')</td>
            <td>{{$rec->area.' '.$rec->phone.' '.$rec->phone2}} ext: {{$rec->ext}}</td>
         </tr>
         <tr>
            <td>Fax</td>
            <td>{{$rec->fax_area.' '.$rec->fax_1.' '.$rec->fax_2}}</td>
        </tr>
         <tr>
            <td>@lang('form.email')</td>
            <td>{{$rec->email_address}}</td>
         </tr>
         <tr>
            <td>SMS/Text Now #</td>
            <td>@if($notes!==NULL){{$notes->sms_num_1.' '.$notes->sms_num_2.' '.$notes->sms_num_3}}@endif</td>
        </tr>
         <tr>
            <td>Get Me On The Phone #</td>
            <td>@if($notes!==NULL){{$notes->gtp_num1.' '.$notes->gtp_num2.' '.$notes->gtp_num3}}@endif</td>
        </tr>
        <tr>
            <td>Alt Phone #</td>
            <td>@if($notes!==NULL){{$notes->alt_num1.' '.$notes->alt_num2.' '.$notes->alt_num3}}@endif</td>
        </tr>
         <tr>
            <td>@lang('form.website')</td>
            <td><a target="_blank" href="{{ $rec->url }}">{{ $rec->url }}</a></td>
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
            <td>Address</td>
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
               <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-post="{{ url('client-comments/' . $rec->customer_id.'/create') }}"
                  data-hx-trigger="click"
                  data-hx-target="#account-notes"
                  data-hx-swap="afterbegin"
                   hx-on::after-request="(function(){document.getElementById('addClientNotes').value='';})()">Add Note</button>
            </form>
            <br>            
            
            <!--search notes-->
            <label style="font-size:14px;font-weight:bold">Search Client Notes</label>
            <form action="{{ url('client-comments/' . $rec->customer_id) }}" method="POST" autocomplete="false">
            @csrf()
            <input type="text" name="comment_query" id="comment_query"/> <br/>Search Note Content: <input type="radio" name="query_type" value="comment" checked="checked"/> Search By Name: <input type="radio" name="query_type" value="admin_person"/><br/>
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
                  hx-on::after-request="(function(){document.getElementById('comment_query').value='';})()">Reset</button>
            </form>
            <div data-hx-get="{{ url('client-comments/' . $rec->customer_id) }}?comment_type=Account"
               data-hx-trigger="load delay:1s"
               data-hx-swap="outerHTML">
            </div>
         </div>

         <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab" x-show="tab == 'tab2'">
            <form action="{{ url('client-comments/' . $rec->customer_id) }}" method="POST" autocomplete="false">
               @csrf()
               <input type="hidden" name="client_id" value="{{ $rec->customer_id }}">
               <input type="hidden" name="comment_type" value="Billing">
               <input type="hidden" name="admin_person" value="{{ $adminPerson }}">
               <div class="form-group">
                  <label for="addBillingNotes" style="font-size:14px;font-weight:bold">Add Billing Note</label>
                  <textarea name="comment" class="form-control form-control-sm block w-full rounded-md my-2 py-1.5 text-gray-900" id="addBillingNotes" rows="3"></textarea>               
               </div>
               <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-post="{{ url('client-comments/' . $rec->customer_id) }}"
                  data-hx-trigger="click"
                  data-hx-target="#billing-notes"
                  data-hx-swap="afterbegin">Add Note</button>
            </form>
            <br>     
            <!--search notes-->
            <label style="font-size:14px;font-weight:bold">Search Client Notes</label>
            <form action="{{ url('client-comments/' . $rec->customer_id) }}" method="POST" autocomplete="false">
            @csrf()
            <input type="text" name="comment_query" id="billing_comment_query"/> <br/>Search Note Content: <input type="radio" name="query_type" value="comment" checked="checked"/> Search By Name: <input type="radio" name="query_type" value="admin_person"/><br/>
            <input type="hidden" name="client_id" value="{{ $rec->customer_id }}">
               <input type="hidden" name="comment_type" value="Billing">
               <input type="hidden" name="admin_person" value="{{ $adminPerson }}">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
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
               data-hx-swap="outerHTML">
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
              
               <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-post="{{ url('client-comments/' . $rec->customer_id) }}"
                  data-hx-trigger="click"
                  data-hx-target="#cancellation-notes"
                  data-hx-swap="afterbegin">Add Note</button>
            </form>
           @if(auth()->user()->is_administrator)
            <form method="POST" action="{{ route( 'cancel_customer', $rec->id) }}" onsubmit="return confirm('Do you really want to cancel this customer?');">
              @csrf()
               @method('patch')
               <label>Cancelled</label><br />
               <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="canceled" id="canceled-yes" value="1" <?= $rec->canceled==1 ? 'checked':'';?>>
          <label class="form-check-label" for="canceled-yes">Yes</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="canceled" id="canceled-no" value="0" <?= $rec->canceled==0 ? 'checked':'';?>>
          <label class="form-check-label" for="canceled-no">No</label>
        </div>
         <div class="form-group">
                  <label for="canceldate">Cancellation Date <em>(i.e: mm/dd/yyyy)</em></label>
                  <input type="date" name="cancel_date" class="form-control" id="cancellationDate" placeholder="12/23/2021" value="{{ isset($rec->cancel_date) ? $rec->cancel_date:'' }}">

               </div> 
               <div class="form-group">
                <label>Cancellation Reason</label><br/>
                  <textarea name="cancel_reason">{{ isset($rec->cancel_reason) ? $rec->cancel_reason:'' }}</textarea>
               </div>

                <input type="submit" name="submit" value="Cancel Customer" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
            </form>
            @endif
            <br>      
               <!--search notes-->
            <label style="font-size:14px;font-weight:bold">Search Client Notes</label>
            <form action="{{ url('client-comments/' . $rec->customer_id) }}" method="POST" autocomplete="false">
            @csrf()
            <input type="text" name="comment_query" id="cancel_comment_query"/> <br/>Search Note Content: <input type="radio" name="query_type" value="comment" checked="checked"/> Search By Name: <input type="radio" name="query_type" value="admin_person"/><br/>
            <input type="hidden" name="client_id" value="{{ $rec->customer_id }}">
               <input type="hidden" name="comment_type" value="Cancellation">
               <input type="hidden" name="admin_person" value="{{ $adminPerson }}">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                  data-hx-post="{{ url('client-comments/' . $rec->customer_id) }}"
                  data-hx-trigger="click"
                  data-hx-target="#billing-notes"
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
         <form action="{{route('updateOutstanding')}}" method="POST">
          {{ csrf_field()  }}
         <?php $count=0;?>
         <table>
	@foreach($monthlyinvoices as $invoice)
	<tr><td><?php echo date("F", strtotime($invoice->billing_date)); $count++; ?><td/><td><input type="hidden" value="{{$invoice->id}}" name="payid[]" /><td/><td><select name="clean_up[]" <?php if(!check_perm('payments_edit')) echo "disabled='disabled'"; ?>>
	 <option value="">Select Option</option>
				    <option value="Outstanding" <?php if($invoice->updated_status=="Outstanding") echo "selected='selected'";?> >Outstanding</option>
				    <option value="Paid" <?php if($invoice->updated_status=="Paid") echo "selected='selected'";?>>Paid</option>
				    <option value="Retry Ok" <?php if($invoice->updated_status=="Retry Ok") echo "selected='selected'";?>>Retry Ok</option>
				    <option value="Called Retry Ok" <?php if($invoice->updated_status=="Called Retry Ok") echo "selected='selected'";?>>Called Retry Ok</option>
				    <option value="Skipped-Free Month" <?php if($invoice->updated_status=="Skipped-Free Month") echo "selected='selected'";?>>Skipped-Free Month</option>
				    <option value="Collections" <?php if($invoice->updated_status=="Collections") echo "selected='selected'";?>>Collections</option>
				</select><td/><td> {{$invoice->billing_date}}</td></tr>
				
	@endforeach
	</table>
	@if(check_perm('payments_edit'))<input type="submit" value="submit" class="px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none"/>@endif
	</form>
	</div>
<div class="tab-pane fade" id="sentInvoices" role="tabpanel" aria-labelledby="sentInvoices-tab" x-show="tab == 'tab5'">
@if(isset($customer_invoices))
<table id="customer_invoices"><tr id="head"><td>Billing Date</td><td>Total</td><td>Internal Notes</td><td>Rep</td><td>Timestamp</td><td>Action</td></tr>
@foreach($customer_invoices as $cinvoice)
<tr><td>{{$cinvoice->date}}</td><td>$ {{$cinvoice->total}}</td><td>{{$cinvoice->internal_notes}}</td><td>{{$cinvoice->rep}}</td><td>{{$cinvoice->timestamp}}</td><td><a href="{{ route('resend-invoice', $cinvoice->id) }}">Resend Invoice</a></td></tr>
@endforeach
</table>
@endif
</div>
      </div>
  </div>
</div>   <!-- End of card -->
<div id="endofnotes"><div>
<div><a href="#topofnotes">Jump to top</a></div>
</div>
</div>
</div>
</div>
</div>
</x-app-layout>