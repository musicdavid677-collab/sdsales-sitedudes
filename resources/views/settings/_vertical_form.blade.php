<div hx-target="this" hx-swap="outerHTML">
<form action="{{ url('settings/vertical/update') }}" 
    method="POST"    
    autocomplete="false"
    data-hx-post="{{ url('settings/vertical/update') }}"
    >
    @csrf()    
    <input type="hidden" name="id" value="{{ $rec->id }}">
    <div class="form-group">
        <table>
        <tr>
      <td><input type="text" name="vertical" value="{{ $rec->vertical }}"></td><td> <button type="button" class="btn btn-outline-primary btn-sm" data-hx-get="{{ url('settings/vertical') }}/{{$rec->id}}">Cancel</button>
        <button type="submit" class="btn btn-outline-primary btn-sm">Update vertical</button></td>
</tr>
   </table>
    </div>

</form>
</div>
