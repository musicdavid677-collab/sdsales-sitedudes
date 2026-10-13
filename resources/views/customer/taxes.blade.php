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
   <h5>Site Dudes HST/GST Billing App</h5>
   <hr>
   <form action="{{route('get_taxes')}}" method="post" target="_blank">
   {{csrf_field()}}
   <div class="row">
      <div class="col-md-12">
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
                                            <label for="year">Year</label>
                                            
                                            <select name="year" id="year" class="block w-full rounded-md py-1.5 text-gray-900" >
                                     @foreach($years as $year)
                                      <option value="{{$year}}" <?php if($year==date('Y')) echo "selected='selected'";?>>{{$year}}</option>
                                      @endforeach
                                            </select>
                                         </div>
                                         <div class="form-group col-md-4">
                  <label for="customer_id">Date</label>
                          <select name="day" id="day" class="block w-full rounded-md py-1.5 text-gray-900" >
                                            <option value="01">1st</option>
                                            <option value="15">15th</option>
                                            </select>

                                            </div></div>
<div class="grid grid-cols-2 gap-6 py-4">
                                         <div class="form-group col-md-4">
                                         <label for="paid">Province</label>
                                           <select name="ch_state" class="block w-full rounded-md py-1.5 text-gray-900" id="ordProvince" autocomplete="false"> 
               <option value="ALL">All</option> 
               <option value="AB">Alberta</option> 
               <option value="BC">British Columbia</option> 
               <option value="MB">Manitoba</option> 
               <option value="NB">New Brunswick</option> 
               <option value="NL">Newfoundland and Labrador</option> 
               <option value="NT">Northwest Territories</option> 
               <option value="NS">Nova Scotia</option> 
               <option value="NU">Nunavut</option> 
               <option value="ON">Ontario</option> 
               <option value="PE">Prince Edward Island</option> 
               <option value="QC">Quebec</option> 
               <option value="SK">Saskatchewan</option> 
               <option value="YT">Yukon</option> 
               </select>
               </div>
               </div>
                <div class="row">
                <div class="form-group">
					
                <input type="submit" class="mt-5 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none" value="Submit" id="search" name="submit">

                 </div></div>
                 </form>

   
</div>
</div></div></div></x-app-layout>

