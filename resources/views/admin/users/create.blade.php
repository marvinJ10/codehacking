@extends('layouts.admin')

@section('content')
    <h1>Create User</h1>
    <div class="row">
        {{--outputs the errors on the form during its validation--}}
        @include('includes.form_error')
    </div>
    <div class="row">
         <center>

             {!! Form::open(['method'=>'POST','action'=>'AdminUsersController@store', 'files'=>true]) !!}

             <div class="form-group">

                 {!!Form::label('name', 'Name:') !!}
                 {!!Form::text('name',null, ['class'=>'form-control']) !!}<br>

                 {!!Form::label('email', 'Email:') !!}
                 {!!Form::email('email',null, ['class'=>'form-control']) !!}

                 {!!Form::label('role_id', 'Role:') !!}
                 {!!Form::select('role_id',[''=>'Choose options'] + $roles, null, ['class'=>'form-control']) !!}<br>

                 {!!Form::label('is_active', 'Status:') !!}
                 {!!Form::select('is_active',array(1=>'Active', 0=>'Inactive'),0, ['class'=>'form-control']) !!}

                 {!!Form::label('photo_id', 'Photo:') !!}
                 {!!Form::file('photo_id',null, ['class'=>'form-control']) !!}

                 {!!Form::label('password', 'Password:') !!}
                 {!!Form::password('password', ['class'=>'form-control']) !!}

             </div>

             <div class='form-group'>
                 {!! Form::submit('Create User',['class'=>'btn btn-primary']) !!}
             </div>




         {!! Form::close() !!}
         </center>
    </div>

@endsection

