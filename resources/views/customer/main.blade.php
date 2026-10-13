<?php
$page_title = (isset($rec->id)) ? __('form.customer') . " : " .$rec->name : __('form.add_new_customer');
?>

<?php 
   $route_name = Route::currentRouteName();
   $group_name = app('request')->input('group');
   $sub_group_name = app('request')->input('subgroup');
   if(isset($rec->id))
   {
       $main_url   = route('view_customer_page', $rec->id);

   }
   ?>
<div class="main-content" style="margin-bottom: 20px;">
   <div class="row" style="margin-bottom: 10px;">
      <div class="col-md-12">
         <h5>@lang('form.customer'): {{ $rec->customer_id }}</h5>
      </div>     
   </div>
   <ul class="nav project-navigation">
      <li class="nav-item">
         <a class="nav-link" href="{{ $main_url }}?customer_id={{ $rec->customer_id }}"><i class="fas fa-user"></i> @lang('form.profile')</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="{{ $main_url }}?group=invoices&customer_id={{ $rec->customer_id }}"><i class="fas fa-file-alt"></i> @lang('form.invoices')</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="{{ $main_url }}?group=payments&customer_id={{ $rec->customer_id }}"><i class="fas fa-chart-line"></i> @lang('form.payments')</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="{{ $main_url }}?group=tasks&customer_id={{ $rec->customer_id }}"><i class="fas fa-tasks"></i> @lang('form.tasks')</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="{{ $main_url }}?group=extras&customer_id={{ $rec->customer_id }}"><i class="fas fa-toolbox" aria-hidden="true"></i> Extras</a>
      </li>
   </ul>
</div>
@if($group_name == '')
@include('customer.profile')
@elseif($group_name == 'show_form')
@include('customer.form')
@elseif($group_name == 'contacts')
@include('customer.contacts')
@elseif($group_name == 'invoices')
@include('customer.invoices')
@elseif($group_name == 'payments')
@include('customer.payments')
@elseif($group_name == 'proposals')
@include('customer.proposals')
@elseif($group_name == 'estimates')
@include('customer.estimates')
@elseif($group_name == 'expenses')
@include('customer.expenses')
@elseif($group_name == 'tasks')
@include('customer.tasks')
@elseif($group_name === 'extras')
@include('customer.extras')
@endif

