@extends('layouts.exskel')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">

        <div class="col-md-12 text-center infinite-scroll px-0">
        @foreach($users as $user)
            <div class="card bg-dark col-lg-10 mx-auto d-flex flex-column px-0" style="max-width: 600px">
                <div class="col card-header border-0 px-3 d-flex flex-row" style="align-items: center">
                    <img src="{{ URL::asset('/imgs/user3-128x128.jpg') }}" alt="" width="40px" height="40px" class="rounded-circle">
                    <h4 class="m-0 ml-3"><a class="text-decoration-none" href="{{ route('discover.user', $user->id) }}">{{ $user->name }}</a></h4>
                </div>
            </div>
        @endforeach
        {{ $users->links() }}
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
