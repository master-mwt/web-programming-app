@extends('layouts.exskel')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">
        
        <div class="col-md-12 text-center px-0">
            <div class="card col-lg-10 mx-auto d-flex flex-row px-0" style="max-width: 800px">
                <div class="rounded-left py-3 d-flex flex-column" style="flex: 0 0 50px; background-color: #222">
                    <a href="" class=""><i class="fas fa-arrow-up mb-1"></i></a>
                    <span class="my-1 text-light">{{ $post->id }}</span>
                    <a href="" class=""><i class="fas fa-arrow-down"></i></a>
                </div>
                <div class="w-100">
                    <div class="card-header text-left bg-transparent border-0 px-3">
                        <p class="m-0 mb-1">
                            <a href="{{ route('channel', $post->channel_id->id) }}" class="text-decoration-none"><b>{{ $post->channel_id->name }} &#183</b></a> <span class="text-muted">Posted by </span>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 text-center infinite-scroll px-0">
        @foreach($replies as $reply)
            <div class="card bg-dark col-lg-10 mx-auto d-flex flex-row px-0" style="max-width: 800px">
                <div class="rounded-left py-3 d-flex flex-column" style="flex: 0 0 50px; background-color: #222">
                    <a href="" class=""><i class="fas fa-arrow-up mb-1"></i></a>
                    <span class="my-1 text-light">{{ $reply->id }}</span>
                    <a href="" class=""><i class="fas fa-arrow-down"></i></a>
                </div>
                <div class="w-100">
                    <div class="card-header text-left border-0 px-3">
                        <p class="m-0 mb-1">
                            <span class="text-muted">Posted by </span>
                            <a href="" class="text-decoration-none">{{ $reply->user_id->name }}</a>
                        </p>
                    </div>
                    <div class="card-body text-left px-3 py-1">
                        <p>{{ $reply->content }}</p>
                    </div>
                    <div class="card-footer border-0 p-1 px-3 text-left" style="border-bottom-left-radius: 0px">
                        <a href="" class="text-decoration-none mr-2"><i class="fas fa-comment-alt mr-1"></i>Reply</a>
                        <a href="" class="text-decoration-none mr-2"><i class="fas fa-crown mr-1"></i>Give Award</a>
                        <a href="" class="text-decoration-none mr-2"><i class="fas fa-bookmark mr-1"></i>Save</a>
                        <a href="" class="text-decoration-none "><i class="fas fa-flag mr-1"></i>Report</a>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $replies->links() }}
        </div>
        
        <h1 class="text-center bg-primary p-2 rounded">GENERALIZED TREE STRUCTURE PROTOTYPE</h1>

        <div class="col-md-12 text-center infinite-scroll px-0">
            <!-- Reply-to-Post card -->
            <div class="card bg-dark col-lg-10 mx-auto d-flex flex-row px-0" style="max-width: 800px">
                <div class="rounded-left py-3 d-flex flex-column" style="flex: 0 0 50px">
                    <a href="" class=""><i class="fas fa-arrow-up mb-1"></i></a>
                    <span class="my-1">{{ $reply->id }}</span>
                    <a href="" class=""><i class="fas fa-arrow-down"></i></a>
                </div>
                <div class="w-100">
                    <div class="card-header text-left bg-transparent border-0 px-3 py-1">
                        <p class="m-0">
                            <span class="text-muted">Posted by </span>
                            <a href="" class="text-decoration-none">{{ $reply->user_id->name }}</a>
                        </p>
                    </div>
                    <div class="card-body text-left px-3 py-1">
                        <p class="m-0">{{ $reply->content }}</p>
                    </div>
                    <div class="card-footer border-0 p-1 px-3 text-left bg-transparent" style="border-bottom-left-radius: 0px">
                        <a href="" class="text-decoration-none mr-2"><i class="fas fa-comment-alt mr-1"></i>Reply</a>
                        <a href="" class="text-decoration-none mr-2"><i class="fas fa-crown mr-1"></i>Give Award</a>
                        <a href="" class="text-decoration-none mr-2"><i class="fas fa-bookmark mr-1"></i>Save</a>
                        <a href="" class="text-decoration-none "><i class="fas fa-flag mr-1"></i>Report</a>
                    </div>
                    
                    <!-- Reply-to-Reply nester card -->
                    <div class="mt-2 card bg-dark col-lg-10 mx-auto d-flex flex-row px-0 border-0 shadow-none" style="max-width: 800px">
                        <div class="rounded-left py-3 d-flex flex-column" style="flex: 0 0 50px">
                            <a href="" class=""><i class="fas fa-arrow-up mb-1"></i></a>
                            <span class="my-1">{{ $reply->id }}</span>
                            <a href="" class=""><i class="fas fa-arrow-down"></i></a>
                        </div>
                        <div class="w-100">
                            <div class="card-header text-left bg-transparent border-0 px-3 py-1">
                                <p class="m-0">
                                    <span class="text-muted">Posted by </span>
                                    <a href="" class="text-decoration-none">{{ $reply->user_id->name }}</a>
                                </p>
                            </div>
                            <div class="card-body text-left px-3 py-1">
                                <p class="m-0">{{ $reply->content }}</p>
                            </div>
                            <div class="card-footer border-0 p-1 px-3 text-left bg-transparent" style="border-bottom-left-radius: 0px">
                                <a href="" class="text-decoration-none mr-2"><i class="fas fa-comment-alt mr-1"></i>Reply</a>
                                <a href="" class="text-decoration-none mr-2"><i class="fas fa-crown mr-1"></i>Give Award</a>
                                <a href="" class="text-decoration-none mr-2"><i class="fas fa-bookmark mr-1"></i>Save</a>
                                <a href="" class="text-decoration-none "><i class="fas fa-flag mr-1"></i>Report</a>
                            </div>
                        </div>
                    </div>
                    <!-- END Reply-to-Reply nester card -->

                </div>
            </div>
            <!-- END Reply-to-Post card -->
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
