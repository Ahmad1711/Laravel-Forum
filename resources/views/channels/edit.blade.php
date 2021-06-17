@extends('layouts.app')
@section('content')

@include('includes.error')
<div class="card">
    <div class="card-header">
        Update Channel : {{$channel->title}}
    </div>
    <div class="card-body">
        <form action="{{route('channels.update',['id'=>$channel->id] )}}" method="post">
            @csrf
            {{method_field('PUT')}}
            <div class="form-group">
                <label for="cname">Channel Name</label>
                <input id="cname" class="form-control" type="text" name="cname" value="{{$channel->title}}">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    Update Channel
                </button>
            </div>
        </form>
    </div>
</div>
@stop