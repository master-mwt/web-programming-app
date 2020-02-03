@extends('layouts.app')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            @foreach($users_channels_roles as $user_channel_role)
                <p>{{ $user_channel_role }}</p>
            @endforeach
        </div>
    </div>
</div>

@endsection
