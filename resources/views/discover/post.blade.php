@extends('layouts.exskel')

@section('content')

<div class="container p-0">
    <div class="row justify-content-center">

        <div class="col-md-12 text-center px-0">
            <div class="card col-lg-10 mx-auto d-flex flex-row px-0" style="max-width: 800px">
                <div class="rounded-left py-3 d-flex flex-column" style="flex: 0 0 50px; background-color: #222">
                    @if($post->upvoted == 'Upvote')
                        <a id="post-{{ $post->id }}-upvote" href="{{ route('post.upvote', $post) }}" class="upvote"><i class="fas fa-arrow-up mb-1"></i></a>
                    @elseif($post->upvoted == 'Unupvote')
                        <a id="post-{{ $post->id }}-upvote" href="{{ route('post.upvote', $post) }}" class="text-warning upvote"><i class="fas fa-arrow-up mb-1"></i></a>
                    @else
                        <a href="{{ route('login') }}" class=""><i class="fas fa-arrow-up mb-1"></i></a>
                    @endif
                    @if($post->upvoted == 'Unupvote' or $post->downvoted == 'Undownvote')
                        <span id="post-{{ $post->id }}-votenumber" class="my-1 text-warning votenumber">{{ $post->upvote - $post->downvote }}</span>
                    @else
                        <span id="post-{{ $post->id }}-votenumber" class="my-1 text-light votenumber">{{ $post->upvote - $post->downvote }}</span>
                    @endif
                    @if($post->downvoted == 'Downvote')
                        <a id="post-{{ $post->id }}-downvote" href="{{ route('post.downvote', $post) }}" class="downvote"><i class="fas fa-arrow-down"></i></a>
                    @elseif($post->downvoted == 'Undownvote')
                        <a id="post-{{ $post->id }}-downvote" href="{{ route('post.downvote', $post) }}" class="text-warning downvote"><i class="fas fa-arrow-down"></i></a>
                    @else
                        <a href="{{ route('login') }}" class=""><i class="fas fa-arrow-down"></i></a>
                    @endif
                </div>
                <div class="col p-0 d-flex flex-column overflow-auto">
                    <div class="card-header text-left bg-transparent border-0 px-3">
                        <p class="m-0 mb-1">
                            <a href="{{ route('discover.channel', $post->channel_id->id) }}" class="text-decoration-none"><b>{{ $post->channel_id->name }} &#183</b></a> <span class="text-muted">Posted by </span>
                            <a href="" class="text-decoration-none">{{ $post->user_id->name }}</a>
                        </p>
                        <h5 class="m-0"><a href="{{ route('discover.post', $post->id) }}" class="text-decoration-none">{{ $post->title }}</a></h5>
                    </div>
                    <div class="card-body text-left px-3 py-1">
                        <div class="markdown-content" data-markdown-content="{{ $post->content }}"></div>
                        @foreach($post->tags as $tag)
                            <span class="badge badge-pill" style="font-size: 11px; background-color: #ddd">{{$tag->tag_id->name}}</span>
                        @endforeach
                    </div>
                    <div class="card-footer border-0 p-1 px-3 text-left mt-1" style="border-bottom-left-radius: 0px">
                    <!-- <a href="@guest {{route('login')}} @else # @endguest" class="text-decoration-none mr-2"><i class="fas fa-crown mr-1"></i>Give Award</a> -->
                        @if($post->saved == 'Save')
                            <a id="post-{{ $post->id }}-save" href="@guest {{route('login')}} @else {{ route('post.save', $post) }} @endguest" class="text-decoration-none mr-2 save"><i id="post-{{ $post->id }}-save-icon" class="far fa-bookmark mr-1"></i>Save</a>
                        @elseif($post->saved == 'Unsave')
                            <a id="post-{{ $post->id }}-save" href="@guest {{route('login')}} @else {{ route('post.save', $post) }} @endguest" class="text-decoration-none mr-2 text-danger save"><i id="post-{{ $post->id }}-save-icon" class="fas fa-bookmark mr-1"></i>Unsave</a>
                        @else
                            <a id="post-{{ $post->id }}-save" href="@guest {{route('login')}} @else {{ route('post.save', $post) }} @endguest" class="text-decoration-none mr-2 save"><i id="post-{{ $post->id }}-save-icon" class="far fa-bookmark mr-1"></i>Save</a>
                        @endif
                        @if($post->hidden == 'Hide')
                            <a id="post-{{ $post->id }}-hide" href="@guest {{route('login')}} @else {{ route('post.hide', $post) }} @endguest" class="text-decoration-none mr-2 hide"><i id="post-{{ $post->id }}-hide-icon" class="far fa-eye-slash mr-1"></i>Hide</a>
                        @elseif($post->hidden == 'Unhide')
                            <a id="post-{{ $post->id }}-hide" href="@guest {{route('login')}} @else {{ route('post.hide', $post) }} @endguest" class="text-decoration-none mr-2 text-danger hide"><i id="post-{{ $post->id }}-hide-icon" class="fas fa-eye-slash mr-1"></i>Unhide</a>
                        @else
                            <a id="post-{{ $post->id }}-hide" href="@guest {{route('login')}} @else {{ route('post.hide', $post) }} @endguest" class="text-decoration-none mr-2 hide"><i id="post-{{ $post->id }}-hide-icon" class="far fa-eye-slash mr-1"></i>Hide</a>
                        @endif
                        @if($post->reported == 'Report')
                            <a id="post-{{ $post->id }}-report" href="@guest {{route('login')}} @else {{ route('post.report', $post) }} @endguest" class="text-decoration-none report"><i id="post-{{ $post->id }}-report-icon" class="far fa-flag mr-1"></i>Report</a>
                        @elseif($post->reported == 'Unreport')
                            <a id="post-{{ $post->id }}-report" href="@guest {{route('login')}} @else {{ route('post.report', $post) }} @endguest" class="text-decoration-none text-danger report"><i id="post-{{ $post->id }}-report-icon" class="fas fa-flag mr-1"></i>Unreport</a>
                        @else
                            <a id="post-{{ $post->id }}-report" href="@guest {{route('login')}} @else {{ route('post.report', $post) }} @endguest" class="text-decoration-none report"><i id="post-{{ $post->id }}-report-icon" class="far fa-flag mr-1"></i>Report</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @auth
            <div class="col-md-12 text-center px-0 mb-3" style="max-width: 800px">
                <button class="btn btn-success btn-block" data-toggle="modal" data-target="#easymde-modal-reply">Make a Reply</button>
            </div>
        @else
            <div class="col-md-12 text-center px-0 mb-3" style="max-width: 800px">
                <a role="button" href="{{ route('login') }}" class="btn btn-success btn-block text-light">Make a Reply</a>
            </div>
        @endauth

        <div class="col-md-12 text-center infinite-scroll px-0">
        @foreach($replies as $reply)
            <div class="card col-lg-10 mx-auto d-flex flex-row px-0" style="max-width: 800px">
                <div class="rounded-left py-3 d-flex flex-column" style="flex: 0 0 50px; background-color: #ddd">
                    @if($reply->upvoted == 'Upvote')
                        <a id="reply-{{ $reply->id }}-upvote" href="{{ route('reply.upvote', $reply) }}" class="replyupvote"><i class="fas fa-arrow-up mb-1"></i></a>
                    @elseif($reply->upvoted == 'Unupvote')
                        <a id="reply-{{ $reply->id }}-upvote" href="{{ route('reply.upvote', $reply) }}" class="text-danger replyupvote"><i class="fas fa-arrow-up mb-1"></i></a>
                    @else
                        <a href="{{ route('login') }}" class=""><i class="fas fa-arrow-up mb-1"></i></a>
                    @endif
                    @if($reply->upvoted == 'Unupvote' or $reply->downvoted == 'Undownvote')
                        <span id="reply-{{ $reply->id }}-votenumber" class="my-1 text-danger text-bold votenumber">{{ $reply->upvote - $reply->downvote }}</span>
                    @else
                        <span id="reply-{{ $reply->id }}-votenumber" class="my-1 text-dark text-bold votenumber">{{ $reply->upvote - $reply->downvote }}</span>
                    @endif
                    @if($reply->downvoted == 'Downvote')
                        <a id="reply-{{ $reply->id }}-downvote" href="{{ route('reply.downvote', $reply) }}" class="replydownvote"><i class="fas fa-arrow-down"></i></a>
                    @elseif($reply->downvoted == 'Undownvote')
                        <a id="reply-{{ $reply->id }}-downvote" href="{{ route('reply.downvote', $reply) }}" class="text-danger replydownvote"><i class="fas fa-arrow-down"></i></a>
                    @else
                        <a href="{{ route('login') }}" class=""><i class="fas fa-arrow-down"></i></a>
                    @endif
                </div>
                <div class="col p-0 d-flex flex-column overflow-auto">
                    <div class="card-header text-left border-0 px-3">
                        <p class="m-0 mb-1">
                            <span class="text-muted">Posted by </span>
                            <a href="" class="text-decoration-none">{{ $reply->user_id->name }}</a>
                        </p>
                    </div>
                    <div class="card-body text-left px-3 py-1">
                        <div class="markdown-content" data-markdown-content="{{ $reply->content }}"></div>
                    </div>
                    <div class="card-footer border-0 p-1 px-3 text-left" style="border-bottom-left-radius: 0px">
                        <form action="/comments" method="post">
                        @csrf
                            <div class="d-flex flex-column py-2 pt-3">
                                {{ Form::hidden('channel_id', $post->channel_id->id) }}
                                {{ Form::hidden('reply_id', $reply->id) }}
                                {{ Form::hidden('post_id', $post->id) }}
                                <textarea name="content" id="area-comment" cols="" rows="3" class="border-0 w-100 rounded-top p-2 m-0" placeholder="Write your message here ..." style="background-color: #ddd"></textarea>

                                <div class="rounded-bottom p-1 m-0" style="background-color: #ccc;">
                                    <button class="btn btn-sm btn-success btn-block">Make a Comment</button>
                                </div>
                            </div>
                        </form>

                        <!-- @auth
                            <a href="" class="text-decoration-none mr-2" data-toggle="modal" data-target="#modal-comment"><i class="fas fa-comment-alt mr-2"></i>Make a Comment</a>
                        @endauth -->

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
                                        <div class="markdown-content" data-markdown-content="{{ $comment->content }}"></div>
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
        {{ $replies->links() }}
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

@auth
    <form action="/replies" method="post">
        @csrf

        <div class="modal fade" id="easymde-modal-reply" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="easymde-modal-reply-label" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-auto" id="easymde-modal-reply-label">make a reply</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ Form::hidden('channel_id', $post->channel_id->id) }}
                        {{ Form::hidden('post_id', $post->id) }}
                        <textarea name="content" id="easymde-area-reply" cols="" rows=""></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary">submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endauth

<!-- @auth
    <form action="/replies" method="post">
        @csrf

        <div class="modal fade" id="modal-comment" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-comment-label" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-auto" id="modal-comment-label">make a comment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ Form::hidden('channel_id', $post->channel_id->id) }}
                        <textarea name="content" id="area-comment" cols="" rows="10" class="w-100 rounded p-2 m-0" placeholder="Write your comment here..."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary">submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endauth -->

<script type="text/javascript">

    //easymde-area-reply [easymde-modal-reply]
    new EasyMDE({
        autoDownloadFontAwesome: false,
        indentWithTabs: true,
        lineWrapping: true,
        minHeight: "400px",
        //showIcons: ['strikethrough', 'code', 'table', 'redo', 'heading', 'undo', 'heading-bigger', 'heading-smaller', 'heading-1', 'heading-2', 'heading-3', 'clean-block', 'horizontal-rule'],
        showIcons: ['strikethrough', 'code', 'table', 'redo', 'heading', 'undo', 'heading-bigger', 'heading-smaller', 'clean-block', 'horizontal-rule'],
        element: document.getElementById('easymde-area-reply'),
        initialValue: '',
        //TODO: insertTexts (horizontalRule, link, IMAGE, table) customize how buttons that insert text behave
        //<img src="" width="" heigth=""> instead of ![](https://)
        uploadImage: true,
        imageMaxSize: "4000x4000x2",
        imageAccept: "image/png, image/jpg",
    });

</script>

@endsection
