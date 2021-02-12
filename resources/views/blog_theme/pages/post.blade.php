@extends('blog_theme/main')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @if(session()->has('message'))
                <div class="alert {{session('alert') ?? 'alert-info'}}">
                    {{ session('message') }}
                </div>
            @endif
            @foreach($additional as $value)
            <h2>{{$post->title}}</h2>
                <p class="text-secondary">Category: <a href="/category/{{$post->category_id}}">{{$value->category}}</a></p>
                    <div><img src="/{{$post->img}}" alt="{{$post->title}}" style="height: 250px"/></div>
            <p>{{$post->body}}</p>
                <p class="post-meta mt-1">Posted by <a href="/user/{{$post->user_id}}">{{$value->name}}</a> {{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</p>
                @endforeach
        </div>
    </div>
    @if(Auth::check())
        <div class="d-flex justify-content-end">
            <div><a href="/edit/{{$post->id}}" class="btn btn-warning p-2 font-weight-normal mr-2">Edit</a></div>
            <div><a onclick="return confirm('Are you really want to delete it?')" class="ml-2 btn btn-danger p-2 font-weight-normal" href="/delete/{{$post->id}}">Delete</a></div>
        </div>
    @endif
@endsection
