@extends('layouts.exskel')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">

        <div class="col-md-12 text-center infinite-scroll px-0">
        @foreach($channels as $channel)
            <div class="card bg-dark col-lg-10 mx-auto d-flex flex-column px-0" style="max-width: 600px">
                <div class="col card-header border-0 px-3 d-flex flex-row" style="align-items: center">
                    <img src="@if(is_null($channel->image)) {{ URL::asset('/imgs/no_channel_img.jpg') }} @else {{ $channel->image->location }} @endif" alt="" width="40px" height="40px" class="rounded">
                    <h3 class="m-0 ml-3"><a class="text-decoration-none" href="{{ route('discover.channel', $channel->id) }}">{{ $channel->name }}</a></h3>
                    @if(!is_null($channel->member))
                    <h5 class="m-0 ml-auto text-warning">{{$channel->member->role_id->name}}</h5>
                    @endif
                </div>
            </div>
        @endforeach
        {{ $channels->links() }}
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
