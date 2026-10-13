<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
	Tracker
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-4 py-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
<div class="main-content">


   <div class="row">
      <div class="col-md-6">
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
</style>
@if(isset($result))
<div class="">
<div class="">
<div class="" x-data="{sdnum:'' }">


<x-modal id="test" maxWidth="lg" x-data="{ show: false}" wire:model="comment">
<form method="POST" action="{{route('tracker_add_comment') }}" style="padding:20px">
{{ csrf_field()  }}
Add Billing comment for <span x-text="sdnum"></span><br/>
<textarea name="comment"></textarea>
<input type="hidden" x-model="sdnum" name="sdnum"><br/>
<input type="submit" value="submit"/>
</form>
</x-modal>
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
<option value="15">15</option>
<option value="25">25</option>
<option value="50">50</option>
<option value="100">100</option>
</select>
</div>
<div>
<input x-model="searchInput" type="text" class="px-2 py-1 border rounded focus:outline-none" placeholder="Search...">
</div>
</div>
<table class="mt-5">
<thead class="border-b-2">
  <th width="2%"></th>
<th width="10%">
<div class="flex space-x-2">
<span>
Customer ID
</span>
</span>
<div class="flex flex-col">
<svg @click="sort('customer_id', 'asc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="h-3 w-3 cursor-pointer text-gray-500 fill-current" x-bind:class="{'text-blue-500': sorted.field === 'customer_id' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
<svg @click="sort('customer_id', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="h-3 w-3 cursor-pointer text-gray-500 fill-current" x-bind:class="{'text-blue-500': sorted.field === 'customer_id' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
</div>
</div>
</th>
<th width="10%">
<div class="flex items-center space-x-2">
<span class="">
Billing Date
</span>
<div class="flex flex-col">
<svg @click="sort('billing_date', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'billing_date' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
<svg @click="sort('billing_date', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'billing_date' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
</div>
</div>
</th>
<th width="10%">
<div class="flex items-center space-x-2">
<span class="">
Montly Fee
</span>
<div class="flex flex-col">
<svg @click="sort('amount', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'amount' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
<svg @click="sort('amount', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'amount' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
</div>
</div>
</th>
<th width="10%">
<div class="flex items-center space-x-2">
<span>
First Name
</span>
<div class="flex flex-col">
<svg @click="sort('first_name', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'first_name' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
<svg @click="sort('first_name', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'first_name' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
</div>
</div>
</th>
<th width="12%">
<div class="flex items-center space-x-2">
<span class="">
Last Name
</span>
<div class="flex flex-col">
<svg @click="sort('last_name', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" 
x-bind:class="{'text-blue-500': sorted.field === 'last_name' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
<svg @click="sort('last_name', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" 
x-bind:class="{'text-blue-500': sorted.field === 'last_name' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
</div>
</div>
</th>
<th width="8%">
<div class="flex items-center space-x-2">
<span class="">
Card Type
</span>
<div class="flex flex-col">
<svg @click="sort('type_of_card', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current".
x-bind:class="{'text-blue-500': sorted.field === 'type_of_card' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
<svg @click="sort('type_of_card', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current".
x-bind:class="{'text-blue-500': sorted.field === 'type_of_card' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
</div>
</div>
</th>
<th width="25%">
<div class="flex items-center space-x-2">
<span class="">
Last Billing Comment
</span>
<div class="flex flex-col">
<svg @click="sort('last_comment_date', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current".
x-bind:class="{'text-blue-500': sorted.field === 'last_name' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
<svg @click="sort('last_comment_date', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current".
x-bind:class="{'text-blue-500': sorted.field === 'last_name' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
</div>
</div>
</th>
<th width="8%">
<div class="flex items-center space-x-2">
<span class="">
Comment Date
</span>
<div class="flex flex-col">
<svg @click="sort('date_time', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current".
x-bind:class="{'text-blue-500': sorted.field === 'last_name' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
<svg @click="sort('date_time', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current".
x-bind:class="{'text-blue-500': sorted.field === 'last_name' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
</div>
</div>
</th>
<th width="12%">
<div class="flex items-center space-x-2">
<span class="">

</span>
<div class="flex flex-col">

</div>
</div>
</th>

</thead>
<tbody>
<template x-for="(item, index) in items" :key="index">
<tr x-show="checkView(index + 1)" class="hover:bg-gray-200 text-gray-900 text-xs">
  <td class="py-3"><span x-text="index+1"></span></td>
<td class="py-3">
<a :href="'/customers/profile/'+item.id+'?customer_id='+item.customer_id" x-text="item.customer_id"></a>
</td>
<td class="py-3">
<a :href="'/customers/profile/'+item.id+'?customer_id='+item.customer_id" x-text="item.billing_date"></a>
</td>
<td class="py-3">
<span x-text="item.amount"></span>
</td>
<td class="py-3">
<span x-text="item.first_name"></span>
</td>
<td class="py-3">
<span x-text="item.last_name"></span>
</td>
<td class="py-3">
<span x-text="item.type_of_card"></span>
</td>
<td class="py-3">
<span x-text="item.last_comment"></span>
</td>
<td class="py-3">
<span x-text="item.last_comment_date"></span>
</td>
<td class="py-3"><button x-data x-on:click="sdnum=item.customer_id;$dispatch('open-modal')">Add Note</div></td>
</tr>
</template>
<tr x-show="isEmpty()">
<td colspan="5" class="text-center py-3 text-gray-900 text-sm">No matching records found.</td>
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
view: 15,
searchInput: '',
pages: [],
offset: 15,
pagination: {
total: data.length,
lastPage: Math.ceil(data.length / 15),
perPage: 15,
currentPage: 1,
from: 1,
to: 1 * 15
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
if (key === 'first_name' || key === 'last_name' || key === 'customer_id') {
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
if (item <= this.currentPage + 15) {
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
</x-app-layout>
