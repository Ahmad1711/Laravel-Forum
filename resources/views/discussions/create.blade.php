@extends('layouts.app')
@section('content')

@include('includes.error')
<div class="card">
    <div class="card-header">
        Create New Discussion
    </div>
    <div class="card-body">
        <form action="{{route('discussions.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" class="form-control" value="{{old('title')}}" type="text" name="title">
            </div>
            <div class="form-group">
                <label for="ch_id">Select Channel</label>
                <select id="ch_id" class="form-control" name="channel">
                    @foreach($channels as $channel)
                    <option value="{{$channel->id}}">{{$channel->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="question">Ask a Question</label>
                <textarea id="question" class="form-control" name="content" rows="10" cols="30">{{old('content')}}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-sm pull-right">Create Discussion</button>
            </div>
        </form>
    </div>
</div>

@stop