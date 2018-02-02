@extends('home.layouts.home')
@section('content')

    <h3>{{$post->title}}</h3>
     <ul class="list-inline"><li class="text-muted">发布时间: {{$post->created_at}}</li><li class="text-muted">浏览次数: {{$post->views}}</li></ul>
    <div>
    	{!! $post->body !!}
    </div>
    <p>标签:  @foreach($post->tags as $tag) <a href="{{route('indexes.index',['tag'=>$tag->name])}}"> {{$tag->name}} </a>@endforeach </p>

    @if($related->count()>0)
        <ul class="list-group">
            <li class="list-group-item active" >相关内容</li>
            @foreach($related as $relate)
                <li class="list-group-item"><a href="{{route('indexes.show',$relate)}}">{{$relate->title}}</a></li>
            @endforeach             
        </ul>

    @endif
     <div>
        <P>总共有 @if($post->comments()->count()>0) {{ $post->comments()->count() }} @else 0 @endif 条评论</P>
        @foreach($comments as $comment)

            <dl class="dl-horizontal">
                <dt>{{$comment->user->name}}</dt>
                <dd>{{$comment->content}}    </dd>
                <dd><small class="text-muted">{{$comment->created_at}}</small>  <small><span>@can('delete', $comment)<a class="glyphicon glyphicon-trash" data-url="{{route('comment.delete', $comment)}}" href="javascript:;"></a> @endcan</span></small>
                    <dd> <a href="javascript:;" data-url="{{route('comment.thumb',$comment)}}" class="glyphicon glyphicon-thumbs-up"
                    @if($comment->thumbs()->where('user_id',auth()->id())->first()) style="color:red" @endif aria-hidden="true">
                         </a> 
                        <span>{{$comment->thumbs_count}}</span>
                    </dd>
                    @auth
                        @if(Auth::user()->id!=$comment->user_id)
                        <p class="text-right "> <a class="text-muted" href="javascript:void(0)">回复</a><input type="hidden" name="comment_id" value="{{$comment->id}}"> </p>
                        @endif
                    @endauth


                </dd>

            </dl>
            
        @endforeach
    </div>
    <div id="comment_div">
    	<form method="post" action="{{ route('comment_add',['post_id'=>$post->id]) }}" id="comment_form">
    		<label>添加评论</label>
            <span id="errmsg"></span>
            <input type="hidden" name="reply_to_comment" >
    		   
                <textarea id="comment" class="form-control" name="content" rows="3" cols="20"></textarea>
                {{ csrf_field() }}
            <button type="submit" class="btn btn-default">提交</button> <span id="msg"></span>    
    	</form>	
    </div>
   
@endsection
@section('js')
    <script>
        $(function(){
            $("a.text-muted").on('click',function() {
                var user = $(this).parents('dl').find('dt').text();
                var content = $("#comment").val();
                $("#comment").val(content+'@'+user+' ') ;
                document.getElementById('comment_div').scrollIntoView();
                var comment_id = $(this).parent().find("input").val() ;
                $("input[name='reply_to_comment']").val(comment_id);
            });

            $("#comment_form textarea").on('focus',function() {
                $("#msg").html('');
            });

            //提交评论
            $("#comment_form").on('submit',function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var data = $("#comment_form").serialize();
                $.ajax({
                    url:url,
                    type:"post",
                    data:data,
                    success:function(response) {
                       $("#comment_form textarea").val('');
                       $("#msg").html(response.msg);
                       setTimeout(function(){location.reload();},1000);
                    },
                    error:function(msg) {
                        
                        if(msg.status == 401) {
                            alert(msg.responseJSON.message);
                        } else {
                            console.log(msg.responseJSON.errors);
                            $errors = msg.responseJSON.errors ;
                            var errorCon = '' ;
                            $.each($errors, function(k ,v) {
                                errorCon+=v ;
                            }) ;
                            alert(errorCon);
                        }
                    }   
                });
            });

            //评论点赞
            $(".glyphicon-thumbs-up").on('click', function() {
                var url = $(this).attr('data-url');
                var obj = $(this);
                //var 
                $.ajax({
                    url:url,
                    type:'post',
                    success:function(data) {
                        if(data.msg == 'inc')
                        {
                            $(obj).next().text(parseInt($(obj).next().text())+1);
                            $(obj).attr('style','color:red')

                        } else {
                            $(obj).next().text(parseInt($(obj).next().text())-1);
                            $(obj).attr('style','');
                        }  
                    },
                    error:function(data) {
                        //console.log(data.responseJSON.message) ;
                        alert(data.responseJSON.message);
                          
                    }
                });
            });

            //删除评论
            $(".glyphicon-trash").on('click', function(){
                var url = $(this).data('url');
                $.ajax({
                    url:url,
                    type:'post',
                    success:function(data){
                        location.reload();
                        //console.log(data);
                        //alert(data);
                    },
                    error:function(data){

                    }
                });
            });

        });

    </script>    
@endsection
