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
                        <a href="" class="text-decoration-none mr-2"><i class="fas fa-crown mr-1"></i>Give Award</a>
                        <a href="" class="text-decoration-none mr-2"><i class="fas fa-bookmark mr-1"></i>Save</a>
                        <a href="" class="text-decoration-none mr-2"><i class="fas fa-ban mr-1"></i>Hide</a>
                        <a href="" class="text-decoration-none"><i class="fas fa-flag mr-1"></i>Report</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 text-center px-0 mb-3" style="max-width: 800px">
            <button class="btn btn-success btn-block" data-toggle="modal" data-target="#easymde-modal">Make a Comment</button>
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
                        <a href="" class="text-decoration-none mr-2" data-toggle="modal" data-target="#easymde-modal"><i class="fas fa-comment-alt mr-1"></i>Reply</a>
                        <a href="" class="text-decoration-none mr-2"><i class="fas fa-crown mr-1"></i>Give Award</a>
                        <a href="" class="text-decoration-none mr-2"><i class="fas fa-bookmark mr-1"></i>Save</a>
                        <a href="" class="text-decoration-none"><i class="fas fa-flag mr-1"></i>Report</a>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $replies->links() }}
        </div>
        
        <h1 class="text-center bg-primary p-2 mb-3 rounded">GENERALIZED TREE STRUCTURE PROTOTYPE</h1>

        <div class="col-md-12 text-center infinite-scroll px-0">
            <!-- Reply-to-Post card -->
            <div class="card bg-dark col-lg-10 mx-auto d-flex flex-row px-0" style="max-width: 800px">
                <div class="rounded-left py-3 d-flex flex-column" style="flex: 0 0 50px">
                    <a href="" class=""><i class="fas fa-arrow-up mb-1"></i></a>
                    <span class="my-1">1</span>
                    <a href="" class=""><i class="fas fa-arrow-down"></i></a>
                </div>
                <div class="w-100">
                    <div class="card-header text-left bg-transparent border-0 px-3 py-1">
                        <p class="m-0">
                            <span class="text-muted">Posted by </span>
                            <a href="" class="text-decoration-none">
                            $reply->user_id->name</a>
                        </p>
                    </div>
                    <div class="card-body text-left px-3 py-1">
                        <p class="m-0">$reply->content</p>
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
                            <span class="my-1">1</span>
                            <a href="" class=""><i class="fas fa-arrow-down"></i></a>
                        </div>
                        <div class="w-100">
                            <div class="card-header text-left bg-transparent border-0 px-3 py-1">
                                <p class="m-0">
                                    <span class="text-muted">Posted by </span>
                                    <a href="" class="text-decoration-none">
                                    $reply->user_id->name</a>
                                </p>
                            </div>
                            <div class="card-body text-left px-3 py-1">
                                <p class="m-0">$reply->content</p>
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

<div class="modal fade" id="easymde-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="easymde-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title ml-auto" id="easymde-modal-label">make a comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea name="" id="easymde-area" cols="" rows=""></textarea>
            </div>
            <div class="modal-footer">
                <!-- <button class="btn btn-primary" data-dismiss="modal">close</button> -->
                <button class="btn btn-secondary">submit</button>
            </div>
        </div>
    </div>
</div>

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

@endsection
