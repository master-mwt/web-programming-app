@extends('layouts.exskel')

@section('content')
<div class="container p-0">
    <div class="row justify-content-center">

        <div class="col-md-12 text-center infinite-scroll px-0">
        @foreach($myreplies as $reply)
            <div class="card col-lg-10 mx-auto d-flex flex-row px-0" style="max-width: 800px">
                <div class="rounded-left py-3 d-flex flex-column" style="flex: 0 0 50px; background-color: #ddd">
                    @if($reply->upvoted == 'Upvote')
                        <a id="reply-{{ $reply->id }}-upvote" href="{{ route('reply.upvote', $reply) }}" class="replyupvote"><i class="fas fa-arrow-up mb-1"></i></a>
                    @elseif($reply->upvoted == 'Unupvote')
                        <a id="reply-{{ $reply->id }}-upvote" href="{{ route('reply.upvote', $reply) }}" class="text-success replyupvote"><i class="fas fa-arrow-up mb-1"></i></a>
                    @else
                        <a href="{{ route('login') }}" class=""><i class="fas fa-arrow-up mb-1"></i></a>
                    @endif
                    @if($reply->upvoted == 'Unupvote' or $reply->downvoted == 'Undownvote')
                        <span id="reply-{{ $reply->id }}-votenumber" class="my-1 text-success text-bold votenumber">{{ $reply->upvote - $reply->downvote }}</span>
                    @else
                        <span id="reply-{{ $reply->id }}-votenumber" class="my-1 text-dark text-bold votenumber">{{ $reply->upvote - $reply->downvote }}</span>
                    @endif
                    @if($reply->downvoted == 'Downvote')
                        <a id="reply-{{ $reply->id }}-downvote" href="{{ route('reply.downvote', $reply) }}" class="replydownvote"><i class="fas fa-arrow-down"></i></a>
                    @elseif($reply->downvoted == 'Undownvote')
                        <a id="reply-{{ $reply->id }}-downvote" href="{{ route('reply.downvote', $reply) }}" class="text-success replydownvote"><i class="fas fa-arrow-down"></i></a>
                    @else
                        <a href="{{ route('login') }}" class=""><i class="fas fa-arrow-down"></i></a>
                    @endif
                </div>
                <div class="w-100">
                    <div class="card-header text-left border-0 px-3">
                        <p class="m-0 mb-1">
                            <a href="{{ route('discover.channel', $reply->channel_id->id) }}" class="text-decoration-none"><b>{{ $reply->channel_id->name }} &#183</b></a>
                            <span class="text-muted">Posted by </span>
                            <span class="text-primary">{{ $reply->user_id->name }}</span>
                        </p>
                    </div>
                    <div class="card-body text-left px-3 py-1">
                        <div class="markdown-content" data-markdown-content="{{ $reply->content }}"></div>
                    </div>
                    <div class="card-footer border-0 p-1 px-3 text-left" style="border-bottom-left-radius: 0px">

                        <a href="{{route('discover.post', $reply->post_id->id)}}" class="text-decoration-none"><i class="fas fa-link mr-2"></i>See the Original Post</a>

                        @if(count($reply->comments) == 0)
                        @else
                        <a href="#comment-collapse-{{$reply->id}}" class="text-decoration-none float-right" data-toggle="collapse"><i class="fas fa-eye mr-2"></i>See Comments</a>
                        @endif

                    </div>
                    @if(count($reply->comments) == 0)
                    @else
                    <div class="pl-2 pr-2 pt-2 collapse" id="comment-collapse-{{$reply->id}}">
                        @forelse($reply->comments as $comment)
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
                        @empty
                        @endforelse
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
        {{ $myreplies->links() }}
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
