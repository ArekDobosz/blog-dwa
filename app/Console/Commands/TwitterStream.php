<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use TwitterStreamingApi;

class TwitterStream extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get tweets';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // TwitterStreamingApi::publicStream()
        //     ->whenHears('#laravel', function(array $tweet) {
        //         echo "{$tweet['user']['screen_name']} tweeted {$tweet['text']} favorite count {$tweet['favorite_count']}";
        //     })
        //     ->startListening();

        TwitterStreamingApi::userStream()
            ->onEvent(function(array $event) {
                // if ($event['event'] === 'favorite') {
                    echo "Our tweet {$event['target_object']['text']} got favorited by {$event['source']['screen_name']}";
                // }
            })
            ->startListening();
    }
}
