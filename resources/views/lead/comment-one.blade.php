<li data-hx-target="closest .comment-placeholder" hx-swap="outerHTML">
  <div class="comment-placeholder">
    <div class="comment">
      <p><strong>{{ $comment->admin_person }} - {{ $comment->date_time }}</strong></p>
      <span><?= htmlspecialchars_decode(strip_tags($comment->comment, ['p', 'span', 'strong', 'b', 'br', 'div']), ENT_QUOTES) ?></span>
    </div>
    <?php $nameAuthenticated = Auth::user()->first_name . ' ' . Auth::user()->last_name; ?>
    @if ($nameAuthenticated === $comment->admin_person)
     <?php
        $today=date("Y-m-d H:i:s");
        $created_at=$comment->date_time;
        $diff=date_diff(date_create($today), date_create($created_at));
        if($diff->days<=25):
      ?>
    <p class="text-right">
    <button hx-on::before-request="checkSession()" class="btn btn-sm" arial-label="Edit Comment" data-hx-get="{{ url("leads/lead-comment/{$comment->id}/edit") }}">Edit Comment</button>
    </p>
  <?php endif ?>
    @endif
  </div>
</li>
