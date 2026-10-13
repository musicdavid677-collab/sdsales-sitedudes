<ul id="{{$comment_type}}-notes">

    @foreach ($comments as $comment)
        @include('lead/comment-one', [
            'comment' => $comment,
            'comment_type' => $comment->comment_type,
            'customer_id' => $customer_id,
        ])
    @endforeach
    
    </ul>