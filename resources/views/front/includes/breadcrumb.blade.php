<nav class="top-nav">
    <ul>
        <li class="{{ Request::is('/') ? 'selected' : '' }}"><a href="{{ route('index') }}"><i class="fa fa-home"></i><span>Нүүр</span></a>
        </li>
        <li class="{{ Request::is('statistics') ? 'selected' : '' }}"><a href="{{ route('statistics') }}"><i class="fa fa-bar-chart-o"></i><span>Үзүүлэлт</span></a>
        </li>
        <li class="{{ Request::is('lesson*') || Request::is('aimag*') || Request::is('district*') ? 'selected' : '' }}"><a href="{{ route('lesson.index') }}"><i class="fa fa-pencil"></i><span>Хичээлүүд</span></a>
            <ul>
                <li><a href="#">Аймаг</a>
                    <ul>
                        <li><a href="{{ route('aimag',1) }}">Архангай</a></li>
                        <li><a href="{{ route('aimag',2) }}">Баян-Өлгий</a></li>
                        <li><a href="{{ route('aimag',3) }}">Баянхонгор</a></li>
                        <li><a href="{{ route('aimag',4) }}">Булган</a></li>
                        <li><a href="{{ route('aimag',5) }}">Говь-Алтай</a></li>
                        <li><a href="{{ route('aimag',6) }}">Говьсүмбэр</a></li>
                        <li><a href="{{ route('aimag',7) }}">Дархан-Уул</a></li>
                        <li><a href="{{ route('aimag',8) }}">Дорноговь</a></li>
                        <li><a href="{{ route('aimag',9) }}">Дорнод</a></li>
                        <li><a href="{{ route('aimag',10) }}">Дундговь</a></li>
                        <li><a href="{{ route('aimag',11) }}">Завхан</a></li>
                        <li><a href="{{ route('aimag',12) }}">Орхон</a></li>
                        <li><a href="{{ route('aimag',13) }}">Өвөрхангай</a></li>
                        <li><a href="{{ route('aimag',14) }}">Өмнөговь</a></li>
                        <li><a href="{{ route('aimag',15) }}">Сүхбаатар</a></li>
                        <li><a href="{{ route('aimag',16) }}">Сэлэнгэ</a></li>
                        <li><a href="{{ route('aimag',17) }}">Төв</a></li>
                        <li><a href="{{ route('aimag',18) }}">Увс</a></li>
                        <li><a href="{{ route('aimag',19) }}">Ховд</a></li>
                        <li><a href="{{ route('aimag',20) }}">Хөвсгөл</a></li>
                        <li><a href="{{ route('aimag',21) }}">Хэнтий</a></li>
                    </ul>
                </li>
                <li><a href="#">Дүүрэг</a>
                    <ul>
                        <li><a href="{{ route('district',1) }}">Багануур</a></li>
                        <li><a href="{{ route('district',2) }}">Багахангай</a></li>
                        <li><a href="{{ route('district',3) }}">Баянгол</a></li>
                        <li><a href="{{ route('district',4) }}">Баянзүрх</a></li>
                        <li><a href="{{ route('district',5) }}">Налайх</a></li>
                        <li><a href="{{ route('district',6) }}">Сонгинохайрхан</a></li>
                        <li><a href="{{ route('district',7) }}">Сүхбаатар</a></li>
                        <li><a href="{{ route('district',8) }}">Хан-Уул</a></li>
                        <li><a href="{{ route('district',9) }}">Чингэлтэй</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        @foreach($pageTypes as $pageType)
        <li class="" ><a href="#"><i class="fa {{ $pageType->icon }}"></i><span>{{ $pageType->name }}</span></a>
            @if($pageType->pages)
            <ul>
                @foreach($pageType->pages as $page)
                <li class="{{ Request::is('pages/'.$page->slug) ? 'selected current' : '' }}">
                    <a href="{{ route('pages',$page->slug) }}">{{ $page->name }}</a>
                </li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
    </ul>
</nav>