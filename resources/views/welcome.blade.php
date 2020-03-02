@extends('layouts.exskel')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
        @foreach($posts as $post)
            <div class="card col-md-5 mx-auto">
                <div class="card-body">
                    <p>{{ $post }}</p>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>

@endsection
