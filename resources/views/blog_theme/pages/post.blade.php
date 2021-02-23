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
    <div>
    <div class="font-weight-bold mb-0 pb-0 text-white">Leave comment:</div>
    <form method="post" id="" action="/addComment">
        {{csrf_field()}}
        <div class="form-group">
            <label>Comment:</label>
            <textarea type="text" name="comment" rows="3" class="form-control"></textarea>
        </div>
        <input type="text" name="post_id" value="{{$post->id}}" hidden>
        <input type="submit" value="Submit" id="submit"
               class="btn btn-sm btn-outline-danger py-0" style="font-size: 1.2em;">
    </form>
    </div>
    <div class="mt-3">
        <h4 class="font-weight-bolder">Reviews:</h4>
        <hr class="mt-0"/>
        <div class="bg-white p-2">
            @foreach($post->comments as $comment)
                    <div>
                        <p class="text-secondary font-italic">{{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</p>
                        <p>{{$comment->comment}}</p></div>
                    <hr/>

            @endforeach

        </div>
    </div>
    </div>
@endsection
