<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
@lang('form.users')
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
            <a class="orangebtn" href="{{ route('add_user_page') }}" role="button">Add New User</a>
         </div>

      </div>
   </div>
   <hr>




<body class="relative">
  <div class="">
    <div class="">
      <div class="">
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
          <table class="mt-5">
            <thead class="border-b-2">
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
              <th width="10%">
                <div class="flex items-center space-x-2">
                  <span>
                    Email
                  </span>
                  <div class="flex flex-col">
                    <svg @click="sort('email', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'email' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
                    <svg @click="sort('email', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'email' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
                  </div>
                </div>
              </th>
              <th width="15%">
                <div class="flex items-center space-x-2">
                  <span class="">
                   Phone
                  </span>
                <!--  <div class="flex flex-col">
                    <svg @click="sort('status', 'asc')" fill="none" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'url' && sorted.rule === 'asc'}"><path d="M5 15l7-7 7 7"></path></svg>
                    <svg @click="sort('status', 'desc')" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500 h-3 w-3 cursor-pointer fill-current" x-bind:class="{'text-blue-500': sorted.field === 'url' && sorted.rule === 'desc'}"><path d="M19 9l-7 7-7-7"></path></svg>
                  </div>-->
                </div>
              </th>
              <th width="10%">
                <div class="flex items-center space-x-2">
                  <span>
                    Job Title
                  </span>
                
                </div>
              </th>
            </thead>
            <tbody>
              <template x-for="(item, index) in items" :key="index">
                <tr x-show="checkView(index + 1)" class="hover:bg-gray-200 text-gray-900 text-xs">
                  <td class="py-3">
                    <a :href="'/user/edit/'+item.id" x-text="item.first_name"></a>
                  </td>
                  <td class="py-3">
                    <a :href="'/user/edit/'+item.id" x-text="item.last_name"></a>
                  </td>

                  <td class="py-3">
                    <span x-text="item.email"></span>
                  </td>
                  <td class="py-3">
                    <span x-text="item.phone"></span>
                  </td>
                  <td class="py-3">
                    <span x-text="item.job_title"></span>
                  </td>
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
  let data=<?php echo $users; ?>
  //console.log(data)
window.dataTable = function () {
  return {
    items: [],
    view: 5,
    searchInput: '',
    pages: [],
    offset: 5,
    pagination: {
      total: data.length,
      lastPage: Math.ceil(data.length / 5),
      perPage: 5,
      currentPage: 1,
      from: 1,
      to: 1 * 5
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
        if (key === 'first_name') {
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
      if (item <= this.currentPage + 5) {
        return true
      }
      return false
    },
    search(value) {
      if (value.length > 1) {
        const options = {
          shouldSort: true,
          keys: ['first_name'],
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
</body>
</x-app-layout>
