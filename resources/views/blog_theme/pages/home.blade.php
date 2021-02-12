@extends('blog_theme/main')

@section('content')
    @if(session()->has('message'))
        <div class="alert {{session('alert') ?? 'alert-info'}}">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @foreach($posts as $post)
                <div class="post-preview">
                        <h2 class="post-title mb-0 pb-0">{{$post->title}}</h2>
                        <p class="post-category pt-0 mt-0 text-secondary">Category: <a href="/category/{{$post->category_id}}">{{$post->category}}</a></p>
                    <div><img src="{{$post->img}}" alt="{{$post->title}}" style="height: 80px"/></div>
                    <h3 class="post-body font-weight-normal mb-4">{{ substr($post->body, 0,  250) }}...</h3> <!--piramame psl matyti teksta iki 250 simboliu-->
                    <a href="/post/{{$post->id}}" class="bg-info text-white p-2 font-weight-bold">Read more</a>
                    <p class="post-meta mt-1">Posted by <a href="/user/{{$post->user_id}}">{{$post->name}} </a>{{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</p>
                </div>
                @if(Auth::check())
            <div class="d-flex justify-content-between">
                <div><a href="/edit/{{$post->id}}" class="btn btn-warning p-1 font-weight-normal">Edit</a></div>
                <div><a onclick="return confirm('Are you really want to delete it?')" class="btn btn-danger p-1 font-weight-normal" href="/delete/{{$post->id}}">Delete</a></div>
            </div>
                @endif
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
