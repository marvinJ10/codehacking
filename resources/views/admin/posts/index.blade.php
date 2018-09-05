@extends('layouts.admin')

@section('content')

    @if(Session::has('create_post'))
        <p class="bg-danger">{{session('create_post')}}</p>
    @endif

    @if(Session::has('updated_post'))
        <p class="bg-danger">{{session('updated_post')}}</p>
    @endif

    @if(Session::has('deleted_post'))
        <p class="bg-danger">{{session('deleted_post')}}</p>
    @endif

    <h1>All Posts</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>User</th>
            <th>Category</th>
            <th>Title</th>
            <th>Body</th>
            <th>Comment Link</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tbody>

        @if($posts)
            @foreach($posts as $post)

                <tr>
                    <td>{{$post->id}}
                    <td><img height="50" width="100" src="{{$post->photo ? $post->photo->file: 'https://via.placeholder.com/400x300'}}"alt=""></td>
                    <td><a href="{{route('admin.posts.edit', $post->id)}}" >{{$post->user->name}}</a></td></td>
                    <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{str_limit($post->body,30)}}</td>
                    <td><a href="{{route('home.post',$post->id)}}">View Post</a> </td>
                    <td><a href="{{route('admin.comments.show',$post->id)}}">View Comments</a> </td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>

                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
@endsection
