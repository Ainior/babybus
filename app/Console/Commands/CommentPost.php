<?php

namespace App\Console\Commands;

use App\Model\Comments;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($data, [
            'post_id' => 'required|exists:App\Model\Post,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            echo $errors->first();
        } else {
            $comment = new Comments();
            $comment->fill($data);
            if ($comment->save()) {
                echo 'success:' . $data['content'];
            } else {
                echo 'comments fail!';
            }
        }
    }
}
