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
                @elseif(Auth::check() && Auth::User()->group_id == 2)
                    <div class="text-center">
                        <a role="button" href="{{ route('home') }}" class="btn btn-dark mb-4">
                            <i class="fas fa-arrow-left mr-2"></i> 
                            return to home
                        </a>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center m-0">edit user</h3>
                    </div>
                        <form action="/users/{{ $user->id }}" method="post">
                        @method('patch')
                        @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="name">name</label>
                                        <input type="text" id="name" class="form-control" autocomplete="off" value="{{ $user->name }}" name="name">
                                        @error('name') <span class="text-primary">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="surname">surname</label>
                                        <input type="text" id="surname" class="form-control" autocomplete="off" value="{{ $user->surname }}" name="surname">
                                        @error('surname') <span class="text-primary">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="username">username</label>
                                        <input type="text" id="username" class="form-control" autocomplete="off" value="{{ $user->username }}" name="username">
                                        @error('username') <span class="text-primary">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="birth_date">birth_date</label>
                                        <input type="date" id="birth_date" class="form-control" autocomplete="off" value="{{ $user->birth_date }}" name="birth_date">
                                        @error('birth_date') <span class="text-primary">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="email">email</label>
                                        <input type="email" id="email" class="form-control" autocomplete="off" value="{{ $user->email }}" name="email">
                                        @error('email') <span class="text-primary">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                @if(Auth::check() && Auth::User()->group_id == 1)
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="group_id">group_id</label>
                                        <input type="text" id="group_id" class="form-control" autocomplete="off" value="{{ $user->group_id }}" name="group_id">
                                        @error('group_id') <span class="text-primary">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                @endif
                                @if(Auth::check() && Auth::User()->group_id == 2)
                                    {{ Form::hidden('group_id', $user->group_id) }}
                                @endif
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