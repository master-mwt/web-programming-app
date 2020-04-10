@extends('layouts.exskel')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">

        <a role="button" href="{{ route('discover.channel', $channel->id) }}" class="btn btn-dark mb-4"><i class="fas fa-arrow-left mr-2"></i> back to channel {{$channel->name}}</a>

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
                    <img src="{{ URL::asset('/imgs/user3-128x128.jpg') }}" alt="" width="40px" height="40px" class="rounded-circle">
                    <h4 class="m-0 ml-3"><a class="text-decoration-none" href="">{{ $member->user_id->name }}</a></h4>

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
                <div class="card-body text-right p-0 px-3 border-0">
                    <a href="" class="" style="color: orange">ban user</a>
                </div>
                @endif
                <div class="card-footer border-0">

                @if($member->role_id->name == 'admin')
                <button class="btn btn-sm btn-outline-light float-right ml-2"><i class="fas fa-arrow-down mr-2"></i><span class="">Downgrade to MODERATOR</span></button>

                @elseif($member->role_id->name == 'moderator')
                <button class="btn btn-sm btn-outline-light float-right ml-2"><i class="fas fa-arrow-down mr-2"></i><span class="">Downgrade to MEMBER</span></button>
                <button class="btn btn-sm btn-outline-light float-right"><i class="fas fa-arrow-up mr-2"></i> <span class="">Upgrade to ADMIN</span></button>

                @elseif($member->role_id->name == 'member')
                <button class="btn btn-sm btn-outline-light float-right"><i class="fas fa-arrow-up mr-2"></i> <span class="">Upgrade to MODERATOR</span></button>

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
