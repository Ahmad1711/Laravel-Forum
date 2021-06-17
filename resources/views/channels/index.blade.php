@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Channels</div>

    <div class="card-body">
        <table class="table table-light">
            <thead>
                <td>Name</td>
                <td>Edit</td>
                <td>Delete</td>
            </thead>
            <tbody>
                @if($channels->count()>0)
                @foreach($channels as $channel)
                <tr>
                    <td>
                        {{$channel->title}}
                    </td>
                    <td>
                        <a href="{{route('channels.edit',['id'=>$channel->id])}}" class="btn btn-info">
                            Edit
                        </a>
                    </td>
                    <td>
                        <form action="{{route('channels.destroy',['id'=>$channel->id])}}" method="post">
                            @csrf 
                            {{method_field('DELETE')}}
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <th colspan="5" class="text-center">No Channels yet.</th>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection