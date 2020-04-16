@extends('layouts.exskel')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">
        <div class="col-md-12 text-center px-0">
            <div class="card bg-dark col-lg-10 mx-auto d-flex flex-column px-0" style="max-width: 800px">
                <div class="col card-header border-0 px-3 d-flex flex-row" style="align-items: center">
                    <img src="@if(is_null($channel->image)) {{ URL::asset('/imgs/no_channel_img.jpg') }} @else {{$channel->image->location}} @endif" alt="" width="50px" height="50px" class="rounded">
                    <h2 class="m-0 ml-3">{{ $channel->name }}</h2>
                    @if(!is_null($channel->member))
                        <h5 class="m-0 ml-3 text-muted">Subscribed as <span class="text-uppercase text-warning">{{$channel->member->role_id->name}}</span></h5>
                    @endif
                    @if($channel->joined == 'Join' && !(\Illuminate\Support\Facades\Auth::user()->group_id == 1))
                        <button onclick="location.href='{{ route('channel.join', $channel) }}'" class="btn btn btn-outline-light ml-auto"><strong>JOIN</strong></button>
                    @elseif($channel->joined == 'Leave' && $channel->member->role_id->name == 'creator')
                        <button class="btn btn btn-outline-danger ml-auto" data-toggle="modal" data-target="#delete-modal"><strong>DELETE CHANNEL</strong></button>
                    @elseif($channel->joined == 'Leave')
                        <button onclick="location.href='{{ route('channel.leave', $channel) }}'" class="btn btn btn-outline-warning ml-auto"><strong>LEAVE</strong></button>
                    @else
                    @endif
                </div>
                <div class="card-body text-left px-3 py-2">
                    <h5 class="text-muted">Description</h5>
                    <p class="">{{ $channel->description }}</p>
                    <h5 class="text-muted">Rules</h5>
                    <p class="">{{ $channel->rules }}</p>
                </div>
                @if(!is_null($channel->member) || \Illuminate\Support\Facades\Auth::user()->group_id == 1)
                <div class="card-footer">
                    <a role="button" href="{{ route('discover.channel.members', $channel->id) }}" class="btn btn-sm btn-info float-right">Members</a>
                    @if($channel->member->role_id->name != 'member')
                        <a role="button" href="{{ route('discover.channel.reported_posts', $channel->id) }}" class="btn btn-sm btn-info float-right mr-2">Reported Posts</a>
                    @endif
                    @if($channel->member->role_id->name != 'member' && $channel->member->role_id->name != 'moderator')
                        <a role="button" href="{{ route('discover.channel.banned_users', $channel->id) }}" class="btn btn-sm btn-info float-right mr-2">Banned Users</a>
                    @endif
                </div>
                @endif
            </div>
        </div>

        @auth
            <div class="col-md-12 text-center px-0 mb-3" style="max-width: 800px">
                <button class="btn btn-success btn-block" data-toggle="modal" data-target="#easymde-modal">Make a Post</button>
            </div>
        @else
            <div class="col-md-12 text-center px-0 mb-3" style="max-width: 800px">
                <a role="button" href="{{ route('login') }}" class="btn btn-success btn-block text-light">Make a Post</a>
            </div>
        @endauth

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
                <div class="col p-0 d-flex flex-column overflow-auto">
                    <div class="card-header text-left border-0 px-3">
                        <p class="m-0 mb-1">
                            <span class="text-muted">Posted by </span>
                            <a href="{{ route('discover.user', $post->user_id->id) }}" class="text-decoration-none">{{ $post->user_id->name }}</a>
                        </p>
                        <h5 class="m-0"><a href="{{ route('discover.post', $post->id) }}" class="text-decoration-none">{{ $post->title }}</a></h5>
                    </div>
                    <div class="card-body text-left px-3 py-1">
                        <div class="markdown-content" data-markdown-content="{{ $post->content }}"></div>
                        @foreach($post->tags as $tag)
                            <a href="{{ route('search', ['target' => 'tags', 'query' => $tag->tag_id->name]) }}"><span class="badge badge-pill" style="font-size: 11px; background-color: #ddd">{{$tag->tag_id->name}}</span></a>
                        @endforeach
                    </div>
                    <div class="card-footer border-0 p-1 px-3 text-left mt-1" style="border-bottom-left-radius: 0px">
                    <!-- <a href="@guest {{route('login')}} @else # @endguest" class="text-decoration-none mr-2"><i class="fas fa-crown mr-1"></i>Give Award</a> -->
                        @if($post->saved == 'Save')
                            <a id="post-{{ $post->id }}-save" href="@guest {{route('login')}} @else {{ route('post.save', $post) }} @endguest" class="text-decoration-none mr-2 save"><i id="post-{{ $post->id }}-save-icon" class="far fa-bookmark mr-1"></i>Save</a>
                        @elseif($post->saved == 'Unsave')
                            <a id="post-{{ $post->id }}-save" href="@guest {{route('login')}} @else {{ route('post.save', $post) }} @endguest" class="text-decoration-none mr-2 text-danger save"><i id="post-{{ $post->id }}-save-icon" class="fas fa-bookmark mr-1"></i>Unsave</a>
                        @else
                            <a href="{{route('login')}}" class="text-decoration-none mr-2"><i class="far fa-bookmark mr-1"></i>Save</a>
                        @endif
                        @if($post->hidden == 'Hide')
                            <a id="post-{{ $post->id }}-hide" href="@guest {{route('login')}} @else {{ route('post.hide', $post) }} @endguest" class="text-decoration-none mr-2 hide"><i id="post-{{ $post->id }}-hide-icon" class="far fa-eye-slash mr-1"></i>Hide</a>
                        @elseif($post->hidden == 'Unhide')
                            <a id="post-{{ $post->id }}-hide" href="@guest {{route('login')}} @else {{ route('post.hide', $post) }} @endguest" class="text-decoration-none mr-2 text-danger hide"><i id="post-{{ $post->id }}-hide-icon" class="fas fa-eye-slash mr-1"></i>Unhide</a>
                        @else
                            <a href="{{route('login')}}" class="text-decoration-none mr-2"><i class="far fa-eye-slash mr-1"></i>Hide</a>
                        @endif
                        @if($post->reported == 'Report')
                            <a id="post-{{ $post->id }}-report" href="@guest {{route('login')}} @else {{ route('post.report', $post) }} @endguest" class="text-decoration-none mr-2 report"><i id="post-{{ $post->id }}-report-icon" class="far fa-flag mr-1"></i>Report Post</a>
                        @elseif($post->reported == 'Unreport')
                            <a id="post-{{ $post->id }}-report" href="@guest {{route('login')}} @else {{ route('post.report', $post) }} @endguest" class="text-decoration-none mr-2 text-danger report"><i id="post-{{ $post->id }}-report-icon" class="fas fa-flag mr-1"></i>Unreport Post</a>
                        @else
                            <a href="{{route('login')}}" class="text-decoration-none mr-2"><i class="far fa-flag mr-1"></i>Report Post</a>
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
    <form action="/posts" method="post">
        @csrf

        <div class="modal fade" id="easymde-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="easymde-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-auto" id="easymde-modal-label">make a post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- MODAL CONTENT -->
                        <!-- TODO: VALIDATION AND ERROR CONTROL -->
                        <input name="title" type="text" class="form-control mb-3" id="title" placeholder="Title">
                        {{ Form::hidden('channel_id', $channel->id) }}
                        <textarea name="content" id="easymde-area" cols="" rows=""></textarea>
                        <!-- / MODAL CONTENT -->
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary">submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endauth

@auth
    <form action="{{route('channel.delete', $channel)}}" method="post">
        @csrf
        @method('delete')

        <div class="modal fade" id="delete-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-auto" id="delete-modal-label">delete channel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- MODAL CONTENT -->
                        <h1 class="text-center text-danger">WARNING: This action is irreversible</h1>
                        <!-- / MODAL CONTENT -->
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endauth

@auth
    <script type="text/javascript">
        new EasyMDE({
            autoDownloadFontAwesome: false,
            indentWithTabs: true,
            lineWrapping: true,
            minHeight: "400px",
            //showIcons: ['strikethrough', 'code', 'table', 'redo', 'heading', 'undo', 'heading-bigger', 'heading-smaller', 'heading-1', 'heading-2', 'heading-3', 'clean-block', 'horizontal-rule'],
            showIcons: ['strikethrough', 'code', 'table', 'redo', 'heading', 'undo', 'heading-bigger', 'heading-smaller', 'clean-block', 'horizontal-rule'],
            element: document.getElementById('easymde-area'),
            initialValue: '',
            //TODO: insertTexts (horizontalRule, link, IMAGE, table) customize how buttons that insert text behave
            //<img src="" width="" heigth=""> instead of ![](https://)
            uploadImage: true,
            imageMaxSize: "4000x4000x2",
            imageAccept: "image/png, image/jpg",
        });
    </script>
@endauth

@endsection
