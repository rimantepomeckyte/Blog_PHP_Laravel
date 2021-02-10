@extends('blog_theme/main')
@section('content')

<a class="btn btn-success p-2 rounded mb-3" href="/add-category">Add new category</a>

    <table class="table table-sm text-center mb-5">
        <thead>
        <tr class="table-primary">
            <th scope="col">Category name</th>
            <th scope="col">#</th>
        </tr>
        </thead>
        <tbody>
@foreach($category as $name)
        <tr>
            <td><a href="/category/{{$name->id}}">{{$name->category}}</a></td>
            <td><a onclick="return confirm('Are you really want to delete it?')" class="btn btn-danger p-1 font-weight-normal" href="/delete/category/{{$name->id}}">Delete</a></td>
        </tr>
@endforeach
        </tbody>
    </table>

@endsection
