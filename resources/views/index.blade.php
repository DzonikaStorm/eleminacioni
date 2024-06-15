@foreach($posts as $post)
    <div>
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->short_description }}</p>
        <a href="{{ route('posts.show', $post) }}">Read more</a>
        <p>Category: <a href="{{ route('categories.show', $post->category) }}">{{ $post->category->name }}</a></p>
    </div>
@endforeach

{{ $posts->links() }}
