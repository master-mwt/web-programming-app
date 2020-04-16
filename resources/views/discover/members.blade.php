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

            @if($member->role_id->name == 'creator')
            <div class="card col-lg-10 mx-auto d-flex flex-column px-0" style="max-width: 600px; background-color: #111">

            @elseif($member->role_id->name == 'admin')
            <div class="card col-lg-10 mx-auto d-flex flex-column px-0" style="max-width: 600px; background-color: #222">

            @elseif($member->role_id->name == 'moderator')
            <div class="card col-lg-10 mx-auto d-flex flex-column px-0" style="max-width: 600px; background-color: #333">

            @elseif($member->role_id->name == 'member')
            <div class="card col-lg-10 mx-auto d-flex flex-column px-0" style="max-width: 600px; background-color: #444">

            @else
            @endif

            <div class="col card-header border-0 px-3 d-flex flex-row" style="align-items: center">
                    <img src="@if(is_null($member->user_id->image_id)) {{ URL::asset('/imgs/no_profile_img.jpg') }} @else {{ $member->user_id->image_id->location }} @endif" alt="" width="40px" height="40px" class="rounded-circle">
                    @if($member->reported == 'Not_Reported')
                        <h4 class="m-0 ml-3">
                            <a href="{{ route('discover.user', $member->user_id->id) }}" class="text-decoration-none text-info" href="">{{ $member->user_id->name }}</a>
                        </h4>
                        <span class="ml-3 badge badge-pill badge-info">{{$member->reported}}</span>
                    @elseif($member->reported == 'Reported')
                        <h4 class="m-0 ml-3">
                            <a href="{{ route('discover.user', $member->user_id->id) }}" class="text-decoration-none text-warning" href="">{{ $member->user_id->name }}</a>
                        </h4>
                        <span class="ml-3 badge badge-pill badge-warning">{{$member->reported}}</span>
                    @else
                    @endif

                    @if($member->role_id->name == 'creator')
                    <h5 class="m-0 ml-auto"><span class="text-danger">{{ $member->role_id->name }}</span></h5>

                    @elseif($member->role_id->name == 'admin')
                    <h5 class="m-0 ml-auto"><span class="text-warning">{{ $member->role_id->name }}</span></h5>

                    @elseif($member->role_id->name == 'moderator')
                    <h5 class="m-0 ml-auto"><span class="text-success">{{ $member->role_id->name }}</span></h5>

                    @elseif($member->role_id->name == 'member')
                    <h5 class="m-0 ml-auto"><span class="text-light">{{ $member->role_id->name }}</span></h5>

                    @else
                    @endif

                </div>
                @if($member->role_id->name != 'creator')
                <div class="card-body p-0 px-3 border-0 d-flex flex-column">

                    @if($user->role->role_id->name == 'creator' || $user->role->role_id->name == 'admin')

                        @if($member->isBanned === false)
                            <a href="{{route('channel.member.ban', ['channel' => $channel, 'member' => $member->user_id])}}" class="ml-auto" style="color: orange">BAN USER</a>
                        @else
                        @endif

                    @endif

                    @if($user->role->role_id->name == 'creator' || $user->role->role_id->name == 'admin' || $user->role->role_id->name == 'moderator')

                        @if($member->isReported === false)
                            <a href="{{route('channel.member.report', ['channel' => $channel, 'member' => $member->user_id])}}" class="ml-auto" style="color: violet">REPORT USER</a>
                        @else
                            <a href="{{route('channel.member.unreport', ['channel' => $channel, 'member' => $member->user_id])}}" class="ml-auto text-warning">UNREPORT USER</a>
                        @endif

                    @endif
                </div>
                @endif
                <div class="card-footer border-0">

                @if($user->role->role_id->name == 'creator')

                    @if($member->role_id->name == 'admin')
                    <button onclick="location.href='{{route('channel.member.admin.downgrade', ['channel' => $channel, 'member' => $member->user_id])}}'" class="btn btn-sm btn-outline-light float-right ml-2"><i class="fas fa-arrow-down mr-2"></i><span class="">Downgrade to MODERATOR</span></button>

                    @elseif($member->role_id->name == 'moderator')
                    <button onclick="location.href='{{route('channel.member.moderator.downgrade', ['channel' => $channel, 'member' => $member->user_id])}}'" class="btn btn-sm btn-outline-light float-right ml-2"><i class="fas fa-arrow-down mr-2"></i><span class="">Downgrade to MEMBER</span></button>
                    <button onclick="location.href='{{route('channel.member.admin.upgrade', ['channel' => $channel, 'member' => $member->user_id])}}'" class="btn btn-sm btn-outline-light float-right"><i class="fas fa-arrow-up mr-2"></i> <span class="">Upgrade to ADMIN</span></button>

                    @elseif($member->role_id->name == 'member')
                    <button onclick="location.href='{{route('channel.member.moderator.upgrade', ['channel' => $channel, 'member' => $member->user_id])}}'" class="btn btn-sm btn-outline-light float-right"><i class="fas fa-arrow-up mr-2"></i> <span class="">Upgrade to MODERATOR</span></button>

                    @else
                    @endif

                @elseif($user->role->role_id->name == 'admin')

                    @if($member->role_id->name == 'moderator')
                    <button onclick="location.href='{{route('channel.member.moderator.downgrade', ['channel' => $channel, 'member' => $member->user_id])}}'" class="btn btn-sm btn-outline-light float-right ml-2"><i class="fas fa-arrow-down mr-2"></i><span class="">Downgrade to MEMBER</span></button>

                    @elseif($member->role_id->name == 'member')
                    <button onclick="location.href='{{route('channel.member.moderator.upgrade', ['channel' => $channel, 'member' => $member->user_id])}}'" class="btn btn-sm btn-outline-light float-right"><i class="fas fa-arrow-up mr-2"></i> <span class="">Upgrade to MODERATOR</span></button>

                    @else
                    @endif

                @elseif($user->group_id == 1)

                    @if($member->role_id->name == 'creator')
                        <button onclick="location.href='{{route('channel.member.creator.downgrade', ['channel' => $channel, 'member' => $member->user_id])}}'" class="btn btn-sm btn-outline-light float-right ml-2"><i class="fas fa-arrow-down mr-2"></i><span class="">Downgrade to ADMIN</span></button>

                    @elseif($member->role_id->name == 'admin')
                        <button onclick="location.href='{{route('channel.member.admin.downgrade', ['channel' => $channel, 'member' => $member->user_id])}}'" class="btn btn-sm btn-outline-light float-right ml-2"><i class="fas fa-arrow-down mr-2"></i><span class="">Downgrade to MODERATOR</span></button>
                        <button onclick="location.href='{{route('channel.member.creator.upgrade', ['channel' => $channel, 'member' => $member->user_id])}}'" class="btn btn-sm btn-outline-light float-right"><i class="fas fa-arrow-up mr-2"></i> <span class="">Upgrade to CREATOR</span></button>

                    @elseif($member->role_id->name == 'moderator')
                        <button onclick="location.href='{{route('channel.member.moderator.downgrade', ['channel' => $channel, 'member' => $member->user_id])}}'" class="btn btn-sm btn-outline-light float-right ml-2"><i class="fas fa-arrow-down mr-2"></i><span class="">Downgrade to MEMBER</span></button>
                        <button onclick="location.href='{{route('channel.member.admin.upgrade', ['channel' => $channel, 'member' => $member->user_id])}}'" class="btn btn-sm btn-outline-light float-right"><i class="fas fa-arrow-up mr-2"></i> <span class="">Upgrade to ADMIN</span></button>

                    @elseif($member->role_id->name == 'member')
                        <button onclick="location.href='{{route('channel.member.moderator.upgrade', ['channel' => $channel, 'member' => $member->user_id])}}'" class="btn btn-sm btn-outline-light float-right"><i class="fas fa-arrow-up mr-2"></i> <span class="">Upgrade to MODERATOR</span></button>

                    @else
                    @endif

                @else
                @endif

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
