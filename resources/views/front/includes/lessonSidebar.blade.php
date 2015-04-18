<li class="widget blog-cat-w fx animated fadeInRight" data-animate="fadeInRight">
    <h3 class="widget-head">Хичээлийн төрлүүд</h3>
    <div class="widget-content">
        <ul class="list list-ok alt">
            @foreach($categories as $cat)
            <li><a href="{{ route('lesson.category.show',$cat->id) }}">{{ $cat->name }}</a><span>[{{ sizeof($cat->lessons)}}]</span></li>
            @endforeach
        </ul>
    </div>
</li>
<li class="widget blog-cat-w fx animated fadeInRight" data-animate="fadeInRight">
    <h3 class="widget-head">Хичээлийн сувгууд</h3>
    <div class="widget-content">
        <ul class="list list-ok alt">
            @foreach($channels as $channel)
            <li><a href="{{ route('lesson.channel.show',$channel->id) }}">{{ $channel->name }}</a><span>[{{ sizeof($channel->lessons)}}]</span></li>
            @endforeach
        </ul>
    </div>
</li>