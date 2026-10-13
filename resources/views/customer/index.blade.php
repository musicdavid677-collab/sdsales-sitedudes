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

   <div class="row">
      <div class="col-md-6">
      </div>
      <div class="col-md-6">
         <div class="float-md-right">
        @if(check_perm('customers_create') || check_perm('customers_edit'))
          <a class="orangebtn" href="{{ route('add_lead_page') }}">@lang('form.new_customer')</a> <a class="orangebtn" href="{{ route('monthly-invoice') }}">Send Monthly Invoices</a> <a class="orangebtn" href="{{ route('monthly-invoice-chq') }}">Send Monthly Chequing Invoices</a> <a class="orangebtn" href="{{ route('tracker') }}">Tracker</a> @if(auth()->user()->is_administrator || Auth::user()->role_id==1)<a href="{{route('get_taxes')}}" class="orangebtn">Taxes</a>@endif
	@endif

         </div>
      </div>
   </div>
    <hr>
    <style>
 fieldset{border:1px solid #9e9e9e;padding:0.75rem;}
 legend{width:auto;font-size:1.2rem;}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
    margin: 0;
    }
    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
      }
         h4{ font-size: 1.5rem;
    color: #262b43;
    font-weight: 500;}
    input[type=text],input[type=email],input[type=number],select{ 
      background: #efefef;
    border: none;
    padding: 10px;
    margin: 5px 0;
}
</style>
<h4>Customer Search</h4>
<form action="{{route('customers')}}" method="post" id="customerSearch">
{{csrf_field()}}
<div class="row">
   <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
<div class="grid grid-cols-2 gap-6 py-1">
   <div class="">
         <label for="customer_id" class="block font-medium text-gray-700">Customer ID  </label>
         <input type="text" 
            name="customer_id" 
            class="block w-full rounded-md py-1.5 text-gray-900" 
            id="customer_id" value="{{ (isset($rec)) ? $rec['customer_id'] : '' }}">
         
      </div>
    <div class="">
         <label for="company" class="block font-medium text-gray-700">Company</label>
         <input type="text" class="block w-full rounded-md py-1.5 text-gray-900" name="company" value="{{ (isset($rec)) ? $rec['company'] : '' }}">
         
      </div>
    </div>
<div class="grid grid-cols-2 gap-6 py-1">
      <div class="">
         <label for="first_name" class="block font-medium text-gray-700">First Name</label>
         <input type="text" class="block w-full rounded-md py-1.5 text-gray-900" name="first_name" value="{{ (isset($rec)) ? $rec['first_name'] : '' }}">
         
      </div>
      <div class="">
         <label for="last_name" class="block font-medium text-gray-700">Last Name </label>
         <input type="text" class="block w-full rounded-md py-1.5 text-gray-900" name="last_name" value="{{ (isset($rec)) ? $rec['last_name'] : '' }}">
         </div>
       </div>
      
      
   
    <div class="grid grid-cols-2 gap-6 py-1">
      <div class="">
            <label for="email_address" class="block font-medium text-gray-700">Email  </label>
            <input type="text" class="block w-full rounded-md py-1.5 text-gray-900" id="email_address" name="email_address" value="{{ (isset($rec)) ? $rec['email_address'] : '' }}">
           
         </div>
         <div class="">
            <label for="url" class="block font-medium text-gray-700">@lang('form.website') </label>
            <input type="text" class="block w-full rounded-md py-1.5 text-gray-900"  id="url" name="url" value="{{ (isset($rec)) ? $rec['url'] : '' }}">
            
         </div>
       </div>
      <div class="grid grid-cols-3 gap-4 py-1" style="grid-template-columns: repeat(3,minmax(0,1fr));">
         <div class="">
            <label for="area" class="block font-medium text-gray-700">@lang('form.phone')  </label>
            <input type="number"  pattern="[0-9]{3}" maxlength="3" class="block w-full rounded-md py-1.5 text-gray-900" id="area" name="area" value="{{ (isset($rec)) ? $rec['area'] : '' }}">
            
         </div>
         <div class="">
            <label for="phone" class="block font-medium text-gray-700">&nbsp;</label>
            <input type="number" pattern="[0-9]{3}" class="block w-full rounded-md py-1.5 text-gray-900" id="phone" name="phone" value="{{ (isset($rec)) ? $rec['phone'] : '' }}">
            
         </div>
         <div class="">
            <label for="phone_2" class="block font-medium text-gray-700">&nbsp;</label>
            <input type="number" pattern="[0-9]{4}" class="block w-full rounded-md py-1.5 text-gray-900" id="phone_2" name="phone_2" value="{{ (isset($rec)) ? $rec['phone_2'] : '' }}">
            <div class="invalid-feedback">@php if($errors->has('phone_2')) { echo $errors->first('phone_2') ; } @endphp</div>
         </div>
      </div>
      <div>
      <div class="grid grid-cols-3 gap-4 py-1" style="grid-template-columns: repeat(3,minmax(0,1fr));">
      <div class="">
      <label for="cancelled" class="block font-medium text-gray-700">Cancelled</label>
      <select name="canceled" id="canceled" class="block w-full rounded-md py-1.5 text-gray-900" >
      <option>-</option>
      <option value="0" selected='selected'>No</option>
      <option value="1" <?php
      if(isset($rec))
      if($rec['canceled']==1)
      echo "selected";
      ?>>Yes</option>
      </select> 
      </div>
      <div class="">
      <label for="orderby" class="block font-medium text-gray-700">Order By</label>
      <select name="orderby" id="orderby" class="block w-full rounded-md py-1.5 text-gray-900">
      <option value="last_name">Last Name</option>
      <option value="first_name">First Name</option>
      <option value="company">Company</option>
      <option value="customer_id">ID</option>
      <option value="signup_date">Signup Date</option>
      </select> 
      </div> 
      <div class="">
      <label for="direction" class="block font-medium text-gray-700">Direction</label>
      <select name="direction" id="direction" class="block w-full rounded-md py-1.5 text-gray-900">
      <option value="desc">Desc</option>
      <option value="asc">Asc</option>
     
      </select> 
      </div>
      </div>
      </div>
       <div x-data="{ expanded: false }">
        <button type="button" x-on:click="expanded = ! expanded" style="color:orange!important; font-weight:600">
            <span x-show="! expanded">Show Product List</span>
            <span x-show="expanded">Hide Product List</span>
        </button>
 
        <div x-show="expanded">
            
    
      <h6>Search By Products</h6>
      <div class="grid grid-cols-3 gap-4 py-1 row products">
      @foreach ($products as $product)
      <div class="col-md-4">
      <div class="form-group form-check">
          <input type="checkbox" name="product[]" class="form-check-input" id="" value="{{ $product->product_id }}"

           {{ (isset($rec['product'])) ? (in_array($product->product_id, $rec['product'])) ? 'checked' : '' : '' }}>
                      <label class="form-check-label" for="">{{ $product->product }}</label>
                      </div>
                      </div>
                      @endforeach
                      </div>
                         </div>
    </div>
      <div class="form-group">
           
            <input type="submit" class="orangebtn" value="Search" id="search" name="Search">
         
         <button  class="orangebtn" type="button" onclick="resetForm()">Reset</button>
         </div>
     
   

   </div>
</div>
</form>  

   <hr>
@if(isset($result))
<div class="">
<div class="">
<div class="">
<h3 style="font-size:16px; font-weight:bold">Results</h3>
<div x-data="dataTable()"
x-init="
initData()
$watch('searchInput', value => {
search(value)
})" class="">
<div class="flex justify-between items-center">
<div class="flex space-x-2 items-center">
<p>Show</p>
<select x-model="view" @change="changeView()">
<option value="5">5</option>
<option value="10">10</option>
<option value="25">25</option>
<option value="50">50</option>
<option value="100">100</option>
</select>
</div>
<div>
<input x-model="searchInput" type="text" class="px-2 py-1 border rounded focus:outline-none" placeholder="Search...">
</div>
</div>
<table class="mt-5" style="width:100%">
<thead class="border-b-2">
  <th width="5%">
<div class="flex space-x-2">
<span>
ID
</span>
</span>
</div>
</th>
<th width="15%">
<div class="flex space-x-2">
<span>
First Name
</span>
</span>
<div class="flex flex-col">
<svg @click="sort('first_name', 'asc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="h-3 w-3 cursor-pointer text-gray-500 fill-current" x-bind:class="{'text-blue-500': sorted.field === 'first_name' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
<svg @click="sort('first_name', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="h-3 w-3 cursor-pointer text-gray-500 fill-current" x-bind:class="{'text-blue-500': sorted.field === 'first_name' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
</div>
</div>
</th>
<th width="15%">
<div class="flex items-center space-x-2">
<span class="">
Last Name
</span>
<div class="flex flex-col">
<svg @click="sort('last_name', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'last_name' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
<svg @click="sort('last_name', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'last_name' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
</div>
</div>
</th>
<th width="20%">
<div class="flex items-center space-x-2">
<span class="">
Company
</span>
<div class="flex flex-col">
<svg @click="sort('company', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'company' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
<svg @click="sort('company', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'conpany' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
</div>
</div>
</th>
<th width="20%">
<div class="flex items-center space-x-2">
<span>
Email
</span>
<div class="flex flex-col">
<svg @click="sort('email_address', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'email_address' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
<svg @click="sort('email_address', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'email_address' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
</div>
</div>
</th>
<th width="20%">
<div class="flex items-center space-x-2">
<span class="">
URL
</span>
<div class="flex flex-col">
<svg @click="sort('url', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'url' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
<svg @click="sort('url', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'url' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
</div>
</div>
</th>
<th width="5%">
<div class="flex items-center space-x-2">
<span class="">
Action
</span>
</div>
</th>
</thead>
<tbody>
<template x-for="(item, index) in items" :key="index">
<tr x-show="checkView(index + 1)" class="hover:bg-gray-200 text-gray-900 text-xs">
  <td class="py-3">
<a :href="'/customers/profile/'+item.id+'?customer_id='+item.customer_id" x-text="item.customer_id"></a>
</td>
<td class="py-3">
<a :href="'/customers/profile/'+item.id+'?customer_id='+item.customer_id" x-text="item.first_name"></a>
</td>
<td class="py-3">
<a :href="'/customers/profile/'+item.id+'?customer_id='+item.customer_id" x-text="item.last_name"></a>
</td>
<td class="py-3">
<span x-text="item.company"></span>
</td>
<td class="py-3">
<span x-text="item.email_address"></span>
</td>
<td class="py-3">
<span x-text="item.url"></span>
</td>
<td class="py-3">
<a :href="'/customers/profile/'+item.id+'?customer_id='+item.customer_id">view/edit</a>
</td>
</tr>
</template>
<tr x-show="isEmpty()">
<td colspan="5" class="text-center py-3 text-gray-900">No matching records found.</td>
</tr>
</tbody>
</table>
<div class="flex mt-5">
<div class="border px-2 cursor-pointer" @click.prevent="changePage(1)">
<span class="text-gray-700">First</span>
</div>
<div class="border px-2 cursor-pointer" @click="changePage(currentPage - 1)">
<span class="text-gray-700"><</span>
</div>
<template x-for="item in pages">
<div @click="changePage(item)" class="border px-2 cursor-pointer" x-bind:class="{ 'bg-gray-300': currentPage === item }">
<span class="text-gray-700" x-text="item"></span>
</div>
</template>
<div class="border px-2 cursor-pointer" @click="changePage(currentPage + 1)">
<span class="text-gray-700">></span>
</div>
<div class="border px-2 cursor-pointer" @click.prevent="changePage(pagination.lastPage)">
<span class="text-gray-700">Last</span>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
let data=<?php echo $result; ?>
//console.log(data)
window.dataTable = function () {
return {
items: [],
view: 10,
searchInput: '',
pages: [],
offset: 10,
pagination: {
total: data.length,
lastPage: Math.ceil(data.length / 10),
perPage: 10,
currentPage: 1,
from: 1,
to: 1 * 10
},
currentPage: 1,
sorted: {
field: 'first_name',
rule: 'asc'
},
initData() {
this.items = data.sort(this.compareOnKey('first_name', 'asc'))
this.showPages()
},
compareOnKey(key, rule) {
return function(a, b) { 
if (key === 'first_name' || key === 'company' || key === 'email_address' || key === 'url') {
let comparison = 0
const fieldA = a[key].toUpperCase()
const fieldB = b[key].toUpperCase()
if (rule === 'asc') {
if (fieldA > fieldB) {
comparison = 1;
} else if (fieldA < fieldB) {
comparison = -1;
}
} else {
if (fieldA < fieldB) {
comparison = 1;
} else if (fieldA > fieldB) {
comparison = -1;
}
}
return comparison
}/* else {
if (rule === 'asc') {
return a.year - b.year
} else {
return b.year - a.year
}
}*/
}
},
checkView(index) {
return index > this.pagination.to || index < this.pagination.from ? false : true
},
checkPage(item) {
if (item <= this.currentPage + 10) {
return true
}
return false
},
search(value) {
if (value.length > 1) {
const options = {
shouldSort: true,
keys: ['first_name', 'company'],
threshold: 0
}                
//    console.log(options);
const fuse = new Fuse(data, options)
this.items = fuse.search(value).map(elem => elem.item)
} else {
this.items = data
}
// console.log(this.items.length)
this.changePage(1)
this.showPages()
},
sort(field, rule) {
this.items = this.items.sort(this.compareOnKey(field, rule))
this.sorted.field = field
this.sorted.rule = rule
},
changePage(page) {
if (page >= 1 && page <= this.pagination.lastPage) {
this.currentPage = page
const total = this.items.length
const lastPage = Math.ceil(total / this.view) || 1
const from = (page - 1) * this.view + 1
let to = page * this.view
if (page === lastPage) {
to = total
}
this.pagination.total = total
this.pagination.lastPage = lastPage
this.pagination.perPage = this.view
this.pagination.currentPage = page
this.pagination.from = from
this.pagination.to = to
this.showPages()
}
},
showPages() {
const pages = []
let from = this.pagination.currentPage - Math.ceil(this.offset / 2)
if (from < 1) {
from = 1
}
let to = from + this.offset - 1
if (to > this.pagination.lastPage) {
to = this.pagination.lastPage
}
while (from <= to) {
pages.push(from)
from++
}
this.pages = pages
},
changeView() {
this.changePage(1)
this.showPages()
},
isEmpty() {
return this.pagination.total ? false : true
}
}
}

</script>
@endif
</div>
</div>
</div>
<script>
  function resetForm(){

/*
 let inputs=document.querySelectorAll('#customerSearch input[type="text"]');
 inputs.forEach(input => {
  input.value="";
});
 document.getElementById('orderby').value='last_name';
  document.getElementById('email_address').value='';
 document.getElementById('direction').value='desc';
*/
window.location.href="/customers";
}</script>
</x-app-layout>
