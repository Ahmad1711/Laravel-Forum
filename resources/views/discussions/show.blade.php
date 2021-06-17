@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <img src="{{asset($discussion->user->avatar)}}" width="50px" height="50px">&nbsp;&nbsp;
        <span>{{$discussion->user->name}},<b>({{$discussion->user->points}})</b></span>
        @if($discussion->has_best_answer())
        <span class="btn btn-success float-right btn-sm">Closed</span>
        @else
        <span class="btn btn-danger float-right btn-sm">Open</span>
        @endif

        @if($discussion->is_being_watched_by_auth_user())

        <a href="{{route('discussion.unwatch',['id'=>$discussion->id])}}" class="btn btn-danger float-right btn-sm" style="margin-right:6px;">Unwatch</a>

        @else

        <a href="{{route('discussion.watch',['id'=>$discussion->id])}}" class="btn btn-success float-right btn-sm" style="margin-right:6px;">Watch</a>

        @endif

        @if(Auth::id()==$discussion->user_id)

        <a href="{{route('discussions.edit',['discussion'=>$discussion->slug])}}" class="btn btn-info float-right btn-sm" style="margin-right:6px;">Edit</a>

        @endif
    </div>
    <div class="card-body">
        <h4 class="text-center"><b>{{$discussion->title}}</b></h4>
        <hr>
        <p class="text-center">{{$discussion->content}}</p>
    </div>
    <hr>
    @if($best)
    <h4 class="text-center"><b>Best Answer</b></h4>
    <div class="card text-center" style="margin:1em;">
        <div class="card-header">
            <img src="{{asset($best->user->avatar)}}" width="50px" height="50px">&nbsp;&nbsp;
            <span>{{$best->user->name}},<b>({{$best->user->points}})</b></span>
        </div>
        <div class="card-body">
            {{$best->content}}
        </div>
    </div>
    @endif

    <div class="card-footer">
        {{$discussion->replies->count()}} Replies
        <a href="{{route('channels.show',['slug'=>$discussion->channel->slug])}}" style="text-decoration: none;" class="float-right">{{$discussion->channel->title}}</a>
    </div>

</div><br>

@foreach($discussion->replies as $reply)
<div class="card">
    <div class="card-header">
        <img src="{{asset($reply->user->avatar)}}" width="50px" height="50px">&nbsp;&nbsp;
        <span>{{$reply->user->name}},<b>({{$reply->user->points}})</b></span>
        @if(Auth::id()!=$reply->user_id)
        @if(!$best)
        <a href="{{route('replys.bestanswer',['id'=>$reply->id])}}" class="btn btn-primary float-right btn-sm">Mark as best answer</a>
        @endif
        @endif
        @if(Auth::id()==$reply->user_id)
        @if(!$best)
        <a href="{{route('replys.edit',['id'=>$reply->id])}}" class="btn btn-info float-right btn-sm" style="margin-right:6px;">Edit</a>
        @endif
        @endif
    </div>
    <div class="card-body">
        <p class="text-center">{{$reply->content}}</p>
    </div>
    <div class="card-footer">
        @if($reply->is_liked_by_auth_user())

        <a href="{{route('replys.unlike',['id'=>$reply->id])}}" class="btn btn-danger btn-sm">Unlike<span class="badge">{{$reply->likes->count()}}</span></a>

        @else

        <a href="{{route('replys.like',['id'=>$reply->id])}}" class="btn btn-success btn-sm">Like<span class="badge">{{$reply->likes->count()}}</span></a>

        @endif
    </div>
</div><br>
@endforeach

<div class="card">
    <div class="card-header">
        Create Reply
    </div>
    <div class="card-body">
        <form action="{{route('replys.store')}}" method="post">
            @csrf
            <div class="form-group">
                <textarea class="form-control" name="content" rows="10" cols="30"></textarea>
                <input type="hidden" name="slug" value="{{$discussion->slug}}" />
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-sm" type="submit">
                    Create Reply
                </button>
            </div>
        </form>
    </div>
</div>

@stop