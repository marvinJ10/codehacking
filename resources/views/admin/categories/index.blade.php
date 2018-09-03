@extends('layouts.admin');

@section('content')

    <h1>Categories</h1>
    @if(Session::has('create_category'))
        <p class="bg-danger">{{session('create_category')}}</p>
    @endif

    @if(Session::has('updated_category'))
        <p class="bg-danger">{{session('updated_category')}}</p>
    @endif

    @if(Session::has('deleted_category'))
        <p class="bg-danger">{{session('deleted_category')}}</p>
    @endif



    <div class="col-sm-6">

        {!! Form::open(['method'=>'POST','action'=>'AdminCategoriesController@store']) !!}

        <div class="form-group">
            {!!Form::label('name', 'Name:') !!}
            {!!Form::text('name',null, ['class'=>'form-control']) !!}<br>

        </div>
        <div class="form-group">
            {!!Form::submit('create Category', ['class'=>'btn btn-primary']) !!}

        </div>

        </center>

    </div>

    <div class="col-sm-6">

        @if($categories)
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created On</th>

                </tr>
                </thead>
                <tbody>


                @foreach($categories as $category)
                    <tr>

                        <td>{{$category->id}}
                        <td><a href="{{route('admin.categories.edit', $category->id)}}" >{{$category->name}}</a></td></td>
                        <td>{{$category->created_at ? $category->created_at -> diffForHumans(): 'no date'}}</td>

                    </tr>
                @endforeach

                </tbody>
            </table>

        @endif

    </div>


@endsection