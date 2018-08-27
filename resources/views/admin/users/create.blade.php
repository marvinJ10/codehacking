@extends('layouts.admin')

@section('content')
    <h1>Create User</h1>

         <center>
             {{--<form action="{{URL::to('/posts')}}" method="post">--}}
             {!! Form::open(['method'=>'POST','action'=>'AdminUsersController@store',]) !!}

             <div class="form-group">
                 {!!Form::label('name', 'Name:') !!}
                 {!!Form::text('name',null, ['class'=>'form-control']) !!}<br>

                 {!!Form::label('email', 'Email:') !!}
                 {!!Form::email('content',null, ['class'=>'form-control']) !!}

                 {!!Form::label('role_id', 'Role:') !!}
                 {!!Form::select('role_id',[''=>'Choose options'] + $roles, null, ['class'=>'form-control']) !!}<br>

                 {!!Form::label('is_active', 'Status:') !!}
                 {!!Form::select('is_active',array(1=>'Active', 0=>'Inactive'),0, ['class'=>'form-control']) !!}

                 {!!Form::label('password', 'Password:') !!}
                 {!!Form::password('password', ['class'=>'form-control']) !!}

             </div>
             <div class="form-group">
                 {!!Form::submit('create User') !!}

             </div>


         {!! Form::close() !!}
         </center>
         {{--outputs the errors on the form during its validation--}}
         @include('includes.form_error')
@endsection

