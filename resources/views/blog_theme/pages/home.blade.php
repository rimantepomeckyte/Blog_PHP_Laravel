@extends('blog_theme/main')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @foreach($posts as $post)
                <div class="post-preview">
                    <a href="post.html" class="">
                        <h2 class="post-title mb-0 pb-0">{{$post->title}}</h2>
                        <p class="post-category pt-0 mt-0 text-secondary">{{$post->category}}</p>
                        <h3 class="post-body font-weight-normal mb-4">{{ substr($post->body, 0,  250) }}</h3> <!--piramame psl matyti teksta iki 250 simboliu-->
                    </a>
                    <a href="post/{{$post->id}}" class="bg-info text-white p-2">Read more</a>
                </div>
                <hr>
        @endforeach

        <!-- Pager -->
            <div class="clearfix">
                {{$posts->links()}}
                <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
            </div>
        </div>
    </div>
@endsection
