    @inject('category','App\Services\CategoryServices')
    <ul class="list-group">
        <li class="list-group-item active">文章分类</li>
        @foreach($category->getCategory() as $category)
            <li class="list-group-item"><span class="badge">{{$category->posts_count}}</span><a href="{{route('indexes.index',['category'=>$category->id])}}">{{$category->name}}</a></li>
        @endforeach
    </ul>
    <ul class="list-group">
        <li class="list-group-item active">评论排行</li>
        @foreach($most_comments as $comment)
        <li class="list-group-item">
            <a href="{{route('indexes.show',$comment)}}">{{$comment->title}}</a>
        </li>  
        @endforeach  
       
    </ul>
   
        <ul class="list-group">
            <li class="list-group-item active">热门标签</li>
            <li class="list-group-item">
                @foreach($hot_tags as $tag)
                    <a href="{{route('indexes.index',['tag'=>$tag->name])}}"><span class="label label-default">{{$tag->name}}</span></a>
                @endforeach
            </li>
        </ul>
   

   