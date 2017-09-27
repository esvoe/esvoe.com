<ul>
    @foreach($categories as $category)
        <li>
            <div>
                <img src="{!! static_uploads($category['image_small']) !!}">
                {{$category['title']}} <a href="/developer/categories/{{$category['id']}}/edit">(Edit)</a> </div>
            @if (isset($category['children']) && $category['children'])

                {!! Theme::partial('developer.category-item', array('categories'=>$category['children'])) !!}


            @endif
        </li>
    @endforeach
</ul>