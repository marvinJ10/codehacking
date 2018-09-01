@extends('layouts.admin')

@section('content')
    <h1>Create Post</h1>
    <div class="row">
        {{--outputs the errors on the form during its validation--}}
        @include('includes.form_error')
    </div>
    <div class="row">
        <center>

            {!! Form::open(['method'=>'POST','action'=>'AdminPostsController@store', 'files'=>true]) !!}

            <div class="form-group">

                {!!Form::label('title', 'Title:') !!}
                {!!Form::text('title',null, ['class'=>'form-control']) !!}<br>

                {!!Form::label('category_id', 'Category:') !!}
                {!!Form::select('category_id',[''=>'Choose Category'] + $categories, null, ['class'=>'form-control']) !!}<br>

                {!!Form::label('photo_id', 'Photo:') !!}
                {!!Form::file('photo_id',null, ['class'=>'form-control']) !!}

                {!!Form::label('body', 'body:') !!}
                {!!Form::textarea('body',null, ['class'=>'form-control']) !!}

            </div>

            <div class='form-group'>
                {!! Form::submit('Create User',['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </center>
    </div>

@endsection

