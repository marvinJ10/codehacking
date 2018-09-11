@extends('layouts.admin')

@section('content')
    @include('includes.tinyeditor')

    <h1>Edit Post</h1>
    <div class="row">
        {{--outputs the errors on the form during its validation--}}
        @include('includes.form_error')
    </div>
    <div class="row">

        <div class="col-sm-3">
            <img src ="{{$post->photo ? $post->photo->file : 'https://via.placeholder.com/400x300'}}" alt="" class=img-responsive img-rounded>

        </div>
        <center>

            <div class="col-sm-9">

                {!! Form::model($post,['method'=>'PATCH','action'=>['AdminPostsController@update', $post->id],'files'=>true]) !!}

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
                    {!! Form::submit('Update Post',['class'=>'btn btn-primary col-sm-5 pull-left' ]) !!}
                </div>

                {!! Form::close() !!}

                {!! Form::open(['method'=>'DELETE','action'=>['AdminPostsController@destroy',$post->id]]) !!}

                <div class='form-group'>
                    {!! Form::submit('Delete Post',['class'=>'btn btn-danger col-sm-5 pull-right']) !!}
                </div>


            </div>

@endsection

