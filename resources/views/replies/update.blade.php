@extends('layouts.app')
@section('content')

@include('includes.error')
<div class="card">
    <div class="card-header">
        Update Reply
    </div>
    <div class="card-body">
        <form action="{{route('replys.update',['id'=>$reply->id])}}" method="post">
            @csrf
            {{method_field('PUT')}}
            <div class="form-group">
                <textarea class="form-control" name="content" rows="10" cols="30">{{$reply->content}}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    Update Reply
                </button>
            </div>
        </form>
    </div>
</div>

@stop