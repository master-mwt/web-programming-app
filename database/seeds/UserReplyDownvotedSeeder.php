<?php

use Illuminate\Database\Seeder;

class UserReplyDownvotedSeeder extends Seeder
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

        factory(App\UserReplyDownvoted::class, 300)->make()->each(function($user_reply_downvoted) {

            global $results;

            $block = [
                'user_id' => $user_reply_downvoted->user_id,
                'reply_id' => $user_reply_downvoted->reply_id,
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
            $reply->downvote = $reply->downvote + 1;
            $reply->save();

            App\UserReplyDownvoted::create($result);
        }
    }
}
