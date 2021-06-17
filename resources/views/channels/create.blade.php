@extends('layouts.app')
@section('content')

@include('includes.error')
<div class="card">
    <div class="card-header">
        Create New Channel
    </div>
    <div class="card-body">
        <form action="{{route('channels.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="cname">Channel Name</label>
                <input id="cname" class="form-control" type="text" name="cname">
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-sm" type="submit">
                    Store Channel
                </button>
            </div>
        </form>
    </div>
</div>
@stop