@extends('layouts.exskel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if(Auth::check() && Auth::User()->group_id == 1)
                    <div class="text-center">
                        <a href="{{ route('backend.users') }}" role="button" class="btn btn-dark mb-3">
                            <i class="fas fa-arrow-left mr-2"></i>
                            return to backend
                        </a>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center m-0">show user</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col">
                                <label for="id">id</label>
                                <input type="text" id="id" class="form-control" disabled value="{{ $user->id }}" name="id">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="name">name</label>
                                <input type="text" id="name" class="form-control" disabled value="{{ $user->name }}" name="name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="surname">surname</label>
                                <input type="text" id="surname" class="form-control" disabled value="{{ $user->surname }}" name="surname">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="username">username</label>
                                <input type="text" id="username" class="form-control" disabled value="{{ $user->username }}" name="username">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="birth_date">birth_date</label>
                                <input type="text" id="birth_date" class="form-control" disabled value="{{ $user->birth_date }}" name="birth_date">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="email">email</label>
                                <input type="text" id="email" class="form-control" disabled value="{{ $user->email }}" name="email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="group_id">group_id</label>
                                <input type="text" id="group_id" class="form-control" disabled value="{{ $user->group_id }}" name="group_id">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form class="d-inline" action="/users/{{ $user->id }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-dark float-right">delete</button>
                        </form>
                        <a href="/users/{{ $user->id }}/edit" class="btn btn-success float-right mr-2" role="button">edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection