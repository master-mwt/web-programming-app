@extends('layouts.exskel')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
        @foreach($users_channels_roles as $user_channel_role)
            <div class="card col-md-4 mx-auto">
                <div class="card-body">
                    <p>{{ $user_channel_role }}</p>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>

@endsection
