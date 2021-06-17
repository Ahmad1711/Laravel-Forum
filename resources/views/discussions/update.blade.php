@extends('layouts.app')
@section('content')

@include('includes.error')
<div class="card">
    <div class="card-header">
        Update Discussion
    </div>
    <div class="card-body">
        <form action="{{route('discussions.update',['slug'=>$discussion->slug])}}" method="post">
            @csrf
            {{method_field('PUT')}}
            <div class="form-group">
                <label for="question">Ask a Question</label>
                <textarea id="question" class="form-control" name="content" rows="10" cols="30">{{$discussion->content}}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Update Discussion</button>
            </div>
        </form>
    </div>
</div>

@stop