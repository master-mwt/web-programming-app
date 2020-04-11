@extends('layouts.exskel')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">

        <div class="col-md-12 text-center px-0">
            <img src="{{ URL::asset('/imgs/no_res.png') }}" alt="" class="rounded my-4" width="350px">
            <h2 class="text-primary">{{ $message }}</h2>
        </div>
        
    </div>
</div>

@endsection
