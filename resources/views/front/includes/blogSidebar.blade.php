<li class="widget r-posts-w fx" data-animate="fadeInRight">
    <h3 class="widget-head">Сүүлд нэмэгдсэн мэдээ</h3>
    <div class="widget-content">
        <ul>
            @foreach($posts as $post)
            <li>
                <div class="post-img">
                    @if($post->featured_image)
                    <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}">
                    @endif
                </div>
                <div class="widget-post-info">
                    <h4>
                        <a href="{{ route('news.show',$post->id) }}">
                            {{ $post->title }}
                        </a>
                    </h4>
                    <div class="meta">
                        <span><i class="fa fa-clock-o"></i>{{ $post->created_date }}
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</li>

<li class="widget blog-cat-w fx" data-animate="fadeInRight">
    <h3 class="widget-head">Мэдээний төрлүүд</h3>
    <div class="widget-content">
        <ul class="list list-ok alt">
            @foreach($categories as $cat)
            <li><a href="{{ route('category.show',$cat->id) }}">{{ $cat->name }}</a></li>
            @endforeach
        </ul>
    </div>
</li>