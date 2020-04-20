@extends('layouts.exskel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="panel panel-primary col">
            <div class="panel-heading col"><h2>change channel image</h2></div>
            <div class="panel-body col">
                @if($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" data-dismiss="alert" class="close">x</button>
                        <strong>{{$message}}</strong>
                    </div>
                <img src="/images/{{ Session::get('image') }}">
                @endif

                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>server error</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>    
                    </div>
                @endif

                <form action="{{ route('home.channel.image.upload.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ Form::hidden('channel_id', $channel->id) }}
                    <div class="row">
                        <div class="col">
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success">upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection