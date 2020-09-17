@extends('layouts.exskel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="text-center mt-3 mb-4">About Us</h1>
            <div class="text-center">
                <img src="{{ URL::asset('/imgs/main_logo.png') }}" alt="Logo" class="img-circle" width="100">
                <h3 class="mt-2 mb-3 text-muted">kernel panic</h3>
                <p class="text-muted">
                    kernel panic is a minimal reddit clone, is heavily community-based and completely free. <br>
                    kernel panic provides a small community building service based on categories, channels. <br>
                    it also provides a rich-text post creation service based on categories and tags, associated with channels. <br>
                    it is also possible to generate discussions connected to a post by creating replies and comments. <br>
                    small communities can manage themselves independently through the hierarchy of roles structured in a minimal way within the platform. <br>
                    these and other features, such as the "subscription to a channel" service or the "notification" service, are only available for registered users. <br>
                    guest users will have full free access to all channels and posts on the platform for viewing only.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection