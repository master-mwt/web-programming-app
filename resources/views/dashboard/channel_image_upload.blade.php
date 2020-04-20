@extends('layouts.exskel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">

            <a role="button" href="{{ route('discover.channel', $channel->id) }}" class="btn btn-dark mb-4"><i class="fas fa-arrow-left mr-2"></i> return to channel {{$channel->name}}</a>
            
            <div class="card">
                <div class="card-header">
                    <h2>change channel image</h2>
                </div>
                <div class="card-body">
                    @if($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" data-dismiss="alert" class="close">x</button>
                            <strong>{{$message}}</strong>
                        </div>
                    <img src="/images/{{ Session::get('image') }}" class="col mb-3">
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
                        <input type="file" name="image" class="form-control-file">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success float-right">upload image</button>
                </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection