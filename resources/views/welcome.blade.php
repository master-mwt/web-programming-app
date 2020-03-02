@extends('layouts.exskel')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">
        <div class="col-md-12 text-center infinite-scroll">
        @foreach($posts as $post)
            <div class="card col-lg-10 mx-auto d-flex flex-row px-0">
                <div class="bg-dark rounded-left py-3 d-flex flex-column" style="flex: 0 0 50px">
                    <a href="" class=""><i class="fas fa-arrow-up mb-1"></i></a>
                    <span class="my-1">{{ $post->id }}</span>
                    <a href="" class=""><i class="fas fa-arrow-down"></i></a>
                </div>
                <div>
                    <div class="card-header text-left bg-transparent border-0 px-3">
                        <p class="m-0 mb-1"><b>{{ $post->channel_id->name }} &#183</b> <span class="text-muted">Posted by </span><span class="text-primary text-bold">{{ $post->user_id->name }}</span></p>
                        <h5 class="m-0">{{ $post->title }}</h5>
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
