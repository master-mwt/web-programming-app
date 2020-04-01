@extends('layouts.exskel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if(Auth::check() && Auth::User()->group_id == 1)
                    <div class="text-center">
                        <a href="{{ route('backend.tags') }}" role="button" class="btn btn-dark mb-3">
                            <i class="fas fa-arrow-left mr-2"></i>
                            return to backend
                        </a>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center m-0">show tag</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col">
                                <label for="id">id</label>
                                <input type="text" id="id" class="form-control" disabled value="{{ $tag->id }}" name="id">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="name">name</label>
                                <input type="text" id="name" class="form-control" disabled value="{{ $tag->name }}" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form class="d-inline" action="/tags/{{ $tag->id }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-dark float-right">delete</button>
                        </form>
                        <a href="/tags/{{ $tag->id }}/edit" class="btn btn-success float-right mr-2" role="button">edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection