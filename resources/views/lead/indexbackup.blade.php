<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
@lang('form.leads')
</h2>
</x-slot>
<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="px-4 py-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
<div class="main-content">
   <div class="row">
      <div class="col-md-6">
        
      </div>
      <div class="col-md-6">
    
         <div class="float-md-right">
            <a class="btn btn-primary btn-sm" href="{{ route('add_lead_page') }}" role="button">@lang('form.new_lead')</a>
            <a class="btn btn-primary btn-sm" href="{{ route('import_lead_page') }}">@lang('form.import_leads')</a>
         </div>

      </div>
   </div>
   <hr>
   <div class="row">
      @if(count($data['stat']) > 0)   
      @foreach($data['stat'] as $stat)      
      <div class="col-md-2 bd-highlight">
         <h5>{{ $stat['total'] }}</h5>
         <div class="text-secondary">{{ $stat['name'] }}</div>
      </div>
      @endforeach
      @endif
      <div class="col-md-2 bd-highlight">
         <h5>{{ $data['stat_customer']['total'] }}</h5>
         <div class="text-success">{{ $data['stat_customer']['name'] }}</div>
      </div>
   </div>
   <hr>
   <div class="row">
      <div class="col-md-2 bd-highlight">
         <h5>{{ $data['lost_lead'] }}%</h5>
         <div class="text-danger">{{ __('form.lost_leads') }}</div>
      </div>
      <div class="col-md-2 bd-highlight">
         <h5>{{ $data['junk_lead'] }}%</h5>
         <div class="text-danger">{{ __('form.junk_leads') }}</div>
      </div>
   </div>
   <hr>
   <div class="form-row">
      <div class="form-group col-md-2">
         <label>@lang('form.status')</label>
         <select name="status_id" id="status_id">
         <?php
        //    echo form_dropdown('status_id', $data['lead_status_id_list'] , $data['default_lead_status_id_list']  , "class='form-control four-boot' multiple='multiple' ");
        foreach($data['lead_status_id_list'] as $lead_status_key =>$lead_status_value){
                  print '<option id="'.$lead_status_key.'" >'.$lead_status_value.' </option>';
                  }
                 

            ?>
            </select>
      </div>
      <div class="form-group col-md-2">
         <label>@lang('form.source')</label>
         <select name="source_id" id="source_id">
         <?php
        //    echo form_dropdown('source_id', $data['lead_source_id_list'] ,  [] , "class='form-control four-boot' multiple='multiple' ");
        foreach($data['lead_source_id_list'] as $lead_source_key =>$lead_source_value){
                  print '<option id="'.$lead_source_key.'" >'.$lead_source_value.' </option>';
                  }
            ?>
            </select>
      </div>
      

       <div class="form-group col-md-3">
         <label>@lang('form.assigned_to')</label>
         <select name="assigned_to" id="assigned_to">
         <?php
        //    echo form_dropdown('assigned_to', $data['assigned_to_list'] , [], "class='form-control four-boot'");
        foreach($data['assigned_to_list'] as $assigned_to_key =>$assigned_to_value){
                  print '<option id="'.$assigned_to_key.'" >'.$assigned_to_value.' </option>';
                  }
            ?>
            </select>
      </div>

      <div class="form-group col-md-2">
         <label>@lang('form.filter_by')</label>
         <?php
        //    echo form_dropdown('additional_filter', $data['additional_filter_list'] , [], "class='form-control four-boot' ");
            ?>
      </div>

     

   </div>
   <hr>

   <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="data">
      <thead>
         <tr>
            <th>@lang("form.name")</th>
            <th>@lang("form.company")</th>
            <th>@lang("form.email")</th>
            <th>@lang("form.phone")</th>
            <th>@lang("form.tags")</th>
            <th>@lang("form.status")</th>
            <th>@lang("form.source")</th>
            <th>@lang("form.last_contacted")</th>
         </tr>
      </thead>
      <tbody>
      
      
      </tbody>
   </table>

</div>
</div>
</div>
</div>
</x-app-layout>
