@extends('layouts.exskel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-3 bg-dark rounded p-2 text-center">channels (edit)</h1>

                <a href="/channels" class="btn btn-primary mt-1 mb-4 text-center" role="button"><< back</a>

                <form action="/channels/{{ $channel->id }}" method="post">
                @method('patch')
                @csrf
                    <div class="row">
                        <div class="form-group col">
                            <label for="name">name</label>
                            <input type="text" id="name" class="form-control" autocomplete="off" value="{{ $channel->name }}" name="name">
                            @error('name') <span class="text-primary">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="title">title</label>
                            <input type="text" id="title" class="form-control" autocomplete="off" value="{{ $channel->title }}" name="title">
                            @error('title') <span class="text-primary">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="description">description</label>
                            <input type="text" id="description" class="form-control" autocomplete="off" value="{{ $channel->description }}" name="description">
                            @error('description') <span class="text-primary">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="rules">rules</label>
                            <input type="text" id="rules" class="form-control" autocomplete="off" value="{{ $channel->rules }}" name="rules">
                            @error('rules') <span class="text-primary">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="creator_id">creator_id</label>
                            <input type="text" id="creator_id" class="form-control" autocomplete="off" value="{{ $channel->creator_id }}" name="creator_id">
                            @error('creator_id') <span class="text-primary">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <button class="btn btn-primary float-right" type="submit">save</button>
                </form>

            </div>
        </div>
    </div>
@endsection