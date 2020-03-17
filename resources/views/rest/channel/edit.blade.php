@extends('layouts.exskel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center m-0">edit channel</h3>
                    </div>
                        <form action="/channels/{{ $channel->id }}" method="post">
                        @method('patch')
                        @csrf
                            <div class="card-body">
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
                                        <textarea type="text" id="description" class="form-control" autocomplete="off" name="description">{{ $channel->description }}</textarea>
                                        @error('description') <span class="text-primary">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="rules">rules</label>
                                        <textarea type="text" id="rules" class="form-control" autocomplete="off" name="rules">{{ $channel->rules }}</textarea>
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
                            </div>
                        <div class="card-footer">
                            <button class="btn btn-success float-right" type="submit">save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection