@extends('blog_theme/main')
@section('content')
    <form method="post" action="/cat" class="row">
        {{csrf_field()}}
            <label for="category" class="col-lg-2 col-md-3 align-self-center" >Category name:</label>
            <input type="text" name="category" class="form-control col-lg-5 col-md-8 align-self-center" id="category" placeholder="Enter category name...">
            <button type="submit" class="btn btn-success btn-sm rounded col-lg-3 col-md-4 ml-2 p-0">Add new category</button>
    </form>
@endsection
