@extends('layouts.admin');

@section('content')

    <h1>Categories</h1>


    <div class="col-sm-6">
        {!! Form::model($category,['method'=>'PATCH','action'=>['AdminCategoriesController@update',$category->id]]) !!}

        <div class="form-group">
            {!!Form::label('name', 'Name:') !!}
            {!!Form::text('name',null, ['class'=>'form-control']) !!}<br>

        </div>
        <div class="form-group">
            {!!Form::submit('Update Category', ['class'=>'btn btn-primary col-sm-5 pull-left' ]) !!}

        </div>

        {!! Form::close() !!}

        {!! Form::open(['method'=>'DELETE','action'=>['AdminCategoriesController@destroy',$category->id]]) !!}

        <div class='form-group'>
            {!! Form::submit('Delete Category',['class'=>'btn btn-danger col-sm-5 pull-right']) !!}
        </div>


    </div>

    <div class="col-sm-6">



    </div>


@endsection