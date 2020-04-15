@extends('layouts.exskel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex flex-row">
                    <img src="@if(is_null($user->image)){{ URL::asset('imgs/no_profile_img.jpg') }} @else {{ $user->image->location }}@endif" alt="user-profile-image" class="rounded border" width='80'>
                    <div class="d-flex flex-column my-auto ml-4">
                        <h4 class="m-0">{{ $user->name }} {{ $user->surname }}</h4>
                        <h5 class="m-0 text-muted">{{ $user->username }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="m-0 mb-2"><b>email</b><span class="ml-4 text-muted">{{ $user->email }}</span></h5>
                    <h5 class="m-0"><b>birth date</b><span class="ml-4 text-muted">{{ $user->birth_date }}</span></h5>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <!-- connect edit button to user rest show/edit profile -->
                        <a role="button" href="{{ route('users.show', $user->id) }}" class="btn btn-success mr-1">show profile data</a>
                        <a role="button" href="{{ route('password.update') }}" class="btn btn-success">change password</a>
                    </div>
                    <a href="{{ route('channels.create') }}" class="btn btn-primary" role="button">create a channel</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
