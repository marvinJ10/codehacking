@extends('layouts.admin')

@section('content')
    <h1>Edit User</h1>
    <div class="row">
        {{--outputs the errors on the form during its validation--}}
        @include('includes.form_error')
    </div>
    <div class="row">

    <div class="col-lg-3">
        <img src height="{{$user->photo ? $user->photo->file : 'https://via.placeholder.com/400x300'}}" alt="" class=img-responsive img-rounded>

    </div>
    <center>
        <div class="col-lg-9">

            {!! Form::model($user,['method'=>'PATCH','action'=>['AdminUsersController@update', $user->id],'files'=>true]) !!}

            <div class="form-group">

                {!!Form::label('name', 'Name:') !!}
                {!!Form::text('name',null, ['class'=>'form-control']) !!}<br>

                {!!Form::label('email', 'Email:') !!}
                {!!Form::email('email',null, ['class'=>'form-control']) !!}

                {!!Form::label('role_id', 'Role:') !!}
                {!!Form::select('role_id',[''=>'Choose options'] + $roles, null, ['class'=>'form-control']) !!}<br>

                {!!Form::label('is_active', 'Status:') !!}
                {!!Form::select('is_active',array(1=>'Active', 0=>'Inactive'),null, ['class'=>'form-control']) !!}

                {!!Form::label('photo_id', 'Photo:') !!}
                {!!Form::file('photo_id',null, ['class'=>'form-control']) !!}

               {{-- {!!Form::label('password', 'Password:') !!}
                {!!Form::password('password', ['class'=>'form-control']) !!}--}}

            </div>


            <div class='form-group'>
                {!! Form::submit('Update User',['class'=>'btn btn-primary col-sm-5 pull-left' ]) !!}
            </div>

            {!! Form::close() !!}

            {!! Form::open(['method'=>'DELETE','action'=>['AdminUsersController@destroy',$user->id]]) !!}

            <div class='form-group'>
                  {!! Form::submit('Delete User',['class'=>'btn btn-danger col-sm-5 pull-right']) !!}
            </div>


        </div>

@endsection

