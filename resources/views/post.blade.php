@extends('layouts.blog-post')


@section('content')

    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span>Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" height="30"  src="{{$post->photo->file}}" alt="">

    <hr>

    <!-- Post Content -->
    {{$post->body}}
    <hr>

    <!-- Flash Message after submitting comment-->

    @if(Session::has('comment_message'))
        {{Session('comment_message')}}
    @endif

    <!-- Allow Comments Form  only when logged in -->
    @if(Auth::check())

        <div class="well">
            <h4>Leave a Comment:</h4>

            {{--<form action="{{URL::to('/posts')}}" method="post">--}}
            {!! Form::open(['method'=>'POST','action'=>'PostsCommentsController@store']) !!}

            {{-- Hiddem field for grtting the user ID--}}
            <input type="hidden" name="post_id" value="{{$post->id}}">

            <div class="form-group">

                {!!Form::label('body', '') !!}
                {!!Form::textarea('body',null, ['class'=>'form-control', 'rows'=>3]) !!}

            </div>
            <div class="form-group">
                {!!Form::submit('Submit Comment' ,['class'=>'btn btn-primary' ])!!}

            </div>

            {!! Form::close() !!}

            @endif
            {{--outputs the errors on the form during its validation--}}
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <hr>

        <!-- Posted Comments -->
        @if(count($comments) > 0)
            @foreach($comments as $comment)


                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" height="90" src="{{Auth::user()->gravatar}}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->author}}
                            <small>{{$comment->created_at->diffForHumans()}}</small>
                        </h4>
                    {{$comment->body}}

                    @if(count($comment->replies)>0)
                        @foreach($comment->replies as $reply)
                            @if ($reply->is_active == 1)


                            <!-- Nested Comment -->
                                <div id="nested-comment" class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" height="40" src="{{Auth::user()->gravatar}}" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{$reply->author}}
                                            <small>{{$reply->created_at->diffForHumans()}}</small>
                                        </h4>
                                        {{$reply->body}}
                                    </div>
                                    {{--container for the jquery functionality--}}
                                    <div class="comment-reply-container" >
                                        <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                                        {{--where the jquery takes effect--}}
                                        <div class="comment-reply col-lg-6">

                                            {{--<form action="{{URL::to('/posts')}}" method="post">--}}
                                            {!! Form::open(['method'=>'POST','action'=>'PostsRepliesController@createReply']) !!}

                                            {{-- Hiddem field for grtting the user ID--}}
                                            <input type="hidden" name="comment_id" value="{{$comment->id}}">

                                            <div class="form-group">

                                                {!!Form::label('body', '') !!}
                                                {!!Form::textarea('body',null, ['class'=>'form-control', 'rows'=>3]) !!}

                                            </div>
                                            <div class="form-group">
                                                {!!Form::submit('Submit Comment' ,['class'=>'btn btn-primary' ])!!}

                                            </div>
                                            {!! Form::close() !!}
                                        </div>

                                    </div>
                                    <!-- End Nested Comment -->
                                </div>
                                @endif
                            @endforeach

                        @endif

                    </div>
                </div>
            @endforeach
        @endif

@stop

@section('scripts')
    <script type="text/javascript">

        $(".comment-reply-container.toggle-reply").onclick(function(){
            $(this).next().slideToggle("slow");
        });

    </script>
@stop