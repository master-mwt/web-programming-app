@extends('layouts.exskel')

@section('content')
<div class="container p-0">
    <div class="row justify-content-center">
            
        <div class="col-md-12 text-center infinite-scroll px-0">
        @foreach($mycomments as $comment)
            <div class="card col-lg-10 mx-auto d-flex flex-row px-0" style="max-width: 800px">
                <div class="rounded-left py-3 d-flex flex-column" style="flex: 0 0 50px; background-color: #ddd">
                    <a href="" class=""><i class="fas fa-arrow-up mb-1"></i></a>
                    <span class="my-1 text-dark text-bold">{{ $comment->reply_id->upvote - $comment->reply_id->downvote }}</span>
                    <a href="" class=""><i class="fas fa-arrow-down"></i></a>
                </div>
                <div class="w-100">
                    <div class="card-header text-left border-0 px-3">
                        <p class="m-0 mb-1">
                            <a href="{{ route('discover.channel', $comment->channel_id->id) }}" class="text-decoration-none"><b>{{ $comment->channel_id->name }} &#183</b></a>
                            <span class="text-muted">Posted by </span>
                            <span class="text-primary">{{ $comment->user_id->name }}</span>
                        </p>
                    </div>
                    <div class="card-body text-left px-3 py-1">
                        <div class="markdown-content" data-markdown-content="{{ $comment->reply_id->content }}"></div>
                    </div>
                    <div class="card-footer border-0 p-1 px-3 text-left" style="border-bottom-left-radius: 0px">
                        
                        <a href="{{route('discover.post', $comment->reply_id->post_id->id)}}" class="text-decoration-none"><i class="fas fa-link mr-2"></i>See the Original Post</a>
                        
                    </div>
                    <div class="pl-2 pr-2 pt-2">
                        <div class="card col-lg-10 mx-auto d-flex flex-row px-0 m-0 border-0 mb-2" style="max-width: 800px">
                            <div class="w-100">
                                <div class="card-header text-left border-0 px-3">
                                    <p class="m-0 mb-1">
                                        <span class="text-muted">Posted by </span>
                                        <a href="" class="text-decoration-none">{{ $comment->user_id->name }}</a>
                                    </p>
                                </div>
                                <div class="card-body text-left px-3 py-1">
                                    <p>{{ $comment->content }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $mycomments->links() }}
        </div>

    </div>
</div>

<!-- JScroll func -->
<script type="text/javascript">
    $('ul.pagination').hide();
    $(function() {
        $('document').ready(function() {
            $('.markdown-content').each(function(){
                let markdown_content = $(this).data('markdown-content');
                $(this).html(marked(markdown_content));
            });
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<div class="spinner-grow text-primary" role="status"><span class="sr-only">loading...</span></div>',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                    // Marked markdown parser func
                    // maybe remove document ready
                    $(document).ready(function(){
                        $('.markdown-content').each(function(){
                            let markdown_content = $(this).data('markdown-content');
                            $(this).html(marked(markdown_content));
                        });
                    });
                }
            }); 
        });
    });
</script>

@endsection