@extends('layouts.exskel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="mt-3 bg-dark rounded p-2 text-center">channels (show)</h1>
                
                <a href="/channels" class="btn btn-primary mt-1 float-left" role="button"><< back</a>
                <a href="/channels/{{ $channel->id }}/edit" class="btn btn-success mt-1" role="button">edit</a>

                <p class="mt-4 text-center"><b class="mr-2 text-primary">ID: </b>{{ $channel->id }}</p>
                <p class="text-center"><b class="mr-2 text-primary">NAME: </b>{{ $channel->name }}</p>
                <p class="text-center"><b class="mr-2 text-primary">TITLE: </b>{{ $channel->title }}</p>
                <p class="text-center"><b class="mr-2 text-primary">DESCRIPTION: </b>{{ $channel->description }}</p>
                <p class="text-center"><b class="mr-2 text-primary">RULES: </b>{{ $channel->rules }}</p>
                <p class="text-center mb-4"><b class="mr-2 text-primary">CREATOR_ID: </b>{{ $channel->creator_id }}</p>
            </div>

            <form class="mx-auto" action="/channels/{{ $channel->id }}" method="post">
                @method('delete')
                @csrf
                <button class="btn btn-danger">delete</button>
            </form>
        </div>
    </div>
@endsection