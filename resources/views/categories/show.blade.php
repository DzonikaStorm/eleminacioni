<h1>Posts in {{ $category->name }}</h1>

@foreach($posts as $post)
    <div>
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->short_description }}</p>
        <a href="{{ route('posts.show', $post) }}">Read more</a>
    </div>
@endforeach

{{ $posts->links() }}
