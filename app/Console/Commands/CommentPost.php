<?php

namespace App\Console\Commands;

use App\Http\Controllers\PostController;
use Illuminate\Console\Command;

class CommentPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:comment {post_id} {user_id} {content}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comments post';

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
        $data = [
            'post_id' => $this->argument('post_id'),
            'user_id' => $this->argument('user_id'),
            'content' => $this->argument('content'),
        ];
        PostController::comment($data);
    }
}
