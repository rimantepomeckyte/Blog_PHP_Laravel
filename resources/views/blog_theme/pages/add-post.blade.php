<!--susikurti route nauja
metoda susikurti addPost kaip suprantu BlogControllery-->
@extends('blog_theme/main')
@section('content')
    <div class="row justify-content-center mb-5">
        <h2>New Post</h2>
    </div>
    @include('blog_theme/_partials/errors')
    <form method="post" action="/store" enctype="multipart/form-data"><!--encytype kad moketu atskirti faila-->
        {{csrf_field()}}
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Post title">
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category">
                <option value="" disabled selected>Choose category</option>
                @foreach($options as $option)
                    <option value={{$option->id}}>{{$option->category}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="content">Your post content:</label>
            <textarea name="body" class="form-control" id="content" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label for="upload">Choose image:</label>
            <input type="file" class="form-control" id="upload" name="img">
        </div>
        <div class="form-group d-flex justify-content-center m-5">
            <button type="submit" class="btn btn-info rounded">Post</button>
        </div>
    </form>
@endsection
