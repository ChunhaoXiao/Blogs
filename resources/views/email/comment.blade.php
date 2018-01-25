@component('mail::message')

您的评论:"{{$origin->content}}" 被：{{$comment->user->name}} 回复： "{{$comment->content}}"

@component('mail::button', ['url' => route('indexes.show',['post'=>$comment->post_id])])
查看
@endcomponent


@endcomponent
