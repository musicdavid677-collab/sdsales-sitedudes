<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
@lang('form.roles')
</h2>
</x-slot>
<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="px-4 py-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">


@section('title', (isset($rec->id)) ?  __('form.edit_role')  : __('form.add_new_role'))


<div class="main-content">

<form method="post" action="{{ (isset($rec->id)) ? route( 'patch_role', $rec->id) : route('post_role') }}">

    {{ csrf_field()  }}
    @if(isset($rec->id))
        {{ method_field('PATCH') }}
    @endif
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>@lang('form.role_name') <span class="required">*</span> </label>
            <input type="text" class="form-control form-control-sm  @php if($errors->has('name')) { echo 'is-invalid'; } @endphp" name="name" value="{{ old_set('name', NULL,$rec) }}">
            <div class="invalid-feedback">@php if($errors->has('name')) { echo $errors->first('name') ; } @endphp</div>
        </div>

    </div>

     <table class="table table-sm table-bordered">
<thead>
    <tr>
        <th class="bold">@lang('form.permission')</th>
        <th class="text-center bold">@lang('form.view')</th>
        <th class="text-center bold">@lang('form.view_own')</th>
        <th class="text-center bold">@lang('form.create')</th>
        <th class="text-center bold">@lang('form.edit')</th>
        <th class="text-center text-danger bold">@lang('form.delete')</th>
    </tr>
</thead>
<tbody>
    @foreach($data['permissions_checkboxes'] as $list)
        <tr>
        <td>{{ $list['name'] }}</td>
        <td class="text-center"><?php echo $list['view']; ?></td>
        <td class="text-center"><?php echo $list['view_own']; ?></td>
        <td class="text-center"><?php echo $list['create']; ?></td>
        <td class="text-center"><?php echo $list['edit']; ?></td>
        <td class="text-center"><?php echo $list['delete']; ?></td>
    </tr>
    @endforeach
</tbody>
</table>
<input type="submit" name="submit" id="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700.
   active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">

    <?php  //echo bottom_toolbar(__('form.submit'))?>

</form>
</div>

</div>
</div>
</div>
</x-app-layout>