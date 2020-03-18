@extends('layouts.exskel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if(Auth::check() && Auth::User()->group_id == 1)
                    <div class="text-center">
                        <a href="{{ route('backend.channels') }}" role="button" class="btn btn-dark mb-3">
                            <i class="fas fa-arrow-left mr-2"></i>
                            return to backend
                        </a>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center m-0">show channel</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col">
                                <label for="id">id</label>
                                <input type="text" id="id" class="form-control" disabled value="{{ $channel->id }}" name="id">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="name">name</label>
                                <input type="text" id="name" class="form-control" disabled value="{{ $channel->name }}" name="name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="title">title</label>
                                <input type="text" id="title" class="form-control" disabled value="{{ $channel->title }}" name="title">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="description">description</label>
                                <textarea type="text" id="description" class="form-control" disabled placeholder="{{ $channel->description }}" name="description"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="rules">rules</label>
                                <textarea type="text" id="rules" class="form-control" disabled placeholder="{{ $channel->rules }}" name="rules"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form class="d-inline" action="/channels/{{ $channel->id }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-dark float-right">delete</button>
                        </form>
                        <a href="/channels/{{ $channel->id }}/edit" class="btn btn-success float-right mr-2" role="button">edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection