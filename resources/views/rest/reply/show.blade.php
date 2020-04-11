@extends('layouts.exskel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if(Auth::check() && Auth::User()->group_id == 1)
                    <div class="text-center">
                        <a href="{{ route('backend.replies') }}" role="button" class="btn btn-dark mb-3">
                            <i class="fas fa-arrow-left mr-2"></i>
                            return to backend
                        </a>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center m-0">show reply</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col">
                                <label for="id">id</label>
                                <input type="text" id="id" class="form-control" disabled value="{{ $reply->id }}" name="id">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="content">content</label>
                                <textarea type="text" id="content" class="form-control" disabled placeholder="{{ $reply->content }}" name="content" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="upvote">upvote</label>
                                <input type="text" id="upvote" class="form-control" disabled value="{{ $reply->upvote }}" name="upvote">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="downvote">downvote</label>
                                <input type="text" id="downvote" class="form-control" disabled value="{{ $reply->downvote }}" name="downvote">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="total votes">total votes</label>
                                <input type="text" id="total votes" class="form-control" disabled value="{{ $reply->upvote - $reply->downvote }}" name="total votes">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="user_id">user_id</label>
                                <input type="text" id="user_id" class="form-control" disabled value="{{ $reply->user_id }}" name="user_id">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="post_id">post_id</label>
                                <input type="text" id="post_id" class="form-control" disabled value="{{ $reply->post_id }}" name="post_id">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="channel_id">channel_id</label>
                                <input type="text" id="channel_id" class="form-control" disabled value="{{ $reply->channel_id }}" name="channel_id">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form class="d-inline" action="/replies/{{ $reply->id }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-dark float-right">delete</button>
                        </form>
                        <!-- <a href="/replies/{{ $reply->id }}/edit" class="btn btn-success float-right mr-2" role="button">edit</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection