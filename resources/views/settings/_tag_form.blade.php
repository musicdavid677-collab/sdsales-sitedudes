<div hx-target="this" hx-swap="outerHTML">
<form action="{{ url('settings/tag/update') }}" 
    method="POST"    
    autocomplete="false"
    data-hx-post="{{ url('settings/tag/update') }}"
    >
    @csrf()    
    <input type="hidden" name="id" value="{{ $rec->id }}">
    <div class="form-group">
        <table>
        <tr>
      <td><input type="text" name="tag" value="{{ $rec->tag }}"></td><td><select name="type"><option value="Client" @if($rec->type=="Client") selected @endif>Client</option><option value="Billing"@if($rec->type=="Billing") selected @endif>Billing</option></select></td><td> <button type="button" class="btn btn-outline-primary btn-sm" data-hx-get="{{ url('settings/tag') }}/{{$rec->id}}">Cancel</button>
        <button type="submit" class="btn btn-outline-primary btn-sm">Update tag</button></td>
</tr>
   </table>
    </div>

</form>
</div>
