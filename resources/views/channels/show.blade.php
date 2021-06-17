@extends('layouts.app')
@section('content')

@foreach($discussions as $discussion)
<div class="card">
    <div class="card-header">
        <img src="{{asset($discussion->user->avatar)}}" width="50px" height="50px">&nbsp;&nbsp;
        <span>{{$discussion->user->name}},<b>{{$discussion->created_at->diffforHumans()}}</b></span>
        @if($discussion->has_best_answer())
        <span class="btn btn-success float-right btn-sm">Closed</span>
        @else
        <span class="btn btn-danger float-right btn-sm">Open</span>
        @endif
        <a href="{{route('discussions.show',['slug'=>$discussion->slug])}}" class="btn btn-info float-right btn-sm" style="margin-right:6px;">View</a>
    </div>
    <div class="card-body">
        <h4 class="text-center"><b>{{$discussion->title}}</b></h4>
        <hr>
        <p class="text-center">{{str_limit($discussion->content,50)}}</p>
    </div>
    <div class="card-footer">
        {{$discussion->replies->count()}} Replies
        <a href="{{route('channels.show',['slug'=>$discussion->channel->slug])}}" style="text-decoration: none;" class="float-right">{{$discussion->channel->title}}</a>
    </div>
</div><br>
@endforeach

<div class="text-center">
    {{$discussions->links()}}
</div>

@stop