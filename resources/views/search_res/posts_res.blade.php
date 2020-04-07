@extends('layouts.exskel')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">

        <div class="col-md-12 text-center infinite-scroll px-0">
        @foreach($posts as $post)
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
                <div class="w-100">
                    <div class="card-header text-left bg-transparent border-0 px-3">
                        <p class="m-0 mb-1">
                            <a href="{{ route('discover.channel', $post->channel_id->id) }}" class="text-decoration-none"><b>{{ $post->channel_id->name }} &#183</b></a> <span class="text-muted">Posted by </span>
                            <a href="" class="text-decoration-none">{{ $post->user_id->name }}</a>
                        </p>
                        <h5 class="m-0 mb-2"><a href="{{ route('discover.post', $post->id) }}" class="text-decoration-none">{{ $post->title }}</a></h5>
                        @foreach($post->tags as $tag)
                            <span class="badge badge-pill" style="font-size: 11px; background-color: #ddd">{{$tag->tag_id->name}}</span>
                        @endforeach
                    </div>
                    <div class="card-footer border-0 p-1 px-3 text-left" style="border-bottom-left-radius: 0px">
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
                debug: true,
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
