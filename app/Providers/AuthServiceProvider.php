<?php

namespace App\Providers;

use App\Channel;
use App\Comment;
use App\Policies\ChannelPolicy;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use App\Policies\ReplyPolicy;
use App\Policies\UserPolicy;
use App\Post;
use App\Reply;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Reply::class => ReplyPolicy::class,
        Comment::class => CommentPolicy::class,
        Channel::class => ChannelPolicy::class,
        User::class => UserPolicy::class,
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
