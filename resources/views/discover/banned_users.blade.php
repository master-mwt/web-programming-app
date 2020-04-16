@extends('layouts.exskel')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">

        <a role="button" href="{{ route('discover.channel', $channel->id) }}" class="btn btn-dark mb-4"><i class="fas fa-arrow-left mr-2"></i> back to channel {{$channel->name}}</a>

        <div class="col-md-12">
            <h5 class="mx-auto mt-3 mb-5 bg-dark text-center p-3 rounded" style="width:600px">
                <span class="text-warning">!!! DEBUG !!!</span>
                <br><br>
                <span class="text-success">channel id: </span> {{$channel->id}}
                <br>
                <span class="text-success">user id: </span> {{$user->id}}
                <br>
                <span class="text-success">user name: </span> {{$user->name}}
                <br>
                <span class="text-success">user role: </span> {{$user->role->role_id->name}}
                <br><br>
                <span class="text-warning">!!! DEBUG !!!</span>
            </h5>
        </div>

        <div class="col-md-12 text-center infinite-scroll px-0">

        @foreach($members as $member)
            <div class="card col-lg-10 mx-auto d-flex flex-column px-0" style="max-width: 600px; background-color: #111">
                <div class="col card-header border-0 px-3 d-flex flex-row" style="align-items: center">
                    <img src="@if(is_null($member->user_id->image_id)) {{ URL::asset('/imgs/no_profile_img.jpg') }} @else {{ $member->user_id->image_id->location }} @endif" alt="" width="40px" height="40px" class="rounded-circle">
                    <h4 class="m-0 ml-3">
                        <a href="{{ route('discover.user', $member->user_id->id) }}" class="text-decoration-none text-info" href="">{{ $member->user_id->name }}</a>
                    </h4>
                    <a href="{{route('channel.member.unban', ['channel' => $channel, 'member' => $member->user_id])}}" class="ml-auto" style="color: orange">UNBAN USER</a>
                </div>
            </div>
        @endforeach
        {{ $members->links() }}
        </div>

    </div>
</div>

<!-- JScroll func -->
<script type="text/javascript">
    $('ul.pagination').hide();
    $(function() {
        $('document').ready(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<div class="spinner-grow text-primary" role="status"><span class="sr-only">loading...</span></div>',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });
        });
    });
</script>

@endsection
