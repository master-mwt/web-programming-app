<?php

use Illuminate\Database\Seeder;

class UserReplyUpvotedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        global $results;
        $results = [];

        factory(App\UserReplyUpvoted::class, 300)->make()->each(function($user_reply_upvoted) {

            global $results;

            $block = [
                'user_id' => $user_reply_upvoted->user_id,
                'reply_id' => $user_reply_upvoted->reply_id,
            ];

            if(empty($results)) {
                array_push($results, $block);
            }

            $guard = false;
            foreach($results as $elem) {
                if($elem !== $block && $guard == false) {
                    continue;
                } else {
                    $guard = true;
                    break;
                }
            }

            if($guard == false) {
                array_push($results, $block);
            }
        });

        foreach($results as $result) {
            $reply = App\Reply::find($result['reply_id']);
            $reply->upvote = $reply->upvote + 1;
            $reply->save();

            App\UserReplyUpvoted::create($result);
        }
    }
}
