@extends('layouts.admin')

@section('content')

    @if(Session::has('create_user'))
        <p class="bg-danger">{{session('create_user')}}</p>
    @endif

    @if(Session::has('updated_user'))
        <p class="bg-danger">{{session('updated_user')}}</p>
    @endif

    @if(Session::has('deleted_user'))
        <p class="bg-danger">{{session('deleted_user')}}</p>
    @endif

    <h1>Users</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Names</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tbody>

        @if($users)
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><img height="50" width="100" src="{{$user->photo ? $user->photo->file: 'https://via.placeholder.com/400x300'}}"alt=""></td>
                    <td><a href="{{route('admin.users.edit', $user->id)}}" >{{$user->name}}</a></td></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role_id== 1 ? 'Administrator' : 'Subscriber'}}</td>
                    <td>{{$user->is_active== 1 ? 'Active' : 'Inactive'}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>

                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">

            {{$users->render()}}

        </div>
    </div>
@endsection
