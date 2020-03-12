@extends('layouts.exskel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="mt-3 bg-dark rounded p-2">channels (index)</h1>

                <a href="/channels/create" class="btn btn-success mt-1 mb-4" role="button">create</a>

                @forelse($channels as $channel)
                    <p><a href="/channels/{{ $channel->id }}">{{ $channel->name }}</a></p>
                @empty
                    <p>no results</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection