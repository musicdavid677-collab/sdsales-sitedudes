<div hx-target="this" hx-swap="outerHTML">
<form action="{{ url('/leads/lead-comment') }}/{{ $comment->id }}/update" 
    method="POST"    
    autocomplete="false"
    data-hx-put="{{ url('/leads/lead-comment') }}/{{ $comment->id }}/update"
    hx-target="this" 
    hx-swap="outerHTML swap:1s"
    >
    @csrf()    
    <input type="hidden" name="client_id" value="{{ $comment->client_id }}">
    <input type="hidden" name="comment_type" value="{{ $comment->comment_type }}">
    <input type="hidden" name="admin_person" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
    <div class="form-group">
        <textarea name="comment" class="form-control" id="comment" rows="2">{{ $comment->comment }}</textarea>
    </div>
    <div class="text-right">
        <button type="button" 
            class="btn btn-outline-primary btn-sm"
            data-hx-get="{{ url('/leads/lead-comment') }}/{{ $comment->id }}">Cancel</button>
        <button type="submit" 
            class="btn btn-outline-primary btn-sm">Update Note</button>
    </div>
</form>
</div>
