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
                        <h3 class="text-center m-0">edit tag</h3>
                    </div>
                        <form action="/tags/{{ $tag->id }}" method="post">
                        @method('patch')
                        @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="name">name</label>
                                        <input type="text" id="name" class="form-control" autocomplete="off" value="{{ $tag->name }}" name="name">
                                        @error('name') <span class="text-primary">{{ $message }}</span> @enderror
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