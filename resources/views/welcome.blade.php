@extends('layouts.exskel')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">
        <div class="col-md-12 text-center infinite-scroll">
        @foreach($posts as $post)
            <div class="card col-lg-7 mx-auto d-flex flex-row px-0 pr-3">
                <div class="bg-dark rounded-left mr-2 py-3 d-flex flex-column" style="flex: 0 0 50px">
                    <a href=""><i class="fas fa-arrow-up mb-1"></i></a>
                    <!-- <span class="mb-1">{{ $post->id}}</span> -->
                    <a href=""><i class="fas fa-arrow-down"></i></a>
                </div>
                <div>
                    <div class="card-header text-left bg-transparent border-0 px-0">
                        <p class="m-0 mb-1"><b>{{ $post->channel_id }}</b> <span class="text-muted">Posted by {{ $post->user_id }}</span> </p>
                        <h5 class="m-0">{{ $post->title }}</h5>
                    </div>
                    <div class="card-body text-left px-0 py-1">
                        <p>{{ $post->content }}</p>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}
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
                loadingHtml: '<img class="center-block" src="/images/loading.gif" alt="Loading..." />',
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
