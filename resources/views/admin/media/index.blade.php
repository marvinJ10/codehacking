@extends('layouts.admin');

@section('content')

    <h1>Media</h1>


    <div class="col-sm-15">

        @if($photos)
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created On</th>

                </tr>
                </thead>
                <tbody>


                @foreach($photos as $photo)
                    <tr>

                        <td>{{$photo->id}}
                        <td><img height="150" width="145" src = "{{$photo->file ? $photo->file : 'No Images'}}">
                        <td>{{$photo->created_at ? $photo->created_at -> diffForHumans(): 'no date'}}</td>

                        <td>
                            {!! Form::open(['method'=>'DELETE','action'=>['AdminMediasController@destroy',$photo->id]]) !!}

                            <div class='form-group'>
                                {!! Form::submit('Delete Media',['class'=>'btn btn-danger', ]) !!}
                            </div>

                            {!! Form::close() !!}


                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>

        @endif

    </div>


@endsection