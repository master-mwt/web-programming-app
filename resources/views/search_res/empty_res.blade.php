@extends('layouts.exskel')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">

        <div class="col-md-12 text-center px-0">
            <img src="{{ URL::asset('/imgs/sad_mac.jpg') }}" alt="" class="rounded my-5" width="100px">
            <h2>{{ $message }}</h2>
        </div>
        
    </div>
</div>

@endsection
