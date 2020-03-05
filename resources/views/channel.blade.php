@extends('layouts.exskel')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">
        <div class="col-md-12 text-center px-0">
            <div class="card bg-dark col-lg-10 mx-auto d-flex flex-column px-0" style="max-width: 800px">
                <div class="col card-header border-0 px-3 d-flex flex-row" style="align-items: center">
                    <img src="{{ URL::asset('/imgs/channellogo.png') }}" alt="" width="50px" height="50px" class="rounded">
                    <h2 class="m-0 ml-3">{{ $channel->name }}</h2>
                    <button class="btn btn-sm btn-outline-success ml-auto">JOIN</button>
                    <button class="btn btn-sm btn-outline-primary ml-2">LEAVE</button>
                </div>
                <div class="card-body text-left px-3 py-1">
                    <p class="text-muted">{{ $channel->description }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 text-center infinite-scroll px-0">
        @foreach($posts as $post)
            <div class="card col-lg-10 mx-auto d-flex flex-row px-0" style="max-width: 800px">
                <div class="rounded-left py-3 d-flex flex-column" style="flex: 0 0 50px; background-color: #222">
                    <a href="" class=""><i class="fas fa-arrow-up mb-1"></i></a>
                    <span class="my-1 text-light">{{ $post->id }}</span>
                    <a href="" class=""><i class="fas fa-arrow-down"></i></a>
                </div>
                <div>
                    <div class="card-header text-left bg-transparent border-0 px-3">
                        <p class="m-0 mb-1">
                            <span class="text-muted">Posted by </span>
                            <a href="" class="text-decoration-none">{{ $post->user_id->name }}</a>
                        </p>
                        <h5 class="m-0"><a href="{{ route('post', $post->id) }}" class="text-decoration-none">{{ $post->title }}</a></h5>
                    </div>
                    <div class="card-body text-left px-3 py-1">
                        <p>{{ $post->content }}</p>
                    </div>
                    <div class="card-footer border-0 p-1 px-3 text-left" style="border-bottom-left-radius: 0px">
                        <a href="" class="text-decoration-none mr-2"><i class="fas fa-comment-alt mr-1"></i>100 Comments</a>
                        <a href="" class="text-decoration-none mr-2"><i class="fas fa-crown mr-1"></i>Give Award</a>
                        <a href="" class="text-decoration-none mr-2"><i class="fas fa-bookmark mr-1"></i>Save</a>
                        <a href="" class="text-decoration-none mr-2"><i class="fas fa-ban mr-1"></i>Hide</a>
                        <a href="" class="text-decoration-none "><i class="fas fa-flag mr-1"></i>Report</a>
                        
                        <!-- buttons -->
                        <!-- <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-comment-alt mr-1"></i>100 Comments</button>
                        <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-crown mr-1"></i>Give Award</button>
                        <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-bookmark mr-1"></i>Save</button>
                        <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-ban mr-1"></i>Hide</button>
                        <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-flag mr-1"></i>Report</button> -->
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
