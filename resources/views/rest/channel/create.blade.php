@extends('layouts.exskel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center m-0">create a new channel</h3>
                    </div>
                        <form action="/channels" method="post">
                        @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="name">name</label>
                                        <input type="text" id="name" class="form-control" autocomplete="off" value="{{ old('name') }}" name="name">
                                        @error('name') <span class="text-primary">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="title">title</label>
                                        <input type="text" id="title" class="form-control" autocomplete="off" value="{{ old('title') }}" name="title">
                                        @error('title') <span class="text-primary">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="description">description</label>
                                        <textarea type="text" id="description" class="form-control" autocomplete="off" value="{{ old('description') }}" name="description"></textarea>
                                        @error('description') <span class="text-primary">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="rules">rules</label>
                                        <textarea type="text" id="rules" class="form-control" autocomplete="off" value="{{ old('rules') }}" name="rules"></textarea>
                                        @error('rules') <span class="text-primary">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="creator_id">creator_id</label>
                                        <input type="text" id="creator_id" class="form-control" autocomplete="off" value="{{ old('creator_id') }}" name="creator_id">
                                        @error('creator_id') <span class="text-primary">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        <div class="card-footer">
                            <button class="btn btn-primary float-right" type="submit">create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection