@extends('layouts.exskel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-12 text-center infinite-scroll px-0">
        @forelse($mychannels as $channel)
            <div class="card bg-dark col-lg-10 mx-auto d-flex flex-column px-0" style="max-width: 600px">
                <div class="col card-header border-0 px-3 d-flex flex-row" style="align-items: center">
                    <img src="{{ URL::asset('/imgs/channellogo.png') }}" alt="" width="40px" height="40px" class="rounded">
                    <h3 class="m-0 ml-3"><a class="text-decoration-none" href="{{ route('discover.channel', $channel->id) }}">{{ $channel->name }}</a></h3>
                    <h5 class="m-0 ml-auto text-muted">{{ $channel->role_id->name }}</h5>
                    <!-- <button class="btn btn-sm btn-outline-success ml-auto">JOIN</button>
                    <button class="btn btn-sm btn-outline-primary ml-2">LEAVE</button> -->
                </div>
            </div>
        @empty
            <h2>no results ...</h2>
        @endforelse
        {{ $mychannels->links() }}
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