<div hx-target="this" hx-swap="outerHTML">
<form action="{{ url('settings/product/update') }}" 
    method="POST"    
    autocomplete="false"
    data-hx-post="{{ url('settings/product/update') }}"
    >
    @csrf()    
    <input type="hidden" name="id" value="{{ $rec->product_id }}">
    <div class="form-group">
        <table>
        <tr>
      <td><input type="text" name="product" value="{{ $rec->product }}"></td><td> <button type="button" class="btn btn-outline-primary btn-sm" data-hx-get="{{ url('settings/product') }}/{{$rec->product_id}}">Cancel</button>
        <button type="submit" class="btn btn-outline-primary btn-sm">Update product</button></td>
</tr>
   </table>
    </div>

</form>
</div>
