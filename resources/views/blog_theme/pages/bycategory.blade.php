@extends('blog_theme/main')
@section('content')
    @foreach($filteredPosts as $post)
        <div class="post-preview">
            <h2 class="post-title mb-0 pb-0">{{$post->title}}</h2>
            <p class="post-category pt-0 mt-0 text-secondary">{{$post->category}}</p>
            <h3 class="post-body font-weight-normal mb-4">{{ substr($post->body, 0,  100) }}...</h3> <!--piramame psl matyti teksta iki 250 simboliu-->
            <a href="post/{{$post->id}}" class="bg-info text-white p-2 font-weight-bold">Read more</a>
            <p class="post-meta mt-1">Posted by <a href="#">Start Bootstrap </a>{{$post->created_at}}</p>
        </div>
        <hr>
        @endforeach

@endsection
