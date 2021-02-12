<!--susikurti route nauja
metoda susikurti addPost kaip suprantu BlogControllery-->
@extends('blog_theme/main')
@section('content')
    <div class="row justify-content-center mb-5">
        <h2>Edit Post</h2>
    </div>
    @include('blog_theme/_partials/errors')
    <form method="post" action="/storeupdate/{{$post->id}}" enctype="multipart/form-data">
        {{csrf_field()}}
        {{method_field('PATCH')}}
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Post title"
                   value="{{$post->title}}">
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category_id">
                @foreach($options as $option)
                    @if($option->id == $post->category_id)
                        <option value="{{$option->id}}" selected>{{$option->category}}</option>
                    @endif
                    @if($option->id!=$post->category_id)
                        <option value="{{$option->id}}">{{$option->category}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="content">Your post content:</label>
            <textarea name="body" class="form-control" id="content" rows="5">{{$post->body}}</textarea>
        </div>
        <div class="form-group">
            <label for="upload">Your uploaded photo: <img src="/{{$post->img}}" alt="{{$post->title}}" style="height: 40px"/>
                ({{ $post->img }})</label>
            <input type="file" class="form-control" id="upload" name="img" value="{{$post->img}}"/>
        </div>
        <div class="form-group d-flex justify-content-center m-5">
            <button type="submit" class="btn btn-info rounded">Edit post</button>
        </div>
    </form>
@endsection
