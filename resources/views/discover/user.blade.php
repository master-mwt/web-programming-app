@extends('layouts.exskel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex flex-row">
                    <img src="@if(is_null($user->image)) {{ URL::asset('/imgs/no_profile_img.jpg') }} @else {{$user->image->location}} @endif" alt="user-profile-image" class="rounded border" width='80'>
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
                        <a role="button" href="{{ route('discover.user.posts', $user->id) }}" class="btn btn-dark mr-1"><i class="fas fa-eye mr-2"></i>See Posts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection