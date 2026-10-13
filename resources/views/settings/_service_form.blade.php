<div hx-target="this" hx-swap="outerHTML">
<form action="{{ url('settings/service/update') }}" 
    method="POST"    
    autocomplete="false"
    data-hx-post="{{ url('settings/service/update') }}"
    >
    @csrf()    
    <input type="hidden" name="id" value="{{ $rec->id }}">
    <div class="form-group">
        <table>
        <tr>
      <td><input type="text" name="service" value="{{ $rec->service }}"></td><td>$ <input type="text" name="price" value="{{ $rec->price }}"></td><td> <button type="button" class="btn btn-outline-primary btn-sm" data-hx-get="{{ url('settings/service') }}/{{$rec->id}}">Cancel</button>
        <button type="submit" class="btn btn-outline-primary btn-sm">Update Service</button></td>
</tr>
   </table>
    </div>

</form>
</div>
