@extends('layouts.exskel')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">

        <a role="button" href="{{ route('discover.channel', $channel->id) }}" class="btn btn-dark mb-4"><i class="fas fa-arrow-left mr-2"></i> back to channel {{$channel->name}}</a>

        <div class="col-md-12 text-center infinite-scroll px-0">
        @forelse($posts as $post)
            <div id="post-{{$post->post_id->id}}" class="card col-lg-10 mx-auto d-flex flex-row px-0" style="max-width: 800px">
                <div class="rounded-left py-3 d-flex flex-column" style="flex: 0 0 50px; background-color: #222">
                    @if($post->upvoted == 'Upvote')
                        <a id="post-{{ $post->post_id->id }}-upvote" href="{{ route('post.upvote', $post->post_id) }}" class="upvote"><i class="fas fa-arrow-up mb-1"></i></a>
                    @elseif($post->upvoted == 'Unupvote')
                        <a id="post-{{ $post->post_id->id }}-upvote" href="{{ route('post.upvote', $post->post_id) }}" class="text-warning upvote"><i class="fas fa-arrow-up mb-1"></i></a>
                    @else
                        <a href="{{ route('login') }}" class=""><i class="fas fa-arrow-up mb-1"></i></a>
                    @endif
                    @if($post->upvoted == 'Unupvote' or $post->downvoted == 'Undownvote')
                        <span id="post-{{ $post->post_id->id }}-votenumber" class="my-1 text-warning votenumber">{{ $post->post_id->upvote - $post->post_id->downvote }}</span>
                    @else
                        <span id="post-{{ $post->post_id->id }}-votenumber" class="my-1 text-light votenumber">{{ $post->post_id->upvote - $post->post_id->downvote }}</span>
                    @endif
                    @if($post->downvoted == 'Downvote')
                        <a id="post-{{ $post->post_id->id }}-downvote" href="{{ route('post.downvote', $post->post_id) }}" class="downvote"><i class="fas fa-arrow-down"></i></a>
                    @elseif($post->downvoted == 'Undownvote')
                        <a id="post-{{ $post->post_id->id }}-downvote" href="{{ route('post.downvote', $post->post_id) }}" class="text-warning downvote"><i class="fas fa-arrow-down"></i></a>
                    @else
                        <a href="{{ route('login') }}" class=""><i class="fas fa-arrow-down"></i></a>
                    @endif
                </div>
                <div class="col p-0 d-flex flex-column overflow-auto">
                    <div class="card-header text-left border-0 px-3">
                        <p class="m-0 mb-1">
                            <a href="{{ route('discover.channel', $post->channel_id->id) }}" class="text-decoration-none"><b>{{ $post->channel_id->name }} &#183</b></a> <span class="text-muted">Posted by </span>
                            <a href="{{ route('discover.user', $post->user_id->id) }}" class="text-decoration-none">{{ $post->user_id->name }}</a>
                            <span class="ml-2 badge badge-pill badge-danger">{{$post->counter}} reports</span>
                        </p>
                        <h5 class="m-0 mb-1"><a href="{{ route('discover.post', $post->post_id->id) }}" class="text-decoration-none">{{ $post->post_id->title }}</a></h5>
                    </div>
                    <a href="#content-collapse-{{$post->post_id->id}}" role="button" class="text-decoration-none px-3 py-2 btn btn-sm btn-block btn-outline-secondary" data-toggle="collapse"><i class="fas fa-eye mr-2"></i>See Post Content</a>

                    <div class="card-body text-left px-3 py-1 collapse mb-1" id="content-collapse-{{$post->post_id->id}}">
                        <div class="markdown-content" data-markdown-content="{{ $post->post_id->content }}"></div>
                        @foreach($post->tags as $tag)
                            <a href="{{ route('search', ['target' => 'tags', 'query' => $tag->tag_id->name]) }}"><span class="badge badge-pill" style="font-size: 11px; background-color: #ddd">{{$tag->tag_id->name}}</span></a>
                        @endforeach
                    </div>
                    <div class="card-footer border-0 p-1 px-3 text-left" style="border-bottom-left-radius: 0px">
                    <!-- <a href="@guest {{route('login')}} @else # @endguest" class="text-decoration-none mr-2"><i class="fas fa-crown mr-1"></i>Give Award</a> -->
                        @if($post->saved == 'Save')
                            <a id="post-{{ $post->post_id->id }}-save" href="@guest {{route('login')}} @else {{ route('post.save', $post->post_id) }} @endguest" class="text-decoration-none mr-2 save"><i id="post-{{ $post->post_id->id }}-save-icon" class="far fa-bookmark mr-1"></i>Save</a>
                        @elseif($post->saved == 'Unsave')
                            <a id="post-{{ $post->post_id->id }}-save" href="@guest {{route('login')}} @else {{ route('post.save', $post->post_id) }} @endguest" class="text-decoration-none mr-2 text-danger save"><i id="post-{{ $post->post_id->id }}-save-icon" class="fas fa-bookmark mr-1"></i>Unsave</a>
                        @else
                            <a href="{{route('login')}}" class="text-decoration-none mr-2"><i class="far fa-bookmark mr-1"></i>Save</a>
                        @endif
                        @if($post->hidden == 'Hide')
                            <a id="post-{{ $post->post_id->id }}-hide" href="@guest {{route('login')}} @else {{ route('post.hide', $post->post_id) }} @endguest" class="text-decoration-none mr-2 hide"><i id="post-{{ $post->post_id->id }}-hide-icon" class="far fa-eye-slash mr-1"></i>Hide</a>
                        @elseif($post->hidden == 'Unhide')
                            <a id="post-{{ $post->post_id->id }}-hide" href="@guest {{route('login')}} @else {{ route('post.hide', $post->post_id) }} @endguest" class="text-decoration-none mr-2 text-danger hide"><i id="post-{{ $post->post_id->id }}-hide-icon" class="fas fa-eye-slash mr-1"></i>Unhide</a>
                        @else
                            <a href="{{route('login')}}" class="text-decoration-none mr-2"><i class="far fa-eye-slash mr-1"></i>Hide</a>
                        @endif
                        <a href="{{route('post.globalunreport', $post->post_id)}}" class="float-right text-decoration-none text-danger mr-2"><i class="fas fa-flag-checkered mr-1"></i>Globally Unreport</a>
                        <a href="{{route('post.delete', $post->post_id)}}" class="float-right text-decoration-none text-danger mr-2 delete"><i class="fas fa-exclamation-triangle mr-1"></i>Delete</a>
                    </div>
                </div>
            </div>
        @empty
            <img src="{{ URL::asset('/imgs/no_res_2.png') }}" alt="" class="rounded my-4" width="350px">
            <h2 class="text-primary">no results ...</h2>
        @endforelse
        {{--{{ $posts->links() }}--}}
        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.markdown-content').each(function(){
            let markdown_content = $(this).data('markdown-content');
            $(this).html(marked(markdown_content));
        });
    });
</script>

<!-- JScroll func -->
{{--<script type="text/javascript">
    $('ul.pagination').hide();
    $(function() {
        $('document').ready(function() {
            $('.markdown-content').each(function(){
                let markdown_content = $(this).data('markdown-content');
                $(this).html(marked(markdown_content));
            });
            $('.infinite-scroll').jscroll({
                debug: true,
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
</script>--}}
@endsection
