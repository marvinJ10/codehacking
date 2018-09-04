@extends('layouts.admin')

@section('styles')

    <link rel="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">

@stop

@section('content')
    <h1>Upload File
    <center>
    {!! Form::open(['method'=>'POST','action'=>'AdminMediasController@store','class'=>'dropzone']) !!}

    {!! Form::close() !!}

   </center></h1>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
@stop