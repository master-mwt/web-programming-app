@extends('layouts.exskel')

@section('content')
<div class="container p-0">
    <div class="row justify-content-center">

        <div class="col-md-12 text-center infinite-scroll px-0">
        @forelse($mycomments as $comment)
            <div id="comment-{{$comment->id}}" class="card col-lg-10 mx-auto d-flex flex-row px-0" style="max-width: 800px">
                <div class="rounded-left py-3 d-flex flex-column" style="flex: 0 0 50px; background-color: #ddd">
                    @if($comment->reply_id->upvoted == 'Upvote')
                        <a id="reply-{{ $comment->reply_id->id }}-upvote" href="{{ route('reply.upvote', $comment->reply_id) }}" class="replyupvote"><i class="fas fa-arrow-up mb-1"></i></a>
                    @elseif($comment->reply_id->upvoted == 'Unupvote')
                        <a id="reply-{{ $comment->reply_id->id }}-upvote" href="{{ route('reply.upvote', $comment->reply_id) }}" class="text-danger replyupvote"><i class="fas fa-arrow-up mb-1"></i></a>
                    @else
                        <a href="{{ route('login') }}" class=""><i class="fas fa-arrow-up mb-1"></i></a>
                    @endif
                    @if($comment->reply_id->upvoted == 'Unupvote' or $comment->reply_id->downvoted == 'Undownvote')
                        <span id="reply-{{ $comment->reply_id->id }}-votenumber" class="my-1 text-danger text-bold votenumber">{{ $comment->reply_id->upvote - $comment->reply_id->downvote }}</span>
                    @else
                        <span id="reply-{{ $comment->reply_id->id }}-votenumber" class="my-1 text-dark text-bold votenumber">{{ $comment->reply_id->upvote - $comment->reply_id->downvote }}</span>
                    @endif
                    @if($comment->reply_id->downvoted == 'Downvote')
                        <a id="reply-{{ $comment->reply_id->id }}-downvote" href="{{ route('reply.downvote', $comment->reply_id) }}" class="replydownvote"><i class="fas fa-arrow-down"></i></a>
                    @elseif($comment->reply_id->downvoted == 'Undownvote')
                        <a id="reply-{{ $comment->reply_id->id }}-downvote" href="{{ route('reply.downvote', $comment->reply_id) }}" class="text-danger replydownvote"><i class="fas fa-arrow-down"></i></a>
                    @else
                        <a href="{{ route('login') }}" class=""><i class="fas fa-arrow-down"></i></a>
                    @endif
                </div>
                <div class="col p-0 d-flex flex-column overflow-auto">
                    <div class="card-header text-left border-0 px-3">
                        <p class="m-0 mb-1">
                            <a href="{{ route('discover.channel', $comment->channel_id->id) }}" class="text-decoration-none"><b>{{ $comment->channel_id->name }} &#183</b></a>
                            <span class="text-muted">Reply posted by </span>
                            <a href="{{route('discover.user', $comment->reply_id->user_id->id) }}" class="text-decoration-none">{{ $comment->reply_id->user_id->name }}</a>
                        </p>
                    </div>
                    <a href="#content-collapse-{{$comment->reply_id->id}}" role="button" class="text-decoration-none px-3 py-2 btn btn-sm btn-block btn-outline-secondary" data-toggle="collapse"><i class="fas fa-eye mr-2"></i>See Reply Content</a>

                    <div class="card-body text-left px-3 py-1 collapse" id="content-collapse-{{$comment->reply_id->id}}">
                        <div class="markdown-content" data-markdown-content="{{ $comment->reply_id->content }}"></div>
                    </div>
                    <div class="card-footer border-0 p-1 px-3 text-left" style="border-bottom-left-radius: 0px">

                        <a href="{{route('discover.post', $comment->reply_id->post_id->id)}}" class="text-decoration-none"><i class="fas fa-link mr-2"></i>See the Original Post</a>

                        <a href="@guest {{route('login')}} @else {{ route('comment.delete', $comment) }} @endguest" class="text-decoration-none mr-2 text-danger commentdelete float-right"><i class="fa fa-exclamation-triangle"></i> Delete Comment</a>

                    </div>
                    <div class="pl-2 pr-2 pt-2">
                        <div class="card col-lg-10 mx-auto d-flex flex-row px-0 m-0 border-0 mb-2" style="max-width: 800px">
                            <div class="w-100">
                                <div class="card-header text-left border-0 px-3">
                                    <p class="m-0 mb-1">
                                        <span class="text-muted">Posted by </span>
                                        <a href="{{ route('discover.user', $comment->user_id->id) }}" class="text-decoration-none">{{ $comment->user_id->name }}</a>
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
        @empty
            <img src="{{ URL::asset('/imgs/no_res_2.png') }}" alt="" class="rounded my-4" width="350px">
            <h2 class="text-primary">no results ...</h2>
        @endforelse
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
