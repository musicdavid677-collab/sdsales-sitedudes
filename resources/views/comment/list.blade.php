@foreach ($comments as $comment)
{{ $comment['comment_type'] }}
{{ $comment['comment'] }}
@endforeach
